<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Bắt đầu phiên làm việc
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Đồ Án 4 - Thiết Kế Web Gợi Ý Xem Phim PHP</title>
<meta charset="UTF-8">
<link href="giao-dien/style.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="giao-dien/favicon.png"/>
<link rel="icon" href="giao-dien/favicon.png"/>
</head>
<body>
<div id="wrapper">
<div id="header">
    <div class="headcontainer">
        <div class="logo">
            <a href="index.php"><img src="logo.png" alt="Nhóm 11" title="Nhóm 11" /></a>
        </div>
        
        <div style="float: right; color: #f1c40f; padding: 20px 20px 0 0; font-weight: bold;">
            <?php if(isset($_SESSION['name'])): ?>
                Chào, <?php echo $_SESSION['name']; ?> | <a href="logout.php" style="color: #fff; font-size: 11px; text-decoration: none;">[THOÁT]</a>
            <?php endif; ?>
        </div>
    </div>  

    <div id="menu" class="default">    
        <ul class="container menu" id="nav">            
            <li class="home"><a href="index.php">TRANG CHỦ</a></li>            
            <li><a href="gioi-thieu.php">GIỚI THIỆU</a></li>
            <li><a href="lien-he.php">LIÊN HỆ</a></li>

            <?php if(!isset($_SESSION['user'])): ?>
                <li><a href="dang-ky.php">ĐĂNG KÝ</a></li>
                <li><a href="dang-nhap.php">ĐĂNG NHẬP</a></li>
            <?php else: ?>
                <li><a href="phim-yeu-thich.php">PHIM CỦA TÔI</a></li>
                <?php if($_SESSION['user'] == 'admin'): ?>
                    <li><a href="admin/index.php" style="color: red;">QUẢN TRỊ</a></li>
                <?php endif; ?>
            <?php endif; ?>

            <li>
                <div class="widget_search">
                    <form method="GET" id="form-search" action="tim-kiem.php">
                        <div>
                            <input type="text" name="tukhoa" placeholder="Tìm tên phim, diễn viên..." value="">
                            <input id="searchsubmit" value=" " type="submit">
                        </div>
                    </form>
                </div>
            </li>             
        </ul>    
    </div>      
</div>

<?php
// Fix lỗi đường dẫn slide
if (file_exists('slide/demo.html')) {
    require('slide/demo.html');
} elseif (file_exists('../slide/demo.html')) {
    require('../slide/demo.html');
}
?>
<div id="body-wrap" class="container">
