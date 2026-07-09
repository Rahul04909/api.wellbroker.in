<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenvLoaded = false;

function loadEnvironment(): void
{
    global $dotenvLoaded;

    if ($dotenvLoaded) {
        return;
    }

    $envPath = __DIR__ . '/..';
    $envFile = $envPath . '/.env';

    if (!file_exists($envFile)) {
        throw new RuntimeException('.env file not found. Copy .env.example to .env and configure your settings.');
    }

    try {
        $dotenv = Dotenv\Dotenv::createImmutable($envPath);
        $dotenv->load();
        $dotenvLoaded = true;
    } catch (Exception $e) {
        throw new RuntimeException('Failed to load .env file: ' . $e->getMessage());
    }
}

function getDbConnection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        loadEnvironment();

        $required = ['DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'];
        foreach ($required as $key) {
            if (empty($_ENV[$key])) {
                throw new RuntimeException("Missing required environment variable: {$key}");
            }
        }

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'] ?? '';
        $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
        ]);
    }

    return $pdo;
}
