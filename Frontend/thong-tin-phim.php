<?php
// 1. Khởi tạo session và gọi các file hệ thống
if(!isset($_SESSION)) session_start();
require('include/header.php');
require('admin/conn.inc.php'); // Đảm bảo file này dùng mysqli_connect

// 2. Lấy ID phim và bảo mật dữ liệu
$_get = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;

// 3. Truy vấn lấy thông tin phim và tên thể loại (Sử dụng mysqli)
$sql = "SELECT phim.*, theloai.theloai 
        FROM phim 
        INNER JOIN theloai ON phim.theloai = theloai.id 
        WHERE phim.id = '$_get'";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);

if ($row) {
    // 4. Cập nhật lượt xem
    mysqli_query($conn, "UPDATE phim SET soluotxem = soluotxem + 1 WHERE id = '$_get'");
?>

<div id="content" style="background: #111; padding: 20px; color: white;">
    <div class="block" id="page-info">
        <div class="watch">
            <div class="blocktitle breadcrumbs">
                <div class="item">
                    <span>
                        <img src="/doan/giao-dien/images/new.gif" /> 
                        <b style="color: #00ADEF; font-size: 18px;">Xem Phim : <?php echo $row["tenphim"] ?></b>
                    </span>
                </div> 
            </div>
            
            <div class="info hreview-aggregate" style="display: flex; gap: 30px; margin-top: 20px;">
                <div class="poster">
                    <img src="<?php echo $row["anhminhhoa"] ?>" style="width: 250px; border: 3px solid #333;" />
                </div>
                
                <div class="col2" style="flex: 1;">
                    <h2 class="title fn" style="color: #ff9d00; margin-top: 0;"><?php echo $row["tenphim"] ?></h2>
                    <dl style="line-height: 2; font-size: 14px;">
                        <dt><b>Đạo diễn :</b> <?php echo $row["daodien"] ?></dt>
                        <dt><b>Diễn viên :</b> <?php echo $row["dienvien"] ?></dt>
                        <dt><b>Nơi sản xuất :</b> <?php echo $row["noisanxuat"] ?></dt>
                        <dt><b>Năm sản xuất :</b> <?php echo date('d-m-Y', strtotime($row['namsanxuat'])); ?></dt>
                        <dt><b>Thời lượng :</b> <?php echo $row["thoiluongphim"] ?></dt>
                        <dt><b>Lượt xem :</b> <?php echo number_format($row["soluotxem"]) ?> views</dt>
                        <dt><b>Thể loại :</b> <?php echo $row["theloai"] ?></dt>
                    </dl>
                    
                    <div style="margin-top: 20px;">
                        <a href="xem-phim.php?id=<?php echo $row["id"] ?>" title="Click để xem phim">
                            <img src="/doan/giao-dien/images/xemphim.png" alt="Xem phim ngay" />
                        </a>
                    </div>
                    <a href="xu-ly-yeu-thich.php?id=<?php echo $row['id']; ?>" 
                       style="background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-left: 10px;">
                       ❤ Lưu Phim
                     </a>
                </div>
            </div>
            
            <div class="detail" style="margin-top: 40px; border-top: 1px solid #333; padding-top: 20px;">
                <div class="blocktitle">
                    <div class="tab" style="background: #333; display: inline-block; padding: 5px 15px; border-radius: 5px 5px 0 0;">
                        Thông Tin Chi Tiết Bộ Phim
                    </div>
                </div>
                <div class="noidungphim" style="background: #222; padding: 20px; border: 1px solid #333;">
                    <p style="line-height: 1.6; text-align: justify;"><?php echo $row["thongtinphim"] ?></p>
                    <div style="margin-top: 15px; color: #aaa;">
                        <span class="label"><b>Tags:</b></span> 
                        <span style="color: #00ADEF;"><?php echo $row["tags"] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
} else {
    echo "<div style='color:white; text-align:center; padding:100px;'>Xin lỗi, không tìm thấy phim này!</div>";
}

include('include/cung-chuyen-muc.php');
require('include/footer.php');
?>
