/**
 * 슬라이드 요소 관리
 */
let eventSwiper = new Swiper('.event .swiper-container', {
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
  },
  autoplay: {
    delay: 4000,     // 자동 슬라이드 시간 (4000)
    disableOnInteraction: false,  // 사용자가 스와이프 후에도 자동 슬라이드 계속
    pauseOnMouseEnter: true,      // 마우스가 슬라이드 위에 있을 때 자동 재생 멈춤
  },
})

// MEMBER
// Move
// 모든 member 요소를 선택
const members = document.querySelectorAll('.member');
const member_inners = document.querySelectorAll('.member-inner');
console.log(member_inners);


// 각 member에 클릭 이벤트를 추가해 active 클래스를 토글
members.forEach((member) => {
  const imgContainer = member.querySelector('.member-img');
  const closeButton = member.querySelector('#btn_close');

  // member 이미지를 클릭하면 active 클래스 추가
  imgContainer.addEventListener('click', () => {
    // 클릭되지 않은 다른 member들은 숨김 처리
    members.forEach((m) => {
      if (m !== member) {
        m.style.display = 'none'; // 다른 member 숨기기
      }
    });
    // 클릭된 member에 active 클래스 추가
    member.classList.add('active');
    const mem_inner = member.querySelector('.member-inner');
    const mem_con = mem_inner.querySelector('.content');
    setTimeout(() => {
      mem_inner.style.width = '100%';
    }, 500); // 0.5초 뒤 애니메이션 시작

    setTimeout(() => {
      mem_con.style.opacity = '1';
    }, 1300); // 0.5초 뒤 애니메이션 시작
  });

  // close 버튼 클릭 시 active 클래스 제거 및 모든 member 다시 보이게
  closeButton.addEventListener('click', () => {
    member.classList.remove('active');

    const mem_inner = member.querySelector('.member-inner');
    const mem_con = mem_inner.querySelector('.content');

    // 애니메이션을 위한 스타일 초기화
    mem_inner.style.width = '0';
    mem_con.style.opacity = '0';

    // 모든 member를 다시 보이도록 설정
    members.forEach((m) => {
      m.style.display = 'block'; // 모든 member 다시 표시
    });
  });
});



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
let debuttSwiper = new Swiper('.debut .swiper-container', {
  slidesPerView: 3,  // 한 화면에 보이는 슬라이드 수
  spaceBetween: 20,  // 슬라이드 간격
  loop: true,        // 무한 반복 설정
  autoplay: {
    delay: 4000,     // 자동 슬라이드 시간 (4000)
    disableOnInteraction: false,  // 사용자가 스와이프 후에도 자동 슬라이드 계속
    pauseOnMouseEnter: true,      // 마우스가 슬라이드 위에 있을 때 자동 재생 멈춤
  },
});

// Swiper.js 초기화
let consertSwiper = new Swiper('.consert .swiper-container', {
  slidesPerView: 3,  // 한 화면에 보이는 슬라이드 수
  spaceBetween: 20,  // 슬라이드 간격
  loop: true,        // 무한 반복 설정
  autoplay: {
    delay: 4000,     // 자동 슬라이드 시간 (4000)
    disableOnInteraction: false,  // 사용자가 스와이프 후에도 자동 슬라이드 계속
    pauseOnMouseEnter: true,      // 마우스가 슬라이드 위에 있을 때 자동 재생 멈춤
  },
});