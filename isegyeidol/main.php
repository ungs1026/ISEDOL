<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ISEDOL DAISUKI!</title>


	<!--FAVICON-->
	<link rel="icon" href="source/img/main-logo.png" type="image/x-icon" />
	<link rel="shortcut icon" href="source/img/main-logo.png" type="image/x-icon" />

	<!--GSAP & ScrollToPlugin-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js" integrity="sha512-nTHzMQK7lwWt8nL4KF6DhwLHluv6dVq/hNnj2PBN0xMl2KaMm1PM02csx57mmToPAodHmPsipoERRNn4pG7f+Q==" crossorigin="anonymous"></script>

	<!--Google Material Icons-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

	<!--Swiper-->
	<link rel="stylesheet" href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css" />
	<script src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script>

	<!--BoxIcons-->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

	<link rel="stylesheet" href="./css/mainStyle.css">
	<script defer src="./js/main.js"></script>
</head>

<body>

	<?php
	include('includes/part/nav.php');
	?>

	<!-- EVENT -->
	<div class="event">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="./source/img/register_1.png" alt="">
				</div>
				<div class="swiper-slide">
					<img src="./source/img/register_2.jpg" alt="">
				</div>
				<div class="swiper-slide">
					<img src="./source/img/register_3.jpg" alt="">
				</div>
				<div class="swiper-slide">
					<img src="./source/img/register_4.png" alt="">
				</div>
			</div>
		</div>

		<div class="swiper-pagination"></div>

		<div class="swiper-prev">
			<span class="material-icons">arrow_back</span>
		</div>
		<div class="swiper-next">
			<span class="material-icons">arrow_forward</span>
		</div>
	</div>

	<!-- MEMBER -->
	<contain class="member-icon-group">

		<!--INE-->
		<div class="member">
			<div class="member-img">
				<a href="https://namu.wiki/w/%EC%95%84%EC%9D%B4%EB%84%A4" target="_blank">
					<img src="source/img/member/profile-ine.png" alt="...">
					<p>INE</p>
				</a>
			</div>
			<div class="member-sns">
				<a href="https://bj.afreecatv.com/inehine" target="_blank">
					<img src="source/img/afreecaTv.png" alt="...">
				</a>
				<a href="https://www.instagram.com/ine_hamine/" target="_blank">
					<img src="source/img/insta.png" alt="...">
				</a>
				<a href="https://www.youtube.com/@INE_" target="_blank">
					<img src="source/img/youtube.png" alt="...">
				</a>
			</div>
		</div>

		<!--JIGNBURGER-->
		<div class="member">
			<div class="member-img">
				<a href="https://namu.wiki/w/%EC%A7%95%EB%B2%84%EA%B1%B0" target="_blank">
					<img src="source/img/member/profile-jingburger.png" alt="...">
					<p>JIGNBURGER</p>
				</a>
			</div>
			<div class="member-sns">
				<a href="https://bj.afreecatv.com/jingburger1" target="_blank">
					<img src="source/img/afreecaTv.png" alt="...">
				</a>
				<a href="https://x.com/jing_burger" target="_blank">
					<img src="source/img/x-logo.png" alt="...">
				</a>
				<a href="https://www.youtube.com/@jingburger" target="_blank">
					<img src="source/img/youtube.png" alt="...">
				</a>
			</div>
		</div>

		<!--LILPA-->
		<div class="member">
			<div class="member-img">
				<a href="https://namu.wiki/w/%EB%A6%B4%ED%8C%8C" target="_blank">
					<img src="source/img/member/profile-lilpa.png" alt="...">
					<p>LILPA</p>
				</a>
			</div>
			<div class="member-sns">
				<a href="https://bj.afreecatv.com/lilpa0309" target="_blank">
					<img src="source/img/afreecaTv.png" alt="...">
				</a>
				<a href="https://x.com/lilpa_official" target="_blank">
					<img src="source/img/x-logo.png" alt="...">
				</a>
				<a href="https://www.youtube.com/@lilpa" target="_blank">
					<img src="source/img/youtube.png" alt="...">
				</a>
			</div>
		</div>

		<!--JURURU-->
		<div class="member">
			<div class="member-img">
				<a href="https://namu.wiki/w/%EC%A3%BC%EB%A5%B4%EB%A5%B4" target="_blank">
					<img src="source/img/member/profile-jururu.png" alt="...">
					<p>JURURU</p>
				</a>
			</div>
			<div class="member-sns">
				<a href="https://bj.afreecatv.com/cotton1217" target="_blank">
					<img src="source/img/afreecaTv.png" alt="...">
				</a>
				<a href="https://x.com/jururu_twitch" target="_blank">
					<img src="source/img/x-logo.png" alt="...">
				</a>
				<a href="https://www.youtube.com/@JU_RURU" target="_blank">
					<img src="source/img/youtube.png" alt="...">
				</a>
			</div>
		</div>

		<!--GOSEGU-->
		<div class="member">
			<div class="member-img">
				<a href="https://namu.wiki/w/%EA%B3%A0%EC%84%B8%EA%B5%AC" target="_blank">
					<img src="source/img/member/profile-gosegu.png" alt="...">
					<p>GOSEGU</p>
				</a>
			</div>
			<div class="member-sns">
				<a href="https://bj.afreecatv.com/gosegu2" target="_blank">
					<img src="source/img/afreecaTv.png" alt="...">
				</a>
				<a href="https://x.com/gosegu486385" target="_blank">
					<img src="source/img/x-logo.png" alt="...">
				</a>
				<a href="https://www.youtube.com/@gosegu" target="_blank">
					<img src="source/img/youtube.png" alt="...">
				</a>
			</div>
		</div>

		<!--VIICHAN-->
		<div class="member">
			<div class="member-img">
				<a href="https://namu.wiki/w/%EB%B9%84%EC%B1%A4" target="_blank">
					<img src="source/img/member/profile-viichan.png" alt="...">
					<p>VIICHAN</p>
				</a>
			</div>
			<div class="member-sns">
				<a href="https://bj.afreecatv.com/viichan6" target="_blank">
					<img src="source/img/afreecaTv.png" alt="...">
				</a>
				<a href="https://x.com/viichan6" target="_blank">
					<img src="source/img/x-logo.png" alt="...">
				</a>
				<a href="https://www.youtube.com/@viichan116" target="_blank">
					<img src="source/img/youtube.png" alt="...">
				</a>
			</div>
		</div>

	</contain>

	<!-- ALBUM-KIDDING -->
	<div class="kidding">

		<iframe src="https://www.youtube.com/embed/rDFUl2mHIW4?autoplay=1&mute=1&loop=1&playlist=rDFUl2mHIW4"
			title="YouTube video player" frameborder="0" allow="autoplay; fullscreen; 
		encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>

		<div class="content">
			<div class="kid-left">
				<img src="./source/img/kidding.jpg" alt="kidding-Album">
				<button id="openModalBtn">lyrics</button>
			</div>
			<div class="kid-right">
				<div class="text-section">
					<p class="album-title">The 3rd Single〈KIDDING〉</p>
					<span class="album-description">매 번 새로운 도전을 하는 이세계아이돌이 이번에는 KPOP 걸그룹 노래에 도전한다.</span>
				</div>
				<div class="text-section">
					<p class="album-title">AWARD GRADE</p>
					<span class="album-description">
						<img src="./source/img/melon.svg" alt="">
						HOT100(발매 30일 이내) 1위 / 실시간 차트 1위
					</span><br>
					<span class="album-description">
						<img src="./source/img/youtubemusic.svg" alt="">
						한국 인기 급상승 음악 1위
					</span><br>
					<span class="album-description">
						<img src="./source/img/circlechart.svg" alt="">
						다운로드 차트 3위
					</span><br>
					<span class="album-description">
						<img src="./source/img/billboard.svg" alt="">
						Billboard Hits of the World : South Korea Songs TOP25 3위
					</span>
				</div>
			</div>

		</div>
	</div>

	<!-- FOOTER -->
	<footer>
		<section>
			<ul class="socials">
			<li>
					<a href="#" class="bx bxl-whatsapp"></a>
					<p>010 - 5657 - 4813</p>
				</li>
				<li>
					<a href="#" class="bx bxl-gmail"></a>
					<p>wodnd565@gmail.com</p>
				</li>
				<li style="width: 6rem;">
					<a href="https://github.com/ungs1026" class="bx bxl-github" target="_blank"></a>
					<p>Github</p>
				</li>
				<li style="width: 6rem;">
					<a href="https://www.notion.so/Study-7daa8a57d33946b79616df556f0edd01"  target="_blank"><img src="./source/img/Notion-logo.png" alt="#"></a>
					<p>Notion</p>
				</li>
			</ul>
			<ul class="links">
				<li><a href="main.php">Home</a></li>
				<li><a href="goods.php">Goods</a></li>
				<li><a href="song.php">Song</a></li>
			</ul>
			<p class="legal"> © 2024 rights reserved </p>
		</section>
	</footer>

	<!-- MODAL -->
	<div id="modal" class="modal">
		<div class="modal-content">
			<span class="close-btn">&times;</span>
			<h2>KIDDING</h2>
			<p id="lyricsContent"></p>
		</div>
	</div>


</body>

</html>