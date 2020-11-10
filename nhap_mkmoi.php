
<!DOCTYPE HTML>
<html>
<head>
    <title>Nhạp mật khẩu mới</title>
    <meta charset="UTF-8">
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
</head>
<body>
    <div class="container">
        <?php
            session_start(); 
            if(isset($_POST['them'])){
               require_once('ketnoi_pdo.php');
              UpdateMatKhauQuen($_GET['manv'],$_POST['email']);
              header("Location:dangnhap.php");
            }else{
              $r="Nhập mật khẩu mới.";
            }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="nhap_mkmoi.php?manv=<?php echo $_GET['manv'] ?>">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Nhập mật khẩu</h2>
              
                <br>
                <input type="text"  class="form-control" placeholder="Mật khẩu mới" name="email" required>
             
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Đồỉ mật khẩu</button>
                <br>
            </form><!-- /form -->
            <p><?php echo $r; ?></p>
          
            <a href="dangnhap.php" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    
</body>