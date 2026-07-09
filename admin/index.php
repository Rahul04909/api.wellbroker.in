<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

function sendResponse(int $statusCode, bool $success, string $message, array $data = []): void
{
    http_response_code($statusCode);
    echo json_encode([
        'status' => $success,
        'message' => $message,
        'data' => $data,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function getProfilePictureUrl(?string $path): ?string
{
    if (empty($path)) {
        return null;
    }

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    return "{$scheme}://{$host}{$path}";
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendResponse(405, false, 'Only POST method is allowed');
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        sendResponse(400, false, 'Invalid JSON payload');
    }

    $loginId = trim($input['email'] ?? $input['username'] ?? '');
    $password = $input['password'] ?? '';

    if (empty($loginId) || empty($password)) {
        sendResponse(400, false, 'Email/Username and password are required');
    }

    $field = 'email';

    if (filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
        $field = 'email';
    } else {
        $field = 'username';

        if (strlen($loginId) < 3 || strlen($loginId) > 100) {
            sendResponse(400, false, 'Username must be between 3 and 100 characters');
        }

        if (!preg_match('/^[a-zA-Z0-9._-]+$/', $loginId)) {
            sendResponse(400, false, 'Username can only contain letters, numbers, dots, hyphens, and underscores');
        }
    }

    $pdo = getDbConnection();
    $stmt = $pdo->prepare(
        "SELECT id, name, email, username, mobile, profile_picture, password, status, created_at
         FROM admins
         WHERE {$field} = :loginId
         LIMIT 1"
    );
    $stmt->execute([':loginId' => $loginId]);
    $admin = $stmt->fetch();

    if (!$admin) {
        sendResponse(401, false, 'Invalid credentials');
    }

    if ((int) $admin['status'] !== 1) {
        sendResponse(403, false, 'Account is deactivated. Contact administrator.');
    }

    if (!password_verify($password, $admin['password'])) {
        sendResponse(401, false, 'Invalid credentials');
    }

    $tokenPayload = [
        'sub' => (int) $admin['id'],
        'email' => $admin['email'],
        'username' => $admin['username'],
        'name' => $admin['name'],
        'role' => 'admin',
    ];

    $token = generateJwtToken($tokenPayload);
    $refreshToken = generateRefreshToken();

    sendResponse(200, true, 'Login successful', [
        'token' => $token,
        'token_type' => 'Bearer',
        'expires_in' => (int) ($_ENV['JWT_EXPIRY'] ?? 3600),
        'refresh_token' => $refreshToken,
        'user' => [
            'id' => (int) $admin['id'],
            'name' => $admin['name'],
            'email' => $admin['email'],
            'username' => $admin['username'],
            'mobile' => $admin['mobile'],
            'profile_picture' => getProfilePictureUrl($admin['profile_picture']),
            'created_at' => $admin['created_at'],
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
