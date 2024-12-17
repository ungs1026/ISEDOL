<?php
include_once './includes/part/inc_common.php';

$menu_code = 'goods';
$js_array = ['js/goods.js'];
$css_array = ['css/goods.css'];
$g_title = 'Goods Admin';
$logo = '../source/img/main-logo.png';
$footerLogo = '../source/img/Notion-logo.png';
$commonC = 'css/common.css';

include_once '../includes/pdo-dbconfig.php';
include './includes/classes/Goods.php';
include_once './includes/lib.php';

$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';
// $total, $limit, $page_limit, $page, $param

$paramArr = ['sn' => $sn, 'sf' => $sf];

// user
$goods = new Goods($pdo);

$kindArr = array_values(array_unique(array_column($goods->kind_list(), 'kind')));

$total = $goods->total($paramArr);
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';

$goodsArr = $goods->list($page, $limit, $paramArr);
$num = $total - (($page - 1) * $limit);

// header
include_once './includes/part/inc_header.php';
?>

<main class="border rounded-5 p-5">
	<div class="container">
		<h3>Goods Management</h3>
	</div>

	<table class="table table-border">
		<tr>
			<th>IDX</th>
			<th>Name</th>
			<th>IMG</th>
			<th>Price</th>
			<th>Production</th>
			<th>Sales</th>
			<th>Kind</th>
			<th>Management</th>
		</tr>

		<?php
		foreach ($goodsArr as $row) {
			// 데이터 정리
			// $row['create_at'] = substr($row['create_at'], 0, 16);

			$price = number_format($row['price']);
			$price .= '￦';
		?>
			<tr>
				<td><?= $num ?></td>
				<td><?= $row['name'] ?></td>
				<td><img src="../<?= $row['img'] ?>" alt="" style="width: 3rem;"></td>
				<td><?= $price ?></td>
				<td><?= $row['production'] ?></td>
				<td><?= $row['sales'] ?></td>
				<td><?= $row['kind'] ?></td>
				<td>
					<button class="btn btn-danger btn-sm btn_goods_delete" data-id="<?= $row['id']; ?>">삭제</button>
				</td>
			</tr>
		<?php 
		$num--;
	} 
	?>

	</table>

	<div class="container mt-3 d-flex gap-2 w-50 ">
		<select class="form-select w-25" name="sn" id="sn">
			<option value="1">Name</option>
			<option value="2">Production</option>
			<option value="3">Kind</option>
		</select>
		<input type="text" class="form-control w-25" id="sf" name="sf" value="<?= $sf ?>">
		<button class="btn btn-primary w-25" id="btn_search">검색</button>
		<button class="btn btn-success w-25" id="btn_all">전체목록</button>
	</div>

	<div class="d-flex mt-3 justify-content-between align-items-start">
		<?php
		$param = '&sn=' . $sn . '&sf=' . $sf;
		$pagination = My_Pagination($total, $limit, $page_limit, $page, $param);
		echo $pagination;
		?>
		<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#goods_create_modal" id="btn_create_modal" style="margin-right: 2rem;">Add Album</button>
	</div>
</main>

<!-- Modal -->
<div class="modal fade" id="goods_create_modal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalTitle">Add Goods</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex flex-column gap-3">
				<!-- name, price, img, detailImg, production, sales, kind -->

				<div>
					<label for="goods_name" class="form-label mb-0">Name</label>
					<input type="text" id="goods_name" class="form-control" placeholder="Goods Name">
				</div>

				<div class="d-flex gap-2">
					<div>
						<label for="goods_price" class="form-label mb-0">Price</label>
						<input type="text" id="goods_price" class="form-control" placeholder="Goods Price">
					</div>

					<div class="w-50">
						<label for="goods_kind" class="form-label mb-0">Kind</label>
						<select name="year" id="goods_kind" class="form-select">
							<?php foreach($kindArr as $kindRow) { ?>
								<option value="<?= $kindRow ?>"><?= $kindRow ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div>
					<label for="goods_img" class="form-label mb-0">Img</label>
					<input type="file" id="goods_img" class="form-control">
				</div>

				<div>
					<label for="goods_detail_img" class="form-label mb-0">Detail Img</label>
					<input type="file" id="goods_detail_img" class="form-control">
				</div>

				<div>
					<label for="goods_production" class="form-label mb-0">Production</label>
					<input type="text" id="goods_production" class="form-control" placeholder="Goods Production">
				</div>

				<div>
					<label for="goods_sales" class="form-label mb-0">Sales</label>
					<input type="text" id="goods_sales" class="form-control" placeholder="Goods Sales">
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_goods_create">확인</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
  // URL로 전달된 값 설정
  const snValue = "<?php echo $sn; ?>";
  const selectElement = document.querySelector("#sn");
  if (snValue) {
    selectElement.value = snValue; // select에서 선택된 값 설정
  }
</script>

<?php
include_once './includes/part/inc_footer.php';
?>