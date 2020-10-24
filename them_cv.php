
<!DOCTYPE HTML>
<html>
<head>
    <title>Thêm chức vụ</title>
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
                       
                                  try{
                                       insertCV($_POST['ten'],$_POST['ghichu']);
                                       header("Location:index.php?detail=chucvu");
                                  }catch(PDOException $e){
                                       $r="đăng ký không thành công";
                                  }
 
                     
          }else{
                $r="Nhập thông tin chức vụ .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="them_cv.php">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Thêm chức vụ</h2>
                
                <br>
                <input type="text"  class="form-control" placeholder="Tên chức vụ" name="ten" required>
             
                <br>
                <input type="text"  class="form-control" placeholder="Ghi chú" name="ghichu" required>
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Thêm chức vụ</button>
                <br>
            </form><!-- /form -->
            <p></p>
          
            <a href="index.php?detail=chucvu" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    
</body>