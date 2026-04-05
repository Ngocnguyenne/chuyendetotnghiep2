<?php 
session_start();
// Chú ý đường dẫn header.php
include "include/header.php"; 
?>

<div class="container" style="background: white; padding: 40px; min-height: 500px; text-align: center;">
    <h1 style="color: #333; margin-bottom: 30px;">LIÊN HỆ VỚI CHÚNG TÔI</h1>
    
    <div style="display: flex; justify-content: center; gap: 50px; flex-wrap: wrap;">
        
        <div class="contact-item">
            <a href="https://www.facebook.com/ngoc.nguyen.998439" target="_blank" style="text-decoration: none;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg" width="80" height="80" alt="Facebook"><br>
                <p style="font-weight: bold; color: #1877F2; margin-top: 10px;">Facebook</p>
            </a>
        </div>

        <div class="contact-item">
            <a href="https://zalo.me/0876101761" target="_blank" style="text-decoration: none;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" width="80" height="80" alt="Zalo"><br>
                <p style="font-weight: bold; color: #0068FF; margin-top: 10px;">Zalo: 0876101761</p>
            </a>
        </div>

        <div class="contact-item">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=20220623@eaut.edu.vn" target="_blank" style="text-decoration: none;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/7e/Gmail_icon_%282020%29.svg" width="80" height="80" alt="Gmail"><br>
                <p style="font-weight: bold; color: #EA4335; margin-top: 10px;">Gmail</p>
            </a>
        </div>

    </div>

    <div style="margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; color: #666;">
        <p>Bản quyền © 2026 bởi Ngoc Nguyen</p>
    </div>
</div>

<style>
    .contact-item { transition: transform 0.3s; width: 150px; display: flex; flex-direction: column; align-items: center;}
    .contact-item:hover { transform: scale(1.1); }
    .contact-item img { display: block; margin: 0 auto; }
</style>

<?php include "include/footer.php"; ?>
