
<!DOCTYPE HTML>
<html>
<head>
    <title>Xác nhận SMS</title>
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
                   if($_POST['email']==$_GET['code']){ 
                      header("Location:dangnhap.php");
                   }else{
                       $r ="Mã SMS không đúng. ";
                   }
             
            }else{
              $r="Nhập mã xác nhận đã gửi qua SĐT bạn đã đăng ký trên hệ thống UTC-Hospital.";
            }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="nhap_maxndt.php?code=<?php echo $_GET['code']; ?>">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Nhập mã SMS </h2>
              
                <br>
                <input type="text"  class="form-control" placeholder="Mã xác nhận" name="email" required>
             
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Đồng ý xác nhận</button>
                <br>
            </form><!-- /form -->
            <p style="color: red"><?php echo $r; ?></p>
          
            <a href="dangnhap.php" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    
</body>