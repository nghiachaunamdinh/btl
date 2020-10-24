<?php
    require_once 'ketnoi_pdo.php'; 
    	deleteDVT('DonViTinh',$_GET['madvt']);
        header("Location:index.php?detail=donvitinh");
    
?>