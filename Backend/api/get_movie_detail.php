<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

require_once('../admin/conn.inc.php');

// 1. Lấy ID phim
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;

if ($id == 0) {
    echo json_encode(["status" => "error", "message" => "ID không hợp lệ"]);
    exit();
}

// 2. Truy vấn thông tin phim
$sql = "SELECT id, tenphim, linkphim, theloai FROM phim WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // 3. Cập nhật lượt xem (giữ nguyên logic cũ)
    mysqli_query($conn, "UPDATE phim SET soluotxem = soluotxem + 1 WHERE id = '$id'");

    // 4. Trả về JSON
    echo json_encode([
        "status" => "success",
        "ten_phim" => $row['tenphim'],
        "link_phim" => $row['linkphim'], // Đảm bảo link này là link trực tiếp (.mp4)
        "id_the_loai" => $row['theloai']
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["status" => "error", "message" => "Phim không tồn tại"]);
}
?>