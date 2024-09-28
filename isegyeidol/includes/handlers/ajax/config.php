<?php
	ob_start();

	$timezone = date_default_timezone_set("Asia/Seoul");
	$con = mysqli_connect("localhost", "root", "", "isegyeidol");
	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}
?>