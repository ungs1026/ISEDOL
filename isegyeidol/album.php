<?php
include_once("includes/mysqli-dbconfig.php");
include("includes/classes/Artist.php");
include("includes/classes/Song.php");
include("includes/classes/Album.php");

if (isset($_GET['id'])) {
	$albumId = $_GET['id'];
	if ($_GET['id'] == 1) {
		$songId = rand(1, 13);
	} else if ($_GET['id'] == 2) {
		$songId = rand(14, 26);
	} else if ($_GET['id'] == 3) {
		$songId = rand(27, 41);
	} else if ($_GET['id'] == 4) {
		$songId = rand(42, 57);
	} else if ($_GET['id'] == 5) {
		$songId = rand(58, 69);
	} else if ($_GET['id'] == 6) {
		$songId = rand(70, 82);
	}
} else {
	header("Location: song.php");
}

$album = new Album($con, $albumId);
$song = new Song($con, $songId);
$artist = $album->getArtist();
?>

<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $song->getSongArt(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $artist->getName(); ?></p>
		<p style="text-transform: uppercase;"><?php echo $album->getNumberOfSongs(); ?> songs</p>

	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">

		<?php
		$songIdArray = $album->getSongIds();

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
					</div>


				</li>";

			$i = $i + 1;
		}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
			console.log(tempPlaylist);
		</script>


	</ul>
</div>