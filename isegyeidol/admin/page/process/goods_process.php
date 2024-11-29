<?php
include_once '../../../includes/pdo-dbconfig.php';
include_once '../../includes/classes/Goods.php';

$goods = new Goods($pdo);

$name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
$price = (isset($_POST['price']) && $_POST['price'] != '') ? $_POST['price'] : '';
$production = (isset($_POST['production']) && $_POST['production'] != '') ? $_POST['production'] : '';
$sales = (isset($_POST['sales']) && $_POST['sales'] != '') ? $_POST['sales'] : '';
$kind = (isset($_POST['kind']) && $_POST['kind'] != '') ? $_POST['kind'] : '';

// Profile Image 처리
$img = '';
if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
	$type = 'goods';
	$new_photo = $_FILES['img'];
	// profile_upload($id, $new_photo, $old_photo = ''
	$img = $goods->profile_upload($name, $type, $new_photo);
}

$detail_img = '';
if (isset($_FILES['detail_img']) && $_FILES['detail_img']['name'] != '') {
	$type = 'goods_detail';
	$new_photo = $_FILES['detail_img'];
	// profile_upload($id, $new_photo, $old_photo = ''
	$detail_img = $goods->profile_upload($name, $type, $new_photo);
}

$arr = [
	'name' => $name,
	'price' => $price,
	'img' => $img,
	'detail_img' => $detail_img,
	'production' => $production,
	'sales' => $sales,
	'kind' => $kind,
];
// input처리

$goods->input($arr);

die(json_encode(['result' => 'success']));