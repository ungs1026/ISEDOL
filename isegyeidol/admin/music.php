<?php
include_once './includes/part/inc_common.php';
$menu_code = 'music';
$js_array = ['js/music.js'];
$css_array = ['css/music.css'];
$g_title = 'Music Admin';
$logo = '../source/img/main-logo.png';
$footerLogo = '../source/img/Notion-logo.png';
$commonC = 'css/common.css';

include_once '../includes/pdo-dbconfig.php';
include './includes/classes/Music.php';
include_once './includes/lib.php';

$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

// $total, $limit, $page_limit, $page, $param

$paramArr = ['sn' => $sn, 'sf' => $sf];

// user
$music = new Music($pdo);

$total = $music->total($paramArr);
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';
$musicArr = $music->list($page, $limit, $paramArr);

$num = $total - (($page - 1) * $limit);
// header
include_once './includes/part/inc_header.php';

?>

<main class="border rounded-5 p-5">
	<div class="container">
		<h3>Music Management</h3>
	</div>

	<table class="table table-border">
		<tr>
			<th>IDX</th>
			<th>SongArt</th>
			<th>Title</th>
			<th>Artist</th>
			<th>Album</th>
			<th>Duration</th>
			<th>Management</th>
		</tr>

		<?php
		foreach ($musicArr as $row) {
			// 데이터 정리
			// $row['create_at'] = substr($row['create_at'], 0, 16);
		?>
			<tr>
				<td><?= $num ?></td>
				<td><img src="../<?= $row['songArt'] ?>" alt="" style="width: 3rem;"></td>
				<td><?= $row['title'] ?></td>
				<td>
					<?php
					switch ($row['artist']) {
						case 1:
							echo 'INE';
							break;
						case 2:
							echo 'JINGBURGER';
							break;
						case 3:
							echo 'LILPA';
							break;
						case 4:
							echo 'JURURU';
							break;
						case 5:
							echo 'GOSEGU';
							break;
						case 6:
							echo 'VIICHAN';
							break;
					}
					?>
				</td>
				<td>
					<?php
					switch ($row['album']) {
						case 1:
							echo 'Playlist_INE';
							break;
						case 2:
							echo 'Playlist_JINGBURGER';
							break;
						case 3:
							echo 'Playlist_LILPA';
							break;
						case 4:
							echo 'Playlist_JURURU';
							break;
						case 5:
							echo 'Playlist_GOSEGU';
							break;
						case 6:
							echo 'Playlist_VIICHAN';
							break;
					}
					?>
				</td>
				<td><?= $row['duration'] ?></td>
				<td>
					<button class="btn btn-danger btn-sm btn_music_delete" data-id="<?= $row['id']; ?>">삭제</button>
				</td>
			</tr>
		<?php $num--;
		} ?>
	</table>

	<div class="container mt-3 d-flex gap-2 w-50 ">
		<select class="form-select w-25" name="sn" id="sn">
			<option value="1">Title</option>
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
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#music_create_modal" id="btn_create_modal" style="margin-right: 2rem;">Add Music</button>
	</div>
</main>

<!-- Modal -->
<div class="modal fade" id="music_create_modal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalTitle">음악 추가</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex flex-column gap-3">

				<div>
					<label for="music_title" class="form-label">Title</label>
					<input type="text" id="music_title" class="form-control" placeholder="Title ...">
				</div>

				<div class="d-flex gap-2">
					<div class="flex-grow-2">
						<label for="music_artist" class="form-label">Artist</label>
						<select name="year" id="music_artist" class="form-select">
							<?php
							$artistArr = $music->artist_list();
							foreach ($artistArr as $artistRow) {
							?>
								<option value="<?= $artistRow['id'] ?>"><?= $artistRow['name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="flex-grow-1">
						<label for="music_album" class="form-label">Album</label>
						<select name="year" id="music_album" class="form-select">
							<?php
								$albumArr = $music->album_list();
								foreach ($albumArr as $albumRow) {
							?>
								<option value="<?= $albumRow['id'] ?>"><?= $albumRow['title'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div>
					<label for="music_duration" class="form-label">Duration</label>
					<input type="text" id="music_duration" class="form-control" placeholder="Duration ...">
				</div>

				<div>
					<label for="music_mp3" class="form-label mb-0">MP3</label>
					<input type="file" id="music_mp3" class="form-control">
				</div>

				<div>
					<label for="music_songArt" class="form-label mb-0">SongArt</label>
					<input type="file" id="music_songArt" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_music_create">확인</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	// 모든 select 요소를 선택
	const allSelects = document.querySelectorAll("select");

	// 각 select 요소의 option을 순회하면서 text를 대문자로 변환
	allSelects.forEach(select => {
		for (let option of select.options) {
			option.text = option.text.toUpperCase();
		}
	});
</script>

<?php
include_once './includes/part/inc_footer.php';
?>