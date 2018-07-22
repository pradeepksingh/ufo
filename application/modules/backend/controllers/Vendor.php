<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Vendor extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$map = array();
		$map['status'] = $this->input->get('status');
		$restaurants = $this->restaurantlib->getRestaurants($map);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/VendorList');
	}

	
	public function newRestaurant() {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$areas = $this->general->getAreas();
		//$cuisines = $this->general->getCuisines();
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		//$this->template->set('cuisines',$cuisines);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/VendorAdd');
	}
	
	public function addRestaurant() {
		$response = array();
		$rest = array();
		//$rest['cityid'] = $this->input->post('cityid');
		//$rest['areaid'] = $this->input->post('areaid');
		$rest['name'] = $this->input->post('name');
		$rest['address'] = $this->input->post('address');
		$rest['email'] = $this->input->post('email');
		$rest['pincode'] = $this->input->post('pincode');				
		$rest['mobile'] = $this->input->post('mobile');				
		$rest['landline'] = $this->input->post('landline');
		/*$rest['locality'] = $this->input->post('locality');
		$rest['latitude'] = $this->input->post('latitude');
		$rest['longitude'] = $this->input->post('longitude');
		$rest['radius'] = $this->input->post('radius');
		$rest['packaging_charge'] = $this->input->post('packaging_charge');
		$rest['delivery_type'] = $this->input->post('delivery_type'); */
		$rest['created_date'] = date('Y-m-d H:i:s');
		$rest['live_date'] = "0000-00-00 00:00:00";
		$rest['verification_date'] = date('Y-m-d H:i:s');
		
		$billing = array();
		$billing['billing_cycle'] = $this->input->post('billing_cycle');
		$billing['with_service_tax'] = $this->input->post('with_service_tax');
		$billing['payment_mode'] = $this->input->post('payment_mode');
		$billing['cheque_favour_of'] = $this->input->post('cheque_favour_of');
		$billing['account_name'] = $this->input->post('account_name');
		$billing['account_number'] = $this->input->post('account_number');
		$billing['bank_name'] = $this->input->post('bank_name');
		$billing['branch_name'] = $this->input->post('branch_name');
		$billing['ifsc_code'] = $this->input->post('ifsc_code');
		$billing['min_amount'] = $this->input->post('min_amount');
		$billing['is_official'] = $this->input->post('is_official');
      /*  $billing['is_trial'] = $this->input->post('is_trial');
		if(!empty($this->input->post('trial_start_date')))
		$billing['trial_start_date'] = date('Y-m-d',strtotime($this->input->post('trial_start_date')));
		if(!empty($this->input->post('trial_end_date')))
		$billing['trial_end_date'] = date('Y-m-d',strtotime($this->input->post('trial_end_date')));
	    $billing['delivery_type'] = $this->input->post('delivery_type'); */
		$billing['hard_copy'] = $this->input->post('hard_copy');
		$billing['company_name'] = $this->input->post('company_name');
		
		$cycle_date = date('Y-m-d',strtotime($this->input->post('cycle_effective_date')));
		$gateway_charge = $this->input->post('gateway_charge');
		$gateway_date = date('Y-m-d',strtotime($this->input->post('gateway_effective_date')));
		$billing_fields = array();
		$billing_fields[] = array('billing_field'=>'cycle_effective_date','value'=>$billing['billing_cycle'],'from_date'=>$cycle_date);
		$billing_fields[] = array('billing_field'=>'gateway_effective_date','value'=>$gateway_charge,'from_date'=>$gateway_date);
		
		$params = array();
		$params['rest'] = $rest;
		$params['billing'] = $billing;
		$params['billingfields'] = $billing_fields;
       
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->addRestaurant($params);
		
		echo json_encode($response);
		
	}
	
	public function editRestaurant($id) {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		//$logs = $this->restaurantlib->getLogsByrestid($id);
		$this->load->library('zyk/adminauth');
		$user = $this->adminauth->getUserList();
		/*$cities = $this->general->getCities();
		$areas = $this->general->getAreas();
		$cuisines = $this->general->getCuisines();
		$restcuisines = $this->restaurantlib->getRestaurantCuisines($id);
		$contacts = $this->restaurantlib->getRestaurantContacts($id);
		$props = $this->restaurantlib->getRestaurantProperties($id);
		$slabs = $this->restaurantlib->getRestaurantSlabs($id);
		$deltimes = $this->restaurantlib->getRestaurantDelTime($id);
		$mov = $this->restaurantlib->getRestaurantMov($id);*/
		$details = $this->restaurantlib->getRestaurantBasicDetails($id);
		$bconfig = $this->restaurantlib->getRestaurantBillingConfig($id);               
		$cycle = $this->restaurantlib->getRestaurantBillingField($id,'cycle_effective_date');
		$gateway = $this->restaurantlib->getRestaurantBillingField($id,'gateway_effective_date');               
		//$config = $this->restaurantlib->getRestaurantConfig($id);
		
       // if($props[0]['is_custom_time'] == "1"){
         //	$timings = $this->restaurantlib->getRestaurantCustomTimings($id);
        //}
		/*$score = $config[0]['basic'] + $config[0]['contact'] + $config[0]['property'] + $config[0]['del_slab'] + $config[0]['del_mov'] + $config[0]['del_time'] + $config[0]['billing'] + $config[0]['menu'];
		$progress = ($score/8)*100;  
		$coords = json_decode($details[0]['fence'],true);  
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		$this->template->set('cuisines',$cuisines);*/
		$this->template->set('basic',$details);
		/*$this->template->set('coords',$coords);
		$this->template->set('contacts',$contacts);
		$this->template->set('restcuisines',$restcuisines);
		$this->template->set('props',$props);              
		$this->template->set('slabs',$slabs);
		$this->template->set('deltimes',$deltimes);
		$this->template->set('movs',$mov);*/
		$this->template->set('bconfig',$bconfig);
		$this->template->set('cycle',$cycle);
		$this->template->set('gateway',$gateway);
		//$this->template->set('progress',$progress);
		//$this->template->set('logs',$logs);
		$this->template->set('users',$user);
       	/*if($props[0]['is_custom_time'] == "1"){
          	$this->template->set('timings',$timings);
        }*/
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		//$this->template->build ('restaurants/RestaurantEdit');
		$this->template->build ('vendor/VendorEdit');
	}
	
	public function updateRestaurantBasicInfo() {
		$rest = array();
		$rest['id'] = $this->input->post('restid');
		
		$rest['name'] = $this->input->post('name');
		$rest['address'] = $this->input->post('address');
		$rest['email'] = $this->input->post('email');
		$rest['mobile'] = $this->input->post('mobile');
		$rest['landline'] = $this->input->post('landline');
		$rest['pincode'] = $this->input->post('pincode');
		$rest['created_date'] = date('Y-m-d H:i:s');
		
		$this->load->library('zyk/RestaurantLib');
		//$rest['comment'] = $this->input->post('comment');
		$response = $this->restaurantlib->updateRestaurantDetails($rest);
		echo json_encode($response);
	}	
	
	public function updateRestaurantBillingInfo() {
		
		$restid = $this->input->post('restid');
		$billing = array();
		$billing['restid'] = $this->input->post('restid');
		$billing['billing_cycle'] = $this->input->post('billing_cycle');
		$billing['with_service_tax'] = $this->input->post('with_service_tax');
		$billing['payment_mode'] = $this->input->post('payment_mode');
		$billing['cheque_favour_of'] = $this->input->post('cheque_favour_of');
		$billing['account_name'] = $this->input->post('account_name');
		$billing['account_number'] = $this->input->post('account_number');
		$billing['bank_name'] = $this->input->post('bank_name');
		$billing['branch_name'] = $this->input->post('branch_name');
		$billing['ifsc_code'] = $this->input->post('ifsc_code');
		$billing['min_amount'] = $this->input->post('min_amount');
		$billing['is_official'] = $this->input->post('is_official');
        /*        $billing['is_trial'] = $this->input->post('is_trial');
		if(!empty($this->input->post('trial_start_date')))
			$billing['trial_start_date'] = date('Y-m-d',strtotime($this->input->post('trial_start_date')));
		if(!empty($this->input->post('trial_end_date')))
			$billing['trial_end_date'] = date('Y-m-d',strtotime($this->input->post('trial_end_date')));
		$billing['hard_copy'] = $this->input->post('hard_copy'); */
	//	$billing['delivery_type'] = $this->input->post('delivery_type');
		//$billing['comment'] = $this->input->post('comment');
		$billing['company_name'] = $this->input->post('company_name');
		
		$cycle_date = date('Y-m-d',strtotime($this->input->post('cycle_effective_date')));
		$gateway_charge = $this->input->post('gateway_charge');
		$gateway_date = date('Y-m-d',strtotime($this->input->post('gateway_effective_date')));
		$billing_fields = array('restid'=>$restid,'billing_field'=>'cycle_effective_date','value'=>$billing['billing_cycle'],'from_date'=>$cycle_date);
		$billing_fields2 = array('restid'=>$restid,'billing_field'=>'gateway_effective_date','value'=>$gateway_charge,'from_date'=>$gateway_date);
		$this->load->library('zyk/RestaurantLib');
		
		$response = $this->restaurantlib->updateRestaurantBillingConfig($billing);
		
		$this->restaurantlib->updateRestaurantBillingFields($billing_fields);
		$this->restaurantlib->updateRestaurantBillingFields($billing_fields2);
		/* $rest = array();
		$rest['id'] = $restid;
		$rest['comment'] = $this->input->post('comment');
		$rest['delivery_type'] = $this->input->post('delivery_type');
		$this->restaurantlib->updateRestaurantDetails($rest); */
		echo json_encode($response);
	}
	
	public function verifyRestaurant($restid) {
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->verifyRestaurant($restid);
		echo json_encode($response);
	}
	
	public function makeRestaurantLive($restid) {
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->makeRestaurantLive($restid);
		echo json_encode($response);
	}
        

	public function turnOnResto() {
        $data['comment'] = $this->input->get('comment'); 
        $data['id'] = $this->input->get('id');       
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->turnOnResto($data);
		redirect(base_url().'admin/restaurant/list');
	}
	
	public function turnOffResto() {
		$data['comment'] = $this->input->get('comment');
		$data['id'] = $this->input->get('id');
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->turnOffResto($data);
		redirect(base_url().'admin/restaurant/list');
	}
	
	public function restClients() {
		$this->load->library('zyk/clientauth');
		$clients = $this->clientauth->getClients();
		$this->template->set('clients',$clients);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/ClientList');
	}
	
	public function newClient() {
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->getRestaurants('');
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/ClientAdd');
	}
	
	public function editClient($id) {
		$this->load->library('zyk/clientauth');
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->getRestaurants('');
		$client = $this->clientauth->getClientById($id);
		$client_rests = $this->clientauth->getClientRestaurants($id);
		$this->template->set('client',$client);
		$this->template->set('client_rests',$client_rests);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/ClientEdit');
	}
	
	public function addClient() {
		$response = array();
		$restids = $this->input->post('restid');
		$client = array();
		$client['username'] = $this->input->post('username');
		$client['password'] = $this->input->post('password');
		$client['text_password'] = $this->input->post('password');
		$client['brand_name'] = $this->input->post('brand_name');
		$client['brand_email'] = $this->input->post('brand_email');
		$client['brand_email_password'] = $this->input->post('brand_email_password');
		$client['sms_provider'] = $this->input->post('sms_provider');
		$client['sms_username'] = $this->input->post('sms_username');
		$client['sms_password'] = $this->input->post('sms_password');
		$client['client_status'] = 1;
		$this->load->library('zyk/clientauth');
		$client_id = $this->clientauth->addClient($client);
		if($client_id) {
			$rests = array();
			foreach ($restids as $restaurant) {
				$rest = array();
				$rest['client_id'] = $client_id;
				$rest['restid'] = $restaurant;
				$rests[] = $rest;
			}
			$this->clientauth->addClientRestaurant($rests);
			$response['status'] = 1;
			$response['msg'] = 'Added successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add client.';
		}
		echo json_encode($response);
	}
	
	public function updateClient() {
		$client = array();
		$client['id'] = $this->input->post('id');
		$client['username'] = $this->input->post('username');
		$client['password'] = $this->input->post('password');
		$client['text_password'] = $this->input->post('password');
		$client['brand_name'] = $this->input->post('brand_name');
		$client['brand_email'] = $this->input->post('brand_email');
		$client['brand_email_password'] = $this->input->post('brand_email_password');
		$client['sms_provider'] = $this->input->post('sms_provider');
		$client['sms_username'] = $this->input->post('sms_username');
		$client['sms_password'] = $this->input->post('sms_password');
		$this->load->library('zyk/clientauth');
		$this->clientauth->updateClient($client);
		$response['status'] = 1;
		$response['msg'] = 'Updated successfully.';
		echo json_encode($response);
	}
	
	public function turnOnClient($id) {
		$client = array();
		$client['id'] = $id;
		$client['status'] = 1;
		$this->load->library('zyk/clientauth');
		$this->clientauth->updateClient($client);
		redirect(base_url().'admin/restaurant/clients');
	}
	
	public function turnOffClient($id) {
		$client = array();
		$client['id'] = $id;
		$client['status'] = 0;
		$this->load->library('zyk/clientauth');
		$this->clientauth->updateClient($client);
		redirect(base_url().'admin/restaurant/clients');
	}
	
	public function restaurant_detail($id) {
		$this->load->library('zyk/RestaurantLib');
		$restaurant = $this->restaurantlib->getRestaurantBasicDetails($id);
		echo json_encode($restaurant);
	}
	public function getgeofance($restid)
	{
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->getgeofance($restid);
		echo json_encode($response);
	}
	public function promoteRestaurantList()
	{
		$restaurants = array();
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->getpromotedRestaurant();
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/Promote_Restaurant');
	}
	public function promote()
	{
		$data = array();
		$id = $this->input->get('id');
		$restaurant = $this->input->get('restid');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$priority = $this->input->get('priority');
		$promoted = array();
		$updatepromoted = array();
		foreach ($restaurant as $key=>$restid) {
			$rests = array();
			$rests['restid'] = $restid;
			$rests['start_date'] = date('Y-m-d',strtotime($start_date[$key]));
			$rests['end_date'] = date('Y-m-d',strtotime($end_date[$key]));
			$rests['priority'] = $priority[$key];
			$rests['status'] = $this->input->get('status'.$restid);
			if(!empty($start_date[$key]) && !empty($end_date[$key])) {
				if(!empty($id[$key])) {
					$rests['id'] = $id[$key];
					$updatepromoted[] = $rests;
				} else {
					$promoted[] = $rests;
				}
			}
		}
		$this->load->library('zyk/RestaurantLib');
		if(count($promoted) > 0)
			$restaurant = $this->restaurantlib->addPromtedRestaurants($promoted);
		if(count($updatepromoted) > 0)
			$restaurant = $this->restaurantlib->updatePromtedRestaurants($updatepromoted);
	}
	
	public function turnoffPromotedResto ()
	{
		$data['comment'] = $this->input->get('comment');
		$data['restid'] = $this->input->get('id');
		$this->load->library('zyk/RestaurantLib');
		$restaurant = $this->restaurantlib->turnoffpromotedresto($data);
	}
	public function turnonPromotedResto ()
	{
		$data['comment'] = $this->input->get('comment');
		$data['restid'] = $this->input->get('id');
		$this->load->library('zyk/RestaurantLib');
		$restaurant = $this->restaurantlib->turnonPromotedResto($data);
	}
	public function searchPromotedRestro()
	{
		$this->input->get('zone_id');
		$restaurants = array();
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library('zyk/RestaurantLib');
		$restaurants = $this->restaurantlib->searchPromotedRestro($this->input->get('zone_id'));
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/Promote_Restaurant');
	}
	public function updateAllPromotedRestaurants() {
		$this->load->library('zyk/RestaurantLib');
		$this->restaurantlib->schedulePromotedRestaurants();
	}
	public function promoteUpdate()
	{
		$data = array();
		$check = $this->input->get('promote');
		$data['restid'] = $check[0];
		$data['comment'] = $this->input->get('comment');
		$data['start_date'] = date('Y-m-d',strtotime($this->input->get('start_date'.$check[0])));
		$data['end_date'] = date('Y-m-d',strtotime($this->input->get('end_date'.$check[0])));
		$data['priority'] = $this->input->get('priority'.$check[0]);
		$data['status'] = $this->input->get('status'.$check[0]);
		$this->load->library('zyk/RestaurantLib');
		unset($data['comment']);
		$restaurant = $this->restaurantlib->promoteUpdate($data);
	}
	
	public function manufactureList() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$details = $this->restaurantlib->getManufactureDetails();
		$this->template->set('details',$details);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Manufacture' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/ManufactureList');
	}
	
	public function manufactureNew() {
		$this->load->library('zyk/General');
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Manufacture' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/ManufactureAdd');
	}
	
	public function addManufacture() {
		$response = array();
		$rest = array();
	
		$rest['name'] = $this->input->post('mname');
		$rest['sort_order'] = $this->input->post('sort_order');
	
		/*$rest['created_date'] = date('Y-m-d H:i:s');
			$rest['live_date'] = "0000-00-00 00:00:00";
		$rest['verification_date'] = date('Y-m-d H:i:s');*/
	
		if (!empty($_FILES['image']['name'])) {
			$profilelocation = 'assets/images/manufacture/';
			$logo_image = uploadImage($_FILES['image'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'logo');
			if($logo_image['status'] == 1) {
				$rest['image'] =  $logo_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$logo_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$errorMsg["errors"] = $errors;
				$logo_image['errormsg'] = $errorMsg;
				echo json_encode($logo_image);
				exit;
			}
		}
		 
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->addManufacture($rest);
	
		echo json_encode($response);
	
	}
	
	public function manufactureEdit($id) {
		$this->load->library('zyk/RestaurantLib');
		$details = $this->restaurantlib->getManufactureDetailsById($id);
		$this->template->set('details',$details);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Manufacture' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('vendor/ManufactureEdit');
	}
	
	public function updateManufacture() {
		$rest = array();
		$rest['manufacturer_id'] = $this->input->post('mid');
	
		$rest['name'] = $this->input->post('mname');
		$rest['sort_order'] = $this->input->post('sort_order');
	
		if (!empty($_FILES['image']['name'])) {
			$profilelocation = 'assets/images/manufacture/';
			$logo_image = uploadImage($_FILES['image'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'logo');
			if($logo_image['status'] == 1) {
				$rest['image'] =  $logo_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$logo_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$errorMsg["errors"] = $errors;
				$logo_image['errormsg'] = $errorMsg;
				echo json_encode($logo_image);
				exit;
			}
		}
	
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->updateManufactureDetails($rest);
		echo json_encode($response);
	}
	
}
