<?php
Class Smsmodel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

//#################### SMS ####################//

	public function sendSMS($to_phone,$smsContent)
	{

		$uni_code=utf8_encode($smsContent);
 		$msg=urlencode($uni_code);
		$url="https://api.msg91.com/api/sendhttp.php?authkey=308533AMShxOBgKSt75df73187&mobiles=$to_phone&country=91&message=$smsContent&sender=GMSADM&route=4&unicode=1";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => "https://api.msg91.com/api/sendhttp.php?mobiles=$phone&authkey=301243AX0Pp4EOQCn5db82c4f&route=4&sender=SKILEX&message=$notes&country=91",
		CURLOPT_URL => $url,

		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		// echo $response;
	}
	
		// 	$str=urlencode($smsContent, ENT_QUOTES, 'UTF-8');
		//
		//
		// 	$msg=urlencode($str);
		//
		//
		// 	 $curl = curl_init();
		// 	 $url="https://api.msg91.com/api/sendhttp.php?authkey=308533AMShxOBgKSt75df73187&mobiles=$to_phone&country=91&message=$smsContent&sender=GMSADM&route=4&unicode=1";
		// 	curl_setopt_array($curl, array(
		//   CURLOPT_URL => $url,
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => "",
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 30,
		//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//   CURLOPT_CUSTOMREQUEST => "POST",
		//   CURLOPT_SSL_VERIFYHOST => 0,
		//   CURLOPT_SSL_VERIFYPEER => 0,
		//   CURLOPT_HTTPHEADER => array(
		//     "content-type: application/json"
		//   ),
		// ));
		//
		// $response = curl_exec($curl);
		// $err = curl_error($curl);
		//
		// curl_close($curl);
		//
		// if ($err) {
		//   echo "cURL Error #:" . $err;
		// } else {
		//   echo $response;
		// }
		// exit;

	}

//#################### SMS End ####################//

//#################### voice call start  ####################//


		function send_voice_call($constituent_id){

			$get_phone="SELECT * FROM constituent where id='$constituent_id'";
			$res=$this->db->query($get_phone);
			foreach($res->result() as $rows){}
			$phone=$rows->mobile_no;
			$username = urlencode("u2630");
			$token = urlencode("57cchT");
			$plan_id = urlencode("5949");
			$announcement_id = urlencode("209974");
			$caller_id = urlencode("newcompany");
			$contact_numbers = urlencode($phone);
			$api = "http://103.255.100.37/api/voice/voice_broadcast.php?username=".$username."&token=".$token."&plan_id=".$plan_id."&announcement_id=".$announcement_id."&caller_id=".$caller_id."&contact_numbers=".$contact_numbers."";
			$curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => $api,

      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }

		}

//#################### voice call end ####################//

}
?>
