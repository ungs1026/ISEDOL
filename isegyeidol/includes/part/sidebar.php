<aside class="sidebar">
	<div class="sidebar-content">
		<?php
		// 현재 페이지 URL에서 파일명을 추출
		$currentPage = basename($_SERVER['PHP_SELF']);

		// 폼의 action URL을 설정
		$formAction = ($currentPage === 'goods.php') ? 'goods.php' : '1';
		?>

		<!-- 정렬 방법 -->
		<form id="filter-form" action="" method="get">
			<div class="filter-section">
				<h3>Sort By</h3>
				<div class="filter-option">
					<input type="radio" id="sort-all" name="sort" value="all">
					<label for="sort-all">All</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-popular" name="sort" value="popular">
					<label for="sort-popular">Popular</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-price-low" name="sort" value="price-low">
					<label for="sort-price-low">Price: Low to High</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="sort-price-high" name="sort" value="price-high">
					<label for="sort-price-high">Price: High to Low</label>
				</div>
			</div>

			<!-- 가격 범위 슬라이더 -->
			<div class="price-range">
				<h3>Price Range</h3>
				<input type="range" id="price-slider" name="price" min="0" max="100000" step="100">
				<span id="price-value"></span>
			</div>

			<!-- 프로덕션 선택 -->
			<div class="production-filter">
				<h3>Production</h3>
				<div class="filter-option">
					<input type="radio" id="prod-all" name="kind" value="all">
					<label for="prod-all">All</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="prod-cushion" name="kind" value="cushion">
					<label for="prod-cushion">cushion</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="prod-acrylic" name="kind" value="acrylic">
					<label for="prod-acrylic">acrylic</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="prod-photo" name="kind" value="photo">
					<label for="prod-photo">photo</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="prod-sundries" name="kind" value="sundries">
					<label for="prod-sundries">sundries</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="prod-pad" name="kind" value="pad">
					<label for="prod-pad">pad</label>
				</div>
				<div class="filter-option">
					<input type="radio" id="prod-clothes" name="kind" value="clothes">
					<label for="prod-clothes">clothes</label>
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
		const priceSlider = document.getElementById('price-slider');
		const priceValue = document.getElementById('price-value');
		const filterForm = document.getElementById('filter-form');
		
		function updatePriceValue() {
			if(priceSlider && priceValue) {
				priceValue.textContent = `${Number(priceSlider.value).toLocaleString()}`;
			}
		}

		function setInitialState() {
			const urlParams = new URLSearchParams(window.location.search);
			const sort = urlParams.get('sort') || 'all';
			const kind = urlParams.get('kind') || 'all';
			const price = urlParams.get('price') || '100000';
			const search = urlParams.get('search') || '';

			const sortRadio = document.querySelector(`input[name="sort"][value="${sort}"]`);
			if (sortRadio) sortRadio.checked = true;

			const kindRadio = document.querySelector(`input[name="kind"][value="${kind}"]`);
			if (kindRadio) kindRadio.checked = true;

			if(priceSlider) {
				priceSlider.value = price;
				updatePriceValue();
			}

			const searchBar = document.getElementById('search-bar');
			if(searchBar) {
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
					
					const newGrid = doc.querySelector('.albums-grid');
					const newPagination = doc.querySelector('.pagination');
					
					const currentGrid = document.querySelector('.albums-grid');
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
					setInitialState(); // 페이지네이션 후에도 사이드바 상태를 재설정
				})
				.catch(error => console.error('Error fetching filtered content:', error));
		}

		if (priceSlider) {
			priceSlider.addEventListener('input', updatePriceValue);
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