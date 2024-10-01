<?php
include('includes/pdo-dbconfig.php');
if (session_status() === PHP_SESSION_NONE) {
	// 세션이 시작되지 않은 상태
	session_start(); // 세션 시작
} 

$userId = isset($_SESSION['userId']) && $_SESSION['userId'] != '' ? $_SESSION['userId'] : '';
$query = "select * from users where id=$userId";
try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo 'Failed : ' . $e->getMessage();
	$user = 'null object';
}
