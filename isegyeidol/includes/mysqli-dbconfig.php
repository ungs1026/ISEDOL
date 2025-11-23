<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "", "isegyeidol", 3307);
	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}
?>