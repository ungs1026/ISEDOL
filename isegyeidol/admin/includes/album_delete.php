<?php
include_once '../../includes/pdo-dbconfig.php';
include_once './classes/Album.php';

$id = (isset($_POST['id']) && $_POST['id'] != '' && is_numeric($_POST['id'])) ? $_POST['id'] : '';

if ($id == '') {
	die(json_encode(['result' => 'empty_idx']));
}

$album = new Album($pdo);
$album->album_del($id);

die(json_encode(['result' => 'album_del_success']));