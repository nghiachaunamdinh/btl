<?php
    require_once 'ketnoi_pdo.php'; 
    	deleteNT('NhomThuoc',$_GET['mant']);
        header("Location:index.php?detail=nhomthuoc");
    
?>
 