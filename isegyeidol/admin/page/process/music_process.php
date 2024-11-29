<?php
include_once '../../../includes/pdo-dbconfig.php';
include_once '../../includes/classes/Music.php';

$music = new Music($pdo);

$title = (isset($_POST['title']) && $_POST['title'] != '') ? $_POST['title'] : '';
$artist = (isset($_POST['artist']) && $_POST['artist'] != '') ? $_POST['artist'] : '';
$album = (isset($_POST['album']) && $_POST['album'] != '') ? $_POST['album'] : '';
$duration = (isset($_POST['duration']) && $_POST['duration'] != '') ? $_POST['duration'] : '';
$albumOrder = (isset($_POST['albumOrder']) && $_POST['albumOrder'] != '') ? $_POST['albumOrder'] : '';

$mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';
if ($mode == '') { die(json_encode(['result' => 'empty_mode'])); }

if ($mode == 'delete') {
	$id = (isset($_POST['id']) && $_POST['id'] != '' && is_numeric($_POST['id'])) ? $_POST['id'] : '';
	if ($id == '') { die(json_encode(['result' => 'empty_id'])); }
	
	$music->music_del($id);
	die(json_encode(['result' => 'success']));
} else if ($mode == 'add') {
	// file
	$path ='';
	if (isset($_FILES['path']) && $_FILES['path']['name'] != '') {
		$new_photo = $_FILES['path'];
		// profile_upload($id, $new_photo, $old_photo = ''
		$path = $music->song_mp3_upload($title, $new_photo);
	}

	$songArt = '';
	if (isset($_FILES['songArt']) && $_FILES['songArt']['name'] != '') {
		$new_file = $_FILES['songArt'];
		// profile_upload($id, $new_photo, $old_photo = ''
		$songArt = $music->song_art_upload($title, $new_file);
	}

	$arr = [
		'title' => $title,
		'artist' => $artist,
		'album' => $album,
		'duration' => $duration,
		'albumOrder' => $albumOrder,
		'path' => $path,
		'songArt' => $songArt,
	];

	$music->input($arr);
	die(json_encode(['result' => 'success_input']));
}
