<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

require_once('../admin/conn.inc.php');

// Lấy từ khóa từ Flutter (Gửi qua phương thức GET hoặc POST)
$tukhoa = isset($_GET['tukhoa']) ? mysqli_real_escape_string($conn, $_GET['tukhoa']) : '';

if ($tukhoa != "") {
    // Tìm kiếm theo tên, diễn viên hoặc đạo diễn
    $sql = "SELECT id, tenphim, anhminhhoa, soluotxem, namsanxuat, thoiluongphim 
            FROM phim WHERE 
            tenphim LIKE '%$tukhoa%' OR 
            dienvien LIKE '%$tukhoa%' OR 
            daodien LIKE '%$tukhoa%' 
            ORDER BY id DESC";
} else {
    // Nếu không có từ khóa, mặc định trả về 20 phim mới nhất
    $sql = "SELECT id, tenphim, anhminhhoa, soluotxem, namsanxuat, thoiluongphim 
            FROM phim ORDER BY id DESC LIMIT 20";
}

$result = mysqli_query($conn, $sql);
$movies = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Fix đường dẫn ảnh tuyệt đối
        $row['anhminhhoa'] = "http://IP_CUA_BAN/doan/admin/" . $row['anhminhhoa'];
        $row['nam'] = date('Y', strtotime($row["namsanxuat"]));
        $movies[] = $row;
    }
    echo json_encode([
        "status" => "success",
        "keyword" => $tukhoa,
        "data" => $movies
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "status" => "empty",
        "message" => "Không tìm thấy kết quả",
        "data" => []
    ]);
}
?>