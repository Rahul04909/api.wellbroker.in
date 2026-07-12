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

    // ===== COMMON FIELD VALIDATION =====
    $requiredFields = ['full_name', 'mobile', 'email', 'password', 'state', 'city', 'address', 'pincode', 'category'];
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

    $fullName = trim(getInput('full_name'));
    $companyName = trim(getInput('company_name', ''));
    $mobile = trim(getInput('mobile'));
    $email = trim(getInput('email'));
    $password = getInput('password');
    $state = trim(getInput('state'));
    $city = trim(getInput('city'));
    $address = trim(getInput('address'));
    $pincode = trim(getInput('pincode'));
    $category = getInput('category');
    $subCategory = trim(getInput('sub_category', ''));
    $experience = trim(getInput('experience', ''));
    $aboutBusiness = trim(getInput('about_business', ''));
    $serviceAreasInput = getInput('service_areas', '');
    $website = trim(getInput('website', ''));
    $whatsappNumber = trim(getInput('whatsapp_number', ''));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendResponse(422, false, 'Invalid email format');
    }

    // Validate email domain exists (skip check if DNS functions unavailable on Windows)
    if (function_exists('checkdnsrr')) {
        $domain = substr(strrchr($email, '@'), 1);
        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            sendResponse(422, false, 'Email domain does not exist');
        }
    }

    // Validate Indian mobile number (10 digits starting with 6-9)
    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        sendResponse(422, false, 'Invalid mobile number. Must be a valid 10-digit Indian mobile number starting with 6-9');
    }

    // Password policy: minimum 8 chars, uppercase, lowercase, digit, special char
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

    // Validate category
    $validCategories = array_keys(getCategories());
    if (!in_array($category, $validCategories)) {
        sendResponse(422, false, 'Invalid category. Must be one of: ' . implode(', ', $validCategories));
    }

    // Validate pincode
    if (!preg_match('/^\d{6}$/', $pincode)) {
        sendResponse(422, false, 'Invalid pincode. Must be a 6-digit number');
    }

    // Validate website URL if provided
    if (!empty($website)) {
        if (!preg_match('/^https?:\/\/.+/', $website)) {
            $website = 'https://' . $website;
        }
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            sendResponse(422, false, 'Invalid website URL');
        }
    }

    // Validate WhatsApp number if provided
    if (!empty($whatsappNumber)) {
        $cleanWhatsApp = preg_replace('/[^0-9]/', '', $whatsappNumber);
        if (strlen($cleanWhatsApp) < 10 || strlen($cleanWhatsApp) > 15) {
            sendResponse(422, false, 'Invalid WhatsApp number');
        }
    }

    $pdo = getDbConnection();

    // Check duplicate email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetch()) {
        sendResponse(409, false, 'An account with this email already exists');
    }

    // Check duplicate mobile
    $stmt = $pdo->prepare("SELECT id FROM users WHERE mobile = :mobile LIMIT 1");
    $stmt->execute([':mobile' => $mobile]);
    if ($stmt->fetch()) {
        sendResponse(409, false, 'An account with this mobile number already exists');
    }

    // ===== FILE UPLOADS =====
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $allowedDocTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];

    $profilePhoto = handleFileUpload('profile_photo', 'profiles', $allowedImageTypes);
    $logo = handleFileUpload('logo', 'logos', $allowedImageTypes);
    $portfolioImages = [];

    // Handle portfolio images for Architects and Interior Decorators
    if (in_array($category, ['architect', 'interior_decorator'])) {
        $portfolioImages = handleMultipleFileUpload('portfolio_images', 'portfolios', $allowedImageTypes);
    }

    // ===== BUILD EXTRA FIELDS (Category-Specific) =====
    $extraFields = [];
    $categoryFieldNames = getCategoryFields($category);

    foreach ($categoryFieldNames as $fieldName) {
        $value = getInput($fieldName);

        if ($value !== null && $value !== '') {
            // Try to decode JSON strings for array fields
            $decoded = json_decode($value, true);
            $extraFields[$fieldName] = ($decoded !== null) ? $decoded : $value;
        }
    }

    // Attach portfolio image paths to extra_fields for architects/interior decorators
    if (!empty($portfolioImages)) {
        $extraFields['portfolio_images'] = $portfolioImages;
    }

    // ===== SERVICE AREAS (JSON array) =====
    $serviceAreasJson = null;
    if (!empty($serviceAreasInput)) {
        $decoded = json_decode($serviceAreasInput, true);
        if ($decoded !== null && is_array($decoded)) {
            $serviceAreasJson = json_encode($decoded);
        } else {
            $serviceAreasJson = json_encode([$serviceAreasInput]);
        }
    }

    // ===== HASH PASSWORD (bcrypt, cost 12) =====
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // ===== INSERT USER =====
    $stmt = $pdo->prepare(
        "INSERT INTO users (
            full_name, company_name, mobile, email, password,
            state, city, address, pincode, category, sub_category,
            profile_photo, logo, experience, about_business,
            service_areas, website, whatsapp_number, extra_fields,
            status, mobile_verified, email_verified, created_at, updated_at
        ) VALUES (
            :full_name, :company_name, :mobile, :email, :password,
            :state, :city, :address, :pincode, :category, :sub_category,
            :profile_photo, :logo, :experience, :about_business,
            :service_areas, :website, :whatsapp_number, :extra_fields,
            1, 0, 0, NOW(), NOW()
        )"
    );

    $stmt->execute([
        ':full_name' => $fullName,
        ':company_name' => $companyName ?: null,
        ':mobile' => $mobile,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':state' => $state,
        ':city' => $city,
        ':address' => $address,
        ':pincode' => $pincode,
        ':category' => $category,
        ':sub_category' => $subCategory ?: null,
        ':profile_photo' => $profilePhoto,
        ':logo' => $logo,
        ':experience' => $experience ?: null,
        ':about_business' => $aboutBusiness ?: null,
        ':service_areas' => $serviceAreasJson,
        ':website' => $website ?: null,
        ':whatsapp_number' => $whatsappNumber ?: null,
        ':extra_fields' => !empty($extraFields) ? json_encode($extraFields) : null,
    ]);

    $userId = (int) $pdo->lastInsertId();

    // ===== GENERATE JWT TOKEN =====
    $tokenPayload = [
        'sub' => $userId,
        'email' => $email,
        'name' => $fullName,
        'role' => 'user',
        'category' => $category,
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
            'full_name' => $fullName,
            'company_name' => $companyName ?: null,
            'email' => $email,
            'mobile' => $mobile,
            'category' => $category,
            'category_label' => getCategoryLabel($category),
            'profile_photo' => getMediaUrl($profilePhoto),
            'logo' => getMediaUrl($logo),
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
