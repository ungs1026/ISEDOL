<?php
// 페이지당 굿즈 수
$songsPerPage = 12;

// 현재 페이지 번호
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page > 0 ? $page : 1;

// 페이지당 굿즈 수에 따라 시작 위치 계산
$offset = ($page - 1) * $songsPerPage;

// 기본 쿼리
$query = "SELECT * FROM groups WHERE 1=1"; // 기본적으로 모든 레코드를 선택하기 위해 WHERE 1=1 사용

// 필터 및 정렬 기능 추가
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'all';
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$year = isset($_GET['year']) ? $_GET['year'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$bindings = []; // 바인딩할 값을 저장하는 배열

if ($type != 'all') {
    $query .= " AND kind = :type";
    $bindings[':type'] = $type; // 바인딩 배열에 추가
}

if ($year != 'all') {
    $query .= " AND year = :year";
    $bindings[':year'] = $year; // 바인딩 배열에 추가
}

if (!empty($search)) {
    $query .= " AND name LIKE :search";
    $bindings[':search'] = '%' . $search . '%'; // 바인딩 배열에 추가
}

if ($sort == 'new') {
    $query .= " ORDER BY date DESC";
} else if ($sort == 'old') {
    $query .= " ORDER BY date";
} else {
    $query .= " ORDER BY id"; // 기본 정렬
}

// 페이지네이션 적용
$query .= " LIMIT :limit OFFSET :offset";

try {
    $stmt = $pdo->prepare($query);
    
    // 동적으로 바인딩된 값 추가
    foreach ($bindings as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    // LIMIT 및 OFFSET 바인딩
    $stmt->bindValue(':limit', $songsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
    $songs = [];
}

// 총 굿즈 수를 계산하기 위한 쿼리
$countQuery = "SELECT COUNT(*) FROM groups WHERE 1=1"; // 기본적으로 모든 레코드를 선택하기 위해 WHERE 1=1 사용

if ($type != 'all') {
    $countQuery .= " AND kind = :type";
}

if ($year != 'all') {
    $countQuery .= " AND year = :year";
}

if (!empty($search)) {
    $countQuery .= " AND name LIKE :search";
}

try {
    $countStmt = $pdo->prepare($countQuery);
    
    // 동적으로 바인딩된 값 추가
    foreach ($bindings as $key => $value) {
        $countStmt->bindValue($key, $value);
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
