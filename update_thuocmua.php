<?php  
    session_start();  
    require_once('ketnoi_pdo.php');
    UpdateCTHDB($_POST['mathuoc'],$_POST['mahdb'],$_POST['soluong']);
    echo $_POST['mathuoc'];
 ?> 