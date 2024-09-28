<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];

	$result = $account->login($username, $password);

	$con = mysqli_connect("localhost", "root", "", "isegyeidol");
	$sql = "select * from users where username='$username'";
	$result1 = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result1);

	if($result == true) {
			$id = $row[0]['id'];
			$_SESSION['userId'] = $id;
			header("Location: main.php");
	}
}
?>