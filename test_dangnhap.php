<?php
function testdata(){
    session_start();
    require_once 'ketnoi_pdo.php';
    $s="Tên đăng nhập hoặc mật khẩu không đúng . ";
    if(isset($_POST["submit"])){
        require_once 'ketnoi_pdo.php';
        $name=$_POST["tendangnhap"];
        $pass=$_POST["matkhau"];
        $result = db()->query("SELECT * FROM DangNhap");
        while($row = $result->fetch()) {
        echo($row["MaNV"]);
        }
        if(!$result) {
		return $s;
	    }  
        while($row = $result->fetch()) {
             if($row["TenDangNhap"]==$name&&$row["MatKhau"]==$pass){
	            header("Location:index.php");
	            $s="";
	            $_SESSION['test']="dac";
                 return "";
             }
        }
        if($s==""){
        	return $s;
        }

    }else{
    	header("Location:dangnhap.php");
        return $s;
    }
}
?>