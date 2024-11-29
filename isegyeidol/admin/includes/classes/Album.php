<?php

class Album
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
					$sn_str = 'name';
					break;
				case 2:
					$sn_str = 'year';
					break;
			}

			$where = "where " . $sn_str . " LIKE :sf";
		}

		$query = "select COUNT(*) cnt from groups " . $where;
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
					$sn_str = 'name';
					break;
				case 2:
					$sn_str = 'year';
					break;
			}

			if ($sn_str) {
				$where = "where " . $sn_str . " LIKE :sf";
			}
		}

		$query = "select id, name, thumbnail, DATE_FORMAT(date, '%Y-%m-%d %H:%i') date, year, kind, youtube
							from groups " . $where . "
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

	public function album_del($id) {
		$query = 'delete from groups where id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}

	// Album Add
	// photo
	public function profile_upload($name, $kind ,$new_photo) {
		$tmparr = explode('.', $new_photo['name']);
		$ext = end($tmparr); // 확장자 추출
		if ($kind == 'cover') {
			$photo = 'source/img/cover/'.$name . '.' . $ext; // 새로운 파일 명
		} else {
			$photo = 'source/img/single/'.$name . '.' . $ext; // 새로운 파일 명
		}
		copy($new_photo['tmp_name'], DOCUMENT_ROOT."/".$photo);
		return $photo;
	}

	// 입력
	public function input($arr)
	{
		$sql = "INSERT INTO groups(name, thumbnail, date, year, kind, youtube) 
      VALUES(:name, :thumbnail, :date, :year, :kind, :youtube)";
		$stmt = $this->conn->prepare($sql);
		$params = [
			':name' => $arr['title'],
			':thumbnail' => $arr['thumbnail'],
			':date' => $arr['date'],
			':year' => $arr['year'],
			':kind' => $arr['kind'],
			':youtube' => $arr['youtube'],
		];
		$stmt->execute($params);
	}

	// 연결 테스트
	public function test() {
		return 'connection';
	}
}