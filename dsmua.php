
<?php 
   require_once 'PHPExcel-1.8\PHPExcel-1.8\Classes\PHPExcel.php';
   if(isset($_POST['btnluu'])){
    require_once 'ketnoi_pdo.php';
     $ss=countCTHDB($_SESSION['mahdb']);
     for($j=1;$j<=$ss;$j++){
          UpdateCTHDB($_SESSION["mathuoc".$j],$_SESSION['mahdb'],$_POST['soluong'.$j]);
     }
   } 
   
?>

<div class="row">
  <h2 align="center" style="color: red;font-weight: bold;">Chi tiết hóa đơn bán</h2>
 
    <table class="table" style="color: #6666ff;" id="dsmuatable">
  <thead class="thead-dark">
    <tr style="color: #6666ff;">
      <th scope="col" style="color: #6666ff;">STT</th>
      <th scope="col" style="color: #6666ff;">Tên thuốc</th>
      <th scope="col" style="color: #6666ff;">Đơn vị</th>
      <th scope="col" style="color: #6666ff;">Số lượng</th> 
      <th scope="col" style="color: #6666ff;">Gía</th>
     <th scope="col" style="color: #6666ff;"></th>
    </tr>
  </thead>
  <tbody>  
    <form action="index.php" method="Post" accept-charset="utf-8" onload="load()" id="dsmua">
    
 
    <?php 
    require_once 'ketnoi_pdo.php';
    $result = db()->query("SELECT * FROM ChiTietHoaDonBan WHERE MaHDB='".$_SESSION['mahdb']."'");
     $stt=0;
     while($row = $result->fetch()) {
      $stt++;
    ?>
    <tr>
      <?php 
      $k="mathuoc".$stt;
      $_SESSION[$k]=$row["MaThuoc"];
      ?>
      <th scope="row"><?php echo $stt;?></th> 
      <td>
        <?php 
            require_once 'ketnoi_pdo.php';
            $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$row["MaThuoc"]."'");
            while($rows = $nsx->fetch()){
              echo $rows["TenThuoc"];
            }
        ?>
      </td>
      <td>
          <?php 
            require_once 'ketnoi_pdo.php';
            $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$row["MaThuoc"]."'");
            while($rows = $nsx->fetch()){
              $dvt = db()->query("SELECT * FROM DonViTinh where MaDVT='".$rows["MaDVT"]."'");
              while($t = $dvt->fetch()){
                   echo $t["TenDVT"];
              }
              
            }
          ?>
            
      </td>
      <td><input type="text" id="soluong<?php echo $stt;?>" value="<?php echo $row['SoLuong']; ?>" style="width: 30px;" name="soluong<?php echo $stt; ?>" disabled>
      </td>
     
      <td><input type="text"  style="width: 50px;" onclick="gia()" disabled value="<?php 
            require_once 'ketnoi_pdo.php';
            $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$row["MaThuoc"]."'");
            while($rows = $nsx->fetch()){
              echo number_format($rows["GiaBan"]); 
            }
        ?> ">
        
      </td>
       
      <td>
        <a  style="color: #d9b3ff;" href="xoa_thuoc.php?mathuoc=<?php echo $row['MaThuoc']; ?>"><i id="xoa" class="far fa-trash-alt xoathuoc" style="font-weight: bold;"></i></a>
       
      </td>
    </tr>
    <?php
       }
    ?>
    <tr>
      
      <td colspan="3">Tổng : </td>
      <td style="color: red;font-weight: bold; font-size: 20px;"><?php echo number_format(sumCTHDB($_SESSION['mahdb'])); ?></td>
      <td style="font-weight: bold; font-size: 20px;">Đồng</td>
      <td></td>
    </tr>
     <tr>
      <script type="text/javascript">
        function thanhtoan(){
           var x=<?php echo slthuoctrongdsmua($_SESSION['mahdb']);?>;
           if(x=="0"){
             var x  require_once 'ketnoi_pdo.php';
            alert("Hãy thêm sản phẩm để thanh toán");
           }else{
              alert("Thanh toán thành công");
           }
        }
        
      </script>
      <td colspan="2"><button type="submit" class="btn btn-primary" style="height: 30px; width: 90px;" id="thanhtoan" name="thanhtoan" onclick="var x=<?php echo slthuoctrongdsmua($_SESSION['mahdb']);?>;if(x=='0'){alert('Không có sản phẩm nào để thanh toán');}else alert('Thanh toán thành công'); ">Thanh Toán </button> </td>
      <td><button type="button" class="btn btn-success" style="height: 30px;width: 50px; background-color: #ff4d4d;" id="sua"  name="sua" onclick="suads()">Sửa</button> </td>
      
      <td><button type="submit" class="btn btn-success" style="height: 30px;width: 50px; background-color: green;" id="luu" onclick=";" name="btnluu" disabled>Lưu</button> </td>
      <td colspan="2"><a href=""><button type="submit" class="btn btn-success" style="height: 30px;width: 90px; background-color: #ff4d4d;" id="xoa" onclick="huy();" name="btnhuy">Hủy đơn</button></a> </td>
      
    </tr>
       </form>
  </tbody>
</table>

<style type="text/css">
          .xoathuoc:hover{
                color: red;
                font-size: 19px;
          }
          .suathuoc:hover{
                color: green;
                font-size: 19px;
          }
          .luuthuoc:hover{
               color: blue;
               font-size: 19px; 
          } 

</style>
</table>


</div>
<script type="text/javascript">
        function suads() {
           var x=<?php echo slthuoctrongdsmua($_SESSION['mahdb']);?>;
           if(x==0){
              alert("Hãy thêm sản phẩm");
           }else{
              var sum=<?php echo $stt;?>;
              for(var i=1;i<=sum;i++){
              document.getElementById('soluong'+i).disabled=false;
              }
              if(document.getElementById('luu').disabled==true){
                document.getElementById('luu').disabled=false;
              }
           }
           
        }
        function load() {
           var sum=<?php echo $stt;?>; 
           for(var i=1;i<=sum;i++){
               document.getElementById('soluong'+i).disabled=true;
           }
        }
        function huy() {
          var sum=<?php  require_once 'ketnoi_pdo.php'; echo countCTHDB($_SESSION['mahdb']); ?>;
          if(sum >0){
            alert("Hãy xóa tất cả sản phẩm trong danh sách mua. ");
          }
        }
       
</script>
