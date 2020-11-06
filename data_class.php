 <?php  
     session_start();  
    require_once('ketnoi_pdo.php');
    if(isset($_SESSION['mahdb'])){
    	insertCTHDB($_SESSION['mahdb'],$_GET["mathuoc"],"1"); 
        header("Location:index.php"); 
    }else{
    	header("Location:index.php");
        echo '<script language="javascript">'; 
        echo 'alert("Hãy nhập thông tin khách hàng.")'; 
        echo '</script>'; 

    }
    
 ?> 