<?php
// 1. Khai báo trả về định dạng JSON
header("Content-Type: application/json; charset=UTF-8");

// 2. Kết nối Database 
require('config.php'); 

// 3. Viết câu lệnh truy vấn lấy phim hay 
$sql = "SELECT id, ten_phim, hinh_anh, link_phim FROM phim ORDER BY id DESC LIMIT 10";
$result = mysqli_query($conn, $sql);

$listPhim = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Fix đường dẫn ảnh để Flutter có thể đọc được 
        $row['hinh_anh'] = "http://192.168.1.xxx/doan/images/" . $row['hinh_anh'];
        $listPhim[] = $row;
    }
}

// 4. Xuất dữ liệu
echo json_encode($listPhim, JSON_UNESCAPED_UNICODE);
?>