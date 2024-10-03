<?php
// 페이지당 굿즈 수
$songsPerPage = 12;

// 현재 페이지 번호
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page > 0 ? $page : 1;

// 페이지당 굿즈 수에 따라 시작 위치 계산
$offset = ($page - 1) * $songsPerPage;

// 기본 쿼리
$query = "SELECT * FROM groups";

// 필터 및 정렬 기능 추가
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'all';
$year = isset($_GET['year']) ? $_GET['year'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($year != 'all') {
    $query .= " WHERE year = :year";
		if($year == "2021"){
			$year = "2021";
		} else if ($year == "2022") {
			$year = "2022";
		} else if ($year == "2023") {
			$year = "2023";
		} else if ($year == "2024") {
			$year = "2024";
		}
}
if (!empty($search)) {
    $query .= ($year != 'all' ? " AND" : " WHERE") . " name LIKE :search";
}
if ($sort == 'all') {
    $query .= " ORDER BY id";
} else if ($sort == 'new') {
    $query .= " ORDER BY date DESC";
} else if ($sort == 'single') {
	$query .= " where kind= 'single'";
} else if ($sort == 'cover') {
	$query .= " where kind= 'cover'";
}

// 페이지네이션 적용
$query .= " LIMIT :limit OFFSET :offset";

try {
    $stmt = $pdo->prepare($query);
    if ($year != 'all') {
        $stmt->bindParam(':year', $year);
    }
    if (!empty($search)) {
        $stmt->bindValue(':search', '%' . $search . '%');
    }
    $stmt->bindValue(':limit', $songsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    $songs = [];
}

// 총 굿즈 수를 계산하기 위한 쿼리
$countQuery = "SELECT COUNT(*) FROM groups";
if ($year != 'all') {
    $countQuery .= " WHERE year = :year";
}
if (!empty($search)) {
    $countQuery .= ($year != 'all' ? " AND" : " WHERE") . " name LIKE :search";
}

try {
    $countStmt = $pdo->prepare($countQuery);
    if ($year != 'all') {
        $countStmt->bindParam(':year', $year);
    }
    if (!empty($search)) {
        $countStmt->bindValue(':search', '%' . $search . '%');
    }
    $countStmt->execute();
    $totalCount = $countStmt->fetchColumn();
    $totalPages = ceil($totalCount / $songsPerPage);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    $totalPages = 1;
}

// 페이지네이션 정보 반환
return [
	'albums' => $songs,
	'totalPages' => $totalPages,
	'currentPage' => $page
];
