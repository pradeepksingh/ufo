<?php
class Adminauth {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function login($umap) {
		$this->CI->load->model ( 'adminusers/user_model', 'adminuser' );
		$user_details = $this->CI->adminuser->getUserDetailByEmail( $umap['email'] );
		$map = array();
		if (count($user_details) > 0) {
			if (MD5($umap['password']) === $user_details[0]['password']) {
				if ($user_details[0]['status'] == 1) {
					$user = array();
					$user['first_name'] = $user_details[0]['first_name'];
					$user['last_name'] = $user_details[0]['last_name'];
					$user['email'] = $user_details[0]['email'];
					$user['mobile'] = $user_details[0]['mobile'];
					$user['id'] = $user_details[0]['id'];
					$user['user_role'] = $user_details[0]['user_role']; 
					$map ['status'] = 1;
					$map ['msg'] = "Logged in successfully.";
					$map ['result'] = $user;
					return $map;
				} else {
					$map ['status'] = 0;
					$map ['msg'] = "Login to this site have been blocked by Admin.";
					$errors = array ();
					array_push ( $errors, "Unautharised access blocked." );
					$map ['errormsg'] [] = $errors;
					return $map;
				}
			} else {
				$map ['status'] = 0;
				$map ['msg'] = "Email or password is wrong.";
				$errors = array ();
				array_push ( $errors, "Email or password is wrong." );
				$map ['errormsg'] [] = $errors;
				return $map;
			}
		} else {
			$map ['status'] = 0;
			$map ['msg'] = "Email or password is wrong.";
			$errors = array ();
			array_push ( $errors, "Email or password is wrong." );
			$map ['errormsg'] [] = $errors;
			return $map;
		}
		
	}
	
	public function logout() {
		
	}
	
	/**
	 * Code For Edit Password
	 * @return integer
	 */
	public function editPassword($data)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $userdetail = $this->CI->adminuser->editPassword($data);
	}
	
	/**
	 * Code For Check Password
	 * @return integer
	 */
	public function  checkPassword($data)
	{
		$response = array();
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =  $userdetail = $this->CI->adminuser->checkPassword($data);
		if(count($result) > 0)
		{
			$response['status'] = 1;
			$response['msg'] = "Record Found";
		}
		else
		{
				
			$response['status'] = 0;
			$response['msg'] = "Old Password Not correct";
		}
		return $response;
	}
	public function getUserList()
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->getUsers();
		return $result;
	}
	public function turnonof($data)
	{
		unset($data['comment']);
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->updateUser($data);
		return $result;
	}
	public function assignRole($data)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->updateUser($data);
		return $result;
	}
	public function getAdminUsers() {
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $this->CI->adminuser->getActiveUsers();
	}
	public function addAdminUser($data){
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $this->CI->adminuser->addAdminUser($data);
	}
	public function updateAdminUser($data){
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $this->CI->adminuser->updateAdminUser($data);
	}
	public function getUserById($id)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->getUserById($id);
		return $result;
	}
	
}
