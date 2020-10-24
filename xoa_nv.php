<?php
    require_once 'ketnoi_pdo.php'; 
    if(taikhoan($_GET['manv'])=="true"){
         echo "Không xóa được tài khỏan của chính bạn .  ";
    }else{
    	delete('NhanVien',$_GET['manv']);
        header("Location:index.php?detail=nhanvien");
       
    }
    
?>
<script type="text/javascript">
	alert('<?php echo $r; ?>');
	alert("trong da");
</script> 