<?php
include('includes/getUserId.php');
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
					<iframe width="533" height="300" src="https://www.youtube.com/embed/fgSXAKsq-Vo?si=ImrmX4rgDTPA55aL"
						title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
					<iframe width="533" height="300" src="https://www.youtube.com/embed/JY-gJkMuJ94?si=5ickv86_IO1YN3cb"
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