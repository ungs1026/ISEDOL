document.addEventListener("DOMContentLoaded", () => {
  // search
  const btn_search = document.querySelector("#btn_search");
  btn_search.addEventListener("click", () => {
    const sf = document.querySelector("#sf");
    if (sf.value == "") {
      alert("검색어를 입력해주세요");
      sf.focus();
      return false;
    }
    const sn = document.querySelector("#sn");
    self.location.href = "./music.php?sn=" + sn.value + "&sf=" + sf.value;
  });

  // all list
  const btn_all = document.querySelector("#btn_all");
  btn_all.addEventListener("click", () => {
    self.location.href = "./music.php";
  });

  // delete
  const btn_music_delete = document.querySelectorAll(".btn_music_delete");
  btn_music_delete.forEach((box) => {
    box.addEventListener("click", () => {
      if (confirm("본 음악을 삭제하시겠습니까?")) {
        const id = box.dataset.id;

        const f = new FormData();
        f.append("id", id);
        f.append("mode", "delete");

        const xhr = new XMLHttpRequest();
        xhr.open("post", "./page/process/music_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
          if (xhr.status == 200) {
            const data = JSON.parse(xhr.responseText);
            if (data.result == "success") {
              alert("삭제되었습니다.");
              self.location.reload();
            } else if (data.result == "empty_id") {
              alert("id값이 없습니다.");
              return false;
            } else if (data.result == "empty_mode") {
              alert("mode 값이 비었습니다");
              return false;
            }
          } else {
            alert("Error : " + xhr.status);
          }
        };
      }
    });
  });

  // input
  const btn_music_create = document.querySelector("#btn_music_create");
  btn_music_create.addEventListener("click", () => {
    // 값
    const music_title = document.querySelector("#music_title");
    const music_artist = document.querySelector("#music_artist");
    const music_album = document.querySelector("#music_album");
    const music_duration = document.querySelector("#music_duration");
    const music_mp3 = document.querySelector("#music_mp3").files[0];
    const music_songArt = document.querySelector("#music_songArt").files[0];

    // 값 확인
    if (music_title.value == "") {
      alert("타이틀을 입력해주세요");
      music_title.focus();
      return false;
    }
    if (music_duration.value == "") {
      alert("재생시간을 입력해주세요");
      music_duration.focus();
      return false;
    }

    // Form Data
    const f1 = new FormData();
    f1.append("title", music_title.value);
    f1.append("artist", music_artist.value);
    f1.append("album", music_album.value);
    f1.append("duration", music_duration.value);
    f1.append("path", music_mp3);
    f1.append("albumOrder", music_artist.value);
    f1.append("songArt", music_songArt);
    f1.append("mode", "add");

    const xhr = new XMLHttpRequest();
    xhr.open("post", "./page/process/music_process.php", true);
    xhr.send(f1);

    xhr.onload = () => {
      if (xhr.status == 200) {
        const data = JSON.parse(xhr.responseText);
        if (data.result == "success_input") {
          alert("추가되었습니다.");
          self.location.reload();
        } else if (data.result == "empty_mode") {
          alert("mode 값이 비었습니다");
          return false;
        } else if (data.result == "not_arrowed_ext") {
          alert("MP3파일의 형식이 잘못되었습니다. .mp3 파일로 업로드해주세요");
          self.location.reload();
          return false;
        } else if (data.result == "title_repeated") {
          alert("Title이 중복됩니다. 중복되지 않은 곡을 업로드해주세요");
          self.location.reload();
          return false;
        }
      } else {
        alert("Error : " + xhr.status);
      }
    };
  });
});
