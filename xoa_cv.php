<?php
    require_once 'ketnoi_pdo.php'; 
    	deleteCV('ChucVu',$_GET['macv']);
        header("Location:index.php?detail=chucvu");
    
?>