<?php
$host = 'localhost'; // 데이터베이스 호스트
$db = 'isegyeidol'; // 데이터베이스 이름
$user = 'root'; // 데이터베이스 사용자
$pass = ''; // 데이터베이스 비밀번호

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

if (!defined('DOCUMENT_ROOT')) {
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/isegyeidol');
}
if (!defined('ADMIN_DIR')) {
  define('ADMIN_DIR', DOCUMENT_ROOT . '/admin');
}
