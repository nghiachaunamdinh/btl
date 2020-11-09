 
<!DOCTYPE HTML>
<html>
<head>
    <title>Thêm thông tin thuốc</title>
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
                                    require_once ('ketnoi_pdo.php');
                                       insertThuoc($_POST['cv'],$_POST['dvt'],$_POST['nt'],$_POST['giaban'],$_POST['tenthuoc'],$_POST['ghichu'],$_POST['anh']);
                                       header("Location:index.php");
                                  }catch(PDOException $e){
                                       $r="Thêm thàn công";
                                  }
          }else{
                $r="Nhập thông tin thuốc .";
          }
         ?>
        <div class="card card-container" style="margin-top: 0px;padding-top: 0px;">
            <form class="form-signin" method="POST" action="them_thuoc.php">
              <img id="profile-img" class="profile-img-card" src="images/logo_utc.jpg" />
                <h3 style="color: blue;font-weight: bold;" align="center">Thêm thông tin thuốc mới</h3>
                <input type="text"  class="form-control" placeholder="Tên thuốc" name="tenthuoc" required autofocus>
                <br>
                <input type="text"  class="form-control" placeholder="Giá bán"  name="giaban" required onchange="testnum();" id="gia">
                <br>
                <input type="text"  class="form-control" placeholder="Ghi chú"  name="ghichu" required>
                <br>
                 Nhà sản xuất :
                <select class="list-group" style="height: 33px;" name="cv">
                  <option value="0">Chọn nhà sản xuất</option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhaSanXuat ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaNSX'] ?>"><?php echo $row['TenNSX'] ?></option>
                  <?php
                        }
                         
                  ?> 
                </select>
                <br>
                Đơn vị tính :
                <select class="list-group" style="height: 33px;" name="dvt">
                  <option value="0">Chọn đơn vị tính</option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM DonViTinh ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaDVT'] ?>"><?php echo $row['TenDVT'] ?></option>
                  <?php
                        }
                         
                  ?> 
                </select>
                <br>
                Nhóm thuốc :
                <select class="list-group" style="height: 33px;" name="nt">
                  <option value="0">Chọn nhóm thuốc</option>
                  <?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhomThuoc ");
                        while($row = $nsx->fetch()){
                  ?>
                        <option value="<?php echo $row['MaNT'] ?>"><?php echo $row['TenNT'] ?></option>
                  <?php
                        }
                         
                  ?>  
                </select>
  
                <br>
                <br>
                
               <label for="myfile">Chọn hình ảnh:</label>
               <input type="file" id="myfile" name="anh">
               
                <br>
                <p style="color: red;"><?php echo $r ?></p>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="them" >Thêm thông tin thuốc</button>
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
    	function testnum() {
    		var x= document.getElementById('gia').value;
    		if(!isNumber(x)){
    			document.getElementById('gia').value="";
    			alert ("Gía tiền phải nhập là số");
    		}
    	}
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
    </script>
</body>
</html>