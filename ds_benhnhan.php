<?php 
    require_once 'ketnoi_pdo.php';
    $result = db()->query("SELECT * FROM BenhNhan");
?>
<h2 align="center" style="color:red;font-weight: bold;">Danh sách bệnh nhân</h2>
        <table class="table table-hover" width="300px;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên bệnh nhân</th>
      <th scope="col">SĐT</th>
      <th scope="col">Thay đổi</th>
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
      <td><?php echo $row['TenBN']; ?></td>
      <td><?php echo $row['SDT'];?></td>
      <td>
           <button type="button" class="btn-default"><a href="sua_bn.php?mabn=<?php echo $row['MaBN']; ?>"><i class="fas fa-toolbox"></i>  Sửa</a></button>
      </td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td><button type="button"><a href="index.php">Quay Lại</a></button></td>
    </tr>
  </tbody>
</table>
