<?php
class AppNotification {
	
	private $google_api_key = "";
	
	public function __construct(){
		$this->CI =& get_instance();
		$fb_config = parse_ini_file(APPPATH."config/APP.ini");
		$this->google_api_key = $fb_config['google_api_key'];
	}
	
	/**
	 * Send App Notification
	 * 
	 * @param array $registatoin_ids
	 * @param string $message
	 * @return multitype:number string
	 */
	public function sendNotification($registatoin_ids, $message, $title, $shortcode) {
		$map = array();
		$message_coded = "4@".$shortcode."@".$message;
		$data = array("message" => $message_coded,"title" => $title);
		$reg_id = array();
		$reg_id[]="cwczvTcBAxg:APA91bEDcYoVsg_eomzKwxVyEeqdlUJPetnwOc5uVIRZbARb1NuPoHvOLF-90YV-g9u3ZlW4i-M_PtwXs4aLuJ2bopIKeT2CozTehRB1RroT6w5BrHUGYCLLa83Wq-2Qw9qUdGwOMhlo";
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
				'registration_ids' =>$registatoin_ids,
				'data' => $data,
		);
		$headers = array(
				'Authorization: key=' . $this->google_api_key,
				'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		$map['status'] = 1;
		$map['message'] = 'Notification sent successfully.';
		$map['result'] = $result;
		
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
			$map['status'] = 0;
			$map['message'] = 'Failed to send notification';
			
		}
		curl_close($ch);
		return $map;
	}
	
}