<?php
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 간단한 라우팅
switch ($request) {
    case '/':
    case '/index':
        require __DIR__ . '/views/home.php';
        break;

    case '/booking':
        require __DIR__ . '/views/booking.php';
        break;

    case '/api/reserve':
        require __DIR__ . '/api/reserve.php';
        break;
    case '/api/reserve-cancel':
        require __DIR__ . '/api/reserve_cancel.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}