
<!DOCTYPE HTML>
<html>
<head>
    <title>Lấy lại mật khẩu</title>
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
              $conn = mysqli_connect("localhost", "root", "", "qlst");
              mysqli_set_charset($conn, "utf8");
              $re = mysqli_query($conn, "SELECT * FROM NhanVien");
               $test ="";
               $test02="";
              while($row = mysqli_fetch_assoc($re)){
                  if($_POST['email']==$row['Email']){
                       GLOBAL $test;
                       $test =".";
                       GLOBAL $test02;
                       $test02=$row['MaNV'];
                  }
              }
             
                   require_once('ketnoi_pdo.php');
                   if(testEmail($_POST['email'])==false){
                       GLOBAL $test;
                        if($test=="."){
                              $value=random_int(1000, 9999);
                              require_once('testmail.php');
                              UpdateDangNhap($value,$test02);
                              header("Location:testmail.php?value=".$value." & email=".$_POST['email']." & manv=".$test02);
                        }else{
                           $r="Gmail chưa được đăng ký.";
                        }
                   }else{
                       $r ="Gmail không đúng. ";
                   }
             
            }else{
              $r="Nhập Gmail.";
            }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="nhap_email.php">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Nhập Gmail nhận </h2>
              
                <br>
                <input type="Email"  class="form-control" placeholder="Email" name="email" required>
             
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Đồng ý gửi</button>
                <br>
            </form><!-- /form -->
            <p><?php echo $r; ?></p>
          
            <a href="dangnhap.php" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    
</body>