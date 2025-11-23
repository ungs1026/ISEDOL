<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// if (!isset($_SESSION['userId']) || $_SESSION['userId'] == 0) {
// 	echo '
// 		<script>
// 			alert("로그인이 필요합니다.")
// 			location.href = "register.php"
// 		</script>
// 	';
// 	exit();
// }

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
			<a href="song.php">SONGS</a>
		</div>
		<div class="nav-right">
			<!--nav right section-->
			<?php if (isset($user['level']) && $user['level'] == 10) { ?>
				<div class="admin_sec">
					<a href="admin/admin.php">
						<span>Admin</span>
						<img src="<?= $user['profilePic'] ?>" alt="profilePic">
					</a>
				</div>
			<?php } else { 
				if (isset($_SESSION['userId'])) { 
					?> <img src="<?= $user['profilePic'] ?>" alt="profilePic"> <?php
				} else { 
					?> <img src="./source/img/admin.png" alt="profilePic"> <?php
				}?>
			<?php } ?>

			<?php 
			if (isset($_SESSION['userId'])) { 
				?> <span class="user"><?= $user['username'] ?></span><?php
			} else { 
				?> <span class="user">GUEST</span> <?php
			}?>
			
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