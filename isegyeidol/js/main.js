/**
 * 슬라이드 요소 관리
 */
new Swiper('.event .swiper-container', {
  // direction: 'horizontal', // 수평 슬라이드
  loop: true, // 반복 재생 여부
  slidesPerView: 3, // 한 번에 보여줄 슬라이드 개수
  spaceBetween: 10, // 슬라이드 사이 여백
  centeredSlides: true, // 1번 슬라이드가 가운데 보이기
  pagination: { // 페이지 번호 사용 여부
    el: '.event .swiper-pagination', // 페이지 번호 요소 선택자
    clickable: true // 사용자의 페이지 번호 요소 제어 가능 여부
  },
  navigation: { // 슬라이드 이전/다음 버튼 사용 여부
    prevEl: '.event .swiper-prev', // 이전 버튼 선택자
    nextEl: '.event .swiper-next' // 다음 버튼 선택자
  }
})

/**
 * Modal
 */
// 모달 열기 버튼과 모달 요소 가져오기
const openModalBtn = document.getElementById('openModalBtn');
const modal = document.getElementById('modal');
const closeBtn = document.getElementsByClassName('close-btn')[0];
const lyricsContent = document.getElementById('lyricsContent');

// 버튼을 클릭하면 모달 열기
openModalBtn.onclick = function () {
  modal.style.display = 'block';

  // 가사 파일을 fetch로 불러오기
  fetch('DB/lyrics.txt')
    .then(response => response.text())
    .then(data => {
      lyricsContent.textContent = data;
    })
    .catch(error => {
      lyricsContent.textContent = '가사를 불러오는 중 오류가 발생했습니다.';
      console.error('Error fetching lyrics:', error);
    });
}

// 닫기 버튼을 클릭하면 모달 닫기
closeBtn.onclick = function () {
  modal.style.display = 'none';
}

// 모달 외부를 클릭하면 모달 닫기
window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
}

// Swiper.js 초기화
var swiper = new Swiper('.swiper-container', {
  slidesPerView: 3,  // 한 화면에 보이는 슬라이드 수
  spaceBetween: 20,  // 슬라이드 간격
  loop: true,        // 무한 반복 설정
  autoplay: {
    delay: 4000,     // 자동 슬라이드 시간 (4000)
    disableOnInteraction: false,  // 사용자가 스와이프 후에도 자동 슬라이드 계속
    pauseOnMouseEnter: true,      // 마우스가 슬라이드 위에 있을 때 자동 재생 멈춤
  },
});
