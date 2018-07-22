<?php
class UserLoginLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function sendVerificationEmail($email) {
		$map = array();
		$map['emailcode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($email, 10, 36));
		$map['email'] = $email;
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfileByEmail ( $email );
		if(count($result) <= 0) {
			$emailcode = $this->CI->userlogin->saveVerificationEmail($map);
			$url = base_url()."signup/verifyemail/".$emailcode;
			$this->CI->load->library ( 'Pkemail' );
			$this->CI->pkemail->load_system_config ();
			$this->CI->pkemail->headline = 'Email verification - Phynart';
			$this->CI->pkemail->subject = 'Email verification - Phynart';
			$this->CI->pkemail->mctag = 'OTP-msg';
			$this->CI->pkemail->attachment = 0;
			$this->CI->pkemail->to = $email;
			$this->CI->template->set ( 'emailcode', $emailcode );
			$this->CI->template->set ( 'url', $url );
			$this->CI->template->set ( 'page', 'signup-message' );
			$this->CI->template->set_layout ( false );
			$text_body = $this->CI->template->build ( 'frontend/emails/verification-email', '', true );
			$this->CI->pkemail->send_email ( $text_body );
			return array("status"=>1,"msg"=>"Verification email sent to your email inbox.");
		} else {
			return array("status"=>0,"msg"=>"This email is already registered with us.");
		}
	}
	
	public function sendVerificationSms($mobile) {
		$map = array();
		$map['mobile'] = $mobile;
		$map['otp'] = rand(100000,999999);
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$otp = $this->CI->userlogin->saveVerificationMobile($map);
		$sms_msg = 'Your OTP is ' . $otp . ' . Your OTP will expires within 3 minutes.';
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $mobile;
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function isEmailVerified($email) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$is_verified = $this->CI->userlogin->isEmailVerified($email);
		return $is_verified;
	}
	
	public function verifyMobileOtp($mobile,$otp) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$map = array();
		$map['mobile'] = $mobile;
		$map['otp'] = $otp;
		$resp = $this->CI->userlogin->verifyMobile($map);
		return $resp;
	}
	
	public function verifyEmail($emailcode) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$map = array();
		$map['emailcode'] = $emailcode;
		$map['is_verified'] = 1;
		$this->CI->userlogin->verifyEmail($map);
	}
	 
	public function userExist($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		if (count ( $exist ) > 0) {
			
			if($exist[0]['status']==0)
			{
				$exist['msg']="You are already registered with us.";
				$exist['is_verify']=1;
				$exist['exist']=1;
				$exist['id']=$exist[0]['id'];
				$exist['email'] = $exist[0]['email'];
				$exist['mobile'] = $exist[0]['mobile'];
				return $exist;
			}
			else 
			{
				$exist['msg']="Mobile already registered.";
				$exist['is_verify']=0;
				$exist['exist']=1;
				$exist['id'] = $exist[0]['id'];
				$exist['email'] = $exist[0]['email'];
				$exist['mobile'] = $exist[0]['mobile'];
				return $exist;
			}
		} else {
			$exist['exist'] = 0;
			return $exist;
		}
	}
	
	public function userRegistration($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$this->CI->load->model ( 'users/Wallet_model', 'walletmodel' );
		$data ['coupon_code'] = mt_rand ( 10000, 99999 );
		$data ['otp'] = mt_rand ( 100000, 999999 );
		$data ['password'] = md5 ( $data ['password'] );
		$data ['source'] = 3;
		$data['created_on']=date('Y-m-d H:i:s');
		try {
			$user_id = $this->CI->userlogin->userRegistration ( $data );
			$wallet = array();
			$wallet['userid'] = $user_id;
			$wallet['amount'] = 0;
			$wallet['created_date'] = date('Y-m-d H:i:s');
			$this->CI->walletmodel->createWallet($wallet);
			$map = array ();
			if ($user_id > 0) {
				$map ['status'] = 1;
				$map ['message'] = 'Successfully registered.';
				$map ['id'] = $user_id;
				$map ['name'] = $data ['name'];
				$map ['email'] = $data ['email'];
				$map ['mobile'] = $data ['mobile'];
				//$this->sendOTPSMS ( $data );
				$this->sendOTPEmail ( $data );
			} else {
				$map ['status'] = 0;
				$map ['message'] = 'Failed to register.';
			}
		} catch ( Exception $e ) {
			$map ['status'] = 0;
			$map ['message'] = 'Failed to register.';
		}
		
		return $map;
	}
	
	public function login($params) {
		$params ['password'] = md5 ( $params ['password'] );
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data = $this->CI->userlogin->login ( $params );
		if (count ( $data ) > 0) {
			if($data[0]['status']==1)
			{
				$data['status'] = 1;
				$data['msg'] = 'Logged in successfully.';
			}
			else if($data[0]['status']==2)
			{
				$data['status'] = 2;
				$data['msg'] = 'Account suspended.';
			}
			else
			{
				$data['status'] = 0;
				$data['msg'] = 'Email/Mobile is not verified';
			}
		} else {
			$data['status'] = 0;
			$data['msg'] = "Wrong Username Or Password";
		}
		return $data;
	} 
	
	public function addAddress($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		return $this->CI->userlogin->addAddress ( $data );
	}
	
	public function getAddressById($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getAddressById ( $data );
		return $result;
	}
	
	public function updateAddress($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateAddress ( $data );
	}
	
	public function getAddressByAddressId($id) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getAddressByAddressId ( $id );
		return $result;
	}
	
	public function getProfile($id) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfile ( $id );
		return $result;
	}
	
	public function updateUserProfile($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateUserProfile ( $data );
		return $result;
	}
	
	public function updateUserProfileByEmail($data) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->updateUserProfileByEmail ( $data );
		return $result;
	}
	
	public function sendOTPSMS($details) {
		$sms_msg = 'Your OTP is ' . $details ['otp'] . ' . Your OTP will expires within 15 minutes.';
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	
	public function sendOTPEmail($user) {
		$this->CI->load->library ( 'Pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Phynart verifyOTP';
		$this->CI->pkemail->subject = 'Verify your email/mobile on Phynart';
		$this->CI->pkemail->mctag = 'OTP-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/otp-email', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function forgetPasswordEmail($user) {
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Phynart';
		$this->CI->pkemail->subject = 'Your Username and Password ';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'name', $user['name'] );
		$this->CI->template->set ( 'email', $user['email'] );
		$this->CI->template->set ( 'password', $user['original'] );
		$this->CI->template->set ( 'page', 'forgetpassword' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/forget_password', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	 public function sendSignUpEmail($user) {
		$this->CI->load->library ( 'Pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = ' SignUp';
		$this->CI->pkemail->subject = 'Welcome To Phynart';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/signup', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	} 
	
	public function sendSubscribeEmail($user) {
		$this->CI->load->library ( 'fbemail' );
		$this->CI->fbemail->load_system_config ();
		$this->CI->fbemail->headline = 'olotime Newsletter';
		$this->CI->fbemail->subject = 'olotime : Newsletter';
		$this->CI->fbemail->mctag = 'newsletter';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/subscribe', '', true );
		$this->CI->fbemail->send_email ( $text_body );
	}
	
	public function forgetPassword($email){
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->forgetPassword ( $email );
		if(count ($result)>0)
		{
			$this->forgetPasswordEmail ( $result[0] );
		}
		return $result;
	}
	
	public function resendOTP ($data)
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$exist = $this->CI->userlogin->userExist ( $data );
		if (count ( $exist ) > 0) {
				$exist['msg']="OTP has been sent in your email address.";
				$exist['is_verify']=1;
				$exist['exist']=1;
				$exist['id']=$exist[0]['id'];
				$this->sendOTPSMS ( $exist[0] );
				$this->sendOTPEmail ( $exist[0] );
				return $exist;
		}
	}
	public function getOrderDetailByUserId ( $id )
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$order = $this->CI->userlogin->getOrderDetailByUserId ( $id );
		return $order;
		
	}
	public function subscribe($email)
	{
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$data = $this->CI->userlogin->subscribe ( $email );
		if (array_key_exists('email', $data)) {
			$this->sendSubscribeEmail ( $data );
		}
		return $data;
	}
	
	public function createWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->createWallet ( $params );
	}
	
	public function addToWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->addToWallet ( $params );
	}
	
	public function removeFromWallet($params) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		$this->CI->wallet->removeFromWallet ( $params );
	}
	
	public function getWalletBalance($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletBalance ( $userid );
	}
	
	public function getWalletTransactions($userid) {
		$this->CI->load->model ( 'users/Wallet_model', 'wallet' );
		return $this->CI->wallet->getWalletTransactions ( $userid );
	}
	
	public function getCustomerDetails($address_id) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		return $data = $this->CI->userlogin->getCustomerDetails ( $address_id );
	}
	
	public function getProfileByEmailMobile($map) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfileByEmailMobile ( $map );
		return $result;
	}
	
	public function getProfileByEmail($email) {
		$this->CI->load->model ( 'users/UserLogin_model', 'userlogin' );
		$result = $this->CI->userlogin->getProfileByEmail ( $email );
		return $result;
	}
	
}