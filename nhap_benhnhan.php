<!DOCTYPE HTML>
<html>
<head>
    <title>Nhập thông tin bệnh nhân</title>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
    
</head>
<body>
    <div class="container" align="center" style="background-color: #cce0ff;">
<?php 
         session_start();
         require_once 'ketnoi_pdo.php';
         if(isset($_POST['submitbn'])){
         	$sdt=$_POST['sdt'];
         	
            if(testsdt($sdt)){
                 if(testsocmt($_POST['socmt'])==true){
            	    try{
                        insertBN($_POST['tenbn'],$_POST['sdt'],$_POST['socmt'],$_POST['diachi']);  
                        $ma=selectmax('BenhNhan','MaBN');  
                        $_SESSION['mabn']=$ma;
                        date_default_timezone_set('UTC');
                        $date=date('Y/m/d H:i:s');
                         insertHDB($ma,$_SESSION["name"],$date); 
                        $_SESSION['mahdb']=selectmax('HoaDonBan','MaHDB'); 
                        header('Location:index.php');
                        $r= "Đăng ký thành công.";
                    }catch(PDOException $e){
                              $r="Đăng ký không thành công";
                    }
                }else{
                    $r="Nhập lại số chứng minh thư chỉ chứa số .";
                }
            }else{ 
            	 $r="Nhập lại số điện thoại(chỉ chứa số, tối đa 10 chữ số) .";
            }
         }else{
                $r="Nhập thông tin đăng ký .";
         }
?>
       
    	<form action="" method="post" accept-charset="utf-8" id="form_tt" style="width: 500px; padding-top: 150px; ">
    		<div class="form-group">
    			<div align="center" class="logo">Nhập thông tin bệnh nhân</div>
                 <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
    			<br>
    			<input type="text"  class="form-control" placeholder="Tên bệnh nhân" required autofocus name="tenbn" id="namekh">
    			<br>
    			<input type="text"  class="form-control" placeholder="SDT" required autofocus name="sdt">
    			<br>
    			<input type="text"  class="form-control" placeholder="Số CMT"  required name="socmt">
    			<br>
    			<input type="text"  class="form-control" placeholder="Địa chỉ" required name="diachi">
    			
    			<br>
    			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submitbn" onclick="">Đăng ký</button>
    			<br>
    			<p style="font-weight: bold;color: red;" align="center"><?php echo $r ?></p>
    		</div>
    	</form>

    </div>
</body>
</html>
     