<?php
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
			<a href="song.php">SONGS</a>
		</div>
		<div class="nav-right">
			<!--nav right section-->
			<img src="<?= $user['profilePic']?>" alt="profilePic">
			<span class="user"><?= $user['username'] ?></span>
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