
 <?php  
     session_start();  
    require_once('ketnoi_pdo.php');
if(slnhap($_GET["mathuoc"])>slban($_GET["mathuoc"])){
if( testThuocCTHDB($_GET["mathuoc"],$_SESSION['mahdb'])=="true"){
    if(isset($_SESSION['mahdb'])){
        insertCTHDB($_SESSION['mahdb'],$_GET["mathuoc"],1,getLoThuocCTHDN($_GET["mathuoc"])); 
        header("Location:index.php"); 
    }else{
        header("Location:index.php");
        echo '<script language="javascript">'; 
        echo 'alert("Chưa tồn tại mhdb.")'; 
        echo '</script>'; 

    }
}else{ 
    require_once('ketnoi_pdo.php');
    $t=slthuoc($_GET["mathuoc"],$_SESSION['mahdb']);
    $t=(int)$t+1;
    UpdateCTHDB($_GET["mathuoc"],$_SESSION['mahdb'],$t."");
    header("Location:index.php"); 
}
}else{   
    header("Location:index.php"); 
}
    
 ?> 