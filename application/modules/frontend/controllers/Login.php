<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper ( 'form' );
		$this->load->library ( 'session' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function login() {
		$login = array ();
		$login ['username'] = $this->input->post ( 'username' );
		$login ['password'] = $this->input->post ( 'password' );
	
		$this->load->library ( 'zyk/UserLoginLib' );
		$user = $this->userloginlib->login ( $login );
		if($user['status'] == 1) {
			$data = $user[0];
			if($data['attempts'] > 0) {
				$data['msg'] = "Login successful continue with shopping";
				$data['url'] = base_url()."unauthorized-access";
				$data['status'] = 1;
				$this->session->set_userdata ( 'olouserid', $data['id'] );
				$this->session->set_userdata ( 'olousername', $data['first_name'] );
				$this->session->set_userdata ( 'olouserlname', $data['last_name'] );
				$this->session->set_userdata ( 'olouseremail', $data['email'] );
				$this->session->set_userdata ( 'olousermobile', $data['mobile'] );
				$map = array();
				$map['email'] = $login['username'];
				$map['is_logged_in'] = 1;
				$map['last_login'] = date('Y-m-d H:i:s');
				$this->userloginlib->updateUserProfileByEmail ( $map );
			} else {
				$data['msg'] = "Login successful continue with shopping";
				$data['url'] = base_url();
				$data['status'] = 1;
				$this->session->set_userdata ( 'olouserid', $data['id'] );
				$this->session->set_userdata ( 'olousername', $data['first_name'] );
				$this->session->set_userdata ( 'olouserlname', $data['last_name'] );
				$this->session->set_userdata ( 'olouseremail', $data['email'] );
				$this->session->set_userdata ( 'olousermobile', $data['mobile'] );
				$map = array();
				$map['email'] = $login['username'];
				$map['is_logged_in'] = 1;
				$map['last_login'] = date('Y-m-d H:i:s');
				$this->userloginlib->updateUserProfileByEmail ( $map );
			}
		} else if($user['status'] == 2) {
			$data = $user[0];
			$this->session->set_userdata ( 'olousername', $data['first_name'] );
			$this->session->set_userdata ( 'olouseremail', $data['email'] );
			$data['status'] = 2;
			$data['msg'] = "Account is suspended";
			$data['url'] = base_url().'suspended-account';
		} else {
			$cookie_name = $login ['username'].'plcs';
			$cookie_name = str_replace(".","",$cookie_name);
			$cookie_name = str_replace("@","",$cookie_name);
			if (!isset($_COOKIE[$cookie_name])) {
				setcookie($cookie_name, 5, time() + (86400*1), "/");
				$attempts = 5;
			} else {
				$attempts = $_COOKIE[$cookie_name];
			}
			$attempts = $attempts -1;
			setcookie($cookie_name, $attempts, time() + (86400*1), "/");
			$data['status'] = 0;
			if($attempts > 0) {
				$data['login_attempts'] = "Only ".$attempts." more times are remaining";
			} else {
				$data['login_attempts'] = "You have reached your maximum login attempts.";
			}
			$data['msg'] = "User name or password wrong";
			$map = array();
			$map['email'] = $login['username'];
			$map['attempts'] = (5 - $attempts);
			$this->userloginlib->updateUserProfileByEmail ( $map );
		}
		echo json_encode ( $data );
	}  
	
	public function continueToProfile() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$email = $this->session->userdata ( 'olouseremail' );
		$map = array();
		$map['email'] = $email;
		$map['attempts'] = 0;
		$this->userloginlib->updateUserProfileByEmail ( $map );
		redirect ( base_url().'account/my-profile' );
	}
	
	function logout() {
		$this->session->unset_userdata ( 'olouserid' );
		$this->session->unset_userdata ( 'olousername' );
		$this->session->unset_userdata ( 'olouseremail' );
		$this->session->unset_userdata ( 'olousermobile' );
		redirect ( base_url () );
	}
	
	public function sendVerificationEmail() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$email = $this->input->post("email");
		$resp = $this->userloginlib->sendVerificationEmail($email);
		echo json_encode($resp);
	}
	
	public function sendVerificationSms() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$mobile = $this->input->post("mobile");
		$this->userloginlib->sendVerificationSms($mobile);
		echo json_encode(array("status"=>1));
	}
	
	public function isEmailVerified() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$email = $this->input->post("email");
		$isverified = $this->userloginlib->isEmailVerified($email);
		if($isverified) {
			echo json_encode(array("status"=>1));
		} else {
			echo json_encode(array("status"=>0));
		}
	}
	
	public function verifyMobileOtp() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$mobile = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$resp = $this->userloginlib->verifyMobileOtp($mobile,$otp);
		echo json_encode($resp);
	}
	
	public function verifyEmail($emailcode) {
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->verifyEmail($emailcode);
		$this->template->set ( 'page', 'users/email-verified' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/email-verified');
	}
	
   	public function UserRegistration() {
		$da = array ();
		$reg = array ();
		$reg ['name'] = $this->input->post ( 'name' );
		//$reg ['lname'] = $this->input->post ( 'lname' );
		$reg ['password'] = $this->input->post ( 'password' );
		$reg ['original'] = $this->input->post ( 'password' );
		$reg ['email'] = $this->input->post ( 'email' );
		$reg ['mobile'] = $this->input->post ( 'mobile' );
			
		$this->load->library ( 'zyk/UserLoginLib' );
		$exist = $this->userloginlib->userExist ( $reg );
		if ($exist['exist'] == 0) // register user
		{
			$da = $this->userloginlib->userRegistration ( $reg );
			$exist['is_register'] = 1;
			$exist['id'] = $da['id'];
			$params = array();
			$params['userid'] = $da['id'];
			$params['amount'] = 0;
			$params['created_date'] = date('Y-m-d H:i:s');
			
		} else {
			$exist['is_register'] = 0;
		}
		echo json_encode($exist);
	}
	
	public function userProfile() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		$this->template->set ( 'address', $address );
		$this->template->set ( 'profile', $profile[0] );
		$this->template->set ( 'page', 'home' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'profile' );
	}
	
	public function editProfile() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		$this->template->set ( 'address', $address );
		$this->template->set ( 'profile', $profile[0] );
		$this->template->set ( 'page', 'profile' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'profile_edit' );
	}
	
	public function userAddress() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		$userid = $_SESSION ['olouserid'];
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		$this->template->set ( 'addresses', $address );
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'userId', '' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'address' );
	}
	
	public function addNewAddress() {
		$data ['userid'] = $this->input->post('userid');
		$data ['address_name'] = $this->input->post ( 'address_name' );
		$data ['address'] = $this->input->post ( 'address' );
		$data ['apt_no'] = $this->input->post ( 'apt_no' );
		$data ['locality'] = $this->input->post ( 'locality' );
		$data ['longitude'] = $this->input->post ( 'longitude' );
		$data ['latitude'] = $this->input->post ( 'latitude' );
		$data ['landmark'] = $this->input->post ( 'landmark' );
		$data ['pincode'] = $this->input->post ( 'pincode' );
		$data ['city'] = $this->input->post ( 'city' );
		$data ['state'] = $this->input->post ( 'state' );
		$data ['address_opt'] = $this->input->post ( 'address_opt' );
		//$data ['areaid'] = $this->input->post ( 'areaid' );
		$data ['is_primary'] = 0;
		$this->load->library ( 'zyk/UserLoginLib' );
		$add_id = $this->userloginlib->addAddress ( $data );
		$resp = array('status'=>1,'msg'=>'Added Successfully.','address_id'=>$add_id);
		echo json_encode($resp);
	}
	
	public function updateAddress() {
		$data ['address'] = $this->input->post ( 'address' );
		$data ['address_name'] = $this->input->post ( 'address_name' );
		$data ['longitude'] = $this->input->post ( 'longitude' );
		$data ['latitude'] = $this->input->post ( 'latitude' );
		$data ['areaid'] = $this->input->post ( 'areaid' );
		$data ['userid'] = $this->session->userdata ( 'olouserid' );
		$data ['locality'] = $this->input->post ( 'locality' );
		$data ['landmark'] = $this->input->post ( 'landmark' );
		$data ['is_primary'] = 0;
		$data ['id'] = $this->input->post ( 'id' );
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->updateAddress ( $data );
		$resp = array('status'=>1,'msg'=>'Updated Successfully.');
		echo json_encode($resp);
	}
	
	//Edit address
	public function getAddressByAddressId($id) {
		$this->load->library ( 'zyk/UserLoginLib' );
		$address = $this->userloginlib->getAddressByAddressId ( $id );
		$this->template->set ( 'address', $address[0] );
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'userId', '' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'default' )->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'address_edit' );
	}
	public function updateUserProfile() {
		$data = array ();
		if ($this->input->post ( 'name' ) != '') {
			$data ['name'] = $this->input->post ( 'name' );
		}
		$data ['id'] = $_SESSION ['olouserid'];
		if ($this->input->post ( 'password' ) != '') {
			$data ['password'] = md5 ( $this->input->post ( 'password' ) );
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->updateUserProfile ( $data );
		$da = array('status'=>1,'msg'=>'Updated Successfully.');
		if ($da ['status'] == 1) {
			$this->session->set_userdata ( 'olousername', $data ['name'] );
		} else {
			$this->session->set_userdata ( 'active', 0 );
		}
		echo json_encode($da);
	}
	
	function subscribe()
	{
		$email = array();
		$email['date'] = date("Y-m-d");
		$email['email']=$this->input->get('email');
		$this->load->library ( 'zyk/UserLoginLib' );
		$data = $this->userloginlib->subscribe ( $email );
		
		echo json_encode($data);
	}
	
	/* ******************* Login Page *********************** */
	
	//login section
	
	public function loginDisplay() {
		$this->template->set ( 'page', 'users/login' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/login');
	}
	
	//login section
	
	// singup section
	
	public function register() {
		$this->template->set ( 'page', 'users/register' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/register');
	}
	//singup section
	
	
	
	//unable to login section
	
	public function unabletologin() {
		$this->template->set ( 'page', 'users/unable-to-login' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/unable-to-login');
	}
	
	//unable to login section
	
	//forgot password section
	
	public function forgotpassword() {
		$this->template->set ( 'page', 'users/forgot-password' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/forgot-password');
	}
	
	//forgot password section
	
	//forgot Customer Id  section
	
	public function forgotCustomerId() {
		$this->template->set ( 'page', 'users/forgot-customer-ID' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/forgot-customer-ID');
	}
	
	//forgot Customer Id section
	
	//enter Customer Id  section
	
	public function enterCustomerId() {
		$this->template->set ( 'page', 'users/enter-customer-ID' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/enter-customer-ID');
	}
	
	//enter Customer Id section
	
	//confirm OTP section
	
	public function confirmOTP() {
		$this->template->set ( 'page', 'users/confirm-OTP' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/confirm-OTP');
	
	}
	
	//confirm OTP section
	
	//confirm PIN section
	
	public function confirmPIN() {
		$this->template->set ( 'page', 'users/confirm-PIN' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/confirm-PIN');
	}
	
	//confirm PIN section
	
	//confirm PIN section
	
	public function loginSecurityQuestion() {
		$this->template->set ( 'page', 'users/security-question' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/security-question');
	}
	
	//confirm PIN section
	
	//OTP Confirmation Message section
	
	public function OTPConfirmationMessage() {
		$this->template->set ( 'page', 'users/OTP-Confirmation-message' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/OTP-Confirmation-message');
	}
	
	//OTP Confirmation Message section
	
	//set new password section
	
	public function setNewPassword() {
		$this->template->set ( 'page', 'users/set-new-password' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/set-new-password');
	}
	
	//set new password section
	
	//password reset successfull section
	
	public function resetPasswordSuccessfull() {
		$this->template->set ( 'page', 'users/reset-successfull' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/reset-successfull');
	}
	
	//password reset successfull section
	//Welcome Message section
	
	public function welcomeMessage() {
		$this->template->set ( 'page', 'users/welcome-message' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/welcome-message');
	}
	
	//Welcome Message section
	
	//Access Error Message section
	
	public function accessErrorMessage() {
		$name = $this->session->userdata ( 'olousername' );
		$attempts = $this->session->userdata ( 'olouserattempts' );
		$this->template->set ( 'name', $name );
		$this->template->set ( 'attempts', $attempts );
		$this->template->set ( 'page', 'users/access-error-message' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/access-error-message');
	}
	
	//Access Error Message section
	
	//Suspended Account section
	
	public function suspendedAccount() {
		$name = $this->session->userdata ( 'olousername' );
		$this->template->set ( 'name', $name );
		$this->template->set ( 'page', 'users/suspended-account' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('users/suspended-account');
	
	}
	
}

