<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Administrator control panel' )
		->set_partial ( 'header', 'partials/header_login' )
		->set_partial ( 'leftnav', 'partials/menu' )
		->set_partial ( 'footer', 'partials/footer_login' );
		$this->template->build ('login');
	}
	
	public function dashboard() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Administrator control panel' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('dashboard');
	}
	
	public function adminlogin() {
		$data['email'] = trim($this->input->post('email'));
		$data['password'] = $this->input->post('password');
		$this->load->library('zyk/adminauth');
		$result = $this->adminauth->login($data);
		if($result['status'])
		{
			$this->session->set_userdata('adminsession',$result['result']);
			//$this->session->set_userdata ( 'adminfname', $result['first_name'] );
		}
		echo json_encode($result);	
	}
	
	/**
   	 * Code For Logout Functionality
   	 */
   	public function logout() {
   		$this->session->unset_userdata('adminsession');
   		redirect(base_url()."admin");
   	}
	

	/**
	 * View Change Password
	 */
	public function view_change_password() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
			 ->title ( 'FreightBazaar | Change Password' )
			 ->set_partial ( 'header', 'partials/header' )
			 ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('change_password');
	}
	
	/**
	 * Edit Password
	 */
	public function editPassword()
	{
		
		$param['updated_by'] = $this->session->userdata['adminsession']['id'];
		$params['updated_date'] = date('Y-m-d H:i:s');
		$param = $this->input->post('data');
		$newpassword = $param['text_password'];
		$password = MD5($newpassword);
		
		$data = array();
		$data['uid'] = $this->session->userdata['adminsession']['id'];
		$data['oldpassword'] = $param['oldpassword'];
		$data['password'] = $password;
		$data['text_password'] = $param['text_password'];
		$this->load->library('zyk/adminauth');
		$response = $this->adminauth->checkPassword($data);
		$map = array();
		if($response['status'] == 1){
			$boolvalue = $this->adminauth->editPassword($data);
			if($boolvalue == 1)
			{
				$map['status'] = 1;
				$map['msg'] = "Password updated successfully";
			}
			else
			{
				$map['status'] = 0;
				$map['msg'] = "Failed to change password";
			}
		}
		else
		{
			$map = $response;
		}
		echo json_encode($map);
	}
	public function userList()
	{
		$this->load->library('zyk/adminauth');
		$users = $this->adminauth->getUserList();
		$this->template->set('users',$users);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Users' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('user/userList');
	}
	public function turnonof()
	{
		$data = array();
		$data['status'] = $this->input->get('status');
		$data['id'] = $this->input->get('id');
		$this->load->library('zyk/adminauth');
		$users = $this->adminauth->turnonof($data);
		return 1;
	}
	public function assignRole()
	{
		$data = array();
		$data['user_role'] = $this->input->get('role');
		$data['id'] = $this->input->get('id');
		$this->load->library('zyk/adminauth');
		$users = $this->adminauth->assignRole($data);
		return 1;
		
	}
	public function addAdminUser() {
		$fname = $this->input->post('first_name');
		$lname = $this->input->post('last_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$status = $this->input->post('status');
		$user_role= $this->input->post('user_role');
		$data = array();
		$data = array(
				'first_name' => $fname,
				'last_name' => $fname,
				'email' => $email,
				'mobile' => $mobile,
				'user_role' => $user_role,
				'password' => $password,
				'status' => $status
		);
		$this->load->library('zyk/Lead', 'lead');
		$response = $this->lead->addLead($data);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('lead/lead-form');
	}
	
}
