<?php
include_once '../../../includes/pdo-dbconfig.php';
include_once '../../includes/classes/User.php';

$user = new User($pdo);

$idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ? $_POST['idx'] : '';
$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';
$email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
$level = (isset($_POST['level']) && $_POST['level'] != '') ? $_POST['level'] : '';
$old_photo = (isset($_POST['old_photo']) && $_POST['old_photo'] != '') ? $_POST['old_photo'] : '';

$mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

// Profile Image 처리
if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
	$new_photo = $_FILES['photo'];
	// profile_upload($id, $new_photo, $old_photo = ''
	$old_photo = $user->profile_upload($id, $new_photo, $old_photo);
}

if ($mode == 'email_chk') {
	if ($email == '') {
		die(json_encode(['result' => 'empty_email']));
	}

	// 이메일 형식 체크
	if ($user->email_format_check($email) === false) {
		die(json_encode(['result' => 'email_format_wrong']));
	}

	if ($user->email_exists($email)) {
		die(json_encode(['result' => 'fail']));
	} else {
		die(json_encode(['result' => 'success']));
	}
} else if ($mode == 'edit') {
	$arr = [
		'idx' => $idx,
		'name' => $name,
		'password' => $password,
		'email' => $email,
		'photo' => $old_photo,
		'level' => $level,
	];
	
	$user->edit($arr);
	
	echo "
		<script>
			alert('수정되었습니다.');
			self.location.href='../../admin.php';
		</script>
		";
}