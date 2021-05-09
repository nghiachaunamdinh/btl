<div class="row" style="padding-right: 20px;"> 
    <h2 align="center" style="color:red;font-weight: bold;">Thống kê thuốc</h2>
    <table class="table table-hover" width="80%;" style="color: red; font-size: 20px;margin-left: 10px;margin-right: 10px;">
        <thead >
            <tr style="color: blue;">
                <th scope="col" style="color: blue;">STT</th>
                <th scope="col" style="color: blue;">Tên thuốc</th>
                <th scope="col" style="color: blue;">Nhà sản xuất</th>
                <th scope="col" style="color: blue;">Gía bán</th>
                <th scope="col" style="color: blue;">Số lượng còn</th>
            </tr>
        </thead>
        <tbody style="color: black;">
  
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

    $trang=!empty($_GET["trang"])?$_GET["trang"]:1;//vị trí trang hiện tại
    $trangcuoi=floor(count($arrayName2)/10)+1;//trang cuối
    if($trang==$trangcuoi){
        $sosp=count($arrayName2)%10; 
        $_GET["sothuoc"]=10;
    }else{
       $sosp=!empty($_GET["sothuoc"])?$_GET["sothuoc"]:10; 
    }
    
    
    $offset=($trang-1)*$sosp;//tính vị trí bắt đàu của trang
    $s=count($arrayName2);//tổng số sản phẩm
    $t=ceil($s/$sosp);// tính tổng số trang
    
    for($i=$offset+1;$i<= ($offset+$sosp);$i++){
    ?>

            <tr style="color: black;">
                <th scope="row" style="color: black;"><?php echo $i; ?></th>
                <td style="color: black;"><?php require_once 'ketnoi_pdo.php';
                $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$i."'");
                while($rows = $nsx->fetch()){
                       echo $rows["TenThuoc"];
                } 
                ?>         
                </td>
                <td style="color: black;">
                    <?php require_once 'ketnoi_pdo.php';
                    $nsx = db()->query("SELECT  * FROM Thuoc where MaThuoc='".$i."'");
                    while($rows = $nsx->fetch()){
                       $nsx2 = db()->query("SELECT * FROM NhaSanXuat where MaNSX='".$rows['MaNSX']."'");
                       while($rows2 = $nsx2->fetch()){
                          echo $rows2["TenNSX"];
                       }
                    } 
                    ?>
                </td>
                <td style="color: black;">
                    <?php require_once 'ketnoi_pdo.php';
                    $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$i."'");
                    while($rows = $nsx->fetch()){
                       echo $rows["GiaBan"];
                    } 
                    ?>
                </td>
          
                <td style="color: black;">
                     <?php echo $arrayName3[$i];?>
                </td>
            </tr>
        
<?php
}
?>
<style>
tr {
    color: black;
}
</style>
</tbody>
    </table>
</div>
<div align="center" style="font-size: 20px,font-weight: bold;">
    <?php 
    $sosp=10;
     if($trang==$trangcuoi){
        $t=ceil($s/$sosp);// tính tổng số trang
     }
    
    for($i=1;$i<=$t;$i++){
        if($trang!=$i){
    ?>
    <a class="page-item" href="?trang=<?php echo $i; ?>&sothuoc=<?php echo $sosp; ?>" style="font-size: 20px;font-weight: bold;">|<?php echo $i ?>      |   </a>
    <?php
    }else{
    ?>
        <b>|<?php echo $i ?>     | </b>
    <?php
    }
}
    ?>
</div>
