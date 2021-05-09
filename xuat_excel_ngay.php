<?php /* 
if($_GET['cv']=='1'){
 $conn = mysqli_connect("localhost", "root", "", "qlst");
     mysqli_set_charset($conn, "utf-8");
    $result = mysqli_query($conn, "SELECT * FROM HoaDonBan");
    while($rowt = mysqli_fetch_assoc($result)){
      date_default_timezone_set('Asia/Ho_Chi_Minh');//khai báo kiểu thời gian ở việt nam
      $date = getdate();//Lấy thời gian hiện tại
      $date =date('Y/m/d');//lấy ngày tháng năm
        $tiem=date_create($rowt['ThoiGian']);//tạo kiểu thời gian
        $tiem=date_format($tiem,"Y/m/d");//chuyển về ngày tháng năm
        if(strtotime($date) == strtotime($tiem)){
          $user = 'root';
        }
$password = '';
$server = 'localhost'; 
$database = 'qlst';
$pdo = new PDO("mysql:host=localhost;dbname=qlst","root","");
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf-8'");
//Query our MySQL table
$sql = "SELECT * FROM ChiTietHoaDonBan Where MaHDB='".$rowt['MaHDB']."'";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);// Lấy dữ liệu từ bảng 
$filename = 'ThongKe.xls';//Tên file tải xuống
// Gửi các tiêu đề chính xác tới trình duyệt để trình duyệt biết
// nó đang tải xuống một tệp Excel.
//header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename"); 
header("Content-type:   application/x-msexcel; charset=utf-8");
//header("Content-Disposition:attachment;filename=\"CHS.csv\""); 
header("Pragma: no-cache"); 
header("Expires: 0");
$separator = "\t";// Xác định đường phân cách
if(!empty($rows)){// Nếu truy vấn  trả về các hàng
    
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
         require_once 'ketnoi_pdo.php';
    echo "\n";
    echo "\nTong : \t".number_format(sumCTHDB($rowt['MaHDB']));
    }
   
         }
  }
}else{
  header("Location:index.php");
}*/
require_once('PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php');//import thư viện
    require_once('ketnoi_pdo.php');
    //Khởi tạo đối tượng mới và xử lý
    $PHPExcel = new PHPExcel();
    //Chọn sheet - sheet bắt đầu từ 0
    $PHPExcel->setActiveSheetIndex(0);
    //Tạo tiêu đề cho sheet hiện tại
    $PHPExcel->getActiveSheet()->setTitle('Export Excel');
    $PHPExcel->getActiveSheet()->setCellValue('A1', 'STT');
    $PHPExcel->getActiveSheet()->setCellValue('B1', 'Ngày');
    $PHPExcel->getActiveSheet()->setCellValue('C1', 'Mã HDB');
    $PHPExcel->getActiveSheet()->setCellValue('D1', 'Tình trạng');
    $PHPExcel->getActiveSheet()->setCellValue('E1', 'Thành tiền');
    //Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
    $rowNumber = 2;
    $date = getdate();//Lấy thời gian hiện tại
    $date =date('Y-m-d');//lấy ngày tháng năm
    //Xét in đậm cho khoảng cột
    $PHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
    $PHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'b3d9ff')
        )
    )
    );
    $tong=0;//Tổng số tiền của 1 ngày
    $connect = new PDO('mysql:host=localhost;dbname=qlst', "root",""); 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $connect->query("select * FROM HoaDonBan where ThoiGian LIKE '%".$date."%'");
    while($row = $result->fetch()) {
        // A1, A2, A3, ...
        $PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, ($rowNumber-1)."");
        // B1, B2, B3, ...
        $PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $date."");
        // C1, C2, C3, ...
        $PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $row['MaHDB']);
        // D1, D2, D3, ...
        $PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber,$row['TinhTrang']);
        // E1, E2, E3, ...
        $PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber,tongtienHDB($row['MaHDB'])."");
        $tong+=tongtienHDB($row['MaHDB']);
        // Tăng row lên để khỏi bị lưu đè
        $rowNumber++;
    }
    $PHPExcel->getActiveSheet()->setCellValue('D'.($rowNumber+2),'Tổng: ');
    $PHPExcel->getActiveSheet()->setCellValue('E'.($rowNumber+2),$tong.'');
    $da = getdate();//Lấy thời gian hiện tại
    $da =date('Y_m_d');//lấy ngày tháng năm
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="Export_data_date_'.$da.'.xls"');
    PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007')->save('php://output');

?>