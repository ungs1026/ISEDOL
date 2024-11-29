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
    self.location.href = "./user.php?sn=" + sn.value + "&sf=" + sf.value;
  });

  // all list
  const btn_all = document.querySelector("#btn_all");
  btn_all.addEventListener("click", () => {
    self.location.href = "./user.php";
  });

  // edit
  const btn_mem_edit = document.querySelectorAll(".btn_mem_edit");
  btn_mem_edit.forEach((box) => {
    box.addEventListener("click", () => {
      const id = box.dataset.id;
      self.location.href = "./page/user_edit.php?id=" + id;
    });
  });

  // delete
  const btn_mem_delete = document.querySelectorAll(".btn_mem_delete");
  btn_mem_delete.forEach((box) => {
    box.addEventListener("click", () => {
      if (confirm("본 회원을 삭제하시겠습니까?")) {
        const id = box.dataset.id;

        const f = new FormData();
        f.append("id", id);

        const xhr = new XMLHttpRequest();
        xhr.open("post", "./includes/user_delete.php", true);
        xhr.send(f);

        xhr.onload = () => {
          if (xhr.status == 200) {
            const data = JSON.parse(xhr.responseText);
            if (data.result == "user_del_success") {
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
});
