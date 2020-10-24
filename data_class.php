 <?php  
     session_start();  
    require_once('ketnoi_pdo.php');
    insertCTHDB($_SESSION['mahdb'],$_GET["mathuoc"],"1"); 
    header("Location:index.php"); 
 ?> 