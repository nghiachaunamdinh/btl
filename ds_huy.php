<?php 
    require_once 'ketnoi_pdo.php';
    $result = db()->query("SELECT * FROM HoaDonBan where TinhTrang='huy'");
?>
        <h2 align="center" style="color:red;font-weight: bold;">Danh sách hóa đơn hủy</h2> 
        <table class="table table-hover" width="300px;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Mã hóa đơn bán</th>
      <th scope="col">Tên nhân viên</th>
      <th scope="col">Tên bệnh nhân</th>
      <th scope="col">Tình trạng</th>
    </tr>
  </thead>
  <tbody>
   <?php
     $s=0;
     while($row = $result->fetch()) {
      $s++;
    ?>
    <tr>
      <th scope="row"><?php echo $s; ?></th>
      <td>
        <?php echo $row['MaHDB']; ?>
      </td>
      <td><?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhanVien where MaNV='".$row["MaNV"]."'");
                         while($rows = $nsx->fetch()){
                        echo $rows["TenNV"];
                        }
          ?>
      </td>
      <td><?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM BenhNhan where MaBN='".$row["MaBN"]."'");
                         while($rows = $nsx->fetch()){
                        echo $rows["TenBN"];
                        }
          ?>
      </td>
      <td>
           <?php echo $row['TinhTrang']; ?>
      </td>
      </td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="3"><button type="button"><a href="index.php">Quay Lại</a></button></td>
    </tr>
  </tbody>
</table>