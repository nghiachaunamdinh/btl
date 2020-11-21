<?php

	//Visist http://http://esms.vn/SMSApi/ApiSendSMSNormal for more information about API
	//� 2013 esms.vn
	//Website: http://esms.vn/
	//Hotline: 0901.888.484      
   
	//Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
	//De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API 
    $APIKey="344466519752E8EACC35DBC1EC5987";
	$SecretKey="6652B768FE5EB90E59598387DCE504";
	$YourPhone=$_GET["sdt"];
	$code=random_int(1000, 9999);
	$Content="Bạn hãy nhập mã "+$code+" để đăng ký UTC_HOSTPITAL";
	
	$SendContent=urlencode($Content);
	$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&Brandname=Verify&SmsType=2";
	//De dang ky brandname rieng vui long lien he hotline 0901.888.484 hoac nhan vien kinh Doanh cua ban
	$curl = curl_init($data); 
	curl_setopt($curl, CURLOPT_FAILONERROR, true); 
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	$result = curl_exec($curl); 
		
	$obj = json_decode($result,true);
    if($obj['CodeResult']==100)
    {
        header("Location:nhap_maxndt.php?manv=".$_GET['msv']."& code=".$code);
    }
    else
    {
        print "Gửi không thành công . Cần nạp tiền";
    }
    


?>