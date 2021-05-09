 

<!DOCTYPE HTML>
<html>
<head> 
    <title>Tạo hóa đơn nhập</title> 
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
            $t="";
            $nsx=date_create($_POST['nsx']);//ngày sản xuát
            $nsx=date_format($nsx,"Y/m/d");
            $hsd=date_create($_POST['hsd']);//hạn sử dụng
            $hsd=date_format($hsd,"Y/m/d");
            if($_POST['soluong']==""||$_POST['soluong']<1){
              $r="Số lượng phải lớn hon 0 và không được để trống .";
            }else{
              if(date("Y",strtotime($nsx))>date("Y",strtotime($hsd))){
                $r="Ngày sản xuất không được sau  hạn sử dụng";
              }elseif(date("Y",strtotime($nsx))<date("Y",strtotime($hsd))){
                try{
                  insertHDN($_POST['ncc'], $_SESSION["name"]);
                  date_default_timezone_set('UTC');
                  $date=date('Y/m/d H:i:s');
                  $max=selectmax("HoaDonNhap","MaHDN");
                  insertCTHDN($max,$_POST['thuoc'],$date,$_POST['gianhap'],$_POST['soluong'],$_POST['lothuoc'],$nsx,$hsd);
                  header("Location:index.php");
                  $t="Thêm hóa đơn nhập thành công";
                  }catch(PDOException $e){
                    $r="đăng ký không thành công";
                  }
              }else{
                if(date("m",strtotime($nsx))>date("m",strtotime($hsd))){
                  $r="Ngày sản xuất không được sau hạn sử dụng.Nhập lại!";
                }elseif(date("m",strtotime($nsx))<date("m",strtotime($hsd))){
                    try{
                    insertHDN($_POST['ncc'], $_SESSION["name"]);
                    date_default_timezone_set('UTC');
                    $date=date('Y/m/d H:i:s');
                    $max=selectmax("HoaDonNhap","MaHDN");
                    insertCTHDN($max,$_POST['thuoc'],$date,$_POST['gianhap'],$_POST['soluong'],$_POST['lothuoc'],$nsx,$hsd);
                    header("Location:index.php");
                    $t="Thêm hóa đơn nhập thành công";
                    }catch(PDOException $e){
                      $r="đăng ký không thành công";
                    }
                }else{
                  if(date("d",strtotime($nsx))>=date("d",strtotime($hsd))){
                    $r="Kiểm tra lại ngày sản xuất.Nhập lại!";
                  }else{
                    try{
                      insertHDN($_POST['ncc'], $_SESSION["name"]);
                      date_default_timezone_set('UTC');
                      $date=date('Y/m/d H:i:s');
                      $max=selectmax("HoaDonNhap","MaHDN");
                      insertCTHDN($max,$_POST['thuoc'],$date,$_POST['gianhap'],$_POST['soluong'],$_POST['lothuoc'],$nsx,$hsd);
                      header("Location:index.php");
                      $t="Thêm hóa đơn nhập thành công";
                      }catch(PDOException $e){
                        $r="đăng ký không thành công";
                      }
                  }
                }
              }
            }
          }else{
            $r="Nhập thông tin hóa đơn .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;"> 
            <form class="form-signin" method="POST" action="them_hoadonnhap.php">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h2 style="color: blue;font-weight: bold;" align="center">Thêm hóa đơn nhâp</h2>
                <p ></p>
                <br>
                Nhà cung cấp:
                <select class="list-group" style="height: 33px;" name="ncc">
                  <option value="0">Chọn nhà cung cấp: </option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhaCungCap ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaNCC'] ?>"><?php echo $row['TenNCC'] ?></option>
                  <?php
                        }
                         
                  ?> 
                </select>
                <br>
                Chọn  thuốc : 
                <select class="list-group" style="height: 33px;" name="thuoc">
                  <option value="0">Chọn thuốc:  </option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM Thuoc ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaThuoc'] ?>"><?php echo $row['TenThuoc'] ?></option>
                  <?php
                        }
                         
                  ?> 
                </select>
                <br>
                <input type="text"  class="form-control" placeholder="Giá nhập" name="gianhap" id="gianhap" required onchange="testnum();">
                <br>
                <input type="text"  class="form-control" placeholder="Số lượng" name="soluong" id="soluong" required onchange="testnum1();">
             
                <br>
                <input type="text"  class="form-control" placeholder="Lô thuốc"  name="lothuoc" required>
                <br>
                NSX : 
                <input type="date" required name="nsx" id='date' onchange="checkDate();">
                <br>
                <br>
                HSD : 
                <input type="date" required name="hsd" id='date2' onchange="checkDate2();">
                <br>
                <p style="color: red;"><?php echo $r; ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" onclick="thongbao();">Thêm hóa đơn nhâp</button>
                <br>
            </form><!-- /form -->
            <p></p>
          
            <a href="index.php" class="forgot-password">
                 Quay lại
            </a>
        </div>
    </div>
    <script type="text/javascript">
    	
    	function isNumber(n) {
	         return !isNaN(parseFloat(n)) && !isNaN(n - 0) 
	    }
	    //kiêm tra là số 
    	function testnum() {
    		var x= document.getElementById('gianhap').value;
    		if(!isNumber(x)){
    			document.getElementById('gianhap').value="";
    			alert ("Gía nhập phải nhập là số");
    		}
    	}
    	function testnum1() {
    		var x= document.getElementById('soluong').value;
    		if(!isNumber(x)){
    			document.getElementById('soluong').value="";
    			alert ("Số lượng phải nhập là số");
    		}
    	}
    	//kiểm tra giá trị date
    	function checkDate() {
    		var strDate=document.getElementById('date').value;
              var comp = strDate.split('-')
              var d = parseInt(comp[2], 10);
              var m = parseInt(comp[1], 10);
              var y = parseInt(comp[0], 10);
               var date = new Date(y,m-1,d);
             if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
                  
             }else{
             	document.getElementById('date').value="";
    			     alert ('Ngày không hợp lệ. VD : 18-07-1999');
             }
              
        }
        function checkDate2() {
    		var strDate=document.getElementById('date2').value;
              var comp = strDate.split('-')
              var d = parseInt(comp[2], 10);
              var m = parseInt(comp[1], 10);
              var y = parseInt(comp[0], 10);
               var date = new Date(y,m-1,d);
             if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
                  
             }else{
             	document.getElementById('date2').value="";
    			     alert ('Ngày không hợp lệ. VD : 18-07-1999');
             }
              
        }
        /*function thongbao() {
    		var x='<?php echo $t; ?>';
             if (x!="") {
                 alert(x);
             }else{
             	 alert('Không thành công');
             }
              
        }*/
    </script>
    
</body>
</html>