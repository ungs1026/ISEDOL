<?php
session_start();

include('includes/getUserId.php');
?>

<!--nav-->
<header>
	<nav>
		<div class="nav-left">
			<a href="main.php"><img src="source/img/main-logo.png" alt="Logo" class="logo"></a>
		</div>
		<div class="nav-center">
			<a href="main.php">MAIN</a>
			<a href="groupsong.php">ALBUMS</a>
			<a href="goods.php">GOODS</a>
			<!-- <a href="board.php?page=1&code=freeboard">COMUNITY</a> -->
			<span role='link' style="color: black; font-weight: bold;" tabindex='0' onclick='openPage("song.php")' class="navItemLink"><span>SONGS</span></span>
		</div>
		<div class="nav-right">
			<!--nav right section-->
			<?php if ($user['level'] == 10) { ?>
				<div class="admin_sec">
					<a href="admin/admin.php">
						<span>Admin</span>
						<img src="<?= $user['profilePic'] ?>" alt="profilePic">
					</a>
				</div>
			<?php } else { ?>
				<img src="<?= $user['profilePic'] ?>" alt="profilePic">
			<?php } ?>

			<span class="user"><?= $user['username'] ?></span>
			<?php if (isset($_SESSION['userId']) && $_SESSION['userId'] != 0) { ?>
				<p><button id="btn-logout" onclick="location.href='includes/handlers/ajax/logout.php'">LogOut</button></p>
			<?php } else { ?>
				<p><button id="btn-login" onclick="location.href='register.php'">LogIn</button></p>
			<?php } ?>
		</div>
	</nav>

	<div class="nav-separator"></div>
</header>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		window.addEventListener('scroll', () => {
			if (window.scrollY > 0) {
				document.querySelector('header').classList.add('scrolled');
			} else {
				document.querySelector('header').classList.remove('scrolled');
			}
		})
	});
</script>