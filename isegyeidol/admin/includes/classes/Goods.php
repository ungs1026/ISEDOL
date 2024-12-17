<?php

class Goods
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
					$sn_str = 'production';
					break;
				case 3:
					$sn_str = 'kind';
					break;
			}

			$where = "where " . $sn_str . " LIKE :sf";
		}

		$query = "select COUNT(*) cnt from goods " . $where;
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
					$sn_str = 'production';
					break;
				case 3:
					$sn_str = 'kind';
					break;
			}

			if ($sn_str) {
				$where = "where " . $sn_str . " LIKE :sf";
			}
		}

		$query = "select id, name, price, img, detailImg, production, sales, kind
							from goods " . $where . "
							order by id limit " . $start . "," . $limit;

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

	// delete
	public function goods_del($id)
	{
		$query = 'delete from goods where id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}

	public function profile_upload($name, $type, $new_photo)
	{
		$tmparr = explode('.', $new_photo['name']);
		$ext = end($tmparr); // 확장자 추출

		if ($type == 'goods_detail') {
			$add_name = 'detail-' . $name;
			$photo = 'source/img/' . $type . '/' . $add_name . '.' . $ext; // 새로운 파일 명
		} else {
			$photo = 'source/img/' . $type . '/' . $name . '.' . $ext; // 새로운 파일 명
		}

		copy($new_photo['tmp_name'], DOCUMENT_ROOT . "/" . $photo);
		return $photo;
	}

	public function input($arr)
	{
		// name, price, img, detailImg, production, sales, kind
		$sql = "INSERT INTO goods(name, price, img, detailImg, production, sales, kind) 
      VALUES(:name, :price, :img, :detailImg, :production, :sales, :kind)";
		$stmt = $this->conn->prepare($sql);
		$params = [
			':name' => $arr['name'],
			':price' => $arr['price'],
			':img' => $arr['img'],
			':detailImg' => $arr['detail_img'],
			':production' => $arr['production'],
			':sales' => $arr['sales'],
			':kind' => $arr['kind'],
		];
		$stmt->execute($params);
	}

	public function kind_list() {
		$query = 'select kind from goods';
		$stmt = $this->conn->prepare($query);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();

		$allKindList = $stmt->fetchAll();

		return $allKindList;
	}
}
