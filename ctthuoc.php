
    <div class="row">
    <?php
    	$conn = mysqli_connect("localhost", "root", "", "qlst");
        mysqli_set_charset($conn, "utf8");
        $result = mysqli_query($conn, "SELECT * FROM Thuoc where MaThuoc='".$_GET["detail"]."'");
        while($row = mysqli_fetch_assoc($result)){
    ?>
        <div class="col-md-3">
       
           <img src="images/<?php echo $row["HinhAnh"] ?>" alt="dsadas" style="height: 250px;width: 200px;"/>
        </div>
        <div class="col-md-9">
            <table class="table table-striped">
                <caption>Thông tin thuốc : <?php echo $row["TenThuoc"] ?></caption>
                <thead></thead>
                <tbody>
                    <tr>
                        <td>Lô thuốc : </td>
                        <td><?php 
                        require_once 'ketnoi_pdo.php';
                        $nsx = db()->query("SELECT * FROM NhaSanXuat where MaNSX='".$row["MaNSX"]."'");
                        while($rows = $nsx->fetch()){
                        echo $rows["TenNSX"];
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Gía bán : </td>
                        <td><?php echo $row["GiaBan"] ?></td>
                    </tr>
                    <tr>
                        <td>Ngày hết hạn : </td>
                        <td><?php echo $row["NgayHetHan"] ?></td>
                    </tr>
                    <tr>
                        <td>Ghi chú : </td>
                        <td><?php echo $row["GhiChu"] ?></td>
                    </tr>
                    <tr>
                        <td><a href="index.php" class="btn btn-info">Quay lại</a></td>
                        <td><a href="" class="btn btn-info">Thêm</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
     }
    ?>
</div>
