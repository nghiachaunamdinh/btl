<?php 
    require_once 'ketnoi_pdo.php';
    $result = db()->query("SELECT * FROM nhacungcap");
?>
        <h2 align="center" style="color:red;font-weight: bold;">Danh sách nhà cung cấp</h2>
        <table class="table table-hover" width="300px;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên nhà cung cấp</th>
      <th scope="col">Địa chỉ</th>
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
      <td><?php echo $row['TenNCC']; ?></td>
      <td><?php echo $row['DiaChi'];?></td>
       <td><?php echo$row['SDT'];?></td>
      <td>
           <a href="sua_ncc.php?mancc=<?php echo $row['MaNCC']; ?>"> <i class="fas fa-toolbox"></i>  Sửa</a>
           <button type=""><a href="xoa_ncc.php?mancc=<?php echo $row['MaNCC']; ?>" > <i class="far fa-trash-alt" >  Xóa</i></a></button>
      </td>
      </td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="3"><button type="button"><a href="index.php">Quay Lại</a></button></td>
      <td colspan="2"><a href="them_ncc.php"><i class="fas fa-plus-square"></i>    Thêm nhà cung cấp</a></td>
    </tr>
  </tbody>
</table>
