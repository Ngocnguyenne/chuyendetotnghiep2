<?php 
require('include/header.php'); 
require('admin/conn.inc.php'); 

if(isset($_POST['btnDangKy'])) {
    $hovaten    = mysqli_real_escape_string($conn, $_POST['hovaten']);
    $username   = mysqli_real_escape_string($conn, $_POST['username']);
    $password   = mysqli_real_escape_string($conn, $_POST['password']);
    $diachi     = mysqli_real_escape_string($conn, $_POST['diachi']);
    $dienthoai  = mysqli_real_escape_string($conn, $_POST['dienthoai']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $ngaysinh   = $_POST['ngaysinh'];
    $gioitinh   = $_POST['gioitinh'];
    $theloai    = $_POST['theloaiyeuthich'];

    // SỬA TÊN BẢNG THÀNH users
    $sql = "INSERT INTO users (hovaten, username, password, diachi, dienthoai, email, ngaysinh, gioitinh, theloaiyeuthich) 
            VALUES ('$hovaten', '$username', '$password', '$diachi', '$dienthoai', '$email', '$ngaysinh', '$gioitinh', '$theloai')";
    
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Đăng ký thành công!'); window.location='dang-nhap.php';</script>";
    } else {
        echo "<div style='color:red; background:white;'>Lỗi: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="container" style="color:#fff; padding: 20px; background: rgba(0,0,0,0.8);">
    <h2 style="text-align:center; color:#f1c40f;">ĐĂNG KÝ THÀNH VIÊN</h2>
    <form method="POST" action="">
        <table style="width: 500px; margin: 0 auto;">
            <tr><td>Họ và tên:</td><td><input type="text" name="hovaten" required style="width:100%"></td></tr>
            <tr><td>Tên đăng nhập:</td><td><input type="text" name="username" required style="width:100%"></td></tr>
            <tr><td>Mật khẩu:</td><td><input type="password" name="password" required style="width:100%"></td></tr>
            <tr><td>Địa chỉ:</td><td><input type="text" name="diachi" style="width:100%"></td></tr>
            <tr><td>Điện thoại:</td><td><input type="text" name="dienthoai" style="width:100%"></td></tr>
            <tr><td>Email:</td><td><input type="email" name="email" style="width:100%"></td></tr>
            <tr><td>Ngày sinh:</td><td><input type="date" name="ngaysinh" style="width:100%"></td></tr>
            <tr><td>Giới tính:</td>
                <td>
                    <input type="radio" name="gioitinh" value="Nam" checked> Nam 
                    <input type="radio" name="gioitinh" value="Nữ"> Nữ
                </td>
            </tr>
            <tr><td>Thể loại yêu thích:</td>
                <td>
                    <select name="theloaiyeuthich" style="width:100%">
                        <option value="Phim Hành Động">Phim Hành Động</option>
                        <option value="Phim Tình Cảm">Phim Tình Cảm</option>
                        <option value="Phim Kinh Dị">Phim Kinh Dị</option>
                    </select>
                </td>
            </tr>
            <tr><td colspan="2" style="text-align:center;">
                <input type="submit" name="btnDangKy" value="ĐĂNG KÝ" style="margin-top:20px; padding:10px 30px; background:#f1c40f; border:none; cursor:pointer;">
            </td></tr>
        </table>
    </form>
</div>

<?php require('include/footer.php'); ?>
