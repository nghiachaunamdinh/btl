<?php

   session_start();
    require_once 'ketnoi_pdo.php';
    $r="Mật khẩu hoặc tên đăng nhập không đúng .";
    if(isset($_POST['submit'])){
        $name=$_POST['tendangnhap'];
        $pass=$_POST['matkhau'];
        $result = db()->query("SELECT * FROM DangNhap");
        while($row = $result->fetch()) {
            if($name==$row['TenDangNhap'] && $pass==$row['MatKhau']){
                header('Location:index.php'); 
                $r="";
                $_SESSION['name']=$row['MaNV'];
            }
        }
    }else{
        $r="Đăng nhập tài khoản";
    }
    
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Trang HTML5</title>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
    
</head>
<body>
    <div class="container">
        <div class="card card-container">
            <div align="center" class="logo">Hệ thống quản lý thuốc <P class="utc">UTC</P></div>
            <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="dangnhap.php" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text"  class="form-control" placeholder="Tên đăng nhập" required autofocus name="tendangnhap">
                <p></p>
                <input type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required name="matkhau">
                <div id="remember" class="checkbox">
                    <label>
                        <a href="dangky.php" class="dangky"> Đăng ký tài khoản ? </a>
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Đăng nhập</button>
            </form><!-- /form -->
            <a href="nhap_email.php" class="forgot-password">
                Quên mật khẩu !
            </a>
            <p><?php echo $r ?></p>
        </div>
    </div>
</body>