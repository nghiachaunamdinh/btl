<!DOCTYPE HTML>
<html>
<head>
    <title>Đăng ký tài khoản</title>
    <meta charset="UTF-8">
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/dangnhap.css">
</head>
<body>
    <div class="container">
    	<a href="test.php?name=5" onclick="test();">click</a>
    </div>
    <?php 
         session_start();
        echo $_SESSION['name'];
    ?>
    <script type="text/javascript">
        <?php session_start();$_SESSION['name']="dac"?>
    </script>
</body>
</html>