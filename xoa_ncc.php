<?php
    require_once 'ketnoi_pdo.php'; 
    	deleteNCC('NhaCungCap',$_GET['mancc']);
        header("Location:index.php?detail=nhacungcap");
    
?>
 