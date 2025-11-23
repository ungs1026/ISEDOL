document.addEventListener('DOMContentLoaded', function () {

	var toggle = true;
	// 화면 토글 창
	const expand_btn = document.getElementById('expand-btn');
	const sidebar = document.querySelector('.sidebar');
	const albumCon = document.querySelector('.albums-content');

	// 가격 범위 슬라이더와 값 업데이트
	const priceSlider = document.getElementById('price-slider');
	const priceValue = document.getElementById('price-value');

	expand_btn.addEventListener("click", () => {
		if (toggle) {
			sidebar.classList.add("collapsed");
			albumCon.classList.add("wide");
			expand_btn.innerHTML = '<span class="material-icons">add_circle</span>';
			toggle = false;
		} else {
			sidebar.classList.remove("collapsed");
			albumCon.classList.remove("wide");
			expand_btn.innerHTML = '<span class="material-icons">cancel</span>'; // 원래 아이콘으로 변경
			toggle = true;
		}
	});

	function updatePriceValue() {
		priceValue.textContent = `${priceSlider.value.toLocaleString('ko-KR')}`;
	}

	priceSlider.addEventListener('input', updatePriceValue);
	updatePriceValue(); // 초기값 설정

	// 사이드바 내 검색 기능
	const searchBar = document.getElementById('search-bar');

	searchBar.addEventListener('input', function () {
		const query = searchBar.value.toLowerCase();
		console.log('Search Query:', query);
	});
});