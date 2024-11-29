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
    self.location.href = "./album.php?sn=" + sn.value + "&sf=" + sf.value;
  });

  // all list
  const btn_all = document.querySelector("#btn_all");
  btn_all.addEventListener("click", () => {
    self.location.href = "./album.php";
  });

  // delete
  const btn_album_delete = document.querySelectorAll(".btn_album_delete");
  btn_album_delete.forEach((box) => {
    box.addEventListener("click", () => {
      if (confirm("본 앨범을 삭제하시겠습니까?")) {
        const id = box.dataset.id;

        const f = new FormData();
        f.append("id", id);

        const xhr = new XMLHttpRequest();
        xhr.open("post", "./includes/album_delete.php", true);
        xhr.send(f);

        xhr.onload = () => {
          if (xhr.status == 200) {
            const data = JSON.parse(xhr.responseText);
            if (data.result == "album_del_success") {
              self.location.reload();
            }
          } else {
            alert("Error : " + xhr.status);
          }
        };
      } else {
        alert("취소되었습니다.");
      }
    });
  });

  // Add Album
  const btn_album_create = document.querySelector("#btn_album_create");
  btn_album_create.addEventListener("click", () => {
    // 값 가져오기
    const album_title = document.querySelector("#album_title");
    const album_year = document.querySelector("#album_year").value;
    const album_date = document.querySelector("#album_date").value;
    const album_kind = document.querySelector("#album_kind").value;
    const album_thumbnail = document.querySelector("#album_thumbnail").files[0];
    const album_youtube = document.querySelector("#album_youtube");

    if (album_title.value == "") {
      alert("타이틀을 작성해주세요");
      album_title.focus();
      return false;
    }
    if (album_date == "") {
      alert("앨범 날짜를 선택해주세요.");
      return false;
    }
    if (album_youtube.value == "") {
      alert("Youtube URL을 작성해주세요");
      album_youtube.focus();
      return false;
    }

    const f = new FormData();
    f.append("title", album_title.value);
    f.append("year", album_year);
    f.append("date", album_date);
    f.append("kind", album_kind);
    f.append("thumbnail", album_thumbnail);
    f.append("youtube", album_youtube.value);

    // AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("post", "./page/process/album_process.php", true);
    xhr.send(f);

    xhr.onload = () => {
      if (xhr.status == 200) {
        const data = JSON.parse(xhr.responseText);
        if (data.result == "success") {
          alert("추가되었습니다.");
          self.location.reload();
        }
      } else {
        alert("Error : " + xhr.status);
      }
    };
  }); // Add Album
});
