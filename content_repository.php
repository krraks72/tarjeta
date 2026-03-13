<?php
require_once __DIR__ . '/conexion.php';

function fetch_page_content(mysqli $mysqli, string $page): array
{
    $stmt = $mysqli->prepare('SELECT content_key, content_value FROM site_content WHERE page_name = ?');
    $stmt->bind_param('s', $page);
    $stmt->execute();
    $result = $stmt->get_result();

    $content = [];
    while ($row = $result->fetch_assoc()) {
        $content[$row['content_key']] = $row['content_value'];
    }

    $stmt->close();
    return $content;
}

function content_value(array $content, string $key, string $default = ''): string
{
    return isset($content[$key]) && $content[$key] !== '' ? $content[$key] : $default;
}

function content_json(array $content, string $key, array $default = []): array
{
    if (!isset($content[$key]) || $content[$key] === '') {
        return $default;
    }

    $decoded = json_decode($content[$key], true);
    return is_array($decoded) ? $decoded : $default;
}

function gallery_images_from_repository(array $content): array
{
    $baseDir = __DIR__ . '/assets/media/gallery/fotos';
    $files = glob($baseDir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
    if ($files === false) {
        return [];
    }

    natsort($files);
    $publicPaths = [];
    foreach ($files as $file) {
        $publicPaths[] = 'assets/media/gallery/fotos/' . basename($file);
    }

    $limit = (int) content_value($content, 'gallery_total_images', '0');
    if ($limit > 0) {
        return array_slice($publicPaths, 0, $limit);
    }

    return $publicPaths;
}
