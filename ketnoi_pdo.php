<?php

//kết nối bnagwf phương thức PDO
function db(){
   $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO("mysql:host=localhost;dbname=qlst;charset=utf8mb4", "root", "");   
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

//kiem tra mật khẩu cũ nhập vào
function test($s){
	 $conn = mysqli_connect("localhost", "root", "", "qlst"); 
     mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, "SELECT * FROM DangNhap");
    while($row = mysqli_fetch_assoc($result)){
        if($row["MatKhau"]==$s){
        	return 'true';
        }
    }
    return 'false';
}

//Lấy bản ghi cuỗi
function selectmax($benhnhan,$MaBN){
     $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO("mysql:host=localhost;dbname=qlst;charset=utf8mb4", "root", "");   
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $db->query("SELECT Max($MaBN) as Ma FROM $benhnhan");
    while($row = $result->fetch()) {
    return $row['Ma'];
   }
}

//insert tài khoản đăng nhập
function insert($MaNV,$TenDangNhap,$MatKhau){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO DangNhap (MaNV,TenDangNhap, MatKhau) VALUES (?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaNV, $TenDangNhap,$MatKhau]);
}
//insert hóa đơn nhâp 
function insertHDN($MaNCC,$MaNV){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO HoaDonNhap (MaNCC,MaNV) VALUES (?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaNCC,$MaNV]);
}

//insert chi tiết hóa đơn nhập
function insertCTHDN($MaHDN,$MaThuoc,$ThoiGian,$gianhap,$SoLuong,$lothuoc,$ngaysanxuat,$hansudung){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO ChiTietHoaDonNhap (MaHDN,MaThuoc,ThoiGian,GiaNhap,SoLuong,LoThuoc,NgaySanXuat,HanSuDung) VALUES (?,?,?,?,?,?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaHDN,$MaThuoc,$ThoiGian,$gianhap,$SoLuong,$lothuoc,$ngaysanxuat,$hansudung]);
}
//insert hóa đơn bán
/*function insertCTHDB($MaHDB,$MaThuoc,$ThoiGian,$SoLuong,$MaHDN){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO DangNhap (MaHDB,MaThuoc,ThoiGian,SoLuong,MaHDN) VALUES (?,?,?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaHDB,$MaThuoc,$ThoiGian,$SoLuong,$MaHDN]);
}*/
//kiểm tra tồn tại mã ko
function taikhoan($s){
     $conn = mysqli_connect("localhost", "root", "", "qlst");
     mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, "SELECT * FROM DangNhap");
    while($row = mysqli_fetch_assoc($result)){
        if($row["MaNV"]==$s){
            return 'true';
        }
    }
    return 'false';
}
//kiểm tra số điện thoại
function testsdt($s){
    $s=$s."";
    if(strlen($s)==10){
        for($i=0;$i<strlen($s);$i++){
           if(!is_numeric($i)){
            return false;
           }
        }
    }else{
        return false;
    }
    return true;
}
//kiem tra so cmt
function testsocmt($s){
    $s=$s."";
    for($i=0;$i<strlen($s);$i++){
        if(!is_numeric($s[$i])){
            return false;
        }
    }
    return true;
}
//insert chức vụ
function insertCV($sdt,$cmt){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO ChucVu (TenCV,GhiChu) VALUES (?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$sdt,$cmt]);
}
//delete chức vụ
function deleteCV($cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ".$cv." WHERE MaCV='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
//update chức vụ
function UpdateCV($manv,$ten,$diachi){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE ChucVu SET TenCV='".$ten."',GhiChu='".$diachi."' WHERE MaCV='".$manv."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//insert đơn vị tính
function insertDVT($sdt,$cmt){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO DonViTinh (TenDVT,GhiChu) VALUES (?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$sdt,$cmt]);
}
//delete đơn vị tính
function deleteDVT($cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ".$cv." WHERE MaDVT='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
//update đơn vị tính
function UpdateDVT($manv,$ten,$diachi){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE DonViTinh SET TenDVT='".$ten."',GhiChu='".$diachi."' WHERE MaDVT='".$manv."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//insert nhà sản xuất
function insertNSX($sdt,$cmt){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO NhaSanXuat (TenNSX,GhiChu) VALUES (?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$sdt,$cmt]);
}
//delete nhà sản xuất
function deleteNSX($cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ".$cv." WHERE MaNSX='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
//update nhà sản xuất
function UpdateNSX($manv,$ten,$diachi){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE NhaSanXuat SET TenNSX='".$ten."',GhiChu='".$diachi."' WHERE MaNSX='".$manv."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//insert nhóm thuốc
function insertNT($sdt,$cmt){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', ''); 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO NhomThuoc (TenNT,GhiChu) VALUES (?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$sdt,$cmt]);
}
//delete nhóm thuốc
function deleteNT($cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ".$cv." WHERE MaNT='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
//update nhóm thuốc
function UpdateNT($manv,$ten,$diachi){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE NhomThuoc SET TenNT='".$ten."',GhiChu='".$diachi."' WHERE MaNT='".$manv."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//insert  bệnh nhân
function insertBN($Ten,$sdt,$cmt,$diachi){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO BenhNhan (TenBN,SDT,SoCMT,DiaChi) VALUES (?,?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$Ten, $sdt,$cmt,$diachi]);
}
//update benh nhân
function Updatebenhnhan($manv,$sdt,$cmt,$diachi,$ghichu){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE BenhNhan SET TenBN='".$sdt."',SDT='".$cmt."',SoCMT='".$diachi."',DiaChi='".$ghichu."' WHERE MaBN='".$manv."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//delete nhà cung cấp
function deleteNCC($cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ".$cv." WHERE MaNCC='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
//update nhà cung cấp
function UpdateNCC($manv,$ten,$diachi,$sdt){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE NhaCungCap SET TenNCC='".$ten."',DiaChi='".$diachi."',SDT='".$sdt."' WHERE MaNCC='".$manv."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//insert nhà cung cấp
function insertNCC($MaNV,$TenDangNhap,$MatKhau){
     $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO NhaCungCap (TenNCC,DiaChi, SDT) VALUES (?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaNV, $TenDangNhap,$MatKhau]);
}
//INSERT nhan vien
function insertNhanVien($Ten,$sdt,$cmt,$diachi,$ghichu,$HinhAn,$cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO NhanVien (MaNV,TenNV,Email,DiaChi,SDT,SoCMT,HinhAnh,MaCV) VALUES (?,?,?,?,?,?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$Ten,$sdt,$cmt,$diachi,$ghichu,$HinhAn,$cv,$t]);
}
//delete nhan viên
function delete($cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ".$cv." WHERE MaNV='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
//update  nhan vien
function UpdateNhanVien($manv,$sdt,$cmt,$diachi,$ghichu,$HinhAn,$cv,$t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE NhanVien SET TenNV='".$sdt."',Email='".$cmt."',DiaChi='".$diachi."',SDT='".$ghichu."',SoCMT='".$HinhAn."',HinhAnh='".$cv."',MaCV='".$t."' WHERE MaNV='".$manv."'";
    //$sql = "INSERT INTO NhanVien (MaNV,TenNV,Email,DiaChi,SDT,SoCMT,HinhAnh,MaCV) VALUES (?,?,?,?,?,?,?,?)";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}

//thêm hóa đơn bán
function insertHDB($Ten,$ghichu){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO HoaDonBan (MaBN,MaNV) VALUES (?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$Ten,$ghichu]);
}
//test Email
function testEmail($email){
    $chuoi = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
    if(!preg_match($chuoi, $email)) { 
          return true;
    } 
    else { 
         return false; 
    } 
}

//kiểm tra thời gian
function thoigian($s){
 }  

 //insert thuốc
 function insertThuoc($MaNSX,$MaDVT,$MaNT,$GiaBan,$TenThuoc,$GhiChu,$HinhAnh) 
 {
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Câu truy vấn
    $sql = "INSERT INTO Thuoc (MaNSX,MaDVT,MaNT,GiaBan,TenThuoc,GhiChu,HinhAnh) VALUES (?,?,?,?,?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaNSX,$MaDVT,$MaNT,$GiaBan,$TenThuoc,$GhiChu,$HinhAnh]);
 }
 //delete thuoc
function deleteThuoc($t){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM ChiTietHoaDonBan WHERE MaThuoc='".$t."'";
    $stmt= $connect->prepare($sql);
    $stmt->execute();
}
 /*function addCTHD($num)
 {
     require_once 'data_class.php';
    static $tt=0;
    $result = db()->query("SELECT * FROM Thuoc where MaThuoc='".$_SESSION['thuoc']."'");
    while($row = $result->fetch()) {
         $nsx = db()->query("SELECT * FROM donvitinh where MaDVT='".$row['MaDVT']."' ");
         while($rows = $nsx->fetch()){
              $tendvt=$rows['TenDVT'];
         }
        $num[$tt]=new thuoc($row['TenThuoc'],$tendvt,$row['GiaBan']);
        $tt++;
    }
    return  $num;
 }*/
 function insertCTHDB($MaHDB,$MaThuoc,$SoLuong)
 {
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    date_default_timezone_set('UTC');
    $date=date('Y/m/d H:i:s');
    //Câu truy vấn
    $sql = "INSERT INTO ChiTietHoaDonBan (MaHDB,MaThuoc,ThoiGian,SoLuong) VALUES (?,?,?,?)";
    $stmt= $connect->prepare($sql);
    $stmt->execute([$MaHDB,$MaThuoc,$date,$SoLuong]);
 }
 //tính tông tiền của hóa đơn
 function sumCTHDB($MaHDB)
 {
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $result = $connect->query("select * FROM ChiTietHoaDonBan where MaHDB='".$MaHDB."'");
   
    $sum=0;
   while($row = $result->fetch()) {
    $sum+= $row['SoLuong']*((FLOAT)giaban($row['MaThuoc']));
   }
   return $sum;
 }
 //TÌM GIÁ BÁN
function giaban($MaHDB)
 {
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $connect->query("select * FROM Thuoc where MaThuoc='".$MaHDB."'");
   while($row = $result->fetch()) {
    $sum=$row['GiaBan'];
   }
   return $sum;
}
//update Cthdb
function UpdateCTHDB($mathuoc,$mahdb,$soluong){
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="UPDATE ChiTietHoaDonBan SET SoLuong='".$soluong."' WHERE MaThuoc='".$mathuoc."' and MaHDB = '".$mahdb."'";
   $stmt = $connect->prepare($sql);
   $stmt->execute();
}
//đén số thuốc trong hóa đơn
function countCTHDB($MaHDB)
 {
    $connect = new PDO('mysql:host=localhost;dbname=qlst', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $connect->query("select * FROM ChiTietHoaDonBan where MaHDB='".$MaHDB."'");
    $sum=0;
    while($row = $result->fetch()) {
        $sum++;
    }
    return $sum;
 }
?>