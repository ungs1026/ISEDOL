<?php
include("includes/includedFiles.php");
include('includes/getUserId.php');
?>
<div class="song-main">
	<div class="gridViewContainer">

		<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums");

		while ($row = mysqli_fetch_array($albumQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?&id=" . $row['id'] . "\")''>
						<img src='" . $row['artworkPath'] . "'>
						<div class='gridViewInfo'>" . $row['title'] . "</div>
					</span>
				</div>";
		}
		?>
	</div>
</div>