
<?php
include_once './includes/part/inc_common.php';
$menu_code = 'album';
$js_array = ['js/album.js'];
$css_array = ['css/album.css'];
$g_title = 'Album Admin';
$logo = '../source/img/main-logo.png';
$footerLogo = '../source/img/Notion-logo.png';
$commonC = 'css/common.css';

include_once '../includes/pdo-dbconfig.php';
include './includes/classes/Album.php';
include_once './includes/lib.php';

$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

// $total, $limit, $page_limit, $page, $param

$paramArr = ['sn' => $sn, 'sf' => $sf];

// user
$album = new Album($pdo);

$total = $album->total($paramArr);
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';

$albumArr = $album->list($page, $limit, $paramArr);

// header
include_once './includes/part/inc_header.php';

?>

<main class="border rounded-5 p-5">
	<div class="container">
		<h3>Albmu Management</h3>
	</div>

	<table class="table table-border">
		<tr>
			<th>IDX</th>
			<th>Thumbnail</th>
			<th>Title</th>
			<th>Date</th>
			<th>Kind</th>
			<th>Youtube</th>
			<th>Management</th>
		</tr>

		<?php
		foreach ($albumArr as $row) {
			// 데이터 정리
			// $row['create_at'] = substr($row['create_at'], 0, 16);
		?>
			<tr>
				<td><?= $row['id'] ?></td>
				<td><img src="../<?= $row['thumbnail'] ?>" alt="" style="width: 3rem;"></td>
				<td><?= $row['name'] ?></td>
				<td><?= $row['date'] ?></td>
				<td><?= $row['kind'] ?></td>
				<td>
					<a href="<?= $row['youtube'] ?>"><img src="../source/img/youtube.png" alt="" style="width: 3rem;"></a>
				</td>
				<td>
					<button class="btn btn-danger btn-sm btn_album_delete" data-id="<?= $row['id']; ?>">삭제</button>
				</td>
			</tr>
		<?php } ?>
	</table>

	<div class="container mt-3 d-flex gap-2 w-50 ">
		<select class="form-select w-25" name="sn" id="sn">
			<option value="1">Title</option>
			<option value="2">Year</option>
		</select>
		<input type="text" class="form-control w-25" id="sf" name="sf">
		<button class="btn btn-primary w-25" id="btn_search">검색</button>
		<button class="btn btn-success w-25" id="btn_all">전체목록</button>
	</div>

	<div class="d-flex mt-3 justify-content-between align-items-start">
		<?php
		$param = '&sn=' . $sn . '&sf=' . $sf;
		$pagination = My_Pagination($total, $limit, $page_limit, $page, $param);
		echo $pagination;
		?>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#album_create_modal" id="btn_create_modal" style="margin-right: 2rem;">Add Album</button>
	</div>
</main>

<!-- Modal -->
<div class="modal fade" id="album_create_modal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalTitle">앨범 추가</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex flex-column gap-3">
				<input type="text" id="album_title" class="form-control" placeholder="Title">
				<div class="d-flex gap-2">
					<div class="w-50">
						<label for="album_year" class="form-label mb-0">Year</label>
						<select name="year" id="album_year" class="form-select">
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
						</select>
					</div>
					<div class="w-50">
						<label for="album_date" class="form-label mb-0">Date</label>
						<input type="date" id="album_date" class="form-control">
					</div>
				</div>
				<label for="album_kind" class="form-label mb-0">Kind</label>
				<select name="kind" id="album_kind" class="form-select">
					<option value="cover">cover</option>
					<option value="single">single</option>
				</select>
				<label for="album_thumbnail" class="form-label mb-0">Thumbnail</label>
				<input type="file" id="album_thumbnail" class="form-control">
				<label for="album_youtube" class="form-label mb-0">Youtube</label>
				<input type="text" id="album_youtube" class="form-control" placeholder="Youtube URL">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_album_create">확인</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php
include_once './includes/part/inc_footer.php';
?>