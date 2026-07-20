<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/jwt.php';
require_once __DIR__ . '/../config/helpers.php';

function getInput(string $key, $default = null)
{
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    if (str_contains($contentType, 'application/json')) {
        static $jsonInput = null;
        if ($jsonInput === null) {
            $jsonInput = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                sendResponse(400, false, 'Invalid JSON payload');
            }
        }
        return $jsonInput[$key] ?? $default;
    }

    return $_POST[$key] ?? $default;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendResponse(405, false, 'Only POST method is allowed');
    }

    $requiredFields = ['name', 'email', 'mobile', 'password', 'state', 'city', 'locality', 'whatsapp_number', 'category'];
    $errors = [];

    foreach ($requiredFields as $field) {
        $value = trim(getInput($field, ''));
        if (empty($value)) {
            $label = ucfirst(str_replace('_', ' ', $field));
            $errors[] = "{$label} is required";
        }
    }

    if (!empty($errors)) {
        sendResponse(422, false, 'Validation failed', ['errors' => $errors]);
    }

    $name = trim(getInput('name'));
    $email = trim(getInput('email'));
    $mobile = trim(getInput('mobile'));
    $password = getInput('password');
    $state = trim(getInput('state'));
    $city = trim(getInput('city'));
    $locality = trim(getInput('locality'));
    $whatsappNumber = trim(getInput('whatsapp_number'));
    $category = trim(getInput('category'));
    $subCategory = trim(getInput('sub_category', ''));

    if (!array_key_exists($category, getCategories())) {
        sendResponse(422, false, 'Invalid category. Allowed: ' . implode(', ', array_keys(getCategories())));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendResponse(422, false, 'Invalid email format');
    }

    if (function_exists('checkdnsrr')) {
        $domain = substr(strrchr($email, '@'), 1);
        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            sendResponse(422, false, 'Email domain does not exist');
        }
    }

    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        sendResponse(422, false, 'Invalid mobile number. Must be a valid 10-digit Indian mobile number starting with 6-9');
    }

    if (strlen($password) < 8) {
        sendResponse(422, false, 'Password must be at least 8 characters long');
    }
    if (!preg_match('/[A-Z]/', $password)) {
        sendResponse(422, false, 'Password must contain at least one uppercase letter');
    }
    if (!preg_match('/[a-z]/', $password)) {
        sendResponse(422, false, 'Password must contain at least one lowercase letter');
    }
    if (!preg_match('/[0-9]/', $password)) {
        sendResponse(422, false, 'Password must contain at least one digit');
    }
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>_\-]/', $password)) {
        sendResponse(422, false, 'Password must contain at least one special character');
    }

    if (!preg_match('/^[6-9]\d{9}$/', $whatsappNumber)) {
        sendResponse(422, false, 'Invalid WhatsApp number. Must be a valid 10-digit Indian mobile number starting with 6-9');
    }

    $pdo = getDbConnection();

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetch()) {
        sendResponse(409, false, 'An account with this email already exists');
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE mobile = :mobile LIMIT 1");
    $stmt->execute([':mobile' => $mobile]);
    if ($stmt->fetch()) {
        sendResponse(409, false, 'An account with this mobile number already exists');
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $stmt = $pdo->prepare(
        "INSERT INTO users (
            name, email, mobile, password,
            state, city, locality, whatsapp_number,
            category, sub_category,
            status, mobile_verified, email_verified, created_at, updated_at
        ) VALUES (
            :name, :email, :mobile, :password,
            :state, :city, :locality, :whatsapp_number,
            :category, :sub_category,
            1, 0, 0, NOW(), NOW()
        )"
    );

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':mobile' => $mobile,
        ':password' => $hashedPassword,
        ':state' => $state,
        ':city' => $city,
        ':locality' => $locality,
        ':whatsapp_number' => $whatsappNumber,
        ':category' => $category,
        ':sub_category' => $subCategory ?: null,
    ]);

    $userId = (int) $pdo->lastInsertId();

    $tokenPayload = [
        'sub' => $userId,
        'email' => $email,
        'name' => $name,
        'role' => 'user',
    ];

    $token = generateJwtToken($tokenPayload);
    $refreshToken = generateRefreshToken();

    sendResponse(201, true, 'Registration successful', [
        'token' => $token,
        'token_type' => 'Bearer',
        'expires_in' => (int) ($_ENV['JWT_EXPIRY'] ?? 3600),
        'refresh_token' => $refreshToken,
        'user' => [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'category' => $category,
            'category_label' => getCategoryLabel($category),
            'sub_category' => $subCategory ?: null,
            'created_at' => date('Y-m-d H:i:s'),
        ],
    ]);

} catch (Throwable $e) {
    error_log('[Wellbroker API Error] ' . get_class($e) . ': ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    $message = 'Internal server error';
    if ($e instanceof PDOException) {
        $message = 'Database connection failed. Please try again later.';
    } elseif ($e instanceof RuntimeException) {
        $message = $e->getMessage();
    }
    sendResponse(500, false, $message);
}
