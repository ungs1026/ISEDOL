// 현재 재생 중인 곡의 플레이리스트와 관련된 배열 변수 초기화
var currentPlaylist = []; // 현재 플레이 중인 곡의 리스트
var shufflePlaylist = []; // 셔플 재생을 위한 곡 리스트
var tempPlaylist = []; // 임시로 저장할 플레이리스트
var audioElement; // 오디오 객체를 담을 변수
var mouseDown = false; // 마우스 클릭 상태를 저장하는 변수
var currentIndex = 0; // 현재 재생 중인 곡의 인덱스
var repeat = false; // 반복 재생 상태 변수
var shuffle = false; // 셔플 재생 상태 변수
var userId; // 사용자 ID 저장 변수
var timer; // 페이지 전환 시 타이머 변수

// mainContent div에 내용을 로드하는 함수
function openPage(url) {
  // 기존 타이머가 있다면 초기화
  if (timer != null) {
    clearTimeout(timer);
  }

  // URL에 쿼리 매개변수가 없으면 추가
  if (url.indexOf("?") == -1) {
    url = url + "?";
  }
  
  // URL 인코딩
  var encodedUrl = encodeURI(url);
  console.log(encodedUrl); // 인코딩된 URL 출력
  $("#mainContent").load(encodedUrl); // mainContent div에 URL의 내용을 로드
  $("body").scrollTop(0); // 페이지가 로드되면 상단으로 스크롤
  history.pushState(null, null, url); // 브라우저의 히스토리에 URL 추가
}

// 페이지 로드시 'song.php'를 바로 로드
document.addEventListener("DOMContentLoaded", function() {
  openPage('song.php');
});

// 초 단위로 주어진 시간을 분:초 형식으로 변환하는 함수
function formatTime(seconds) {
  var time = Math.round(seconds); // 시간을 반올림
  var minutes = Math.floor(time / 60); // 분 계산
  var seconds = time - (minutes * 60); // 초 계산
  var extraZero = (seconds < 10) ? "0" : ""; // 초가 10보다 작으면 앞에 0 추가
  return minutes + ":" + extraZero + seconds; // "분:초" 형식으로 반환
}

// 현재 재생 시간과 남은 시간, 진행 바를 업데이트하는 함수
function updateTimeProgressBar(audio) {
  $(".progressTime.current").text(formatTime(audio.currentTime)); // 현재 시간 표시
  $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime)); // 남은 시간 표시
  var progress = audio.currentTime / audio.duration * 100; // 진행 바의 퍼센트 계산
  $(".playbackBar .progress").css("width", progress + "%"); // 진행 바의 너비 업데이트
}

// 볼륨 진행 바의 퍼센트를 업데이트하는 함수
function updateVolumeProgressBar(audio) {
  var volume = audio.volume * 100; // 볼륨을 퍼센트로 변환
  $(".volumeBar .progress").css("width", volume + "%"); // 볼륨 바의 너비 업데이트
}

// 임시 플레이리스트의 첫 번째 곡을 재생하는 함수
function playFirstSong() {
  setTrack(tempPlaylist[0], tempPlaylist, true); // 첫 번째 곡을 재생
}

// Audio 객체 생성자
function Audio() {
  this.currentlyPlaying; // 현재 재생 중인 곡
  this.audio = document.createElement('audio'); // 오디오 엘리먼트 생성

  // 곡이 끝났을 때 다음 곡을 재생하는 이벤트 리스너
  this.audio.addEventListener("ended", function () {
    nextSong(); // 다음 곡 재생
  });

  // 곡을 재생할 수 있을 때 곡의 길이를 표시하는 이벤트 리스너
  this.audio.addEventListener("canplay", function () {
    var duration = formatTime(this.duration); // 총 재생 시간 포맷
    $(".progressTime.remaining").text(duration); // 남은 시간 표시
  });

  // 재생 중일 때 시간 업데이트하는 이벤트 리스너
  this.audio.addEventListener("timeupdate", function () {
    if (this.duration) {
      updateTimeProgressBar(this); // 시간 진행 바 업데이트
    }
  });

  // 볼륨이 변경될 때 볼륨 진행 바 업데이트하는 이벤트 리스너
  this.audio.addEventListener("volumechange", function () {
    updateVolumeProgressBar(this); // 볼륨 진행 바 업데이트
  });

  // 트랙을 설정하는 메소드
  this.setTrack = function (track) {
    this.currentlyPlaying = track; // 현재 곡 설정
    this.audio.src = track.path; // 오디오 소스 경로 설정
  }

  // 재생 메소드
  this.play = function () {
    this.audio.play(); // 오디오 재생
  }

  // 정지 메소드
  this.pause = function () {
    this.audio.pause(); // 오디오 정지
  }

  // 재생 시간을 설정하는 메소드
  this.setTime = function (seconds) {
    this.audio.currentTime = seconds; // 지정된 초로 현재 재생 시간 설정
  }
}
