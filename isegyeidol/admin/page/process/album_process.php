<?php
include_once '../../../includes/pdo-dbconfig.php';
include_once '../../includes/classes/Album.php';

$album = new Album($pdo);

$title = (isset($_POST['title']) && $_POST['title'] != '') ? $_POST['title'] : '';
$year = (isset($_POST['year']) && $_POST['year'] != '') ? $_POST['year'] : '';
$date = (isset($_POST['date']) && $_POST['date'] != '') ? $_POST['date'] : '';
$kind = (isset($_POST['kind']) && $_POST['kind'] != '') ? $_POST['kind'] : '';
$youtube = (isset($_POST['youtube']) && $_POST['youtube'] != '') ? $_POST['youtube'] : '';

// Profile Image 처리

$thumbnail = '';
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name'] != '') {
	$new_photo = $_FILES['thumbnail'];
	// profile_upload($id, $new_photo, $old_photo = ''
	$thumbnail = $album->profile_upload($title, $kind, $new_photo);
}

$arr = [
	'title' => $title,
	'thumbnail' => $thumbnail,
	'date' => $date,
	'year' => $year,
	'kind' => $kind,
	'youtube' => $youtube,
];
$album->input($arr);

die(json_encode(['result' => 'success']));

// Array (
// 	[title] => title
// 	[year] => 2022
// 	[date] => 2024-11-07
// 	[kind] => cushion
// 	[youtube] => asdasasd.asd
// )
// Array (
// 	[thumnail] => Array
// 		(
// 			[name] => 5.webp
// 			[type] => image/webp
// 			[tmp_name] => D:\xampp\tmp\phpEDBC.tmp
// 			[error] => 0
// 			[size] => 10362
// 		)
// )