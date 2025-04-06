<?php
// 사이트 기본 설정
define('SITE_NAME', '바로크 동방 예약');

// 데이터베이스 연결
$host = 'localhost';
$user = 'root';
$password = '1111';
$database = 'baroque';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

// UTF-8 설정
mysqli_set_charset($conn, "utf8");
?>
