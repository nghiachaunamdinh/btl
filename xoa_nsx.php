<?php
    require_once 'ketnoi_pdo.php'; 
    	deleteNSX('NhaSanXuat',$_GET['mansx']);
        header("Location:index.php?detail=nhasanxuat");
    
?>