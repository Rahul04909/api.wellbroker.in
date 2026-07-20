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

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendResponse(405, false, 'Only POST method is allowed');
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        sendResponse(400, false, 'Invalid JSON payload');
    }

    $loginId = trim($input['email'] ?? $input['mobile'] ?? '');
    $password = $input['password'] ?? '';

    if (empty($loginId)) {
        sendResponse(400, false, 'Email or mobile number is required');
    }

    if (empty($password)) {
        sendResponse(400, false, 'Password is required');
    }

    // Auto-detect: valid email → login by email, otherwise try mobile
    $isEmail = filter_var($loginId, FILTER_VALIDATE_EMAIL);

    if ($isEmail) {
        $field = 'email';
    } else {
        // Validate mobile format before querying
        if (!preg_match('/^[6-9]\d{9}$/', $loginId)) {
            sendResponse(400, false, 'Invalid email or mobile number format');
        }
        $field = 'mobile';
    }

    $pdo = getDbConnection();

    $stmt = $pdo->prepare(
        "SELECT id, name, email, mobile, password, state, city, locality, whatsapp_number,
                category, sub_category, mobile_verified, email_verified, status, created_at
         FROM users
         WHERE {$field} = :loginId
         LIMIT 1"
    );
    $stmt->execute([':loginId' => $loginId]);
    $user = $stmt->fetch();

    if (!$user) {
        sendResponse(401, false, 'Invalid credentials');
    }

    if ((int) $user['status'] !== 1) {
        sendResponse(403, false, 'Account is deactivated. Contact administrator.');
    }

    if (!password_verify($password, $user['password'])) {
        sendResponse(401, false, 'Invalid credentials');
    }

    $tokenPayload = [
        'sub' => (int) $user['id'],
        'email' => $user['email'],
        'name' => $user['name'],
        'role' => 'user',
        'category' => $user['category'],
    ];

    $token = generateJwtToken($tokenPayload);
    $refreshToken = generateRefreshToken();

    sendResponse(200, true, 'Login successful', [
        'token' => $token,
        'token_type' => 'Bearer',
        'expires_in' => (int) ($_ENV['JWT_EXPIRY'] ?? 3600),
        'refresh_token' => $refreshToken,
        'user' => [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'mobile' => $user['mobile'],
            'state' => $user['state'],
            'city' => $user['city'],
            'locality' => $user['locality'],
            'whatsapp_number' => $user['whatsapp_number'],
            'category' => $user['category'],
            'category_label' => getCategoryLabel($user['category']),
            'sub_category' => $user['sub_category'],
            'mobile_verified' => (bool) $user['mobile_verified'],
            'email_verified' => (bool) $user['email_verified'],
            'created_at' => $user['created_at'],
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
