<?php
/**
 * Connect to MySQL using PDO.
 */
$user = 'root'; 
$password = '';
$server = 'localhost';
$database = 'qlst';
$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf-8'");
//Query our MySQL table
$sql = "SELECT * FROM ChiTietHoaDonBan Where MaHDB='".$_GET['mahdb']."'";
$stmt = $pdo->query($sql);
 
// Lấy dữ liệu từ bảng 
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//Tên file tải xuống
$filename = 'xuat_hoa_don_theo_ngay.xls';
 
// Gửi các tiêu đề chính xác tới trình duyệt để trình duyệt biết
// nó đang tải xuống một tệp Excel.
//header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename"); 
header("Content-type:   application/x-msexcel; charset=utf-8");
//header("Content-Disposition:attachment;filename=\"CHS.csv\""); 
header("Pragma: no-cache"); 
header("Expires: 0");
 
// Xác định đường phân cách
$separator = "\t";
 
// Nếu truy vấn  trả về các hàng
if(!empty($rows)){
    
    // Tự động in ra tên cột dưới dạng hàng đầu tiên trong tài liệu.
     // Điều này có nghĩa là mỗi cột Excel sẽ có một tiêu đề.
	 
 
   echo "Ten thuoc\tDon vi tinh\tSo luong\t Gia ban"."\n";
 
    //echo mb_convert_encoding(implode($separator, array_keys($rows[0]))."\n",'utf-16','utf-8');
   // Lặp qua các hàng
  //echo implode($separator,$rows);
    foreach($rows as $row){
        $thuoc=$row["MaThuoc"];
        // Làm sạch dữ liệu và xóa mọi ký tự đặc biệt có thể xung đột
        foreach($row as $k => $v){
        	if($k=="MaThuoc"){
        		require_once 'ketnoi_pdo.php';
                $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$row["MaThuoc"]."'");
                while($rows = $nsx->fetch()){
                    $row[$k]= $rows["TenThuoc"];
                }
        	}
        	if($k=="ThoiGian"){
                 require_once 'ketnoi_pdo.php';
                 $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$thuoc."'");
                 while($rowss = $nsx->fetch()){
                 $dvt = db()->query("SELECT * FROM DonViTinh where MaDVT='".$rowss["MaDVT"]."'");
                while($t = $dvt->fetch()){
                   $row[$k]= $t["TenDVT"];
                }
                }
            }
            if($k=="MaHDB"){
            	require_once 'ketnoi_pdo.php';
                $nsx = db()->query("SELECT * FROM Thuoc where MaThuoc='".$thuoc."'");
                while($rows = $nsx->fetch()){
                     $row[$k]= number_format($rows["GiaBan"]);
                }
            }
            $row[$k] = str_replace($separator . "$", "", $row[$k]);
            $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
            $row[$k] = trim($row[$k]);
            $row[$k]=mb_convert_encoding($row[$k],'utf-16','utf-8');
        }
        
        // Mã hóa và in các cột ra bằng cách sử dụng
         // Dấu phân cách $ làm tham số keo
        //echo implode($separator, $row) . "\n";
        //nôi phần tử của mảng thành 1 chuỗi
        echo mb_convert_encoding(implode($separator, $row) . "\n",'utf-16','utf-8');

    }
    require_once 'ketnoi_pdo.php';
    echo "\n";
    echo "\nTong : \t".number_format(sumCTHDB($_GET['mahdb']));
  
}

?>