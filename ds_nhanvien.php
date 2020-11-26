<?php 
    require_once 'ketnoi_pdo.php'; 
    $result = db()->query("SELECT * FROM NhanVien");
?>
<h2 align="center" style="color:red;font-weight: bold;">Danh sách nhân viên</h2>
        <table class="table table-hover" width="300px;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên nhân viên</th>
      <th scope="col">Chức vụ</th>
      <th scope="col">Email</th>
      <th scope="col">Số CMT</th>
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
      <td><?php echo $row['TenNV']; ?></td>
      <td><?php
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM ChucVu where MaCV='".$row["MaCV"]."'");
                         while($rows = $nsx->fetch()){
                        echo $rows["TenCV"];
                        }
      ?>
      </td>
      <td><?php echo $row['Email'];?></td>
       <td><?php echo$row['SoCMT'];?></td>
      <td>
           <a href="sua_nv.php?manv=<?php echo $row['MaNV']; ?>"><i class="fas fa-toolbox"></i>  Sửa</a>
           <button type=""><a href="xoa_nv.php?manv=<?php echo $row['MaNV']; ?>" > <i class="far fa-trash-alt" >  Xóa</i></a></button>
           <a href="index.php?ctnv=<?php echo $row['MaNV']; ?>" onclick=""><i class="fas fa-info-circle">   Chi tiết</i></a>
      </td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="4"></td>
      <td colspan="2"><a href="them_nv.php"><i class="fas fa-plus-square"></i>    Thêm nhân viên</a></td>
    
    </tr>
  </tbody>
</table>
