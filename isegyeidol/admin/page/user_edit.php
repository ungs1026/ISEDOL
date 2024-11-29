<?php
$menu_code = 'user';
$js_array = ['../js/user_edit.js'];
$css_array = ['../css/user.css'];
$g_title = 'User Admin';
$logo = '../../source/img/main-logo.png';
$footerLogo = '../../source/img/Notion-logo.png';
$commonC = '../css/common.css';

include '../includes/part/inc_header.php';
include '../../includes/pdo-dbconfig.php';
include '../includes/classes/User.php';
include_once '../includes/lib.php';

$id = (isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id'])) ? $_GET['id'] : '';

if ($id == '') {
	die("<script>
		alert('id 값이 비었습니다.');
		history.go(-1);
		</script>");
}

$user = new User($pdo);
$row = $user->getInfoId($id);

?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<main class="w-100 mx-auto border rounded-5 p-5 ">
	<h1 class="text-center">User Edit</h1>

	<!-- enctype => 이미지 때문 -->
	<form name="input_form" method="post" enctype="multipart/form-data" action="./process/user_process.php" autocomplete="off">
		<input type="hidden" name="mode" value="edit">
		<input type="hidden" name="idx" value="<?= $row['id']; ?>">
		<input type="hidden" name="email_chk" value="0">
		<input type="hidden" name="old_email" value="<?= $row['email']; ?>">
		<input type="hidden" name="old_photo" value="<?= $row['profilePic']; ?>">
		<div class="d-flex gap-2 align-items-end">
			<div>
				<label for="f_id" class="form-label">아이디</label>
				<input type="text" name="id" value="<?= $row['username'] ?>" readonly class="form-control" id="f_id" placeholder="아이디를 입력해주세요.">
			</div>
		</div>

		<div class="d-flex mt-3 gap-2 align-items-end">
			<div class="w-25">
				<label for="f_name" class="form-label">이름</label>
				<input type="text" name="name" value="<?= $row['lastName'] . $row['firstName']; ?>" class="form-control" id="f_name" placeholder="이름을 입력해주세요.">
			</div>
			<div class="w-25">
				<label for="f_name" class="form-label">LEVEL</label>
				<select name="level" id="" class="form-select">
					<option value="1" <?php if ($row['level'] == 1) echo " selected;" ?>>일반회원</option>
					<option value="10" <?php if ($row['level'] == 10) echo " selected;" ?>>관리자</option>
				</select>
			</div>
		</div>

		<div class="d-flex mt-3 gap-2 justify-content-between">
			<div class="flex-grow-1">
				<label for="f_pw" class="form-label">비밀번호</label>
				<input type="password" name="password" class="form-control" id="f_pw" placeholder="비밀번호를 입력해주세요.">
			</div>
			<div class="flex-grow-1">
				<label for="f_pw2" class="form-label">비밀번호 확인</label>
				<input type="password" name="password2" class="form-control" id="f_pw2" placeholder="비밀번호를 입력해주세요.">
			</div>
		</div>

		<div class="d-flex mt-3 gap-2 align-items-end">
			<div class="flex-grow-1">
				<label for="f_email" class="form-label">이메일</label>
				<input type="email" name="email" value="<?= $row['email']; ?>" class="form-control" id="f_email" placeholder="이메일을 입력해주세요.">
			</div>
			<button type="button" class="btn btn-secondary" id="btn_email_check">이메일 중복확인</button>
		</div>

		<div class="mt-3 d-flex gap-5">
			<div>
				<label for="f_photo" class="form-label">프로필이미지</label>
				<input type="file" name="photo" id="f_photo" class="form-control">
			</div>
			<?php if ($row['profilePic'] != '') {
				echo '<img src="../../'.$row['profilePic'].'" id="f_preview" class="w-25" alt="photo img" style="filter: drop-shadow(0 1px 2px black);">';
			} else {
				echo '<img src="../../source/img/leaf.png" id="f_preview" class="w-25" alt="photo img" style="filter: drop-shadow(0 1px 2px black);">';
			}
			?>
		</div>

		<div class="mt-3 d-flex gap-2">
			<button type="button" class="btn btn-primary flex-grow-1" id="btn_submit">수정확인</button>
			<button type="button" class="btn btn-secondary flex-grow-1" id="btn_cancel">수정취소</button>
		</div>
	</form>
</main>

<?php
include '../includes/part/inc_footer.php';
?>