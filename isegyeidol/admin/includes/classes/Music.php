<?php

class Music
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function total($paramArr)
	{
		// $paramArr => sn 과 sf
		$where = '';
		if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
			switch ($paramArr['sn']) {
				case 1:
					$sn_str = 'title';
					break;
			}

			$where = "where " . $sn_str . " LIKE :sf";
		}

		$query = "select COUNT(*) cnt from songs " . $where;
		$stmt = $this->conn->prepare($query);

		if ($where != '') {
			// 검색어에 와일드카드 추가
			$searchTerm = "%" . $paramArr['sf'] . "%";
			$stmt->bindParam(':sf', $searchTerm, PDO::PARAM_STR);
		}

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$row = $stmt->fetch();

		return $row['cnt'];
	}

	public function list($page, $limit, $paramArr)
	{
		// $page => page 수
		// $limit => 제한
		// $paramArr => sn 과 sf
		$start = ($page - 1) * $limit;

		$where = '';
		if (!empty($paramArr['sn']) && !empty($paramArr['sf'])) {
			switch ($paramArr['sn']) {
				case 1:
					$sn_str = 'title';
					break;
			}

			if ($sn_str) {
				$where = "where " . $sn_str . " LIKE :sf";
			}
		}

		$query = "select *
							from songs " . $where . "
							order by id desc limit " . $start . "," . $limit;

		$stmt = $this->conn->prepare($query);

		if (!empty($where)) {
			// 검색어에 와일드카드 추가
			$searchTerm = "%" . $paramArr['sf'] . "%";
			$stmt->bindParam(':sf', $searchTerm, PDO::PARAM_STR);
		}

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function music_del($id)
	{
		$query = 'delete from songs where id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}

	// music add
	public function song_art_upload($name, $new_photo)
	{
		$tmparr = explode('.', $new_photo['name']);
		$ext = end($tmparr); // 확장자 추출
		$photo = 'source/music_group/' . $name . '.' . $ext; // 새로운 파일 명
		
		copy($new_photo['tmp_name'], DOCUMENT_ROOT . "/" . $photo);
		return $photo;
	}

	public function song_mp3_upload($name, $new_file)
	{
		$tmparr = explode('.', $new_file['name']);
		$ext = end($tmparr); // 확장자 추출
		if ($ext != 'mp3') {
			$mp3 = 'error_ext';
		} else {
			$mp3 = 'source/music_group/' . $name . '.' . $ext; // 새로운 파일 명
			copy($new_file['tmp_name'], DOCUMENT_ROOT . "/" . $mp3);
		}
		return $mp3;
	}

	// 입력
	public function input($arr)
	{
		$sql = "INSERT INTO songs(title, artist, album, duration, path, albumOrder, songArt) 
      VALUES(:title, :artist, :album, :duration, :path, :albumOrder, :songArt)";
		$stmt = $this->conn->prepare($sql);
		$params = [
			':title' => $arr['title'],
			':artist' => $arr['artist'],
			':album' => $arr['album'],
			':duration' => $arr['duration'],
			':path' => $arr['path'],
			':albumOrder' => $arr['albumOrder'],
			':songArt' => $arr['songArt'],
		];
		$stmt->execute($params);
	}

	// 연결 테스트
	public function test()
	{
		return 'connection_music';
	}
}
