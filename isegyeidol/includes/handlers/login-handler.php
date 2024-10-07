<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];

	$result = $account->login($username, $password);

	$con = mysqli_connect("localhost", "root", "", "isegyeidol");
	$sql = "select * from users where username='$username'";
	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($res);

	if($result == true) {
		if(is_numeric($row[0]['id'])){
			$_SESSION['userId'] = $row[0]['id'];
			header("Location: main.php");
		}
	}
}
?>