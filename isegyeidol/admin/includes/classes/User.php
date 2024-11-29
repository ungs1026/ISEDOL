<?php

class User
{
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	// email

	public function email_format_check($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function email_exists($email) {
		$query = "select * from users where email=:email";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();

		return $stmt->rowCount() ? true : false;
	}

	// ================

	public function total($paramArr)
	{
		// $paramArr => sn 과 sf
		$where = '';
		if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
			switch ($paramArr['sn']) {
				case 1:
					$sn_str = 'username';
					break;
				case 2:
					$sn_str = 'email';
					break;
			}

			$where = "where " . $sn_str . " LIKE :sf";
		}

		$query = "select COUNT(*) cnt from users " . $where;
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
					$sn_str = 'username';
					break;
				case 2:
					$sn_str = 'email';
					break;
				default:
					$sn_str = null; // 올바르지 않은 경우 대비
			}

			if ($sn_str) {
				$where = "where " . $sn_str . " LIKE :sf";
			}
		}

		// 번호 아이디 이름 이메일 등록일시
		$query = "select id, username, email, DATE_FORMAT(signUpDate, '%Y-%m-%d %H:%i') signUpDate, level
                from users " . $where . "
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

	public function getInfoId ($id) {
		$query = 'select * from users where id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		return $stmt->fetch();
	}
	
	public function user_del($id) {
		$query = 'delete from users where id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}

	// photo
	public function profile_upload($id, $new_photo, $old_photo) {
		if ($old_photo != '' && $old_photo == 'source/img/leaf.png') {
			unlink(DOCUMENT_ROOT.'/'.$old_photo); // 삭제
		}
	
		$tmparr = explode('.', $new_photo['name']);
		$ext = end($tmparr); // 확장자 추출
		$photo = 'source/img/'.$id . '.' . $ext; // 새로운 파일 명
	
		copy($new_photo['tmp_name'], DOCUMENT_ROOT."/".$photo);
	
		return $photo;
	}

	// edit
	public function edit($marr) {
		// 'idx' => $idx,
		// 'name' => $name,1
		// 'password' => $password,
		// 'email' => $email,1
		// 'photo' => $old_photo,1
		// 'level' => $level,

		$query = "update users set username=:username, email=:email, profilePic=:profilePic";
		$params = [
			':username' => $marr['name'],
			':email' => $marr['email'],
			':profilePic' => $marr['photo'],
		];
		if ($marr['password'] != '') {
			// 단방향 암호화
			$new_hash_password = password_hash($marr['password'], PASSWORD_DEFAULT);
			$params[':password'] = $new_hash_password;

			$query .= ", password=:password";
		}

		if (isset($marr['idx']) && $marr['idx'] != ''){
			$query .= ", level=:level";
			$query .= " where id=:idx";
			$params[':level'] = $marr['level'];
			$params[':idx'] = $marr['idx'];
		} else {
			$query .= ' where id=:idx';
			$params[':idx'] = $marr['idx'];
		}


		$stmt = $this->conn->prepare($query);
		$stmt->execute($params);
	}
}
