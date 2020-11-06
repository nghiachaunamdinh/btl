 <?php  
     session_start();  
    require_once('ketnoi_pdo.php');
    deletethuoc($_GET["mathuoc"]); 
    header("Location:index.php"); 
 ?> 