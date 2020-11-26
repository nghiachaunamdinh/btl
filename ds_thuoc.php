
<div class="row">  
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
    require ("test_data.php"); 
    //$result = ketnoi()->query("SELECT * FROM Thuoc");
    $sosp=!empty($_GET["sosp"])?$_GET["sosp"]:6;
    $trang=!empty($_GET["name"])?$_GET["name"]:1; 
    $offset=($trang-1)*$sosp;
    $conn = mysqli_connect("localhost", "root", "", "qlst");
     mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, "SELECT * FROM Thuoc limit ".$sosp." offset ".$offset); 
    $r = mysqli_query($conn, "SELECT * FROM Thuoc");
    $s=$r->num_rows;
    $t=ceil($s/$sosp);//làm tròn tổng số sản phẩm 
    $dem=0;
    while($row = mysqli_fetch_assoc($result)){ 
        $dem=$dem+1;
    ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="my-list">
            <img src="images/<?php echo $row['HinhAnh'] ?>" alt="dsadas" style="height: 200px;width: 200px;"/>
            <h3><?php echo $row['TenThuoc'] ?></h3>
            <span>Gía: <?php echo $row['GiaBan'] ?></span>
            <div class="detail">
            <p><?php echo $row['GhiChu'] ?></p>
            <img src="images/<?php echo $row['HinhAnh'] ?>" alt="dsadas" style="height: 200px;width: 200px;"/>

            
                <a class="btn btn-info" onclick="themthuoc<?php echo $dem; ?>()" href="data_class.php?mathuoc=<?php echo $row['MaThuoc']; ?>" name="them<?php echo $row['MaThuoc']; ?>" >Thêm</a>
                <script type="text/javascript">
                 function themthuoc<?php echo $dem; ?>() {
                    var x='';
                    x='<?php echo empty($_SESSION['mahdb']); ?>';

                    if(x=='1'){

                        alert("Hãy điền thông tin bệnh nhân trước khi thêm thuốc .");
                    }else{
                        if( '<?php echo slnhap($row['MaThuoc']);?>' <= '<?php echo slban($row['MaThuoc']); ?>' ){
                             alert("Thuốc đã hết");
                        }
                    }
                }   
                </script>
                <a href="index.php?detail=<?php echo $row['MaThuoc']; ?>" class="btn btn-info"style="padding-top: 15px;">Chi tiết</a>
           
        
            </div>
        </div>
        </div>
        <?php
        }
    ?>
    </div>
    
<div class="clearfix"> </div>
<div align="center" style="font-size: 20px,font-weight: bold;">
    <?php 
    for($i=1;$i<=$t;$i++){
        if($trang!=$i){
    ?>
    <a class="page-item" href="?name=<?php echo $i ?>&sosp=<?php echo $sosp ?>" style="font-size: 20px;font-weight: bold;"><?php echo $i ?>      |   </a>
    <?php
    }else{
        ?>
        <b><?php echo $i ?>     | </b>
    <?php
        }}
    ?>
</div>
