<?php
        
        
        require_once 'ketnoi_pdo.php'; 
         try {
               deleteNCC('NhaCungCap',$_GET['mancc']);
               header("Location:index.php?detail=nhacungcap");
         }
         catch (Exception $e) {
                echo '<script language="javascript">'; 
                echo 'alert("Không xóa được.")'; 
                echo '</script>'; 
                 header("Location:index.php");
         }
    	
?>
 