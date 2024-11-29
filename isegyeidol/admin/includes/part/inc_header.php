<?php

?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= (isset($g_title) && $g_title != '' ? $g_title : 'Admin') ?></title>

	<link rel="icon" href="<?= $logo ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?= $logo ?>" type="image/x-icon" />

	<!-- Bootstrap CSS JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>

	<!-- sns icon css -->
	<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

	<!-- local css -->
	<link rel="stylesheet" href="<?= $commonC ?>">

	<?php
	if (isset($js_array)) {
		foreach ($js_array as $var) {
			echo '<script src="' . $var .'"></script>';
		}
	}

	if (isset($css_array)) {
		foreach ($css_array as $var) {
			echo '<link rel="stylesheet" href="' . $var . '">';
		}
	}
	?>
</head>

<body>
	<div class="container">
		<header class="d-flex p-5 flex-wrap justify-content-center align-items-center py-3 mb-5 border-bottom" style="left: 0;">
			<a href="admin.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
				<img src="<?= $logo ?>" alt="Logo" style="width: 2rem;" class="me-2">
				<span class="fs-4">Admin</span>
			</a>

			<ul class="nav nav-pills">
				<li class="nav-item"><a href="../main.php" class="<?= ($menu_code == 'home') ? "active" : '' ?>">MAIN</a></li>
				<li class="nav-item"><a href="user.php" class="<?= ($menu_code == 'user') ? "active" : '' ?>">USER</a></li>
				<li class="nav-item"><a href="album.php" class="<?= ($menu_code == 'album') ? "active" : '' ?>">ALBUM</a></li>
				<li class="nav-item"><a href="goods.php" class="<?= ($menu_code == 'goods') ? "active" : '' ?>">GOODS</a></li>
				<li class="nav-item"><a href="music.php" class="<?= ($menu_code == 'music') ? "active" : '' ?>">MUSIC</a></li>
				<li class="nav-item"><a href="../includes/handlers/ajax/logout.php" class=" <?= ($menu_code == 'login') ? "active" : '' ?>">LOGOUT</a></li>
			</ul>
		</header>
		<!-- main으로 시작 -->