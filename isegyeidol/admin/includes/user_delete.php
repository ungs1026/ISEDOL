<?php
include_once '../../includes/pdo-dbconfig.php';
include_once './classes/User.php';

$id = (isset($_POST['id']) && $_POST['id'] != '' && is_numeric($_POST['id'])) ? $_POST['id'] : '';

if ($id == '') {
	die(json_encode(['result' => 'empty_idx']));
}

$user = new User($pdo);
$user->user_del($id);

die(json_encode(['result' => 'user_del_success']));