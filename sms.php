<?php 
		//Visist http://http://esms.vn/SMSApi/ApiSendSMSNormal for more information about API
		//� 2013 esms.vn
		//Website: http://esms.vn/
		//Hotline: 0902.435.340      
	   
		//Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
		//De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API 
		
		$APIKey="344466519752E8EACC35DBC1EC5987";
		$SecretKey="6652B768FE5EB90E59598387DCE504";
		$YourPhone="0945240518";
        $ch = curl_init();

		
		$SampleXml = "<RQST>"
                               . "<APIKEY>". $APIKey ."</APIKEY>"
                               . "<SECRETKEY>". $SecretKey ."</SECRETKEY>"                                    
                               . "<ISFLASH>0</ISFLASH>"
		               		   . "<SMSTYPE>2</SMSTYPE>"
							   . "<CONTENT>". 'Welcome to SMS - from PHP http://esms.vn' ."</CONTENT>"
							   . "<BRANDNAME>Verify</BRANDNAME>"//De dang ky brandname rieng vui long lien he hotline 0902435340 hoac nhan vien kinh Doanh cua ban
                               . "<CONTACTS>"
                               . "<CUSTOMER>"
                               . "<PHONE>". $YourPhone ."</PHONE>"
                               . "</CUSTOMER>"                               
                               . "</CONTACTS>"
							   . "</RQST>";
							   		
							   
		curl_setopt($ch, CURLOPT_URL,            "http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V4/" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POST,           1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS,     $SampleXml ); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: P ')); 

		$result=curl_exec ($ch);		
		$xml = simplexml_load_string($result);

		if ($xml === false) {
			die('Error parsing XML');   
		}

		//now we can loop through the xml structure
		//Tham khao them ve SMSTYPE de gui tin nhan hien thi ten cong ty hay gui bang dau so 8755... tai day :http://esms.vn/SMSApi/ApiSendSMSNormal
		
		   
		    	try {
		    		 header("Location:http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=0818783826&Content=Hãy nhập mã ".random_int(1000, 9999)."để xác nhận UTC_HOSTPITAL &ApiKey=344466519752E8EACC35DBC1EC5987&SecretKey=6652B768FE5EB90E59598387DCE504&SmsType=2&Brandname=Verify");
		    		     header("Location:index.php");
		    	} catch (Exception $e) {
		    		echo "ttt";
		    	}
		
			?>
			
		
		 
