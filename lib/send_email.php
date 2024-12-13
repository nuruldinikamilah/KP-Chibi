<?php
function kirim_email($to,$subject,$body){
	$token="TokenSpesialBuatOomAnggaAgarBisaNgirimEmailViaUNIKOMMailSenderOK";
	$postUrl            = "https://mail.info.unikom.ac.id/sendsingle"; 
	$postData           = array("to" => $to,
								"subject" => $subject,
								"body"=>$body,
										
								"token" => $token,
								"prioritas" => 1);
	$ch                 = curl_init();
	curl_setopt($ch, CURLOPT_URL, $postUrl);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	if($httpCode==200){
		$ar=json_decode($response,true);
		if(!is_null($ar)){
			return true;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}

/*if($terkirim=kirim_email("anggasetiyadi@gmail.com","Judul Email","ini isi emailnya"))
   echo "Email telah sukses dikirim";
else
  echo "Pengiriman email gagal";*/