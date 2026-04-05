<?php 
require_once('include/header.php'); 
require_once('config.php'); 
$id = $_GET["id"];
$result = mysql_query("select * from theloai where id = ".$id, $connect);
$row = mysql_fetch_array($result);
?>
<div class="block" id="movie-update"><br />
<div class="blocktitle">
<div class="icon movie2"></div>
  <?php
                                 $sql2 = mysql_query("select * from theloai where id = " . $id, $connect);
                                 while ($row2 = mysql_fetch_array($sql2)) {
                                    $id = $row2['id'];
                                    $tongsophim = 0;
                                    $sql3 = mysql_query("select count(*) from phim where theloai = " . $id);
                                    $count = mysql_fetch_array($sql3);
                                    $tongsophim = $count[0];
                                    ?>

<?php }
                                 
 ?>
<h2 class="title">Thể Loại : <?php echo $row["theloai"] ?> Có <?php echo $tongsophim; ?> Phim</h2>
                               
                                 
   
<div class="tabs" data-target="#list-movie-update">
</div>
</div><br /><br />
<div class="blockbody" id="list-movie-update">
<div class="divider"></div>
<ul class="list-film tab phim-chieu-rap">

   
<?php
$connect = mysql_connect("localhost", "root", "") or die ("Server not found!");
mysql_select_db("webphim", $connect) or die("Database not found!");
mysql_query("SET NAMES 'utf8'");
$query = mysql_query("select * from phim where theloai = ".$id, $connect);
while($row = mysql_fetch_array($query)){?>
<li>
<div class="inner">
<div>
<a href="/doan/thong-tin-phim/<?php echo $row["id"] ?>.html" title="<?php echo $row["tenphim"] ?>">
<img class="khung" src="/doan/admin/<?php echo $row["anhminhhoa"] ?>" alt="<?php echo $row["tenphim"] ?>" />
</a>
</div>
<div class="statustop">
<span><?php echo $row["soluotxem"] ?> views</span>
</div>
<div class="statusbot">
<span class="statusbotleft"><?php echo $row["namsanxuat"] ?></span>
<span class="statusbotright"><?php echo $row["thoiluongphim"] ?></span>
</div>
<div class="name">
<a href="/doan/thong-tin-phim/<?php echo $row["id"] ?>.html" title="<?php echo $row["tenphim"] ?>"><?php echo $row["tenphim"] ?></a>
</div>
</div>
</li>

<?php
}
echo '</ul></div></div>';

require_once('include/footer.php');
?>
