<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include('includes/mysqli-dbconfig.php');
	include("includes/classes/Artist.php");
	include("includes/classes/Album.php");
	include("includes/classes/Song.php");
}	
else {
	include("includes/part/header.php");
	include("includes/part/footer.php");
	exit();
}
?>