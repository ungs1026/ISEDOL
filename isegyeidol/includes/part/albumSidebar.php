<aside class="sidebar">
	<div class="sidebar-content">
		<?php
		// 현재 페이지 URL에서 파일명을 추출
		$currentPage = basename($_SERVER['PHP_SELF']);

		// 폼의 action URL을 설정
		$formAction = ($currentPage === 'groupsong.php') ? 'groupsong.php' : '1';
		?>

		<!-- sort 방법 -->
		<form id="filter-form" action="" method="get">
			<div class="filter-section">
				<h3>Sort By</h3>
				<div class="filter-option">
					<input type="radio" id="sort-all" name="sort" value="all">
					<label for="sort-all">All</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-new" name="sort" value="new">
					<label for="sort-new">Newest</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-old" name="sort" value="old">
					<label for="sort-old">Oldest</label>
				</div>
			</div>

			<!-- Types 선택 -->
			<div class="types-filter">
				<h3>Types</h3>
				<div class="filter-option">
					<input type="radio" id="type-all" name="type" value="all">
					<label for="type-all">All</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="type-single" name="type" value="single">
					<label for="type-single">single</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="type-cover" name="type" value="cover">
					<label for="type-cover">cover</label>
				</div>
			</div>

			<!-- Year 선택 -->
			<div class="kind-filter">
				<h3>Years</h3>
				<div class="filter-option">
					<input type="radio" id="year-all" name="year" value="all">
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
		const filterForm = document.getElementById('filter-form');
		
		function setInitialState() {
			const urlParams = new URLSearchParams(window.location.search);
			const sort = urlParams.get('sort') || 'all';
			const type = urlParams.get('type') || 'all';
			const year = urlParams.get('year') || 'all';
			const search = urlParams.get('search') || '';

			const sortRadio = document.querySelector(`input[name="sort"][value="${sort}"]`);
			if (sortRadio) sortRadio.checked = true;

			const typeRadio = document.querySelector(`input[name="type"][value="${type}"]`);
			if (typeRadio) typeRadio.checked = true;

			const yearRadio = document.querySelector(`input[name="year"][value="${year}"]`);
			if (yearRadio) yearRadio.checked = true;

			const searchBar = document.getElementById('search-bar');
			if (searchBar) {
				searchBar.value = search;
			}
		}

		function fetchContent(url) {
			const ajaxUrl = new URL(url, window.location.origin);
			ajaxUrl.searchParams.set('ajax', '1');

			fetch(ajaxUrl)
				.then(response => response.text())
				.then(html => {
					const parser = new DOMParser();
					const doc = parser.parseFromString(html, 'text/html');
					
					const newGrid = doc.querySelector('.album-grid');
					const newPagination = doc.querySelector('.pagination');
					
					const currentGrid = document.querySelector('.album-grid');
					const currentPagination = document.querySelector('.pagination');

					if (newGrid && currentGrid) {
						currentGrid.innerHTML = newGrid.innerHTML;
					}

					if (newPagination && currentPagination) {
						currentPagination.innerHTML = newPagination.innerHTML;
					} else if (currentPagination) {
						currentPagination.innerHTML = '';
					}
					
					history.pushState(null, '', url);
					setInitialState();
				})
				.catch(error => console.error('Error fetching filtered content:', error));
		}

		setInitialState();

		if (filterForm) {
			filterForm.addEventListener('submit', function(event) {
				event.preventDefault();
				const formData = new FormData(filterForm);
				const params = new URLSearchParams(formData);
				const url = `${window.location.pathname}?${params.toString()}`;
				fetchContent(url);
			});
		}

		document.addEventListener('click', function(event) {
			const target = event.target.closest('.pagination a');
			if (target) {
				event.preventDefault();
				fetchContent(target.href);
			}
		});

		window.addEventListener('popstate', function() {
			fetchContent(window.location.href);
		});
	});
</script>