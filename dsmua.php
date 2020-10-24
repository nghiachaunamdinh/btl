
<div class="row">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên thuốc</th>
      <th scope="col">Đơn vị tính</th>
      <th scope="col">Số lượng</th> 
      <th scope="col">Gía</th>
      <th scope="col">Thành tiền</th>
     <th scope="col"></th>
    </tr>
  </thead>
  <tbody>  
    <?php 
    require_once 'ketnoi_pdo.php';
    $result = db()->query("SELECT * FROM ChiTietHoaDonBan");
     $stt=0;
     while($row = $result->fetch()) {
      $stt++;
    ?>
    <tr>
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
      <td><input type="text" onchange="thanhtien();" id="soluong<?php echo $row['MaThuoc'];?>" value="<?php echo $row['SoLuong']; ?>" style="width: 30px;"></td>
     
      <td><input type="text" id="gia<?php echo $row['MaThuoc'];?>" style="width: 80px;" onclick="gia()" disabled value="<?php 
            require_once 'ketnoi_pdo.php';
            $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$row["MaThuoc"]."'");
            while($rows = $nsx->fetch()){
              echo $rows["GiaBan"];
            }
        ?> ">
        
      </td>
      <td><input type="text" style="width: 60px" id="thanhtien<?php echo $row['MaThuoc'];?>" onclick="thanhtien()"></td>
      <script type="text/javascript">
        
       function soluong(){
          var x = prompt('Nhập số lượng ');
          if(x!=""&&x!=NULL){
             document.getElementById('soluong<?php echo $row['MaThuoc'];?>').value=x;
             document.getElementById('thanhtien<?php echo $row['MaThuoc'];?>').value=Number(x)*Number(document.getElementById('gia<?php echo $row['MaThuoc'];?>').value);
          }
        }

        function thanhtien() {
            var x=Number(document.getElementById('soluong<?php echo $row['MaThuoc'];?>').value)*Number(document.getElementById('gia<?php echo $row['MaThuoc'];?>').value);
            document.getElementById('thanhtien<?php echo $row['MaThuoc'];?>').value=x;
        
        }
         function gia() {
            var x=document.getElementById('gia<?php echo $row['MaThuoc'];?>').value;
      
        }
</script>
      <td><input type="checkbox" style="width: 10px" value="<?php echo $i ?>" id="<?php echo $i ?>" value="yes"></td>
    </tr>
    <?php
       }
    ?>
    <tr>
      
      <td colspan="5">Tổng : </td>
      <td></td>
    </tr>
     <tr>
      <td colspan="3"><button type="buton" class="btn btn-primary" style="width: 100px;height: 30px;" id="thanhtoan">Thanh Toán </button> </td>

      <td colspan="3"><button type="button" class="btn btn-success" style="width: 100px;height: 30px;" onclick="xoa();">Xóa</button> </td>
    </tr>
  </tbody>

</table>


</div>
