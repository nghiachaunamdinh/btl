
 
<!DOCTYPE HTML>
<html> 
<head>
    <title>Sửa thông tin đơn vi tính</title>
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
                       
                                  try{
                                       UpdateDVT($_GET['madvt'],$_POST['ten'],$_POST['diachi']);
                                         header("Location:index.php?detail=donvitinh");
                                  }catch(PDOException $e){
                                       $r="Sửa không thành công";
                                  }
                      
          }else{
                $r="Nhập thông tin đơn vị tính cần sửa .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="sua_dvt.php?madvt=<?php echo $_GET['madvt']; ?>">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Sửa nhân viên</h2>
                <p ></p>
                <input type="text"  class="form-control" placeholder="Tên đơn vị tính" name="ten" required>
               
                <br>
                <input type="text"  class="form-control" placeholder="Ghi chú" name="diachi" required>
             
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="sua" onclick="test();">Sửa đơn vị tính</button>
                <br>
            </form><!-- /form -->
            <p></p>
          
            <a href="index.php?detail=donvitinh" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
  
</body>
</html>s
