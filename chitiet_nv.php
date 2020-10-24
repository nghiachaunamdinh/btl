
     
     <div class="row">
    <?php
        require_once 'ketnoi_pdo.php';
         $result = db()->query("SELECT * FROM NhanVien where MaNV='".$_GET["ctnv"]."'");
         while($row = $result->fetch()){
    ?>
        <div class="col-md-3">
       
           <img src="images/<?php echo $row["HinhAnh"] ?>" alt="dsadas" style="height: 250px;width: 200px;"/>
        </div>
        <div class="col-md-9">
            <table class="table table-striped">
                <caption>Thông tin nhân viên : <?php echo $row["TenNV"] ?></caption>
                
                <tbody>
                    <tr>
                        <td>Tên nhân viên : </td>
                        <td><?php echo $row["TenNV"] ?></td>
                    </tr>
                    <tr>
                        <td>Chức Vụ    : </td>
                        <td><?php 
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM ChucVu where MaCV='".$row["MaCV"]."'");
                        while($rows = $nsx->fetch()){
                        echo $rows["TenCV"];
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Địa Chỉ : </td>
                        <td><?php echo $row["DiaChi"] ?></td>
                    </tr>
                    <tr>
                        <td>Số Điện Thoại : </td>
                        <td><?php echo $row["SDT"] ?></td>
                    </tr>
                   
                    <tr>
                        <td><a href="index.php?detail=nhanvien" class="btn btn-info">Quay lại</a></td>
                      
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
     }
    ?>
</div>