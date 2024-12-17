<?php
include_once("includes/mysqli-dbconfig.php");
include("includes/classes/Artist.php");
include("includes/classes/Song.php");
include("includes/classes/Album.php");
include './includes/pdo-dbconfig.php';

$id = (isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id'])) ? $_GET['id'] : '';

if ($id != '') {
	if ($id == 1) {
		$songArtId = rand(1, 13);
	} else if ($id == 2) {
		$songArtId = rand(14, 26);
	} else if ($id == 3) {
		$songArtId = rand(27, 41);
	} else if ($id == 4) {
		$songArtId = rand(42, 57);
	} else if ($id == 5) {
		$songArtId = rand(58, 69);
	} else if ($id == 6) {
		$songArtId = rand(70, 82);
	}
} else {
	header("Location: song.php");
}

$album = new Album($con, $id);
if ($id != 0) {
	$song = new Song($con, $songArtId);
}
$artist = $album->getArtist();
?>

<div class="entityInfo">

	<div class="leftSection">
		<?php if ($id == 0) { ?>
			<img src="<?php echo $album->getArtworkPath(); ?>">
		<?php } else { ?>
			<img src="<?php echo $song->getSongArt(); ?>">
		<?php } ?>
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p style="text-transform: uppercase;">By <?php echo $artist->getName(); ?></p>
		<p style="text-transform: uppercase;"><?php 
			if ($id != 0) {
				echo $album->getNumberOfSongs(); 
			} else {
				echo $album->getNumberAllSong();
			}
		?> songs</p>

	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">

		<?php
		if ($id != 0) {
			$songIdArray = $album->getSongIds();
		} else {
			$songIdArray = $album->getAllSong();
		}

		$i = 1;
		foreach ($songIdArray as $songId) {

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='./source/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle() . "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
						<span class='play'>Hits : " . $albumSong->getPlay() . "</span>
					</div>

				</li>";

			$i++;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
			console.log(tempPlaylist);
		</script>


	</ul>
</div>