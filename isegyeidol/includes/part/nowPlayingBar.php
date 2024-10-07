<?php
// MySQL 데이터베이스에서 랜덤으로 10개의 노래 ID를 선택
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

// 결과를 담을 배열 초기화
$resultArray = array();

// 쿼리 결과에서 각 노래의 ID를 배열에 추가
while ($row = mysqli_fetch_array($songQuery)) {
  array_push($resultArray, $row['id']);
}

// 결과 배열을 JSON 형식으로 변환
$jsonArray = json_encode($resultArray);
?>

<!-- JavaScript -->
<script>
  // 문서가 로드되면 실행되는 초기화 코드
  $(document).ready(function() {
    var newPlaylist = <?php echo $jsonArray; ?>; // PHP에서 전달된 노래 ID 배열
    audioElement = new Audio(); // 오디오 요소 생성
    setTrack(newPlaylist[0], newPlaylist, false); // 첫 번째 트랙 설정
    updateVolumeProgressBar(audioElement.audio); // 볼륨 프로그레스 바 업데이트

    // 현재 재생 바와 관련된 기본 동작을 방지
    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
      e.preventDefault();
    });

    // 재생 바에서 마우스 이벤트 처리
    $(".playbackBar .progressBar").mousedown(function() {
      mouseDown = true; // 마우스 클릭 상태
    });
    $(".playbackBar .progressBar").mousemove(function(e) {
      if (mouseDown == true) {
        timeFromOffset(e, this); // 마우스 위치에 따라 재생 시간 조정
      }
    });
    $(".playbackBar .progressBar").mouseup(function(e) {
      timeFromOffset(e, this); // 마우스가 떨어질 때 재생 시간 조정
    });

    // 볼륨 바에서 마우스 이벤트 처리
    $(".volumeBar .progressBar").mousedown(function() {
      mouseDown = true; // 마우스 클릭 상태
    });
    $(".volumeBar .progressBar").mousemove(function(e) {
      if (mouseDown == true) {
        var percentage = e.offsetX / $(this).width(); // 볼륨 퍼센트 계산
        if (percentage >= 0 && percentage <= 1) {
          audioElement.audio.volume = percentage; // 오디오 볼륨 설정
        }
      }
    });

    // 마우스 버튼이 떨어질 때 클릭 상태 초기화
    $(document).mouseup(function() {
      mouseDown = false;
    });
  });

  // 마우스 위치를 기반으로 재생 시간을 설정하는 함수
  function timeFromOffset(mouse, progressBar) {
    var percentage = mouse.offsetX / $(progressBar).width() * 100; // 진행 바에 대한 퍼센트 계산
    var seconds = audioElement.audio.duration * (percentage / 100); // 재생 시간으로 변환
    audioElement.setTime(seconds); // 오디오 재생 시간 설정
  }

  // 이전 곡을 재생하는 함수
  function prevSong() {
    if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
      audioElement.setTime(0); // 곡을 처음부터 재생
    } else {
      currentIndex--; // 이전 곡으로 이동
      setTrack(currentPlaylist[currentIndex], currentPlaylist, true); // 이전 곡 재생
    }
  }

  // 다음 곡 재생
  function nextSong() {
    if (repeat == true) {
      audioElement.setTime(0); // 시간 초기화
      playSong(); // 자동 재생
      return;
    }
    if (currentIndex == currentPlaylist.length - 1) {
      currentIndex = 0; // 마지막 곡일 경우 처음 곡으로
    } else {
      currentIndex++; // 다음 곡으로 이동
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex]; // 셔플에 따라 재생할 곡 선택
    setTrack(trackToPlay, currentPlaylist, true); // 선택한 곡 재생
  }

  // 반복 재생 기능 설정
  function setRepeat() {
    repeat = !repeat; // 반복 여부 토글
    var imageName = repeat ? "repeat-active.png" : "repeat.png"; // 아이콘 변경
    $(".controlButton.repeat img").attr("src", "source/icons/" + imageName);
  }

  // 볼륨 음소거 설정
  function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted; // 음소거 토글
    var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png"; // 아이콘 변경
    $(".controlButton.volume img").attr("src", "source/icons/" + imageName);
  }

  // 랜덤곡 재생 기능 설정
  function setShuffle() {
    shuffle = !shuffle; // 셔플 여부 토글
    var imageName = shuffle ? "shuffle-active.png" : "shuffle.png"; // 아이콘 변경
    $(".controlButton.shuffle img").attr("src", "source/icons/" + imageName);

    if (shuffle == true) {
      shuffleArray(shufflePlaylist); // 랜덤화된 재생 목록 생성
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id); // 현재 곡 인덱스 설정
    } else {
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id); // 일반 재생 목록으로 복원
    }
  }

  // 배열을 셔플하는 함수
  function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
      j = Math.floor(Math.random() * i); // 랜덤 인덱스 선택
      x = a[i - 1]; // 현재 인덱스와 랜덤 인덱스의 값 교환
      a[i - 1] = a[j];
      a[j] = x;
    }
  }

  // 트랙을 설정하고 필요한 데이터를 가져오는 함수
  function setTrack(trackId, newPlaylist, play) {
    if (newPlaylist != currentPlaylist) { // 현재 재생 목록과 다른 경우
      currentPlaylist = newPlaylist; // 새 재생 목록으로 업데이트
      shufflePlaylist = currentPlaylist.slice(); // 셔플을 위한 복사본 생성
      shuffleArray(shufflePlaylist); // 셔플 배열 생성
    }

    // 셔플 여부에 따라 인덱스 설정
    if (shuffle) {
      currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
      currentIndex = currentPlaylist.indexOf(trackId);
    }
    
    pauseSong(); // 현재 곡 일시 정지

    // AJAX 요청을 통해 곡 정보 가져오기
    $.post("includes/handlers/ajax/getSongJson.php", {
      songId: trackId
    }, function(data) {
      var track = JSON.parse(data); // JSON 데이터를 객체로 변환

      // UI 업데이트
      $(".trackName span").text(track.title);
      $(".content .albumLink img").attr("src", track.songArt);

      // 아티스트 정보 가져오기
      $.post("includes/handlers/ajax/getArtistJson.php", {
        artistId: track.artist
      }, function(data) {
        var artist = JSON.parse(data);
        $(".trackInfo .artistName span").text(artist.name);
        $(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");
      });

      // 앨범 정보 가져오기
      $.post("includes/handlers/ajax/getAlbumJson.php", {
        albumId: track.album
      }, function(data) {
        var album = JSON.parse(data);
        $(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
        $(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id + "')");
      });

      audioElement.setTrack(track); // 오디오 트랙 설정
      if (play == true) {
        playSong(); // 즉시 재생
      }
    });
  }

  // 음악 재생
  function playSong() {
    if (audioElement.audio.currentTime == 0) {
      $.post("includes/handlers/ajax/updatePlays.php", {
        songId: audioElement.currentlyPlaying.id // 재생 횟수 업데이트
      });
    }

    // 재생 버튼과 일시 정지 버튼의 UI 변경
    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play(); // 오디오 재생
  }

  // 음악 정지
  function pauseSong() {
    // 재생 버튼과 일시 정지 버튼의 UI 변경
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause(); // 오디오 정지
  }
</script>

<div id="nowPlayingBarContainer">

  <div id="nowPlayingBar">

    <div id="nowPlayingLeft">
      <div class="content">
        <span class="albumLink">
          <img role="link" tabindex="0" src="" class="albumArtwork">
        </span>

        <div class="trackInfo">

          <span class="trackName">
            <span role="link" tabindex="0"></span>
          </span>

          <span class="artistName">
            <span role="link" tabindex="0"></span>
          </span>

        </div>
      </div>
    </div>

    <div id="nowPlayingCenter">

      <div class="content playerControls">

        <div class="buttons">

          <button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
            <img src="source/icons/shuffle.png" alt="Shuffle">
          </button>

          <button class="controlButton previous" title="Previous button" onclick="prevSong()">
            <img src="source/icons/previous.png" alt="Previous">
          </button>

          <button class="controlButton play" title="Play button" onclick="playSong()">
            <img src="source/icons/play.png" alt="Play">
          </button>

          <button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
            <img src="source/icons/pause.png" alt="Pause">
          </button>

          <button class="controlButton next" title="Next button" onclick="nextSong()">
            <img src="source/icons/next.png" alt="Next">
          </button>

          <button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
            <img src="source/icons/repeat.png" alt="Repeat">
          </button>

        </div>


        <div class="playbackBar">
          <span class="progressTime current">0.00</span>

          <div class="progressBar">
            <div class="progressBarBg">
              <div class="progress"></div>
            </div>
          </div>

          <span class="progressTime remaining">0.00</span>
        </div>
      </div>
    </div>

    <div id="nowPlayingRight">
      <div class="volumeBar">

        <button class="controlButton volume" title="Volume button" onclick="setMute()">
          <img src="source/icons/volume.png" alt="Volume">
        </button>

        <div class="progressBar">
          <div class="progressBarBg">
            <div class="progress"></div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>