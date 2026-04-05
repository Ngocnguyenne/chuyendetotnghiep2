<?php
// 1. Sử dụng kết nối mysqli từ file hệ thống (conn.inc.php)
require_once('admin/conn.inc.php');

echo '<div class="block" id="movie-update"><br />
<div class="blocktitle">
    <div class="icon movie2"></div>
    <h2 class="title" style="color: #00ADEF;">Phim Cùng Chuyên Mục</h2>
</div><br />
<div class="blockbody" id="list-movie-update">
<ul class="list-film tab phim-chieu-rap" style="display: flex; flex-wrap: wrap; list-style: none; padding: 0; gap: 15px;">';

// 2. Lấy ID phim hiện tại và Thể loại để lọc
// $row là mảng dữ liệu phim đang xem đã được gọi ở file cha (xem-phim.php hoặc thong-tin-phim.php)
$current_id = isset($row['id']) ? $row['id'] : 0;
$theloai_id = isset($row['theloai']) ? $row['theloai'] : 0;

// 3. Truy vấn lấy các phim cùng thể loại (trừ phim đang xem)
$sql = "SELECT * FROM phim WHERE theloai = '$theloai_id' AND id != '$current_id' ORDER BY RAND() LIMIT 6";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// 4. Vòng lặp hiển thị (Không gọi fetch_array bên ngoài while)
if (mysqli_num_rows($result) > 0) {
    while($r = mysqli_fetch_array($result)) {
?>
<li>
    <div class="inner" style="width: 160px; background: #111; border: 1px solid #333; padding: 5px;">
        <div>
            <a href="thong-tin-phim.php?id=<?php echo $r["id"] ?>" title="<?php echo $r["tenphim"] ?>">
                <img class="khung" src="<?php echo $r["anhminhhoa"] ?>" 
                     alt="<?php echo $r["tenphim"] ?>" 
                     style="width: 100%; height: 220px; object-fit: cover;" />
            </a>
        </div>
        <div class="statustop" style="font-size: 10px; color: #aaa; margin-top: 5px;">
            <span><?php echo number_format($r["soluotxem"]) ?> views</span>
        </div>
        <div class="statusbot" style="display: flex; justify-content: space-between; font-size: 10px; color: #888;">
            <span class="statusbotleft"><?php echo date('Y', strtotime($r["namsanxuat"])) ?></span>
            <span class="statusbotright"><?php echo $r["thoiluongphim"] ?></span>
        </div>
        <div class="name" style="margin-top: 5px; text-align: center; height: 32px; overflow: hidden;">
            <a href="thong-tin-phim.php?id=<?php echo $r["id"] ?>" 
               title="<?php echo $r["tenphim"] ?>" 
               style="color: #ff9d00; text-decoration: none; font-size: 12px; font-weight: bold;">
                <?php echo $r["tenphim"] ?>
            </a>
        </div>
    </div>
</li>

<?php
    }
} else {
    echo "<p style='color: #666; margin-left: 20px;'>Không có phim liên quan khác.</p>";
}
echo '</ul></div></div>';
?>
