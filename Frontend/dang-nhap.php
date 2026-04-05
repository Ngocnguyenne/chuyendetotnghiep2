<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
require('include/header.php');
require('admin/conn.inc.php');

// --- PHẦN 1: XỬ LÝ ĐĂNG NHẬP (PHP) ---
if(isset($_POST['btnDangNhap'])) {
    $u = mysqli_real_escape_string($conn, $_POST['txtUser']);
    $p = mysqli_real_escape_string($conn, $_POST['txtPass']);

    // Kiểm tra bảng admin
    $sql_admin = "SELECT * FROM admin WHERE username='$u' AND password='$p'";
    $res_admin = mysqli_query($conn, $sql_admin);

    if(mysqli_num_rows($res_admin) > 0) {
        $row = mysqli_fetch_assoc($res_admin);
        $_SESSION['user'] = $row['username'];
        $_SESSION['name'] = $row['hovaten'];
        $_SESSION['role'] = 'admin';
        echo "<script>alert('Chào Admin " . $row['hovaten'] . "!'); window.location='admin/index.php';</script>";
        exit();
    } 

    // Kiểm tra bảng users
    $sql_user = "SELECT * FROM users WHERE username='$u' AND password='$p'";
    $res_user = mysqli_query($conn, $sql_user);

    if(mysqli_num_rows($res_user) > 0) {
        $row = mysqli_fetch_assoc($res_user);
        $_SESSION['user'] = $row['username'];
        $_SESSION['name'] = $row['hovaten'];
        $_SESSION['role'] = 'user';
        echo "<script>alert('Đăng nhập thành công!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu!');</script>";
    }
}
?>

<div class="container" style="padding: 100px 0; text-align: center; background: #111;">
    <div style="width: 350px; margin: 0 auto; background: rgba(34, 34, 34, 0.9); padding: 40px; border-radius: 10px; border: 1px solid #f1c40f; box-shadow: 0px 0px 15px rgba(241, 196, 15, 0.3);">
        
        <h2 style="color: #f1c40f; margin-bottom: 30px; font-family: Arial, sans-serif;">ĐĂNG NHẬP HỆ THỐNG</h2>
        
        <form method="POST" action="">
            <div style="margin-bottom: 20px; text-align: left;">
                <label style="color: #ccc; display: block; margin-bottom: 5px;">Tên đăng nhập:</label>
                <input type="text" name="txtUser" required placeholder="Nhập username..." 
                       style="width: 100%; padding: 12px; border-radius: 5px; border: 1px solid #444; background: #222; color: #fff; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 25px; text-align: left;">
                <label style="color: #ccc; display: block; margin-bottom: 5px;">Mật khẩu:</label>
                <input type="password" name="txtPass" required placeholder="Nhập mật khẩu..." 
                       style="width: 100%; padding: 12px; border-radius: 5px; border: 1px solid #444; background: #222; color: #fff; box-sizing: border-box;">
            </div>
            
            <input type="submit" name="btnDangNhap" value="VÀO XEM PHIM" 
                   style="width: 100%; padding: 12px; background: #f1c40f; color: #000; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.3s;">
        </form>
        
        <p style="color: #888; margin-top: 20px; font-size: 14px;">
            Chưa có tài khoản? <a href="dang-ky.php" style="color: #f1c40f; text-decoration: none;">Đăng ký ngay</a>
        </p>
    </div>
</div>

<?php require('include/footer.php'); ?>
