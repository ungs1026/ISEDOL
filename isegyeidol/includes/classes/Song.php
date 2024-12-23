<?php
	class Song {

		private $con;
		private $id;
		private $mysqliData;
		private $title;
		private $artistId;
		private $albumId;
		private $duration;
		private $path;
		private $songArt;
		private $play;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");
			$this->mysqliData = mysqli_fetch_array($query);
			$this->title = $this->mysqliData['title'];
			$this->artistId = $this->mysqliData['artist'];
			$this->albumId = $this->mysqliData['album'];
			$this->duration = $this->mysqliData['duration'];
			$this->songArt = $this->mysqliData['songArt'];
			$this->path = $this->mysqliData['path'];
			$this->play = $this->mysqliData['plays'];
		}

		public function getTitle() {
			return $this->title;
		}

		public function getId() {
			return $this->id;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

		public function getAlbum() {
			return new Album($this->con, $this->albumId);
		}
		
		public function getDuration() {
			return $this->duration;
		}

		public function getPath() {
			return $this->path;
		}

		public function getSongArt() {
			return $this->songArt;
		}

		public function getMysqliData() {
			return $this->mysqliData;
		}

		public function getPlay() {
			return $this->play;
		}
	}
?>