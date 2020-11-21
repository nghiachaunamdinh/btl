
<!DOCTYPE HTML>
<html>
<head>
    <title>Đăng ký tài khoản</title> 
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
              while($row = mysqli_fetch_assoc($re)){
                  if($_POST['manv']==$row['MaNV']){
                       $test =".";
                  }
              }
              if($test==""){
                   require_once('ketnoi_pdo.php');
                   if(testEmail($_POST['email'])==false){ 
                        if(testsdt($_POST['sdt'])==true){
                           if(testsocmt($_POST['cmt'])==true){
                                  try{
                                       insertNhanVien($_POST['tendangnhap'],$_POST['email'],$_POST['diachi'],$_POST['sdt'],$_POST['cmt'],$_POST['anh'],$_POST['cv']);
                                       header("Location:index.php?detail=nhanvien");
                                  }catch(PDOException $e){
                                       $r="đăng ký không thành công";
                                  }

                           }else{
                               $r="Số chứng minh thư chỉ chứa số ";
                            }
                        }else{
                          $r="Số điện thoại chỉ gồm 10 chữ số. ";
                        }
                   }else{
                       $r ="Email không đúng. ";
                   }
              }else{
                  $r ="Đã tồn tại mã nhân viên . ";
              }
          }else{
                $r="Nhập thông tin nhân viên .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="them_nv.php">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Thêm nhân viên</h2>
                <p ></p>
               <!--  Chọn nhà cung cấp :
                <select class="list-group" style="height: 33px;" name="cv">
                  <option value="0">Chọn</option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhaCungCap ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaNCC'] ?>"><?php echo $row['TenNCC'] ?></option>
                  <?php
                        }
                         
                  ?> 
                </select>-->
                <br>
                <input type="text"  class="form-control" placeholder="Tên nhân viên" name="tendangnhap" required>
                <br>
                <input type="Email"  class="form-control" placeholder="Email" name="email" required>
                <br>
                <input type="text"  class="form-control" placeholder="Địa chỉ" name="diachi" required>
                <br>
                <input type="text"  class="form-control" placeholder="Số điện thoại" name="sdt" required>
                <br>
                <input type="text"  class="form-control" placeholder="Số CMT"  name="cmt" required>
                <br>
               <label for="myfile">Chọn hình ảnh:</label>
               <input type="file" id="myfile" name="anh">
                <br>
                Chức vụ :
                <select class="list-group" style="height: 33px;" name="cv">
                  <option value="0">Chọn chức vụ</option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM ChucVu ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaCV'] ?>"><?php echo $row['TenCV'] ?></option>
                  <?php
                        }
                         
                  ?> 
                </select>
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Thêm nhân viên</button>
                <br>
            </form><!-- /form -->
            <p></p>
          
            <a href="index.php" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    
</body>