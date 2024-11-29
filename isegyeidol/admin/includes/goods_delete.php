<?php
include_once '../../includes/pdo-dbconfig.php';
include_once './classes/Goods.php';
// Array ( [id] => 2 )

$id = (isset($_POST['id']) && $_POST['id'] != '' && is_numeric($_POST['id'])) ? $_POST['id'] : '';

if ($id == '') {
	die(json_encode(['result' => 'empty_id']));
}

$goods = new Goods($pdo);
$goods->goods_del($id);

die(json_encode(['result' => 'success']));