<?php
	include('includes/pdo-dbconfig.php');
	session_start();

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
?>