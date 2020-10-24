 <?php 
    require_once 'ketnoi_pdo.php';
    $result = db()->query("SELECT * FROM chucvu");
?>
        <h2 align="center" style="color:red;font-weight: bold;">Danh sách chức vụ</h2>
        <table class="table table-hover" width="300px;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên chức vụ</th>
      <th scope="col">Ghi chú</th>
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
      <td><?php echo $row['TenCV']; ?></td>
      <td><?php echo $row['GhiChu'];?></td>
      <td>
           <a href="sua_cv.php?macv=<?php echo $row['MaCV']; ?>"> <i class="fas fa-toolbox"></i>  Sửa</a>
           <button type=""><a href="xoa_cv.php?macv=<?php echo $row['MaCV']; ?>" > <i class="far fa-trash-alt" >  Xóa</i></a></button>
      </td>
      </td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="3"><button type="button"><a href="index.php">Quay Lại</a></button></td>
      <td colspan="2"><a href="them_cv.php"><i class="fas fa-plus-square"></i>    Thêm chức vụ</a></td>
    </tr>
  </tbody>
</table>
