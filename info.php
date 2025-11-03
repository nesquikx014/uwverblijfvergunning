<?php
// Set proper content type
header('Content-Type: text/html; charset=utf-8');

// Safe default and sanitization
$page = isset($_GET['page']) ? basename(trim($_GET['page']), '.php') : '';

// Whitelist of allowed pages
$allowed_pages = ['EUprocedure'];

// Validate the requested page
if (!in_array($page, $allowed_pages)) {
    http_response_code(404);
    echo 'Page not found';
    exit;
}

// Include the files with full path for clarity
include_once __DIR__ . '/header.php';
include_once __DIR__ . "/info/{$page}.php";
include_once __DIR__ . '/footer.php';
