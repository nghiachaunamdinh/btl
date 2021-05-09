<?php

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
    //$PHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setColor('#ff0000');
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
        // Tăng row lên để khỏi bị lưu đè
        $rowNumber++;
    }
    $da = getdate();//Lấy thời gian hiện tại
    $da =date('Y_m_d');//lấy ngày tháng năm
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="Export_data_date_'.$da.'.xls"');
    PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007')->save('php://output');
?>