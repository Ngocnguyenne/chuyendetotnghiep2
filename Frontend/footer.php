<style>
    #left_ads_float { margin-left: 30px; bottom: 50px; left: 0px; position: fixed; }
    #right_ads_float { bottom: 50px; right: 0px; position: fixed; }
</style>

<script>
    function check_adswidth() {
        var lwidth = document.body.clientWidth;
        var display = (lwidth < 1235) ? 'none' : 'block';
        document.getElementById('left_ads_float').style.display = display;
        document.getElementById('right_ads_float').style.display = display;
        setTimeout(check_adswidth, 100);
    }
</script>

<div id="left_ads_float">
    <iframe src="/doan/quang-cao/images/trai.gif" width="160" height="600" frameborder="0" scrolling="no"></iframe>
</div>

<div id="right_ads_float">
    <iframe src="/doan/quang-cao/images/phai.gif" width="160" height="600" frameborder="0" scrolling="no"></iframe>
</div>

<script>check_adswidth();</script>

<div id="sidebar">
    <div class="thongke">
        <div class="block">
            <div class="blocktitle"><div class="tab">Khách Đăng Nhập</div></div>
            <div class="blockbody">
                <form action="dang-nhap.php" method="post" style="padding: 10px;">
                    <font color="white">Username: <input type="text" name="username" style="width:90%"></font><br /><br />
                    <font color="white">Password: <input type="password" name="password" style="width:90%"></font><br /><br />
                    <div align="center">
                        <input type="submit" name="submit" value=" Đăng Nhập ">
                        <input type="reset" name="reset" value=" Hủy Bỏ ">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="thongke">
        <div class="block">
            <div class="blocktitle"><div class="tab">Thể Loại Phim Truyện</div></div>
            <div class="blockbody">
                <ul class="tab topviewday">
                <?php
                // Kết nối chuẩn mysqli
                $conn = mysqli_connect("localhost", "root", "", "webphim") or die("Không kết nối được DB");
                mysqli_set_charset($conn, "utf8");
                
                $result = mysqli_query($conn, "SELECT * FROM theloai");
                while($row = mysqli_fetch_array($result)) {
                ?>
                    <li>
                        <span class="st top">TL</span>
                        <div class="detail">
                            <div class="name">
                                <a href="/doan/the-loai/<?php echo $row["id"] ?>.html"><?php echo $row["theloai"] ?></a>
                            </div>
                            <div class="views">
                                <a href="/doan/the-loai/<?php echo $row["id"] ?>.html"><font color="gray">Xem Chi Tiết</font></a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="thongke">
        <div class="block">
            <div class="blocktitle"><div class="tab">Thống Kê WebSite</div></div>
            <div class="blockbody">
                <ul class="tab topviewday" style="padding:10px;">
                <?php 
                // Đếm số lượng phim
                $r_phim = mysqli_query($conn, "SELECT count(*) as tong FROM phim");
                $d_phim = mysqli_fetch_assoc($r_phim);
                
                // Đếm số Admin/Thành viên
                $r_admin = mysqli_query($conn, "SELECT count(*) as tong FROM admin");
                $d_admin = mysqli_fetch_assoc($r_admin);

                echo "<li><font color='white'>Số Bộ Phim: <b>{$d_phim['tong']}</b></font></li>";
                echo "<li><font color='white'>Số Thành Viên: <b>{$d_admin['tong']}</b></font></li>";
                ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="quangcao">
        <img src="/doan/quang-cao/event-free-ship.png" width="298px" />
    </div>
</div>

<div id="footer">
    <div class="container info">
        <div class="text">
            <b>Copyright © 2026 by CDTN - All Rights Reserved.<br />
            Sinh viên thực hiện: Nguyên Ngọc - Nhật Vũ - Hồng Hải</b>
        </div>
    </div>
</div>
