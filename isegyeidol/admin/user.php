<?php
include_once './includes/part/inc_common.php';
$menu_code = 'user';
$js_array = ['js/user.js'];
$css_array = ['css/user.css'];
$g_title = 'User Admin';
$logo = '../source/img/main-logo.png';
$footerLogo = '../source/img/Notion-logo.png';
$commonC = 'css/common.css';

include_once '../includes/pdo-dbconfig.php';
include './includes/classes/User.php';
include_once './includes/lib.php';

$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

// $total, $limit, $page_limit, $page, $param

$paramArr = ['sn' => $sn, 'sf' => $sf];

// user
$user = new User($pdo);

$total = $user->total($paramArr);
$limit = 5;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';

$memArr = $user->list($page, $limit, $paramArr);

// header
include_once './includes/part/inc_header.php';

?>

<main class="border rounded-5 p-5">
	<div class="container">
		<h3>User Management</h3>
	</div>

	<table class="table table-border">
		<tr>
			<th>IDX</th>
			<th>User(Name)</th>
			<th>Email</th>
			<th>SignUpDate</th>
			<th>Level</th>
			<th>Management</th>
		</tr>

		<?php
		foreach ($memArr as $row) {
			// 데이터 정리
			// $row['create_at'] = substr($row['create_at'], 0, 16);
		?>
			<tr>
				<td><?= $row['id'] ?></td>
				<td><?= $row['username'] ?></td>
				<td><?= $row['email'] ?></td>
				<td><?= $row['signUpDate'] ?></td>
				<td>
					<?php if ($row['level'] == 10) {
						echo 'Admin';
					} else if ($row['level'] == 1) { echo 'User'; }
					else { echo 'Guest'; } ?>
				</td>
				<td>
					<button class="btn btn-primary btn-sm btn_mem_edit" data-id="<?= $row['id']; ?>">수정</button>
					<button class="btn btn-danger btn-sm btn_mem_delete" data-id="<?= $row['id']; ?>">삭제</button>
				</td>
			</tr>
		<?php } ?>
	</table>

	<div class="container mt-3 d-flex gap-2 w-50 ">
		<select class="form-select w-25" name="sn" id="sn">
			<option value="1">아이디(이름)</option>
			<option value="2">이메일</option>
		</select>
		<input type="text" class="form-control w-25" id="sf" name="sf">
		<button class="btn btn-primary w-25" id="btn_search">검색</button>
		<button class="btn btn-success w-25" id="btn_all">전체목록</button>
	</div>

	<div class="d-flex mt-3 justify-content-center align-items-start">
		<?php
		$param = '&sn=' . $sn . '&sf=' . $sf;
		$pagination = My_Pagination($total, $limit, $page_limit, $page, $param);
		echo $pagination;
		?>
	</div>
</main>

<?php 
include_once './includes/part/inc_footer.php';
?>