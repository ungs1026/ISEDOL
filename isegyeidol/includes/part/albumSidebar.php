<aside class="sidebar">
	<div class="sidebar-content">
		<?php
		// 현재 페이지 URL에서 파일명을 추출
		$currentPage = basename($_SERVER['PHP_SELF']);

		// 폼의 action URL을 설정
		$formAction = ($currentPage === 'groupsong.php') ? 'groupsong.php' : '1';
		?>

		<!-- 정렬 방법 -->
		<form id="filter-form" action="<?php echo $formAction; ?>" method="get">
			<div class="filter-section">
				<h3>Sort By</h3>
				<div class="filter-option">
					<input type="radio" id="sort-all" name="sort" value="all" checked>
					<label for="sort-all">All</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-new" name="sort" value="new">
					<label for="sort-new">Newest</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-single" name="sort" value="single">
					<label for="sort-single">single</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-cover" name="sort" value="cover">
					<label for="sort-cover">cover</label>
				</div>
			</div>

			<!-- Year 선택 -->
			<div class="production-filter">
				<h3>Years</h3>
				<div class="filter-option">
					<input type="radio" id="year-all" name="year" value="all" checked>
					<label for="year-all">All</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="year-2021" name="year" value="2021">
					<label for="year-2021">2021</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="year-2022" name="year" value="2022">
					<label for="year-2022">2022</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="year-2023" name="year" value="2023">
					<label for="year-2023">2023</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="year-2024" name="year" value="2024">
					<label for="year-2024">2024</label>
				</div>
			</div>

			<!-- 검색 창 추가 -->
			<div class="search-container">
				<input type="text" id="search-bar" name="search" placeholder="Enter search term...">
			</div>

			<!-- 적용 버튼 -->
			<div class="apply-button-container">
				<button type="submit" id="apply-filters"><span>Apply</span></button>
			</div>
		</form>
	</div>
</aside>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		// 사이드바 내 검색 기능
		const searchBar = document.getElementById('search-bar');

		searchBar.addEventListener('input', function() {
			const query = searchBar.value.toLowerCase();
			console.log('Search Query:', query);
		});
	});
</script>