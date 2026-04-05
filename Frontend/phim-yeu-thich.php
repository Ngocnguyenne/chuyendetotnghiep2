<?php 
if(!isset($_SESSION)) session_start();
include "include/header.php"; 
include "admin/conn.inc.php";

// Kiểm tra đăng nhập
if(!isset($_SESSION['user'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem phim của tôi!'); window.location='dang-nhap.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id']; // Đảm bảo lúc đăng nhập bạn đã lưu ID người dùng vào session
?>

<div class="container" style="background: #111; padding: 30px; min-height: 500px; color: white;">
    <h1 style="border-left: 5px solid #ff9d00; padding-left: 15px; margin-bottom: 30px;">PHIM CỦA TÔI (YÊU THÍCH)</h1>
    
    <div class="movie-grid" style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php 
    // Truy vấn lấy các phim từ bảng favorites liên kết với bảng phim
    $sql = "SELECT phim.* FROM favorites 
            JOIN phim ON favorites.phim_id = phim.id 
            WHERE favorites.user_id = '$user_id' 
            ORDER BY favorites.id DESC";
            
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            ?>
            <div class="item-phim" style="width: 180px; background: #222; border: 1px solid #333; padding: 10px;">
                <a href="thong-tin-phim.php?id=<?php echo $row['id']; ?>" style="text-decoration: none;">
                    <img src="<?php echo $row['anhminhhoa']; ?>" style="width: 100%; height: 240px; object-fit: cover;">
                    <h3 style="color: #ff9d00; font-size: 14px; margin: 10px 0; text-align: center;"><?php echo $row['tenphim']; ?></h3>
                </a>
                <a href="xoa-yeu-thich.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Bỏ phim này khỏi danh sách?')"
                   style="color: #ff4444; font-size: 12px; display: block; text-align: center;">[ Bỏ yêu thích ]</a>
            </div>
            <?php
        }
    } else {
        echo "<div style='padding: 20px; color: #888;'>Bạn chưa có phim nào trong danh sách yêu thích.</div>";
    }
    ?>
    </div>
</div>

<?php include "include/footer.php"; ?>
