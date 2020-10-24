
<!DOCTYPE HTML>
<html>
<head>
    <title>Thêm nhóm thuôc</title>
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
                                 
                                  try{
                                    require_once('ketnoi_pdo.php');
                                       insertNT($_POST['tendangnhap'],$_POST['ghichu']);
                                       header("Location:index.php?detail=nhomthuoc");
                                  }catch(PDOException $e){
                                       $r="Thêm nhóm thuốc không thành công .";
                                  }

                     
              }else{
                $r="Nhập thông tin nhóm thuốc .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="them_nt.php">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Thêm nhóm thuốc</h2>
                
                <br>
                <input type="text"  class="form-control" placeholder="Tên nhóm thuốc" name="tendangnhap" required>
                <br>
                <input type="text"  class="form-control" placeholder="Ghi chú" name="ghichu" required>
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Thêm nhóm thuốc</button>
                <br>
            </form><!-- /form -->
            <p></p>
          
            <a href="index.php?detail=nhomthuoc" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    
</body>