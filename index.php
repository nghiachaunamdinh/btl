<?php
    session_start(); 
    if(!isset($_SESSION["name"])){
        header("Location:dangnhap.php");
    }  
    if(isset($_POST['btnhuy'])){
    require_once 'ketnoi_pdo.php';

     $ss=countCTHDB($_SESSION['mahdb']); 
     if($ss<=0){
        UpdateTinhtrangCTHDB($_SESSION['mahdb']); 
        unset($_SESSION['mabn']);
        unset($_SESSION['mahdb']);
     }
    }
    if(isset($_POST['thanhtoan'])){
    require_once 'ketnoi_pdo.php';
        if(slthuoctrongdsmua($_SESSION['mahdb'])>0){
            //header("Location:xuat_excel.php?mahdb=".$_SESSION['mahdb']);
          unset($_SESSION['mabn']);
          unset($_SESSION['mahdb']);
        } 
    }
    
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
     <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
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
      <i class="fas fa-bars show_menu" style="font-size: 25px;" onclick="menu_show()"></i>
    </div>
    <div class="col-md-2" style="padding-top: 80px;">
    
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

     <div class="col-md-1" style="padding-top: 60px;height: 50px;">
      <a href="index.php?detail=thongtinnv">
     <img id="profile-img" class="profile-img-card" src="images/<?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhanVien Where MaNV='".$_SESSION["name"]."' ");
                        while($row = $nsx->fetch()){
                          echo $row['HinhAnh'];
                        }
                  ?>" style="width: 50px;height: 50px;" />
     </a>
     </div>
     
     <div class="col-md-1" style="padding-top: 80px;height: 50px;color: red; font-weight: bold; font-style: in">
      <?php
          require_once 'ketnoi_pdo.php';
          $nsx = db()->query("SELECT * FROM NhanVien Where MaNV='".$_SESSION["name"]."' ");
          while($row = $nsx->fetch()){
            echo $row['TenNV'];
          }
      ?>
    
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
<!--
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
           <ul> <li><a href="index.php"><i class="fas fa-plus"></i>Danh sách thuốc</a></li>
               <li><a href="them_thuoc.php"><i class="fas fa-plus"></i>  Thêm thuốc</a></li> 
               <li><a href="them_hoadonnhap.php"><i class="fas fa-plus"></i>  Nhập Thuốc</a> </li> 
               <li><a href="index.php?detail=dshdb"><i class="fas fa-plus"></i>  Bán thuốc</a></li> 
               <li><a href="index.php?detail=dshuy"><i class="fas fa-plus"></i>  Hủy thuốc</a></li> 
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
                <li><a href="index.php?detail=thongke"><i class="fas fa-plus"></i>  Thống kê thuốc</a></li> 
                <li><a href="xuat_excel_ngay.php?cv=<?php require_once'phanquyen.php'; echo ketqua($_SESSION['name']); ?>" onclick="thongke()"><i class="fas fa-plus" ></i>  Báo cáo theo ngày</a></li> 
                <script type="text/javascript">
                  function themnv()
                 {
                    
                   var x=<?php require_once'phanquyen.php';echo(ketqua($_SESSION['name'])); ?>;
                  if(x=="1"){
                      alert("Bạn đủ quyền thêm nhân viên");
                  }else{
                      alert("Bạn không phải là giám đốc");
                  }
                 }            
                  function thongke()
                 {
                    
                   var x=<?php require_once'phanquyen.php';echo(ketqua($_SESSION['name'])); ?>;
                  if(x=="1"){
                      alert("Xuất báo cáo thành công");
                  }else{
                      alert("Bạn không phải là giám đốc");
                  }
                 }                 
                </script>
            </ul> 
      </li> 
       </ul> 
    </nav> 
  </div> 
-->
  <div class="col-md-6" style="margin: 0px;padding: 0px;">  
      <?php
      if(isset($_GET["detail"])){
        if($_GET["detail"]=="thongtinnv"){
          require_once('thongtinnv.php');
        }elseif ($_GET["detail"]=="nhanvien") {
          require_once'phanquyen.php';
          if(ketqua($_SESSION['name'])==1){
            require_once('ds_nhanvien.php');
          }else{
          echo '<script language="javascript">'; 
           echo 'alert("Giam đốc mới được thêm nhân viên.")'; 
           echo '</script>'; 
           require_once('ds_thuoc.php');
          }

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
        }elseif ($_GET["detail"]=="dshuy") {
          require_once('ds_huy.php');
        }elseif ($_GET["detail"]=="dshdb") {
          require_once('ds_hdb.php');
        }elseif ($_GET["detail"]=="chucvu") {
          require_once('ds_chucvu.php');
        }elseif ($_GET["detail"]=="thongke") {
          require_once('thongkethuoc2.php');
        }else{
          require_once('ctthuoc.php');
        }
        }elseif (isset($_GET["Empsearch"])){
          require_once('search_thuoc.php');
        }elseif(isset($_GET["ctnv"])){
           require_once('chitiet_nv.php');
        }
        else{
          if(isset($_GET["trang"])){
            require_once('thongkethuoc2.php');
          }else{
            require_once('ds_thuoc.php');
          }
        }
      ?>
  </div>  
  <div class="col-md-6" style="height: 600px;border-left: 2px solid #99ccff; margin: 0px;padding: 0px;">
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
            <div class="row text-center padding" style="padding-bottom: 0px;margin-top: 10px; margin: 0px;padding: 0px;" >
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



<div id="nav_overlay" onclick="nav_overlay_check()"></div>


<nav class="nav" id="nav" style="margin: 0px;padding: 0px;"> 
    <ul>
      <li><i class="fas fa-times" style="font-size: 25px;color: black;padding-left: 150px" onclick="menu_dis()"></i></li>
     <li class="selected" style="margin: 0px;padding: 0px;"><a href=""><i class="fas fa-user"></i>Tài khoản</a> 
         <ul>
    
             <li><a href="index.php?detail=thongtinnv"><i class="fas fa-plus"></i>  Thông tin tài khoản</a></li> 
             <li><a href="doimatkhau.php"><i class="fas fa-plus"></i>  Đổi mật khẩu</a></li> 
         </ul> 
     </li> 
     <li><a><i class="far fa-keyboard"></i>    Quản lý thuốc</a> 
           <ul> <li><a href="index.php"><i class="fas fa-plus"></i>Danh sách thuốc</a></li>
               <li><a href="them_thuoc.php"><i class="fas fa-plus"></i>  Thêm thuốc</a></li> 
               <li><a href="them_hoadonnhap.php"><i class="fas fa-plus"></i>  Nhập Thuốc</a> </li> 
               <li><a href="index.php?detail=dshdb"><i class="fas fa-plus"></i>  Bán thuốc</a></li> 
               <li><a href="index.php?detail=dshuy"><i class="fas fa-plus"></i>  Hủy thuốc</a></li> 
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
                <li><a href="index.php?detail=thongke"><i class="fas fa-plus"></i>  Thống kê thuốc</a></li> 
                <li><a href="xuat_excel_ngay.php?cv=<?php require_once'phanquyen.php'; echo ketqua($_SESSION['name']); ?>" onclick="thongke()"><i class="fas fa-plus" ></i>  Báo cáo theo ngày</a></li> 
                <script type="text/javascript">
                  function menu_show(){
                    document.getElementById("nav_overlay").style.display="block";
                    document.getElementById("nav").style.transform="translateX(0%)";
                  }
                  function nav_overlay_check(){
                    document.getElementById("nav_overlay").style.display="none";
                    document.getElementById("nav").style.transform="translateX(-100%)";
                  }
                  function menu_dis(){
                    document.getElementById("nav_overlay").style.display="none";
                    document.getElementById("nav").style.transform="translateX(-100%)";
                  }
                  function themnv()
                 {
                    
                   var x=<?php require_once'phanquyen.php';echo(ketqua($_SESSION['name'])); ?>;
                  if(x=="1"){
                      alert("Bạn đủ quyền thêm nhân viên");
                  }else{
                      alert("Bạn không phải là giám đốc");
                  }
                 }            
                  function thongke()
                 {
                    
                   var x=<?php require_once'phanquyen.php';echo(ketqua($_SESSION['name'])); ?>;
                  if(x=="1"){
                      alert("Xuất báo cáo thành công");
                  }else{
                      alert("Bạn không phải là giám đốc");
                  }
                 }                 
                </script>
            </ul> 
      </li> 
       </ul> 
</nav> 
    <style type="text/css">
        #nav_overlay{
          display: none;
          position: fixed;
          top:0px;
          bottom: 0px;
          right: 0px;
          left: 0px;
          background-color: rgb(153, 204, 255,0.3);
        }
        .nav{
          transform: translateX(-100%);
          position: fixed;
          top: 0px;
          bottom: 0px;
          left:0px;
          background-color: #fff;
          width: 320px;
          max-width: 100%;
        }
        .nav {  
width: auto;    
margin:0px auto;    
color: #FFF;    
background-color: #F60;
}
.table-dark {
  color: #fff;
  background-color: #663300;
}
.table-dark th,
.table-dark td,
.table-dark thead th {
 border-color: #FF860D;
}
.nav ul {   
margin: 0;  
padding: 0; 
list-style: none;   
border-bottom-width: 1px;   
border-bottom-style: solid; 
border-bottom-color: #999999;
}
.nav ul li {    
border-top-width: 1px;  
border-top-style: solid;    
border-top-color: #999999;
}
 
.nav ul li a {  
color: #FFF;    
display: block; 
font-size: 14px;    
line-height: normal;    
padding: 12px 20px; 
text-decoration: none;  
font-family:Arial, Helvetica, sans-serif;
}
.nav ul li a:hover {    
font-family:Arial, Helvetica, sans-serif;   
text-decoration: none;  
background-color: #F00; 
color: #FFF;
}
 
.nav ul ul {    
border-bottom: none
}
 
.nav ul ul li { 
background-color: #F5F5F5;  
border-top-width: 1px;  
border-top-style: solid;    
border-top-color: #E2E2E2;
}
.nav ul ul li a {   
color: #000000; 
display: block; 
font-size: 1em; 
line-height: normal;    
padding: 0.5em 1em 0.5em 2.5em;
}
.nav ul ul li a:hover { 
background-color: #E9E9E9;  
color: #FF0000;
}
.nav ul ul ul { 
border-top: 1px solid #46CFB0;
}
 
.nav ul ul ul li {  
border: none;
}
.nav ul ul ul li a {    
padding-left: 3.5em;    
padding-top: 0.25em;    
padding-bottom: 0.25em;
}
 
ul li.has-subnav .accordion-btn {   
color: #fff;    
font-size: 16px;    
background-color: #C0C0C0;  
background-position: 0;
} 
 
@media screen and (max-width: 1024px) { 
.nav {width: 100%;
}
} 
 
@media screen and (max-width: 700px) { 
.nav {
width: 100%;
}
}
        
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</body>
</html>