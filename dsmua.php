
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
  <hr align="center" style="color: red;font-weight: bold; background-color: red;">
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
     
      <td><input type="text"  style="width: 80px;" onclick="gia()" disabled value="<?php 
            require_once 'ketnoi_pdo.php';
            $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$row["MaThuoc"]."'");
            while($rows = $nsx->fetch()){
              echo number_format($rows["GiaBan"]);
            }
        ?> ">
        
      </td>
       
      <td>
        <a  style="color: #d9b3ff;" href="xoa_thuoc.php?mathuoc=<?php echo $row['MaThuoc']; ?>"><i id="xoa" class="far fa-trash-alt xoathuoc" style="font-weight: bold;"></i></a>
        <a  style="color: #d9b3ff;"><i class="fas fa-toolbox suathuoc" style="font-weight: bold;" id="sua"></i></a>
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
      
      <td colspan="2"><button type="button" class="btn btn-primary" style="height: 30px;" id="thanhtoan" name="thanhtoan" onclick="xuatExcel('dsmuatable','','');" >Thanh Toán </button> </td>
      <td><button type="button" class="btn btn-success" style="height: 30px;width: 50px; background-color: #ff4d4d;" id="sua"  name="sua" onclick="suads()">Sửa</button> </td>
      
      <td><button type="submit" class="btn btn-success" style="height: 30px;width: 50px; background-color: green;" id="luu" onclick=";" name="btnluu">Lưu</button> </td>
      <td colspan="2"><a href="index.php?huy=t"><button type="button" class="btn btn-success" style="height: 30px;width: 100px; background-color: #ff4d4d;" id="xoa" onclick="huy();" name="btnhuy">Hủy đơn</button></a> </td>
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
           var sum='<?php echo $stt;?>';
           for(var i=1;i<=sum;i++){
               document.getElementById('soluong'+i).disabled=false;
           }
        }
        function load() {
           var sum='<?php echo $stt;?>';
           for(var i=1;i<=sum;i++){
               document.getElementById('soluong'+i).disabled=true;
           }
        }
        function huy() {
          var sum='<?php  require_once 'ketnoi_pdo.php'; echo countCTHDB($_SESSION['mahdb']); ?>';
          if(sum >0){
            alert("Hãy xóa tất cả sản phẩm trong danh sách mua. ");
          }
        }

        function xuatExcel(tablename,headercolor,filename) {
           alert("Bạn phải cung cấp tên bảng");
           if(tablename.trim()===""){
            alert("Bạn phải cung cấp tên bảng");
            return;
           }
           if(headercolor.trim()===""){
             headercolor="#d5ff80";
           }
           if(filename.trim()===""){
            filename="filexuat";
           }
           var export_data="";
           var arrtable=tablename.split("|");
           if(arrtable.length>0){
            //duyệt tùng bảng
            for(var i=0;i<arrtable.length;i++){
               export_data+="<table border='2px'><tr bgcolor='"+headercolor+"'>";
               var objecttable=document.getElementById(arrtable[i]);//lấy id bảng thứ i
               if(objecttable===undefined){
                alert("Không tìm thấy bảng");
                return;
               }
               for(var j=0;j<objecttable.rows.length;j++){
                export_data+=objecttable.rows[j].innerHTML+"</tr>";
               }
               export_data+="</table>";
            }
            //kiểm tra xem trình duyệt có phải là IE ko
            if(window.vavigator.userAgent.indexOf("MSIE")>0||!!window.navigator.userAgent.match(/Trient.*rv\:11\./)){
              exportIF.document.open("txt/html","replace");
              exportIF.document.write(export_data);
              exportIF.document.close();
              exportIF.focus();
              sa=exportIF.document.execCommand("SaveAs",true,filename+".xsl");
            }else{
              sa=window.open("data:application/vnd.ms-excel,"+encodeURIComponent(export_data))
            }
           }
        }
      </script>
