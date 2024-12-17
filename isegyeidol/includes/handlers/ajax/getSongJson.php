<?php
include_once '../../pdo-dbconfig.php';

$songId = (isset($_POST['songId']) && $_POST['songId'] != '' && is_numeric($_POST['songId'])) ? $_POST['songId'] : '';

if($songId != '') {
	$songId = $_POST['songId'];

	$sql = 'select * from songs where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->bindParam(':id', $songId);
	$stmt->execute();
	echo json_encode($stmt->fetch());
}
?>