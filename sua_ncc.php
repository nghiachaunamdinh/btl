 
<!DOCTYPE HTML>
<html> 
<head>
    <title>Sửa thông tin nhà cung cấp</title>
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
             if(isset($_POST['sua'])){
                        require_once('ketnoi_pdo.php');
                        if(testsdt($_POST['sdt'])==true){
                          
                                  try{
                                       UpdateNCC($_GET['mancc'],$_POST['tendangnhap'],$_POST['diachi'],$_POST['sdt']);
                                         header("Location:index.php?detail=nhacungcap");
                                  }catch(PDOException $e){
                                       $r="Sửa không thành công";
                                  }
                        }else{
                          $r="Số điện thoại chỉ gồm 10 chữ số. ";
                        }
          }else{
                $r="Nhập thông tin nhà cung cấp cần sửa .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="sua_ncc.php?mancc=<?php echo $_GET['mancc']; ?>">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Sửa nhân viên</h2>
                <p ></p>
                <input type="text"  class="form-control" placeholder="Tên nhân viên" name="tendangnhap" required>
               
                <br>
                <input type="text"  class="form-control" placeholder="Địa chỉ" name="diachi" required>
                <br>
                <input type="text"  class="form-control" placeholder="Số điện thoại" name="sdt" required>
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="sua" onclick="test();">Sửa nhà cung cấp</button>
                <br>
            </form><!-- /form -->
            <p></p>
          
            <a href="index.php?detail=nhacungcap" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
  
</body>
</html>s
