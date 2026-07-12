<?php

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

function getMediaUrl(?string $path): ?string
{
    if (empty($path)) {
        return null;
    }

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    return "{$scheme}://{$host}{$path}";
}

function handleFileUpload(string $fileKey, string $subDir, array $allowedTypes = [], int $maxSize = 5242880): ?string
{
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $file = $_FILES[$fileKey];

    if (!empty($allowedTypes)) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            sendResponse(400, false, "Invalid file type for {$fileKey}. Allowed: " . implode(', ', $allowedTypes));
        }
    }

    if ($file['size'] > $maxSize) {
        $maxSizeMB = $maxSize / 1048576;
        sendResponse(400, false, "File {$fileKey} exceeds maximum size of {$maxSizeMB}MB");
    }

    $uploadDir = __DIR__ . '/../uploads/' . $subDir;

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            sendResponse(500, false, "Failed to create upload directory");
        }
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = bin2hex(random_bytes(16)) . '.' . $extension;
    $filepath = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        sendResponse(500, false, "Failed to upload {$fileKey}");
    }

    return '/uploads/' . $subDir . '/' . $filename;
}

function handleMultipleFileUpload(string $fileKey, string $subDir, array $allowedTypes = [], int $maxSize = 5242880): array
{
    $uploadedPaths = [];

    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'][0] !== UPLOAD_ERR_OK) {
        return $uploadedPaths;
    }

    $files = $_FILES[$fileKey];
    $fileCount = count($files['name']);

    $uploadDir = __DIR__ . '/../uploads/' . $subDir;

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            sendResponse(500, false, "Failed to create upload directory");
        }
    }

    for ($i = 0; $i < $fileCount; $i++) {
        if ($files['error'][$i] !== UPLOAD_ERR_OK) {
            continue;
        }

        if (!empty($allowedTypes)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $files['tmp_name'][$i]);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedTypes)) {
                continue;
            }
        }

        if ($files['size'][$i] > $maxSize) {
            continue;
        }

        $extension = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $filepath = $uploadDir . '/' . $filename;

        if (move_uploaded_file($files['tmp_name'][$i], $filepath)) {
            $uploadedPaths[] = '/uploads/' . $subDir . '/' . $filename;
        }
    }

    return $uploadedPaths;
}

function getCategoryFields(string $category): array
{
    $fields = [
        'agent_broker' => ['rera_number', 'property_types', 'buy_sell_rent', 'years_of_experience'],
        'builder_developer' => ['rera_registration', 'company_registration_no', 'total_projects', 'ongoing_projects', 'completed_projects'],
        'architect' => ['coa_registration_number', 'qualification', 'design_style', 'portfolio'],
        'interior_decorator' => ['specialization', 'portfolio_images', 'design_style', 'minimum_project_budget'],
        'building_contractor' => ['contractor_license', 'team_size', 'services_offered', 'minimum_project_value'],
        'vaastu_consultant' => ['certification', 'consultation_type', 'languages'],
        'home_inspection' => ['inspection_types', 'certifications', 'equipment_details'],
        'property_consultant' => ['specialization', 'commercial_residential', 'investment_consulting'],
    ];

    return $fields[$category] ?? [];
}

function getCategoryLabel(string $category): string
{
    $labels = [
        'agent_broker' => 'Agents / Brokers',
        'builder_developer' => 'Builders / Developers',
        'architect' => 'Architects',
        'interior_decorator' => 'Interior Decorators',
        'building_contractor' => 'Building Contractors',
        'vaastu_consultant' => 'Vaastu Consultants',
        'home_inspection' => 'Home Inspection',
        'property_consultant' => 'Property Consultants',
    ];

    return $labels[$category] ?? $category;
}

function getCategories(): array
{
    return [
        'agent_broker' => 'Agents / Brokers',
        'builder_developer' => 'Builders / Developers',
        'architect' => 'Architects',
        'interior_decorator' => 'Interior Decorators',
        'building_contractor' => 'Building Contractors',
        'vaastu_consultant' => 'Vaastu Consultants',
        'home_inspection' => 'Home Inspection',
        'property_consultant' => 'Property Consultants',
    ];
}
