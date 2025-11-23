<?php
	include('includes/getUserId.php');

	if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
		// AJAX 요청 처리
		$pagination = include './includes/part/pagination.php';
		$goods = $pagination['goods'];
		$totalPages = $pagination['totalPages'];
		$currentPage = $pagination['currentPage'];

		// 굿즈 그리드 렌더링
		echo '<div class="albums-grid">';
		if (empty($goods)) {
			echo '<div class="no-results">';
			echo '<img src="source/icons/crying.png" alt="No Results" class="no-results-image">';
			echo '<p>No results</p>';
			echo '</div>';
		} else {
			foreach ($goods as $item) {
				echo '<div class="album-item" data-id="' . htmlspecialchars($item['id']) . '">';
				echo '<img src="' . htmlspecialchars($item['img']) . '" alt="Goods Image">';
				echo '<div class="album-name">' . htmlspecialchars($item['name']) . '</div>';
				echo '<div class="album-price">' . number_format($item['price']) . '원</div>';
				echo '<div class="album-overlay">';
				echo '<a href="goodsDetail.php?id=' . $item['id'] . '" target="_blank">Go to Detail</a>';
				echo '</div>';
				echo '</div>';
			}
		}
		echo '</div>';

		// 페이지네이션 렌더링 (수정된 부분)
		$queryParams = $_GET;
		unset($queryParams['ajax']);
		unset($queryParams['page']);
		$queryString = http_build_query($queryParams);
		$baseUrl = 'goods.php?';

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
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Goods Page</title>

	<link rel="icon" href="source/img/main-logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="source/img/main-logo.png" type="image/x-icon"/>

	<!--BoxIcons-->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

	<link rel="stylesheet" href="./css/common.css">
	<link rel="stylesheet" href="./css/goodsStyle.css">
</head>

<body class="scrollbar">
	<?php include './includes/part/nav.php'; ?>
	<main>
		<section class="content-wrapper">
			<?php include './includes/part/sidebar.php'; ?>

			<section class="albums-content"> <!-- 동일한 클래스 사용 -->
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
				
				<!-- 굿즈 그리드 -->
				<div class="albums-grid"> <!-- 동일한 그리드 클래스 사용 -->
					<?php
					// 페이지네이션 포함 / db는 getuserid에 있기 때문에 생략
					$pagination = include './includes/part/pagination.php';
					$goods = $pagination['goods'];
					$totalPages = $pagination['totalPages'];
					$currentPage = $pagination['currentPage'];

					if (empty($goods)): ?>
						<div class="no-results">
							<img src="source/icons/crying.png" alt="No Results" class="no-results-image">
							<p>No results</p>
						</div>
					<?php else: ?>
						<?php foreach ($goods as $item): ?>
							<div class="album-item" data-id="<?php echo htmlspecialchars($item['id']); ?>"> <!-- 동일한 클래스 사용 -->
								<img src="<?php echo htmlspecialchars($item['img']); ?>" alt="Goods Image">
								<div class="album-name"><?php echo htmlspecialchars($item['name']); ?></div> <!-- 동일한 클래스 사용 -->
								<div class="album-price"><?php echo number_format($item['price']); ?>원</div> <!-- 동일한 클래스 사용 -->
								<div class="album-overlay">
									<a href="goodsDetail.php?id=<?= $item['id'] ?>" target="_blank">Go to Detail</a>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<!-- 페이지네이션 -->
				<div class="pagination">
					<?php if ($currentPage > 1): ?>
						<a href="goods.php?page=<?php echo $currentPage - 1; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['kind']) ? '&kind=' . $_GET['kind'] : ''; ?><?php echo isset($_GET['price']) ? '&price=' . $_GET['price'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">&laquo; Previous</a>
					<?php endif; ?>

					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
						<a href="goods.php?page=<?php echo $i; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['kind']) ? '&kind=' . $_GET['kind'] : ''; ?><?php echo isset($_GET['price']) ? '&price=' . $_GET['price'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>" <?php echo $i == $currentPage ? 'class="active"' : ''; ?>>
							<?php echo $i; ?>
						</a>
					<?php endfor; ?>

					<?php if ($currentPage < $totalPages): ?>
						<a href="goods.php?page=<?php echo $currentPage + 1; ?><?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?><?php echo isset($_GET['kind']) ? '&kind=' . $_GET['kind'] : ''; ?><?php echo isset($_GET['price']) ? '&price=' . $_GET['price'] : ''; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?>">Next &raquo;</a>
					<?php endif; ?>
				</div>
			</section>
		</section>
	</main>

	<?php
		include 'includes/part/infoFooter.php';
	?>
</body>

</html>