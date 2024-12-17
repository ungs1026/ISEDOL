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
    self.location.href = "./goods.php?sn=" + sn.value + "&sf=" + sf.value;
  });

  // all list
  const btn_all = document.querySelector("#btn_all");
  btn_all.addEventListener("click", () => {
    self.location.href = "./goods.php";
  });

  // delete
  const btn_goods_delete = document.querySelectorAll(".btn_goods_delete");
  btn_goods_delete.forEach((box) => {
    box.addEventListener("click", () => {
      if (confirm("본 굿즈를 삭제하시겠습니까?")) {
        const id = box.dataset.id;

        const f = new FormData();
        f.append("id", id);

        const xhr = new XMLHttpRequest();
        xhr.open("post", "./includes/goods_delete.php", true);
        xhr.send(f);

        xhr.onload = () => {
          if (xhr.status == 200) {
            const data = JSON.parse(xhr.responseText);
            if (data.result == "success") {
              alert("삭제되었습니다.");
              self.location.reload();
            }
          } else {
            alert("Error : " + xhr.status);
          }
        };
      }
    });
  });

  // input
  const btn_goods_create = document.querySelector("#btn_goods_create");
  btn_goods_create.addEventListener("click", () => {
    // 변수 가져오기
    const goods_name = document.querySelector("#goods_name");
    const goods_price = document.querySelector("#goods_price");
    const goods_img = document.querySelector("#goods_img").files[0];
    const goods_detail_img =
      document.querySelector("#goods_detail_img").files[0];
    const goods_production = document.querySelector("#goods_production");
    const goods_sales = document.querySelector("#goods_sales").value;
    const goods_kind = document.querySelector("#goods_kind").value;

    // 비교
    if (goods_name.value == "") {
      alert("굿즈 이름을 작성해주세요");
      goods_name.focus();
      return false;
    }
    if (goods_price.value == "") {
      alert("굿즈 가격을 작성해주세요");
      goods_price.focus();
      return false;
    }
    if (goods_production.value == "") {
      alert("굿즈 세트 이름을 작성해주세요");
      goods_production.focus();
      return false;
    }

    // dataform 안에 넣기
    const f = new FormData();
    f.append("name", goods_name.value);
    f.append("price", goods_price.value);
    f.append("img", goods_img);
    f.append("detail_img", goods_detail_img);
    f.append("production", goods_production.value);
    f.append("sales", goods_sales);
    f.append("kind", goods_kind);

    // AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("post", "./page/process/goods_process.php", true);
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
  });
});
