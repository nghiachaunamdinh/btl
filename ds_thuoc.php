
<div class="row">
    <?php
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
    $t=ceil($s/$sosp);
    while($row = mysqli_fetch_assoc($result)){
    ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="my-list">
            <img src="images/<?php echo $row['HinhAnh'] ?>" alt="dsadas" style="height: 200px;width: 200px;"/>
            <h3><?php echo $row['TenThuoc'] ?></h3>
            <span>Gía: <?php echo $row['GiaBan'] ?></span>
            <div class="detail">
            <p><?php echo $row['GhiChu'] ?></p>
            <img src="images/<?php echo $row['HinhAnh'] ?>" alt="dsadas" style="height: 200px;width: 200px;"/>

            <form action="data_class.php?mathuoc=<?php echo $row['MaThuoc']; ?>" method="POST">
                <button type="submit" class="btn btn-info" onclick="themthuoc()" formaction="data_class.php?mathuoc=<?php echo $row['MaThuoc']; ?>" name="them<?php echo $row['MaThuoc']; ?>" >Thêm</button>
                <script type="text/javascript">
                 function themthuoc() {
                    var x="";
                    x='<?php echo empty($_SESSION['mahdb']); ?>';
                    if(x=='1'){
                        alert("Bạn hãy điền thông tin bệnh nhân trước khi thêm .");
                    }
                }   
                    
                </script>
                <a href="index.php?detail=<?php echo $row['MaThuoc']; ?>" class="btn btn-info"style="padding-top: 15px;">Chi tiết</a>
            </form>
        
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
