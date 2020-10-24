<?php
function ketnoi(){
   $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO("mysql:host=localhost;dbname=qlst;charset=utf8mb4", "root", "");   
    return $db;
}
?>