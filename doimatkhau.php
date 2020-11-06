<!DOCTYPE HTML>
<html>
<head>
    <title>Đổi mật khẩu</title>
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
            if(isset($_POST['submitmk'])){
              $conn = mysqli_connect("localhost", "root", "", "qlst");
              mysqli_set_charset($conn, "utf8");
              $test="";
              $re = mysqli_query($conn, "SELECT * FROM DangNhap where MaNV='".$_SESSION["name"]."'");
              while($row = mysqli_fetch_assoc($re)){
                  if($_POST['mkcu']==$row['MatKhau']){
                     if($_POST['matkhaumoi']==$_POST['makhaumoi2']){
                          require_once 'ketnoi_pdo.php';
                          try{
                              $sql = "UPDATE DangNhap SET MatKhau='".$_POST['matkhaumoi']."' WHERE MaNV='".$_SESSION["name"]."'";    
                              db()->exec($sql);
                              echo '<script language="javascript">'; 
                              echo 'alert("Cập nhật mật khẩu thành công.")'; 
                              echo '</script>'; 
                              header("Location:index.php");
                             
                          } catch(PDOException $e){
                              //die("ERROR: Không thể thực thi truy $sql. " . $e->getMessage());
                              $r="Cập nhật không thành công";
                          }
                      }else{
                         $r="Nhập lại mật khẩu mới chưa đúng.";
                      }
                         $test="1";
                  }
              }
              if($test==""){
                   $r ="Mật khẩu cũ không đúng";
                    }
              
            }else{
                $r="Nhập thông tin .";
            }
             
        ?>
<div class="card card-container">
            <div align="center" class="logo">Hệ thống quản lý thuốc <P class="utc">UTC</P></div>
            <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
            <p id="profile-name" class="profile-name-card"></p>

            <form class="form-signin" action="doimatkhau.php" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="password"  class="form-control" placeholder="Mật khẩu cũ" required autofocus name="mkcu" id="mkcu">
                <p></p>
                <input type="password"  class="form-control" placeholder="Mật khẩu mới" name="matkhaumoi" id="matkhaumoi">
                 <p></p>
                <input type="password"  class="form-control" placeholder="Nhập lại mật khẩu" name="makhaumoi2" id="makhaumoi2">
                <p></p>
                <p></p>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submitmk" onclick="" >Đổi mật khẩu</button>
            </form><!-- /form -->
            <p></p>
            <a href="index.php" class="forgot-password">
                Quay lại
            </a>
            <p></p>
            <a href="" class="" style="color: red;font-weight: bold;">
                <?php echo $r ?>
            </a>
        </div>
    </div>
</body>