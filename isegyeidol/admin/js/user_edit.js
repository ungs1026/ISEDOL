document.addEventListener("DOMContentLoaded", () => {
  // 이메일 중복 확인
  const btn_email_check = document.querySelector("#btn_email_check");
  btn_email_check.addEventListener("click", () => {
    const f = document.input_form;
    if (f.old_email.value == f.email.value) {
      alert(
        "이메일 변경 사항이 없어 중복확인이 필요없습니다. 수정 후 클릭해주세요."
      );
      return false;
    }

    if (f.email.value == "") {
      alert("이메일을 입력해주세요.");
      f.email.focus();
      return false;
    }

    // AJAX
    const f1 = new FormData();
    f1.append("email", f.email.value);
    f1.append("mode", "email_chk");

    const xhr = new XMLHttpRequest();
    xhr.open("post", "../page/process/user_process.php", true);
    xhr.send(f1);

    xhr.onload = () => {
      if (xhr.status == 200) {
        const data = JSON.parse(xhr.responseText)
				if (data.result == 'success') {
					alert('사용 가능한 이메일 입니다.');
					document.input_form.email_chk.value = '1';
				} else if (data.result == 'fail') {
					document.input_form.email_chk.value = '0';
					alert('이미 사용중인 이메일입니다. 다른 이메일를 입력해 주세요.');
					f_email.value = '';
					f_email.focus();
				} else if (data.result == 'empty_email') {
					alert('이메일이 비어 있습니다.');
					f_email.focus();
				} else if (data.result == 'email_format_wrong') {
					alert('이메일이 형식에 맞지 않습니다.');
					f_email.value = '';
					f_email.focus();
				}
      } else {
				alert('fail')
			}
    };
  });

	// 사진
	const f_photo = document.querySelector('#f_photo');
	f_photo.addEventListener('change', (e) => {
		const reader = new FileReader();
		reader.readAsDataURL(e.target.files[0]);

		reader.onload = function (e) {
			const f_preview = document.querySelector('#f_preview');
			f_preview.setAttribute('src', e.target.result);
		}
	})

	// 수정 확인 버튼 클릭 시
	const btn_submit = document.querySelector('#btn_submit');
	btn_submit.addEventListener('click', () => {
		const f = document.input_form;

		// 이름 확인
		if (f.name.value == '') {
			alert('이름 입력해 주세요');
			f.name.focus();
			return false;
		}

		// 비밀번호 일치 여부 확인
		if (f.password.value != f.password2.value) {
			alert('비밀번호가 서로 일치하지 않습니다.');
			f.password.value = '';
			f.password2.value = '';
			f.password.focus();
			return false;
		}

		// 이메일 확인
		if (f.email.value == '') {
			alert('이메일을 입력해 주세요.');
			f.email.focus();
			return false;
		}
		// 이메일 중복 체크
		if (f.email.value != f.old_email.value) {
			if (f.email_chk.value == 0) {
				alert('이메일 중복확인을 해주세요');
				return false;
			}
		}

		f.submit();
	})

	const btn_cancel = document.querySelector('#btn_cancel')
	btn_cancel.addEventListener('click', () => {
		history.go(-1);
	})
});
