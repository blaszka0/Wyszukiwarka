<?php
declare(strict_types=1);

require_once __DIR__ . '/data.php';

$uri = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?? '/';
$uri = rawurldecode($uri);

$base = base_path();
if ($base !== '' && ($uri === $base || str_starts_with($uri, $base . '/'))) {
    $uri = $uri === $base ? '/' : substr($uri, strlen($base));
}
if ($uri === '') {
    $uri = '/';
}

$staticFile = __DIR__ . $uri;
if ($uri !== '/' && is_file($staticFile) && !str_ends_with(strtolower($staticFile), '.php')) {
    return false;
}

if (preg_match('#^/archons/[^/]+/?$#', $uri)) {
    require __DIR__ . '/details-of-archons.php';
    return true;
}

if (preg_match('#^/archons/?$#', $uri)) {
    require __DIR__ . '/archons.php';
    return true;
}

if (preg_match('#^/compare/[^/]+/[^/]+/?$#', $uri)
    || preg_match('#^/compare/?$#', $uri)
    || preg_match('#^/compare-archons\.php$#', $uri)) {
    require __DIR__ . '/compare-archons.php';
    return true;
}

if ($uri === '/' || $uri === '/index.php') {
    require __DIR__ . '/index.php';
    return true;
}

http_response_code(404);
header('Content-Type: text/plain; charset=UTF-8');
echo 'Not found';
return true;
