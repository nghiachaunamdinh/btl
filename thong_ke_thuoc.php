<?php 
  $arrayName = array();
  require_once('ketnoi_pdo.php');
  $conn = mysqli_connect("localhost", "root", "", "qlst"); 
     mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, "SELECT * FROM Thuoc");
    while($row = mysqli_fetch_assoc($result)){
    	try {
    		 $arrayName[$row['MaThuoc']]=slnhap($row['MaThuoc']);
    	} catch (Exception $e) {
    		$arrayName[$row['MaThuoc']]='0';
    	}
      
    }
    $arrayName2 = array();
   
    $result2 = mysqli_query($conn, "SELECT * FROM Thuoc");
    while($row = mysqli_fetch_assoc($result2)){
    	try {
    		 $arrayName2[$row['MaThuoc']]=slban($row['MaThuoc']);
    	} catch (Exception $e) {
    		$arrayName2[$row['MaThuoc']]='0';
    	}
      
    }
    $arrayName3 = array();
    for($i=1;$i<=count($arrayName2);$i++){
    	$arrayName3[$i]=(int)$arrayName[$i]-(int)$arrayName2[$i];
    }

?>
<h2 align="center" style="color:red;font-weight: bold;">Thống kê thuốc</h2>
        <table class="table table-hover" width="300px;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên thuốc</th>
      <th scope="col">Nhà sản xuất</th>
      <th scope="col">Gía bán</th>
      <th scope="col">Số lượng tồn</th>
    </tr>
  </thead>
  <tbody>
   <?php
     for($i=1;$i<=count($arrayName2);$i++){
    ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php require_once 'ketnoi_pdo.php';
                $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$i."'");
                while($rows = $nsx->fetch()){
                       echo $rows["TenThuoc"];
                } 
           ?>
                        	
      </td>
      <td><?php require_once 'ketnoi_pdo.php';
                $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$i."'");
                while($rows = $nsx->fetch()){
                       $nsx2 = db()->query("SELECT * FROM NhanSanXuat where MaNSX='".$rows['MaNSX']."'");
                       while($rows2 = $nsx2->fetch()){
                       	echo $rows2["TenNSX"];
                       }
                } 
           ?>
      </td>
      <td>
      	<?php require_once 'ketnoi_pdo.php';
                $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$i."'");
                while($rows = $nsx->fetch()){
                       echo $rows["GiaBan"];
                } 
           ?>
      </td>
          
      <td>
           <?php echo $arrayName3[$i];?>
      </td>
    </tr>
    <?php
    }
    ?>
   
  </tbody>
</table>