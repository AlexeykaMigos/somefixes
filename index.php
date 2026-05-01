<?php

error_reporting(E_ALL & ~E_DEPRECATED);

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$host = $_SERVER['HTTP_HOST'] ?? '';

// Handle v2 route
if ($uri === '/v2' || str_starts_with($uri, '/v2/')) {
    $path = ($uri === '/v2') ? '' : substr($uri, strlen('/v2/'));
    $targetFile = __DIR__ . '/v2/' . ($path ?: 'index.html');
    if (is_file($targetFile)) {
        $ext = pathinfo($targetFile, PATHINFO_EXTENSION);
        $mimes = ['js'=>'application/javascript','css'=>'text/css','png'=>'image/png','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','gif'=>'image/gif','svg'=>'image/svg+xml','ico'=>'image/x-icon','html'=>'text/html'];
        if (isset($mimes[$ext])) header('Content-Type: '.$mimes[$ext]);
        readfile($targetFile); exit;
    }
    header('Content-Type: text/html');
    readfile(__DIR__ . '/v2/index.html'); exit;
}

// Handle old-version-v1 route
if ($uri === '/old-version-v1' || str_starts_with($uri, '/old-version-v1/')) {
    $path = ($uri === '/old-version-v1') ? '' : substr($uri, strlen('/old-version-v1/'));
    $targetFile = __DIR__ . '/old-version-v1/' . ($path ?: 'index.html');
    if (is_file($targetFile)) {
        $ext = pathinfo($targetFile, PATHINFO_EXTENSION);
        $mimes = ['js'=>'application/javascript','css'=>'text/css','png'=>'image/png','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','gif'=>'image/gif','svg'=>'image/svg+xml','ico'=>'image/x-icon','html'=>'text/html'];
        if (isset($mimes[$ext])) header('Content-Type: '.$mimes[$ext]);
        readfile($targetFile); exit;
    }
    header('Content-Type: text/html');
    readfile(__DIR__ . '/old-version-v1/index.html'); exit;
}

// Handle upimax.com domains
if (strpos($host, 'upimax.com') !== false || strpos($host, 'upimax.ru') !== false) {
    if (!str_starts_with($uri, '/wp-json') && !str_starts_with($uri, '/admin') && !str_starts_with($uri, '/api') && !str_starts_with($uri, '/cms')) {
        $path = ltrim($uri, '/');
        $targetFile = __DIR__ . '/old-version/' . ($path ?: 'index.html');
        if (is_file($targetFile)) {
            $ext = pathinfo($targetFile, PATHINFO_EXTENSION);
            $mimes = ['js'=>'application/javascript','css'=>'text/css','png'=>'image/png','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','gif'=>'image/gif','svg'=>'image/svg+xml','ico'=>'image/x-icon','html'=>'text/html'];
            if (isset($mimes[$ext])) header('Content-Type: '.$mimes[$ext]);
            readfile($targetFile); exit;
        }
        header('Content-Type: text/html');
        readfile(__DIR__ . '/old-version/index.html'); exit;
    }
}

use Illuminate\Http\Request;
define('LARAVEL_START', microtime(true));
if (file_exists($maintenance = __DIR__.'/app_storage/framework/maintenance.php')) require $maintenance;
require __DIR__.'/vendor/autoload.php';
(require_once __DIR__.'/bootstrap/app.php')->handleRequest(Request::capture());
