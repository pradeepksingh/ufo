<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Trucks API
 * @author Pradeep Singh
 * @package users
 *
 */
class Api extends REST_Controller
{
	private $CI;
	
	public function signup_post() {
		$da = array ();
		$reg = array ();
		$reg ['name'] = $this->post ( 'name' );
		$reg ['password'] = $this->post ( 'password' );
		$reg ['email'] = $this->post ( 'email' );
		$reg ['mobile'] = $this->post ( 'mobile' );
		$reg ['client_id'] = $this->post ( 'client_id' );
		if (isset ( $_FILES ['avtar'] )) {
			if ($_FILES ['avtar'] != "") {
				$image_path = 'assets/images/user/';
				$temp_image = explode ( ".", $_FILES ['avtar'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$reg ['avatar'] = 'images/user/'.$image;
				move_uploaded_file ( $_FILES ['avtar'] ['tmp_name'], $image_path .$image );
			}
		} else {
			$reg ['avatar'] = '';
		}
	
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
			$this->userloginlib->createWallet($params);
		} else {
			$exist['is_register'] = 0;
		}
		$this->response ( $exist,200);
	}
	
	public function verifyotp_post() {
		$userid = $this->post('userid');
		$otp = $this->post('otp');
		$this->load->library ( 'zyk/UserLoginLib' );
		$user = $this->userloginlib->otpMatch ( $userid, $otp );
		$this->response ( $user[0],200);
	}
	
	public function login_post() {
		$login = array ();
		$login ['mobile'] = $this->post ( 'mobile' );
		$login ['password'] = $this->post ( 'password' );
		if(!empty($this->post ( 'client_id' )))
		$login ['client_id'] = $this->post ( 'client_id' );
		$this->load->library ( 'zyk/UserLoginLib' );
		$user = $this->userloginlib->login ( $login );
		if(count($user) > 0) {
			$this->response ( $user[0],200);
		} else {
			$user['status'] = 0;
			$user['msg'] = "User name or password wrong";
			$this->response ( $user,200);
		}
	}
	
	public function forgetpassword_post(){
		$this->load->library ( 'zyk/UserLoginLib' );
		$mobile = $this->post ( 'mobile' );
		$client_id = $this->post ( 'client_id' );
		if(empty($mobile)) {
			$this->response ( array('msg'=>'Mobile Number Required.','status'=>0),200);
		}
		$data = $this->userloginlib->forgetPassword ( $mobile,$client_id );
		$result = array();
		if($data[0]['status'] == 1) {
			$result['status'] = 1;
			$result['msg'] = 'success';
			unset($data[0]['password']);
			$result['data'] = $data[0];
		} else {
			$result['status'] = 0;
			$result['msg'] = 'This mobile is not registered with us.';
		}
		$this->response ( $result,200 );
	}
	
	public function newpassword_post() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$params = array();
		$params['id'] = $this->post ( 'userid' );
		$params['password'] = md5($this->post ( 'password' ));
		$otp = $this->post ( 'otp' );
		if(empty($params['id'])) {
			$this->response ( array('msg'=>'User Id Required.','status'=>0),200);
		}
		if(empty($params['password'])) {
			$this->response ( array('msg'=>'Password Required.','status'=>0),200);
		}
		if(empty($otp)) {
			$this->response ( array('msg'=>'OTP Required.','status'=>0),200);
		}
		$profile = $this->userloginlib->getProfile($params['id']);
		$result = array();
		if($profile[0]['otp'] == $otp) {
			$this->userloginlib->updateUserProfile ( $params );
			$result['status'] = 1;
			$result['msg'] = 'success';
			unset($profile[0]['password']);
			$result['data'] = $profile[0];
		} else {
			$result['status'] = 0;
			$result['msg'] = 'OTP do not matched.';
		}
		$this->response ( $result,200 );
	}
	
	public function changepassword_post() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$params = array();
		$params['id'] = $this->post ( 'userid' );
		$params['password'] = md5($this->post ( 'password' ));
		if(empty($params['id'])) {
			$this->response ( array('msg'=>'User Id Required.','status'=>0),200);
		}
		if(empty($params['password'])) {
			$this->response ( array('msg'=>'Password Required.','status'=>0),200);
		}
		$result = array();
		$this->userloginlib->updateUserProfile ( $params );
		$result['status'] = 1;
		$result['msg'] = 'success';
		$result['id'] = $params['id'];
		$this->response ( $result,200 );
	}
	
	public function profile_get() {
		$userid = $this->get('userid');
		$this->load->library ( 'zyk/UserLoginLib' );
		$profile = $this->userloginlib->getProfile ( $userid );
		$address = $this->userloginlib->getAddressById ( $userid );
		unset($profile[0]['password']);
		$resp = array();
		$resp['profile'] = $profile[0];
		$resp['address'] = $address;
		$this->response ( $resp,200 );
	}
	
	public function orders_get() {
		$userid = $this->get('userid');
		$this->load->library ( 'zyk/UserLoginLib' );
		$orders = $this->userloginlib->getOrderDetailByUserId ( $userid );
		$this->response ( $orders,200 );
	}
	
	public function address_get() {
		$id = $this->get('address_id');
		$this->load->library ( 'zyk/UserLoginLib' );
		$address = $this->userloginlib->getAddressByAddressId ( $id );
		$this->response ( $address[0],200 );
	}
	
	public function updateprofile_post() {
		$data = array ();
		if ($this->post ( 'name' ) != '') {
			$data ['name'] = $this->post ( 'name' );
		}
		$data ['id'] = $this->post('userid');
		if(!empty($this->post('avatar')))
		{
			$data ['avatar'] = $this->post('avatar');
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->updateUserProfile ( $data );
		$this->response (array('status'=>1,'msg'=>'Updated Successfully.'),200 );
	}
	
	public function updateaddress_post() {
		$id = $this->get('address_id');
		$this->load->library ( 'zyk/UserLoginLib' );
		$data ['address'] = $this->post ( 'address' );
		$data ['address_name'] = $this->post ( 'address_name' );
		$data ['longitude'] = $this->post ( 'longitude' );
		$data ['latitude'] = $this->post ( 'latitude' );
		$data ['areaid'] = $this->post ( 'areaid' );
		$data ['userid'] = $this->post ( 'userid' );
		$data ['locality'] = $this->post ( 'locality' );
		$data ['landmark'] = $this->post ( 'landmark' );
		$data ['is_primary'] = 0;
		$data ['id'] = $this->input->post ( 'id' );
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->userloginlib->updateAddress ( $data );
		$this->response (array('status'=>1,'msg'=>'Updated Successfully.'),200 );
	}
	
	public function addaddress_post() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$data ['address'] = $this->post ( 'address' );
		$data ['address_name'] = $this->post ( 'address_name' );
		$data ['longitude'] = $this->post ( 'longitude' );
		$data ['latitude'] = $this->post ( 'latitude' );
		$data ['areaid'] = $this->post ( 'areaid' );
		$data ['userid'] = $this->post ( 'userid' );
		$data ['locality'] = $this->post ( 'locality' );
		$data ['landmark'] = $this->post ( 'landmark' );
		$data ['is_primary'] = 0;
		$this->load->library ( 'zyk/UserLoginLib' );
		$add_id = $this->userloginlib->addAddress ( $data );
		$this->response (array('status'=>1,'msg'=>'Added Successfully.','address_id'=>$add_id),200 );
	}
	
	public function walletbalance_get() {
		$userid = $this->get('userid');
		if(empty($userid)) {
			$this->response (array('status'=>0,'msg'=>'User Id required.'),200 );
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$wallet = $this->userloginlib->getWalletBalance($userid);
		$transactions = $this->userloginlib->getWalletTransactions($userid);
		$resp = array();
		$resp['wallet'] = $wallet;
		$resp['transactions'] = $transactions;
		$resp['status'] = 1;
		$this->response ($resp,200 );
	}
	
	
}