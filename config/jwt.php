<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJwtSecret(): string
{
    loadEnvironment();
    $secret = $_ENV['JWT_SECRET'] ?? null;

    if (empty($secret)) {
        throw new RuntimeException('JWT_SECRET is not configured in .env file');
    }

    if (strlen($secret) < 32) {
        throw new RuntimeException('JWT_SECRET must be at least 32 characters long');
    }

    return $secret;
}

function generateJwtToken(array $payload): string
{
    $secretKey = getJwtSecret();
    $issuer = $_ENV['JWT_ISSUER'] ?? 'wellbroker-api';
    $expiry = (int) ($_ENV['JWT_EXPIRY'] ?? 3600);
    $algorithm = $_ENV['JWT_ALGORITHM'] ?? 'HS256';

    $issuedAt = time();

    $payload['iss'] = $issuer;
    $payload['aud'] = $issuer;
    $payload['iat'] = $issuedAt;
    $payload['nbf'] = $issuedAt;
    $payload['exp'] = $issuedAt + $expiry;
    $payload['jti'] = bin2hex(random_bytes(16));

    return JWT::encode($payload, $secretKey, $algorithm);
}

function generateRefreshToken(): string
{
    return bin2hex(random_bytes(32));
}

function validateJwtToken(string $token): object
{
    $secretKey = getJwtSecret();
    $issuer = $_ENV['JWT_ISSUER'] ?? 'wellbroker-api';
    $algorithm = $_ENV['JWT_ALGORITHM'] ?? 'HS256';

    $headers = new stdClass();
    $decoded = JWT::decode($token, new Key($secretKey, $algorithm), $headers);

    if (!isset($decoded->iss) || $decoded->iss !== $issuer) {
        throw new UnexpectedValueException('Invalid token issuer');
    }

    if (!isset($decoded->aud) || $decoded->aud !== $issuer) {
        throw new UnexpectedValueException('Invalid token audience');
    }

    if (!isset($decoded->jti)) {
        throw new UnexpectedValueException('Invalid token: missing jti');
    }

    return $decoded;
}
