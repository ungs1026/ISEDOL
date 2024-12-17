<?php
include("../../pdo-dbconfig.php");

$songId = (isset($_POST['songId']) && $_POST['songId'] != '' && is_numeric($_POST['songId'])) ? $_POST['songId'] : '';

if($songId != '') {
	$query = 'update songs set plays = plays + 1 where id=:id';
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(':id', $songId);
	$stmt->execute();
}
?>