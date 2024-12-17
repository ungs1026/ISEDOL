<?php
include_once '../../pdo-dbconfig.php';

if(isset($_POST['artistId'])) {
	$artistId = $_POST['artistId'];

	$sql = 'select * from artists where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->bindParam(':id', $artistId);
	$stmt->execute();
	echo json_encode($stmt->fetch());
}
?>