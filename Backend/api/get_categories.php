<?php
// Khai báo cho Flutter biết đây là dữ liệu JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // Cho phép Flutter truy cập từ các nguồn khác nhau

// Kết nối database từ file cũ của bạn
require_once('../admin/conn.inc.php'); 

// 1. Lấy ID thể loại từ Flutter gửi lên
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$response = array();

// 2. Lấy thông tin thể loại
$sql_theloai = "SELECT theloai FROM theloai WHERE id = $id";
$result_tl = mysqli_query($conn, $sql_theloai);
$data_tl = mysqli_fetch_assoc($result_tl);

if (!$data_tl) {
    echo json_encode(["status" => "error", "message" => "Thể loại không tồn tại"]);
    exit();
}

$response['ten_theloai'] = $data_tl['theloai'];

// 3. Truy vấn danh sách phim
$query_phim = mysqli_query($conn, "SELECT id, tenphim, anhminhhoa, soluotxem, namsanxuat, thoiluongphim FROM phim WHERE theloai = $id ORDER BY id DESC");

$movies = array();
while($row = mysqli_fetch_assoc($query_phim)) {
    // Quan trọng: Chuyển đường dẫn ảnh thành đường dẫn tuyệt đối để Flutter tải được
    $row['anhminhhoa'] = "http://IP_CUA_MAY_TINH/doan/admin/" . $row['anhminhhoa'];
    $row['nam'] = date('Y', strtotime($row["namsanxuat"]));
    $movies[] = $row;
}

$response['status'] = "success";
$response['movies'] = $movies;

// Xuất kết quả
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>