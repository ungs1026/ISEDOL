<?php
	include('includes/getUserId.php');

	if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
		// AJAX 요청 처리
		$pagination = include_once './includes/part/albumPagination.php';
		$albums = $pagination['albums'];
		$totalPages = $pagination['totalPages'];
		$currentPage = $pagination['currentPage'];

		// 앨범 그리드 렌더링
		echo '<div class="album-grid">';
		if (empty($albums)) {
			echo '<div class="no-result">';
			echo '<img src="source/img/leaf.png" alt="No Result" class="no-result-img">';
			echo '<p>No Result</p>';
			echo '</div>';
		} else {
			foreach ($albums as $song) {
				echo '<div class="song-item" data-id="' . htmlspecialchars($song['id']) . '">';
				echo '<a href="' . htmlspecialchars($song['youtube']) . '">';
				echo '<img src="' . htmlspecialchars($song['thumbnail']) . '" alt="Thumbnail" class="song-thumb">';
				echo '<img src="./source/img/disk.png" alt="Disk" class="song-disk">';
				echo '<img src="' . htmlspecialchars($song['thumbnail']) . '" alt="Thumbnail" class="song-thumb-overlay">';
				echo '</a>';
				echo '<div class="song-name">' . htmlspecialchars($song['name']) . '</div>';
				echo '<div class="song-date">' . htmlspecialchars($song['date']) . '</div>';
				echo '</div>';
			}
		}
		echo '</div>';

		// 페이지네이션 렌더링 (수정된 부분)
		$queryParams = $_GET;
		unset($queryParams['ajax']);
		unset($queryParams['page']);
		$queryString = http_build_query($queryParams);
		$baseUrl = 'groupsong.php?';

		echo '<div class="pagination">';
		if ($currentPage > 1) {
			echo '<a href="' . $baseUrl . 'page=' . ($currentPage - 1) . '&' . $queryString . '">&laquo; Previous</a>';
		}
		for ($i = 1; $i <= $totalPages; $i++) {
			echo '<a href="' . $baseUrl . 'page=' . $i . '&' . $queryString . '" ' . ($i == $currentPage ? 'class="active"' : '') . '>' . $i . '</a>';
		}
		if ($currentPage < $totalPages) {
			echo '<a href="' . $baseUrl . 'page=' . ($currentPage + 1) . '&' . $queryString . '">Next &raquo;</a>';
		}
		echo '</div>';

		exit; // AJAX 요청 처리를 마치고 스크립트 종료
	}
?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Group Album Page</title>

	<!-- Favicon -->
	<link rel="icon" href="source/img/main-logo.png" type="image/x-icon" />
	<link rel="shortcut icon" href="source/img/main-logo.png" type="image/x-icon" />

	<!--BoxIcons-->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

	<!--Include Local Script-->
	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/group.css">

	<script src="js/group.js"></script>
</head>

<body class="scrollbar">
	<?php include_once './includes/part/nav.php'; ?>

	<main>
		<section class="content-wrapper">
			<?php include_once './includes/part/albumSidebar.php' ?>

			<section class="content">
				<div class="main-img">
					<iframe width="533" height="300" src="https://www.youtube.com/embed/zFmKBpHrKY8?si=V_PDudtYUF_EygTH" 
						title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
					<iframe width="533" height="300" src="https://www.youtube.com/embed/fff8P0kYexQ?si=x-EFXYeFHVTdQcY_"
						title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
					<iframe width="533" height="300" src="https://www.youtube.com/embed/rDFUl2mHIW4?si=xciIHqc7tmwE9olO?rel=0"
						title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
				</div>
				<!-- 앨범 그리드 -->
				<div class="album-grid">
					<?php
					// 페이지네이션 포함 / db는 getUserId에 있기 때문에 생략
					$pagination = include_once './includes/part/albumPagination.php';
					$albums = $pagination['albums'];
					$totalPages = $pagination['totalPages'];
					$currentPage = $pagination['currentPage'];

					if (empty($albums)): ?>
						<div class="no-result">
							<img src="source/img/leaf.png" alt="No Result" class="no-result-img">
							<p>No Result</p>
						</div>
					<?php else: ?>
						<?php foreach ($albums as $song): ?>
							<div class="song-item" data-id="<?php echo htmlspecialchars($song['id']); ?>">
								<a href="<?php echo htmlspecialchars($song['youtube']) ?>">
									<img src="<?php echo htmlspecialchars($song['thumbnail']); ?>" alt="Thumbnail" class="song-thumb">
									<img src="./source/img/disk.png" alt="Disk" class="song-disk">
									<img src="<?php echo htmlspecialchars($song['thumbnail']); ?>" alt="Thumbnail" class="song-thumb-overlay">
								</a>
								<div class="song-name"><?php echo htmlspecialchars($song['name']); ?></div>
								<div class="song-date">
									<?php echo htmlspecialchars($song['date']); ?>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<!-- 페이지네이션 -->
				<div class="pagination">
					<?php if ($currentPage > 1): ?>
						<a href="groupsong.php?page=<?php echo $currentPage - 1; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['type']) ? '&type=' . $_GET['type'] : ''; ?><?php echo isset($_GET['year']) ? '&year=' . $_GET['year'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">&laquo; Previous</a>
					<?php endif; ?>

					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
						<a href="groupsong.php?page=<?php echo $i; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['type']) ? '&type=' . $_GET['type'] : ''; ?><?php echo isset($_GET['year']) ? '&year=' . $_GET['year'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>" <?php echo $i == $currentPage ? 'class="active"' : ''; ?>>
							<?php echo $i; ?>
						</a>
					<?php endfor; ?>

					<?php if ($currentPage < $totalPages): ?>
						<a href="groupsong.php?page=<?php echo $currentPage + 1; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['type']) ? '&type=' . $_GET['type'] : ''; ?><?php echo isset($_GET['year']) ? '&year=' . $_GET['year'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Next &raquo;</a>
					<?php endif; ?>
				</div>

			</section>
		</section>
	</main>

	<?php
		include_once 'includes/part/infoFooter.php';
	?>
</body>

</html>