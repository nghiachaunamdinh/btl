<?php
    session_start();
    if(!isset($_SESSION["name"])){
        header("Location:dangnhap.php");
    } 
    //date_default_timezone_set('Asia/Ho_Chi_Minh');
    //$date=date_create("2017-02-19");
    //echo date_format($date,"Y/m/d");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Quản lý thuốc UTC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="shortcut icon" type="text/css" href="images/logo_utc.jpg">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/ds_thuoc.css">
    <link rel="stylesheet" type="text/css" href="css/doimatkhau.css">
    <!-- Latest compiled and minified JavaScript --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ek+Mukta">
    <link href="css/index.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="js/myscript.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<body style="margin: 0px;padding: 0px;">
<div class="container" style="margin: 0px;padding: 0px; width: 100%;height: 100%;"> 
 <div class="row" style="margin: 0px;padding: 0px;width: 100%;height: 100%;">
     <div class="col-md-6" style="margin: 0px;padding: 0px;">
      <a href="https://www.utc.edu.vn/"><img src="images/utc_title.PNG" alt="" width="100%" height="100%"></a>
     </div>
     <div class="col-md-1" style="padding-top: 80px;height: 50px;">
      <!--
      <select class="list-group" style="height: 33px;" size="5" name="loai[]">
           <option value="0">Loại tìm kiếm</option>
           <option value="Thuoc">Thuốc</option>
           <option value="NhanVien">Nhân viên</option>
           <option value="NhaSanXuat">Nhà sản xuất</option>
           <option value="NhaCungCap">Nhà cung cấp</option>
       </select>-->
     </div>
    <div class="col-md-3" style="padding-top: 80px;">
    
        <div class="row">
            <form method="get" asp-action="Index">
                <div class="col-lg-8"><input type="search" placeholder="Nhập tên tìm kiếm ...." class="form-control" name="Empsearch" id="search" /></div>
                <div class="col-lg-4" style="height: 50px;"> <input formaction="" type="submit" onclick="searchthuoc()" id="btn_search" value="Search" class="btn btn-success" style="height: 34px;"></div>
            </form>
        </div>
     </div>

     <div class="col-md-2" style="padding-top: 90px;font-size: 15px;font-weight: bold;">
       <a href="dangnhap.php"><i class="fas fa-sign-out-alt"></i>  Đăng xuất   |</a>
        
      <a href="https://www.utc.edu.vn/"><i class="fas fa-phone-alt"></i>Liên hệ   </a> 
     </div>
 </div>
 <!--
<marquee behavior="alternate" id="marq" scrollamount="4" direction="left" loop="50" scrolldelay="0" onmouseover="this.stop()" onmouseout="this.start()">
<a href="Link"><img src="images/v01.png" title="" width="500" height="150" style="border-right: 1px #b3d9ff solid;"/> </a>
<a href="Link"><img src="images/v02.png" title="" width="500" height="150" style="border-right: 1px #b3d9ff solid;"/> </a>
<a href="Link"><img src="images/v03.png" title="" width="500" height="150" style="border-right: 1px #b3d9ff solid;"/> </a>
<a href="Link"><img src="images/v04.jpg" title="" width="500" height="150"/> </a>
</marquee>-->

<hr style="border: 1px #b3d9ff solid;">


 <div class="row" style="margin: 0px;padding: 0px;"> 

  <div class="col-md-2" style="margin: 0px;padding: 0px;">  
   <nav class="mainNav" style="margin: 0px;padding: 0px;"> 
    <ul> 
     <li class="selected" style="margin: 0px;padding: 0px;"><a href=""><i class="fas fa-user"></i>    Tài khoản</a> 
         <ul> 
             <li><a href="index.php?detail=thongtinnv"><i class="fas fa-plus"></i>  Thông tin tài khoản</a></li> 
             <li><a href="doimatkhau.php"><i class="fas fa-plus"></i>  Đổi mật khẩu</a></li> 
         </ul> 
     </li> 
     <li><a><i class="far fa-keyboard"></i>    Quản lý thuốc</a> 
           <ul> 
               <li><a href="them_thuoc.php"><i class="fas fa-plus"></i>  Thêm thuốc</a></li> 
               <li><a href="them_hoadonnhap.php"><i class="fas fa-plus"></i>  Nhập Thuốc</a> </li> 
               <li><a href=""><i class="fas fa-plus"></i>  Bán thuốc</a></li> 
               <li><a href=""><i class="fas fa-plus"></i>  Hủy thuốc</a></li> 
          </ul> 
     </li> 
     <li><a href="http://hocwebgiare.com/"><i class="fas fa-paperclip"></i>    Quản lý danh mục</a> 
          <ul> 
               <li><a href="index.php?detail=nhacungcap"><i class="fas fa-plus"></i>  Nhà cung cấp</a></li> 
               <li><a href="index.php?detail=benhnhan"><i class="fas fa-plus"></i>  Bệnh nhân</a></li> 
               <li><a href="index.php?detail=nhanvien"><i class="fas fa-plus"></i>  Nhân viên</a></li>  
               <li><a href="index.php?detail=nhomthuoc"><i class="fas fa-plus"></i>  Nhóm thuốc</a></li> 
               <li><a href="index.php?detail=donvithuoc"><i class="fas fa-plus"></i>  Đơn vị tính</a></li>
               <li><a href="index.php?detail=nhasanxuat"><i class="fas fa-plus"></i>  Nhà sản xuất</a></li> 
               <li><a href="index.php?detail=chucvu"><i class="fas fa-plus"></i>  Chức vụ</a></li> 
          </ul>  
      </li> 
      <li><a><i class="far fa-id-card"></i>    Thống kê</a> 
            <ul> 
                <li><a href="http://hocwebgiare.com/"><i class="fas fa-plus"></i>  Báo cáo hàng ngày</a></li> 
                <li><a href="http://hocwebgiare.com/"><i class="fas fa-plus"></i>  Thống kê thuốc</a></li> 
            </ul>
      </li> 
       </ul>
        </nav> 
  </div> 
  <div class="col-md-6" style="border-right: 1px solid blue;">  
      <?php
      if(isset($_GET["detail"])){
        if($_GET["detail"]=="thongtinnv"){
          require_once('thongtinnv.php');
        }elseif ($_GET["detail"]=="nhanvien") {
         require_once('ds_nhanvien.php');
        }elseif ($_GET["detail"]=="benhnhan") {
         require_once('ds_benhnhan.php');
        }elseif ($_GET["detail"]=="chitietnv") {
          require_once('chitiet_nv.php');
        }elseif ($_GET["detail"]=="nhacungcap") {
          require_once('ds_nhacungcap.php');
        }elseif ($_GET["detail"]=="nhomthuoc") {
          require_once('ds_nhomthuoc.php');
        }elseif ($_GET["detail"]=="donvithuoc") {
          require_once('ds_donvithuoc.php');
        }elseif ($_GET["detail"]=="nhasanxuat") {
          require_once('ds_nhasanxuat.php');
        }elseif ($_GET["detail"]=="chucvu") {
          require_once('ds_chucvu.php');
        }else{
          require_once('ctthuoc.php');
        }
        }elseif (isset($_GET["Empsearch"])){
          require_once('search_thuoc.php');
        }elseif(isset($_GET["ctnv"])){
           require_once('chitiet_nv.php');
        }
        else{
            require_once('ds_thuoc.php');
        }
      ?>
  </div>  
  <div class="col-md-4" >
          <?php
              if(empty($_SESSION['mabn'])){
          ?>

                 <form action="nhap_benhnhan.php" method="post" accept-charset="utf-8" style="padding-top: 150px;">
                 <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" formaction="nhap_benhnhan.php">Đăng ký thông tin mua thuốc </button>
                 </form>

          <?php
              }else{
                  require_once('dsmua.php');
              }
            ?>
  </div>
 </div>
            <div class="row text-center padding" style="padding-bottom: 0px;margin-top: 10px;">
                <div class="col-12 ">
                    <a href="" style="font-size: 30px;padding: 20px;"><i class="fab fa-twitter" style="color: #00aced;"></i></a>
                    <a href="" style="font-size: 30px;padding: 20px;"><i class="fab fa-facebook" style="color: #3b5998;"></i></a>
                    <a href="" style="font-size: 30px;padding: 20px;"><i class="fab fa-google-plus-g" style="color: #dd4b39;"></i></a>
                    <a href="https://www.instagram.com" style="font-size: 30px;padding: 20px;"><i class="fab fa-instagram" style="color: #517fa4;"></i></a>
                    <a href="https://www.youtube.com" style="font-size: 30px;padding: 20px;"><i class="fab fa-youtube" style="color: #bb0000;"></i></a>
                    <a href="https://www.facebook.com/home.php" style="font-size: 30px;padding: 20px;"><i class="far fa-id-badge"></i></a>
                </div>
            </div>
</div>
<div>
      <div class="wthree_footer_copy" style="height: 50px;padding-top: 10px;margin-top: 0px;">
                <marquee loop="50" scrollamount="6" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="2" style="background:orange">© 2020 | utc | Thiết kế bởi <a href="http://sis.utc.edu.vn">trong dac</a></marquee>
      </div>
</div> 

</body>
</html>