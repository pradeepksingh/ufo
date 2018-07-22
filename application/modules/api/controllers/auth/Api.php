<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	public function loginUser_post() 
	{
		$data = array();
		$data['username'] = $this->post('username');
		
		$data['password'] = $this->post('password');
		
		$this->load->library('fb/auth');
		$userdata = $this->auth->login($data);
		if($userdata['status'] == 1) {
			if($userdata['result']['status'] == 1 && $userdata['result']['terms_accepted'] == 1
					&& $userdata['result']['cce_verify'] == 1 && $userdata['result']['otp_verify'] == 1  ) {
						$this->session->set_userdata('fbuser',$userdata['result']);
						$this->session->set_userdata('fbuserid',$userdata['result']['id']);
					}
		}
		echo json_encode($userdata);
	}
	/**
	 * code for accept trems and condition
	 */
	public function acceptTermsCondition_post()
	{
		$userdata = array();
		$userdata['id'] = $this->post('id');
		$userdata['terms_accepted'] = 1;
		$this->load->library('fb/userLib');
		$boolvalue = $this->userlib->updateUserById($userdata);
		if($boolvalue == 1)
		{
			$data = array();
			$data['status'] = 1;
			$data['message'] = "Terms and condition updated successfully";
			
			$this->response ( $data,200);
			
		}
		else
		{
			$data = array();
			$data['status']  = 0;
			$data['message'] = "Error in updating Terms and condition ";
				
			$this->response ( $data,200);
		}
	}
	
	/**
	 * 
	 * 
	 */
	public function initRegister_get()
	{
		$this->load->library('fb/general');
		$states = $this->general->getStates();
		$membership = $this->general->getMemebership();
		
		$data = array();
		$data['states'] = $states;
		$data['membership'] = $membership;
		
		$this->response ($data,200 );
		
		
	}
	/**
  	* code for save data of business
    */
   	public  function saveBusinessUser_post()
   	{
   		$map = array();
   		$user_data = json_decode($this->post('user_data',true),true);
   		$business_data = json_decode($this->post('business_data',true),true);
   		$this->load->library('fb/userLib');
   		$result = $this->userlib->checkUserEmailAndMobile($user_data['email'],$user_data['mobile']);
   		if($result['old_email'] == true) {
   			$map ['status'] = 2;
   			$map ['msg'] = "Email already registered on FreightBazaar.";
   		} else if($result['old_mobile'] == true) {
   			$map ['status'] = 2;
   			$map ['msg'] = "Mobile already registered on FreightBazaar.";
   		} else {
	   		$service_offered['service_offered'] = json_decode($this->post('service_offered',true),true);
	   	
	   		
	   		$params = array();
	   		$params = array_merge($user_data,$business_data);
	   		
	   		
	   		$_POST = $params;
	   		
	   		
		   	$this->load->helper('utility_helper');
		   	$this->load->helper ( array (
		   			'form',
		   			'url'
		   	) );
		   	$errors = array ();
		   	$this->load->library ( 'form_validation' );
		   	$errorMsg = array ();
		   	$err_num = 0;
		   
		    $this->form_validation->set_rules ( 'cust_type', 'Customer Type', 'trim|required' );
		   	$this->form_validation->set_rules ( 'busi_type', 'Business Type', 'trim|required' );
		   	$this->form_validation->set_rules ( 'business_entity', 'Business Entity', 'trim|required' );
		   	$this->form_validation->set_rules ( 'company_establish_date', 'Company establishment date', 'required|required' );
		   	$this->form_validation->set_rules ( 'busi_name', 'Business Name', 'trim|required' );
		   	$this->form_validation->set_rules ( 'mobile', 'Mobile Number', 'trim|required|numeric|max_length[10]' );
		   	$this->form_validation->set_rules ( 'first_name', 'First Name', 'trim|required' );
		   	$this->form_validation->set_rules ( 'last_name', 'Last Name', 'trim|required' );
		   	$this->form_validation->set_rules ( 'address', 'Address', 'trim|required' );
		   	$this->form_validation->set_rules ( 'locality', 'Locality', 'trim|required' );
		   	$this->form_validation->set_rules ( 'city', 'city', 'trim|required' );
		   	$this->form_validation->set_rules ( 'state_id', 'state', 'trim|required' );
		   	$this->form_validation->set_rules ( 'pincode', 'Pincode', 'trim|required|numeric|max_length[6]' );
		   	$this->form_validation->set_rules ( 'pancard', 'Pancard Number', 'trim|required' );
		   	$this->form_validation->set_rules ( 'email', 'Email', 'trim|required' );
		   	//$this->form_validation->set_rules ( 'text_password', 'Password', 'trim|required' );
		   	if(empty($_FILES['pancard_image']['name'])){
		   		$this->form_validation->set_rules ( 'pancard_image', 'Pancard Image', 'trim|required' );
		   	}
		   	if(empty($_FILES['img_busi_reg']['name']))
		   	{
		   		$this->form_validation->set_rules ( 'img_busi_reg', 'Business Registration Image', 'trim|required' );
		   	}
		   	$this->form_validation->set_rules ( 'busi_description', 'Business Descreption', 'trim|required' );
		   	$cust_type = $business_data['cust_type'];
		   	if($cust_type == 1 || $cust_type == 0)	{  //Truck User
		   		$this->form_validation->set_rules ( 'vehicle_required', 'Number Of Vehicle Required', 'trim|required|numeric' );
		   		$this->form_validation->set_rules ( 'no_of_gps_system_required', 'No of trucks with GPS system required', 'trim|required|numeric' );
		   	}
		   	if($cust_type == 2 || $cust_type == 0)	{ //Truck Supplier
		   		$this->form_validation->set_rules ( 'vehicle_owned', 'Number of Vehicle Owned', 'trim|required' );
		   		$this->form_validation->set_rules ( 'no_of_gps_system', 'No of vehicles with GPS system available', 'trim|required|numeric' );
		   	}
		   	//$this->form_validation->set_rules ( 'service_offered[]', 'Service Offered', 'trim|required' ); 
		 if ($this->form_validation->run () == FALSE) 
		   	{
		   		echo validation_errors();
		   		$errors = array ();
	  	   		$error = array("cust_type"=>strip_tags ( form_error ( 'cust_type' )));
	  	   		
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("busi_type"=>strip_tags ( form_error ( 'busi_type' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("business_entity"=>strip_tags ( form_error ( 'business_entity' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("company_establish_date"=>strip_tags ( form_error ( 'company_establish_date' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("busi_name"=>strip_tags ( form_error ( 'busi_name' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("mobile"=>strip_tags ( form_error ( 'mobile' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("first_name"=>strip_tags ( form_error ( 'first_name' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("last_name"=>strip_tags ( form_error ( 'last_name' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("address"=>strip_tags ( form_error ( 'address' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("locality"=>strip_tags ( form_error ( 'locality' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("city"=>strip_tags ( form_error ( 'city' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("state_id"=>strip_tags ( form_error ( 'state_id' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("pincode"=>strip_tags ( form_error ( 'pincode' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("pancard"=>strip_tags ( form_error ( 'pancard' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		$error = array("email"=>strip_tags ( form_error ( 'email' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}  
		   		if(empty($_FILES['pancard_image']['name'])){
			   		$error = array("pancard_img"=>strip_tags ( form_error ( 'pancard_image' )));
			   		if (! empty ( $error )) {
			   			array_push ( $errors, $error );
			   		}
		   		}
		   		if(empty($_FILES['img_busi_reg']['name'])){
			   		$error = array("busi_reg_cert_img"=>strip_tags ( form_error ( 'img_busi_reg' )));
			   		if (! empty ( $error )) {
			   			array_push ( $errors, $error );
			   		}
		   		}
		   		$error = array("busi_description"=>strip_tags ( form_error ( 'busi_description' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		}
		   		if($cust_type == 1 || $cust_type == 0)	{  //Truck User
			   			$error = array("vehicle_required"=>strip_tags ( form_error ( 'vehicle_required' )));
			   			if (! empty ( $error )) {
			   				array_push ( $errors, $error );
			   			}
			   			$error = array("no_of_gps_system_required"=>strip_tags ( form_error ( 'no_of_gps_system_required' )));
			   			if (! empty ( $error )) {
			   				array_push ( $errors, $error );
			   			}
		   		}
		   		if($cust_type == 2 || $cust_type == 0) { //Both
			   			$error = array("vehicle_owned"=>strip_tags ( form_error ( 'vehicle_owned' )));
			   			if (! empty ( $error )) {
			   				array_push ( $errors, $error );
			   			}
			   			$error = array("no_of_gps_system"=>strip_tags ( form_error ( 'no_of_gps_system' )));
			   			if (! empty ( $error )) {
			   				array_push ( $errors, $error );
			   			}
		   		}
		   		/* $error = array("service_offered"=>strip_tags ( form_error ( 'service_offered' )));
		   		if (! empty ( $error )) {
		   			array_push ( $errors, $error );
		   		} */
		   		$errorMsg [$err_num] ["errors"] = $errors;
		   		$err_num ++;
		   	} 
		   	$map = array ();
		  
			if (count ( $errorMsg ) <= 0) 
			{
				
				
				$member_type = $business_data['member_type'];
				
				$city1 = $business_data['city'];
				
				$destination_city = explode(',',$city1);
				$city = trim($destination_city[0]);
		   		$user = array();
		   		$business = array();
		   		$user['first_name'] = $user_data['first_name'];
		   		$user['last_name'] = $user_data['last_name'];
		   		$user['email'] = $user_data['email'];
		   		$user['password'] = $user_data['text_password'];
		   		$user['landline'] = $user_data['landline'];
		   		$user['mobile'] = $user_data['mobile'];
		   		$user['terms_accepted'] = 1;
		   		$user['is_mobile'] = 1;
		   		$user['machine_id'] = 0;
		   	
		   		if (!empty($_FILES['user_photo']['name'])) 
		   		{
		   			
		   			$user_photo1 = $_FILES['user_photo']['name'];
		   			$profilelocation = 'assets/images/customer/profile/';
		   			$user_photoImg = uploadImage($_FILES['user_photo'],$profilelocation,array('jpeg','jpg','png','gif'),4097152,'avatar');
		   		
		   			if($user_photoImg['status'] == 1) {
		   				$user['avatar'] =  $user_photoImg['image'];
		   			} else {
		   				$error = array("avatar"=>$user_photoImg['msg']);
		   				if (! empty ( $error )) {
		   					array_push ( $errors, $error );
		   				}
		   				$errorMsg["errors"] = $errors;
		   				$user_photoImg['errormsg'] = $errorMsg;
		   				echo json_encode($user_photoImg);
		   				exit;
		   			}
		   		}
		   		/* if(!empty($this->input->post('company_establish_date')))
		   			$business['company_establish_date'] = date('Y-m-d',strtotime($this->input->post('company_establish_date')));
		   		else  */
		   		
		   		$business['company_establish_date'] ="2016-02-15";
		   		$business['cust_type'] = $business_data['cust_type'];
		   		$business['business_entity'] = $business_data['business_entity'];
		   		$business['busi_type'] = $business_data['busi_type'];
		   		$business['busi_name'] = $business_data['busi_name'];
		   		$business['website'] = $business_data['website'];
		   		$business['pancard'] = $business_data['pancard'];
		   	    $business['busi_reg_no'] = $business_data['busi_reg_no'];
		   	    $business['membership_type'] = $business_data['member_type'];
		   	    $business['busi_description'] =  $business_data['busi_description'];
		   		$business['vehicle_required'] = $business_data['vehicle_required'];
		   		$business['vehicle_owned'] = $business_data['vehicle_owned'];
		   		$business['state_id'] = $business_data['state_id'];
		   		$business['city'] = $city;
		   		$business['locality'] = $business_data['locality'];
		   		$business['address'] = $business_data['address'];
		   		$business['pincode'] = $business_data['pincode'];
		   		$business['no_of_gps_system'] = $business_data['no_of_gps_system'];
		   		$business['no_of_gps_system_required'] =$business_data['no_of_gps_system_required'];
		   		$business['service_offered'] = $business_data['service_offered'];
		   			
		   	
		   		$trucktype_array = json_decode($this->post('vehicle_type',true),true);
		   	
		   	
		   		$branchname_array  = json_decode($this->post('branch_name',true),true);
		   		$branchaddress_array = json_decode($this->post('branch_address',true),true);
		   		$stateoperated_array = json_decode($this->post('stateoperated',true),true);
		   		$fromlocation_array = json_decode($this->post('From_Location',true),true);
		   		$tolocation_array = json_decode($this->post('To_Location',true),true);
		   		$fromlat_array = json_decode($this->post('fromlatitude',true),true);
		   		$fromlong_array = json_decode($this->post('fromlongitude',true),true);
		   		$tolat_array = json_decode($this->post('tolatitude',true),true);
		   		$tolong_array = json_decode($this->post('tolongitude',true),true);
		   	
		   		if (!empty($_FILES['comp_logo']['name'])) {
		   			$comp_logo1 = $_FILES['comp_logo']['name'];
		   			$compnylogolocation ='assets/images/customer/company_logo/';
		   			$complogoImg = uploadImage($_FILES['comp_logo'],$compnylogolocation,array('jpeg','jpg','png','gif'),4097152,'logo');
		   			if($complogoImg['status'] == 1) {
		   				$business['company_logo_img'] =  $complogoImg['image'];
		   			} else {
		   				$error = array("company_logo_img"=>$complogoImg['msg']);
		   				if (! empty ( $error )) {
		   					array_push ( $errors, $error );
		   				}
		   				$errorMsg["errors"] = $errors;
		   				$complogoImg['errormsg'] = $errorMsg;
		   				echo json_encode($complogoImg);
		   				exit;
		   			}
		   		}
		   		if (!empty($_FILES['office_photo']['name'])) {
		   			$office_photo1 = $_FILES['office_photo']['name'];
		   			$officelocation ='assets/images/customer/office_image/';
		   			$officephotoImg = uploadImage($_FILES['office_photo'],$officelocation,array('jpeg','jpg','png','gif'),4097152,'office');
		   			if ($officephotoImg['status'] == 1) {
		   				$business['office_img'] = $officephotoImg['image'];
		   			} else {
		   				$error = array("office_img"=>$officephotoImg['msg']);
		   				if (! empty ( $error )) {
		   					array_push ( $errors, $error );
		   				}
		   				$errorMsg["errors"] = $errors;
		   				$officephotoImg['errormsg'] = $errorMsg;
		   				echo json_encode($officephotoImg);
		   				exit;
		   			}
		   		}
		   		if (!empty($_FILES['business_pancard_image']['name'])) {
		   			$pancard_image1 = $_FILES['business_pancard_image']['name'];
		   			$pancardlocation ='assets/images/customer/pancard/';
		   			$bpancardImg = uploadImage($_FILES['business_pancard_image'],$pancardlocation,array('jpeg','jpg','png','gif','pdf'),4097152,'bpancard');
		   			if ($bpancardImg['status'] == 1) {
		   				$business['business_pancard_image'] = $bpancardImg['image'];
		   			} else {
		   				$error = array("business_pancard_image"=>$bpancardImg['msg']);
		   				if (! empty ( $error )) {
		   					array_push ( $errors, $error );
		   				}
		   				$errorMsg["errors"] = $errors;
		   				$bpancardImg['errormsg'] = $errorMsg;
		   				echo json_encode($bpancardImg);
		   				exit;
		   			}
		   		}
		   		if (!empty($_FILES['pancard_image']['name'])) {
		   		
		   			$pancard_image1 = $_FILES['pancard_image']['name'];
		   			$pancardlocation ='assets/images/customer/pancard/';
		   			$pancardImg = uploadImage($_FILES['pancard_image'],$pancardlocation,array('jpeg','jpg','png','gif','pdf'),4097152,'pancard');
		   		
		   			if ($pancardImg['status'] == 1) {
		   				$business['pancard_img'] = $pancardImg['image'];
		   			} else {
		   				$error = array("pancard_img"=>$pancardImg['msg']);
		   				if (! empty ( $error )) {
		   					array_push ( $errors, $error );
		   				}
		   				$errorMsg["errors"] = $errors;
		   				$pancardImg['errormsg'] = $errorMsg;
		   				echo json_encode($pancardImg);
		   				exit;
		   			}
		   		}
		   		if (!empty($_FILES['img_busi_reg']['name'])) {
		   			$img_busi_reg1 = $_FILES['img_busi_reg']['name'];
		   			$businessreglocation ='assets/images/customer/business_registration/';
		   			$businessRegImg = uploadImage($_FILES['img_busi_reg'],$businessreglocation,array('jpeg','jpg','png','gif','pdf'),4097152,'certificate');
		   			
		   			if ($businessRegImg['status'] == 1) 
		   			{
		   				
		   				$business['busi_reg_cert_img'] = $businessRegImg['image'];
		   			} else 
		   			{
		   				$error = array("busi_reg_cert_img"=>$businessRegImg['msg']);
		   				if (! empty ( $error )) 
		   				{
		   					array_push ( $errors, $error );
		   				}
		   				$errorMsg["errors"] = $errors;
		   				$businessRegImg['errormsg'] = $errorMsg;
		   				echo json_encode($businessRegImg);
		   				exit;
		   			}
		   		}
		   		
		   		$this->load->library('fb/businesslib');
		   		$map = $this->businesslib->addBusiness($business);
		   		
		   		if($map['status'] == 0) 
		   		{
		   			echo json_encode($map);
		   			
		   			exit;
		   		} else {
		   			$busi_id = $map['busi_id'];
		   			if($member_type == 1 || $member_type == 2)
		   			{
		   				$user['user_role'] = 2;
		   			}
		   			else if($member_type == 3 || $member_type == 4)
		   			{
		   				$user['user_role'] = 1;
		   			}
		   			else
		   			{
		   				$user['user_role'] = 2;
		   			}
		   			$user['busi_id'] = $busi_id;
		   			$userid = $this->businesslib->addUser($user);
		   			$map['userid'] = $userid;
			   		$branch_count = count($branchname_array);
			   		if($branch_count > 0)
			   		{
			   			$branches = array();
			   			for ($i = 0; $i < $branch_count; $i++) {
			   				if($branchname_array[$i] != ""){
			   					$branch = array();
			   					$branch['branch_name'] = $branchname_array[$i];
			   					$branch['branch_address'] = $branchaddress_array[$i];
			   					$branch['busi_id'] = $busi_id;
			   					$branches[] = $branch;
			   				}
			   			}
			   			if(count($branches) > 0){
			   				$this->businesslib->addBusibranches($branches);
			   			}
			   		}
			   		// Code for insert Business  Vehicle Types
			   		$vehicle_count = count($trucktype_array);
			   		if($vehicle_count > 0)
			   		{
			   			$vehicletypes = array();
			   			for($i = 0; $i < $vehicle_count; $i++){
			   				$vehicletype = array();
			   				$vehicletype['vehicle_type_id'] = $trucktype_array[$i];
			   				$vehicletype['busi_id'] = $busi_id;
			   				$vehicletypes[] = $vehicletype;
			   			}
			   			if(count($vehicletypes) > 0)
			   				$this->businesslib->updateBusinessVehicles($vehicletypes);
			   		}
			   		//Code for insert Business StateOperated
			   		$state_count = count($stateoperated_array);
			   		if($state_count > 0)
			   		{
			   			$stateoperated = array();
			   			for($i = 0; $i < $state_count; $i++){
			   				$stateop = array();
			   				$stateop['state_id'] = $stateoperated_array[$i];
			   				$stateop['busi_id'] = $busi_id;
			   				$stateoperated[] = $stateop;
			   			}
			   			if(count($stateoperated) > 0)
			   				$this->businesslib->updateBusinessStates($stateoperated);
			   		}
			   		
			   		//Code for insert Business Routes
			   		$route_count = count($fromlocation_array);
			   		if($route_count > 0)
			   		{
			   			$routes = array();
			   			for($i = 0; $i < $route_count; $i++){
			   				if($fromlocation_array[$i] != ""){
			   					$route['from_location'] = $fromlocation_array[$i];
			   					$route['to_location'] = $tolocation_array[$i];
			   					$route['from_lat'] = $fromlat_array[$i];
			   					$route['from_lng'] = $fromlong_array[$i];
			   					$route['to_lat'] = $tolat_array[$i];
			   					$route['to_lng'] = $tolong_array[$i];
			   					$route['busi_id'] = $busi_id;
			   					$routes[] = $route;
			   				}
			   			}
			   			if(count($routes) > 0){
			   				$this->businesslib->updateBusinessRoutes($routes);
			   			}
			   		}
		   		}
		   	}
		   	else
		   	{
		   		$map = array();
		   		$map ['status'] = 0;
				$map ['msg'] = "Failed to add business details.";
				$map ['errormsg'] = $errorMsg;
	   		}
   		}
   		echo json_encode($map);
 	}
 	
 	
 	/**
 	 * fuction to check OTP
 	 *
 	 *
 	 * @return JSON
 	 */
 	public function checkOtp_post()
 	{
 		$map = array();
 		$otpverification=array(
 				'id'=>$this->post('userid'),
 				'otp'=>$this->post('otp'),
 		);
 		$this->load->library('fb/userLib');
 		if($this->userlib->isOTPValid($this->post('userid'),$this->post('otp'))) {
 			$this->userlib->updateUserByOtp($otpverification);
 			$map['status'] = 1;
 			$map['message'] = "OTP verified successfully.";
 		} else {
 			$map['status'] = 0;
 			$map['message'] = "Invalid OTP.";
 		}
 		echo json_encode($map);
 	}
 	public function regenerateOTP_post()
 	{
 		print_r("hi");
 		$this->load->library('fb/businesslib');
 		$userid = $this->post('userid');
 		$map = array();
 		if($this->businesslib->regenerateOTP($userid)) {
 			$map['status'] = 1;
 			$map['message'] = 'OTP sent to your registered mobile and email.';
 		} else {
 			$map['status'] = 0;
 			$map['message'] = 'Failed to regenerate OTP.';
 		}
 		echo json_encode($map);
 	}
 	
	 
	public function editPassword_post()
	{
		$user_id = $this->post('user_id');
		$param =json_decode($this->post('params',true),true);
		$newpassword = $param['text_password'];
		$password = MD5($newpassword);
		$param['password'] = $password;
		$this->load->library('fb/auth');
		$response = $this->auth->checkPassword($param);
		$map = array();
		if($response['status'] == 1){
			$param['id'] = $user_id;
			$boolvalue = $this->auth->editPassword($param);
			if($boolvalue == 1)
			{
				$map['status'] = 1;
				$map['msg'] = "Password updated successfully";
				
				$this->response($map,200);
			}
			else
			{
				$map['status'] = 0;
				$map['msg'] = "Failed to change password";
				
				$this->response($map,200);
			}
		}
		else
		{
		
				$map['status'] = 0;
				$map['msg'] = "Failed to change password";
				
				$this->response($map,200);
			
		}
		
	}
	/**
	 * Code For Logout Functionality
	 */
	public function logout_post() {
		$userid = $this->post('user_id');
		
		
		$response = array();
		$userdata = array();
		$userdata['id'] = $userid;
		$userdata['last_visit_date'] = date('Y-m-d H:i:s');
		$this->load->library('fb/userLib');
		$userdata = $this->userlib->updateUserById($userdata);
		
		if($userdata)
		{
			$response['status'] = 1;
			$response ['result'] = $userdata;
			
			$this->response($response,200);
			
		}
		else
		{
			$response['status'] = 0;
			$response ['result'] = $userdata;
				
			$this->response($response,200);
		}
	}
	
	public function loginDetail_post() {
		$getdata = $this->post();
		error_log(json_encode($_POST),0);
		echo json_encode($getdata);
	}
	
}

	