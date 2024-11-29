<?php
include $_SERVER['DOCUMENT_ROOT'] . '/isegyeidol/admin/includes/getUser.php';

$_SESSION['userLevel'] = $user['level'];

$userId = (isset($_SESSION['userId']) && $_SESSION['userId'] != '') ? $_SESSION['userId'] : '';
$userLevel = (isset($_SESSION['userLevel']) && $_SESSION['userLevel'] != '') ? $_SESSION['userLevel'] : '';

if ($userId == '' || $userLevel != 10) {
	die("
	<script>
		alert('관리자만 접근 가능합니다.');
		self.location.href='../main.php';
	</script>
	");
}

/* Array (
	[id] => 3
	[username] => jingburger
	[firstName] => Burger
	[lastName] => Jing
	[email] => Jingburger@gmail.com
	[password] => 4297f44b13955235245b2497399d7a93
	[signUpDate] => 2024-09-27 15:28:52
	[profilePic] => source/img/leaf.png
	[level] => 10
)*/

