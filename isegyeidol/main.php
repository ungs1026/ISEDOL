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

	<!-- Swiper -->
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/mainStyle.css">
	<script defer src="./js/main.js"></script>
</head>

<body class="scrollbar">

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
	<h1>- MEMBER -</h1>
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
	<h1>- 3rd ALBUM -</h1>
	<div class="kidding">

		<iframe src="https://www.youtube.com/embed/rDFUl2mHIW4?autoplay=1&mute=1&loop=1&playlist=rDFUl2mHIW4"
			title="YouTube video player" frameborder="0" allow="autoplay; fullscreen; 
		encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>

		<div class="content">
			<div class="kid-left">
				<img src="./source/img/kidding.jpg" alt="kidding-Album">
				<img src="./source/img/single/KIDDING.png" alt="kidding-Album" class="cover-overlay">
				<div class="audio-control">
					<audio controls>
						<source src="./source/music_group/kidding.mp3" type="audio/mp3">
						None
					</audio>
					<button id="openModalBtn">lyrics</button>
				</div>
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

	<!--DEBUT-->
	<h1>- AfreecaTV DEBUT CONSERT-</h1>
	<div class="debut">
		<section class="swiper-container">
			<div class="swiper-wrapper">

				<div class="swiper-slide">
					<a href="https://vod.afreecatv.com/player/115894243" target="_blank">
						<img src="./source/img/consert/debut/INE.jpg" alt="INE">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/%EC%95%84%EC%9D%B4%EB%84%A4%20%EC%95%84%ED%94%84%EB%A6%AC%EC%B9%B4TV%20%EB%8D%B0%EB%B7%94%20%EC%BD%98%EC%84%9C%ED%8A%B8" target="_blank">
							<p>Detail</p>
						</a>
						<p>INE</p>
					</div>
				</div>

				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=0HcTddHouRo" target="_blank">
						<img src="./source/img/consert/debut/JINGBURGER.jpg" alt="JINGBURGER">
					</a>
					<div class="text-area">
						<a href="https://www.youtube.com/watch?v=0HcTddHouRo" target="_blank">
							<p>Detail</p>
						</a>
						<p>JIGNBURGER</p>
					</div>
				</div>

				<div class="swiper-slide">
					<a href="https://vod.afreecatv.com/player/115972573" target="_blank">
						<img src="./source/img/consert/debut/LILPA.jpg" alt="LILPA">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/LILease" target="_blank">
							<p>Detail</p>
						</a>
						<p>LILPA</p>
					</div>
				</div>

				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=udB06Jvizu4" target="_blank">
						<img src="./source/img/consert/debut/JURURU.jpg" alt="JURURU">
					</a>
					<div class="text-area">
						<a href="https://www.youtube.com/watch?v=udB06Jvizu4" target="_blank">
							<p>Detail</p>
						</a>
						<p>JURURU</p>
					</div>
				</div>

				<div class="swiper-slide">
					<a href="https://vod.afreecatv.com/player/115986767" target="_blank">
						<img src="./source/img/consert/debut/GOSEGU.jpg" alt="GOSEGU">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/GOSEGU%20%EB%AF%B8%EB%8B%88%20%EC%BD%98%EC%84%9C%ED%8A%B8" target="_blank">
							<p>Detail</p>
						</a>
						<p>GOSEGU</p>
					</div>
				</div>

				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=UIHoQ-4ts38&t=690s" target="_blank">
						<img src="./source/img/consert/debut/VIICHAN.jpg" alt="VIICHAN">
					</a>
					<div class="text-area">
						<a href="https://www.youtube.com/watch?v=UIHoQ-4ts38&t=690s" target="_blank">
							<p>Detail</p>
						</a>
						<p>VIICHAN</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!--CONSERT-->
	<h1>- CONSERT -</h1>
	<div class="consert">
		<section class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=aCa5qn11IrI" target="_blank">
						<img src="./source/img/consert/main/ine_everPurple.png" alt="INE_CONSERT">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/EVER%20PURPLE" target="_blank">
							<p>Detail</p>
						</a>
						<p>INE - Ever Purple</p>
					</div>
				</div>
				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=SLa8fe1Z2XE&feature=youtu.be" target="_blank">
						<img src="./source/img/consert/main/lilpa_dreamAgain.png" alt="LILPA_CONSERT">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/Dream%20Again(%EC%BD%98%EC%84%9C%ED%8A%B8)" target="_blank">
							<p>Detail</p>
						</a>
						<p>LILPA - Dream Again</p>
					</div>
				</div>
				<div class="swiper-slide">
					<a href="#">
						<img src="./source/img/consert/main/lilpa_goingout.png" alt="LILPA_CONSERT">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/LILPACON%20:%20Going%20Out%20-%20SOOPER%20CONCERT" target="_blank">
							<p>Detail</p>
						</a>
						<p>LILPA - Going Out</p>
					</div>
				</div>
				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=wmbN3BPIUbQ" target="_blank">
						<img src="./source/img/consert/main/jururu_jutaime.png" alt="JURURU_CONSERT">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/Ju.%20T'aime" target="_blank">
							<p>Detail</p>
						</a>
						<p>JURURU - Ju Taime</p>
					</div>
				</div>
				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=78_SbCuAhxA" target="_blank">
						<img src="./source/img/consert/main/gesegu_tour.png" alt="GOSEGU_CONSERT">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/TOUR" target="_blank">
							<p>Detail</p>
						</a>
						<p>GOSEGU - Tour</p>
					</div>
				</div>
				<div class="swiper-slide">
					<a href="https://www.youtube.com/watch?v=Ip1WwW0gwf4" target="_blank">
						<img src="./source/img/consert/main/viichan_역광.png" alt="VIICHAN_CONSERT">
					</a>
					<div class="text-area">
						<a href="https://namu.wiki/w/%EC%97%AD%EA%B4%91(%EC%BD%98%EC%84%9C%ED%8A%B8)" target="_blank">
							<p>Detail</p>
						</a>
						<p>VIICHAN - Back Light</p>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- FOOTER -->
	<?php
	include 'includes/part/infoFooter.php';
	?>

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