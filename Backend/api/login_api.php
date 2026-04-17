<?php
// 1. Cho phép tất cả mọi nguồn truy cập (Quan trọng cho Flutter Web)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// 2. Cho phép các phương thức phổ biến và đặc biệt là OPTIONS
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// 3. Cho phép các Header mà Flutter thường gửi kèm
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// 4. XỬ LÝ PREFLIGHT REQUEST (CỰC KỲ QUAN TRỌNG)
// Trình duyệt sẽ gửi lệnh OPTIONS trước khi gửi POST thật. Nếu không trả về 200, nó sẽ chặn POST.
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once('../admin/conn.inc.php');

// Nhận dữ liệu JSON từ Flutter gửi lên
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->username) && !empty($data->password)) {
    $u = mysqli_real_escape_string($conn, $data->username);
    $p = mysqli_real_escape_string($conn, $data->password);

    // 1. Kiểm tra Admin
    $sql_admin = "SELECT username, hovaten FROM admin WHERE username='$u' AND password='$p'";
    $res_admin = mysqli_query($conn, $sql_admin);

    if(mysqli_num_rows($res_admin) > 0) {
        $row = mysqli_fetch_assoc($res_admin);
        echo json_encode([
            "status" => "success",
            "role" => "admin",
            "name" => $row['hovaten'],
            "username" => $row['username']
        ]);
        exit();
    }

    // 2. Kiểm tra User thường
    $sql_user = "SELECT username, hovaten FROM users WHERE username='$u' AND password='$p'";
    $res_user = mysqli_query($conn, $sql_user);

    if(mysqli_num_rows($res_user) > 0) {
        $row = mysqli_fetch_assoc($res_user);
        echo json_encode([
            "status" => "success",
            "role" => "user",
            "name" => $row['hovaten'],
            "username" => $row['username']
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Sai tài khoản hoặc mật khẩu!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin"]);
}
?>