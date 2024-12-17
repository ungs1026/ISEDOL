<?php
include_once '../../pdo-dbconfig.php';

if(isset($_POST['albumId'])) {
	$albumId = $_POST['albumId'];

	$sql = 'select * from albums where id=:id';
	$stmt = $pdo->prepare($sql);
	$params = ['id' => $albumId];
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute($params);
	echo json_encode($stmt->fetch());
}
?>
