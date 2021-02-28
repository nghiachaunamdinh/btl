
<!DOCTYPE HTML>
<html>
<head>
    <title>Đăng ký tài khoản</title>
    <meta charset="UTF-8">
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
      <link rel="shortcut icon" type="text/css" href="images/logo_utc.jpg">
</head>
<body>
    <div class="container">
        <?php 
            session_start();
         if(isset($_POST['dangky'])){
    
              $conn = mysqli_connect("localhost", "root", "", "qlst");
              mysqli_set_charset($conn, "utf8");
              $test="";
              $msv="";
              $re = mysqli_query($conn, "SELECT * FROM NhanVien");
              while($row = mysqli_fetch_assoc($re)){
                  if($_POST['email']==$row['Email']){
                    $msv=$row['MaNV'];
                    require_once 'ketnoi_pdo.php';

                    if(taikhoan($row['MaNV'])=="false"){
                      if(testtendangnhap($_POST['tendangnhap'])=="false"){
                        if($_POST['matkhau1']==$_POST['matkhau2']){
                          require_once 'ketnoi_pdo.php';
                          try{
                              $mk=base64_encode(stripslashes($_POST['matkhau1']));
                              $_SESSION['tendangnhap']=$_POST['tendangnhap'];
                              $_SESSION['matkhau']=$mk;
                              //insert($msv,$_POST['tendangnhap'],$mk); 
                              header("Location:sms2.php?manv=".$msv."& sdt=".$row['SDT']);
                             } catch(PDOException $e){
                              //die("ERROR: Không thể thực thi truy $sql. " . $e->getMessage());
                              $r="Đăng ký không thành công";
                             }
                    
                      }else{
                         $r="Nhập lại mật khẩu  chưa đúng.";
                      }
                         $test="1";
                       }else{
                          $r="Tên đăng nhập đã tồn tại.";
                       }
                       $test="1";
                    }else{
                    $test="1";
                    $r="Tài khoản đã tồn tại.";
                    }
                     
                  }
              }
              if($test==""){
                   $r ="Không tồn tại nhân viên trong danh sách.Kiểm tra Email";
            }
}else{
                $r="Nhập thông tin đăng ký .";
}
         ?>
        <div class="card card-container">
            <div align="center" class="logo">Hệ thống quản lý thuốc <P class="utc">UTC</P></div>
            <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST" action="dangky.php">
                 <span id="reauth-email" class="reauth-email"></span>
                <p ></p>
                <input type="Email"  class="form-control" placeholder="Email" name="email" required>
                <br>
                <p></p>
                <input type="text"  class="form-control" placeholder="Tên đăng nhập" name="tendangnhap" required>
                <br>
                <input type="password"  class="form-control" placeholder="Mật khẩu" name="matkhau1" required>
                <br>
                <input type="password"  class="form-control" placeholder="Nhập lại mật khẩu"  name="matkhau2" required>
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="dangky" >Đăng ký tài khoản</button>
                <br>
            </form><!-- /form -->
            <p></p>
            Đã có tài khoản ?
            <a href="dangnhap.php" class="forgot-password">
                 Đăng nhập tài khoản.
            </a>
        </div>
    </div>
    
</body>