<?php
include("../../mysqli-dbconfig.php");

if(isset($_POST['songId'])) {
	$songId = $_POST['songId'];

	$query = mysqli_query($con, "UPDATE song SET plays = plays + 1 WHERE id='$songId'");
}
?>