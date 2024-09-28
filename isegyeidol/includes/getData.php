<?php
function getData($pdo, $id)
{
	// $connection = DB Connection
	// $id = data id

	$query = "select * from goods where id=$id";

	try {
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$rs = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Failed : ' . $e->getMessage();
		$rs = 'null object';
	}
	return $rs;
}
