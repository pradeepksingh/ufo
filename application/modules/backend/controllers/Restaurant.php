<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Restaurant extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$cities = $this->general->getCities();
		$areas = $this->general->getAreas();
		$map = array();
		$map['status'] = $this->input->get('status');
		$restaurants = $this->restaurantlib->getRestaurants($map);
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/RestaurantList');
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
		$this->template->build ('restaurants/RestaurantAdd');
	}
	
	public function addRestaurant() {
		$response = array();
		$rest = array();
		//$rest['cityid'] = $this->input->post('cityid');
		//$rest['areaid'] = $this->input->post('areaid');
		$rest['name'] = $this->input->post('name');
		$rest['address'] = $this->input->post('address');
		$rest['landmark'] = $this->input->post('landmark');
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
		
		//$rest['cuisine'] = implode(",",$this->input->post('cuisines'));
      /*  $rest['promote'] = $this->input->post('is_promote');
        $rest['is_veg'] = $this->input->post('is_veg');
        $rest['is_coupon_applicable'] = $this->input->post('is_coupon_applicable');  */
		if (!empty($_FILES['logo']['name'])) {
			$profilelocation = 'assets/images/restaurant/logo/';
			$logo_image = uploadImage($_FILES['logo'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'logo');
			if($logo_image['status'] == 1) {
				$rest['logo'] =  $logo_image['image'];
			} else {
				$errors = array();
				$error = array("logo"=>$logo_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$errorMsg["errors"] = $errors;
				$logo_image['errormsg'] = $errorMsg;
				echo json_encode($logo_image);
				exit;
			}
		}
		
		$contacts = array();
		$contacts['landline_1'] = $this->input->post('landline_1');
		$contacts['landline_2'] = $this->input->post('landline_2');
		$contacts['landline_3'] = $this->input->post('landline_3');
		$contacts['landline_4'] = $this->input->post('landline_4');
		$contacts['owner_name'] = $this->input->post('owner_name');
		$contacts['owner_mobile'] = $this->input->post('owner_mobile');
		$contacts['manager_1_name'] = $this->input->post('manager_1_name');
		$contacts['manager_1_mobile'] = $this->input->post('manager_1_mobile');
		$contacts['manager_2_name'] = $this->input->post('manager_2_name');
		$contacts['manager_2_mobile'] = $this->input->post('manager_2_mobile');
		$contacts['order_notify_mobile'] = $this->input->post('order_notify_mobile');
		$contacts['invoice_notify_mobile'] = $this->input->post('invoice_notify_mobile');
		$contacts['order_notify_email'] = $this->input->post('order_notify_email');
		$contacts['invoice_notify_email'] = $this->input->post('invoice_notify_email');
		
		$property = array();
		$property['economic_category'] = $this->input->post('economic_category');
		$property['order_placing_mode'] = $this->input->post('order_placing_mode');
		$property['online_payment'] = $this->input->post('online_payment');
		$property['mstart_time'] = date('H:i:s',strtotime($this->input->post('mstart_time')));
		$property['mclose_time'] = date('H:i:s',strtotime($this->input->post('mclose_time')));
		$property['estart_time'] = date('H:i:s',strtotime($this->input->post('estart_time')));
		$property['eclose_time'] = date('H:i:s',strtotime($this->input->post('eclose_time')));
		$property['vat'] = $this->input->post('vat');
		$property['tax'] = $this->input->post('tax');
		$property['service_charge'] = $this->input->post('service_charge');
		$property['is_packaging_tax'] = $this->input->post('is_packaging_tax');
        $property['is_custom_time'] = $this->input->post('cboCustomTime');
        $property['source'] = $this->input->post('cboSource');	
        $property['services'] ="";           
     	if (is_array($this->input->post('restservice'))) {
         	foreach($this->input->post('restservice') as $value){
            	$property['services'] .= $value."," ;
            }
      	} else {
           	$property['services'] = $this->input->post('restservice');
        }
        $property['services'] = rtrim($property['services'],',');
              
                /****/
                $arrTiming = array();
                if($property['is_custom_time'] == 1){
                    for($j = 0; $j <=6;$j ++){
                        switch ($j) {
                            case 0:
                                $day = "mon";
                                break;
                            case 1:
                                $day = "tue";
                                break;
                            case 2:
                                $day = "wed";
                                break;
                            case 3:
                                $day = "thu";
                                break;
                            case 4:
                                $day = "fri";
                                break;
                            case 5:
                                $day = "sat";
                                break;
                            case 6:
                                $day = "sun";
                                break;

                        } 
                    
                       // $arrTiming['restid'] = '';
                        $arrTiming[$j]['holiday'] = $this->input->post('chkholiday'.($j+1) );
                        $arrTiming[$j]['day'] = $day ;
                        $mopen = 'mopen_time'.($j+1);
                        $mclose = 'mclose_time'.($j+1);
                        $eopen = 'eopen_time'.($j+1);
                        $eclose = 'eclose_time'.($j+1); 
                     
                        $arrTiming[$j]['morning_open_time'] = date('H:i:s',strtotime($this->input->post($mopen )));;
                        $arrTiming[$j]['morning_closing_time'] = date('H:i:s',strtotime($this->input->post($mclose )));
                        $arrTiming[$j]['evening_open_time'] = date('H:i:s',strtotime($this->input->post($eopen )));
                        $arrTiming[$j]['evening_closing_time'] =  date('H:i:s',strtotime($this->input->post($eclose)));
                    }  
               	} else {
               		for($j = 0; $j <=6;$j ++){
               			switch ($j) {
               				case 0:
               					$day = "mon";
               					break;
               				case 1:
               					$day = "tue";
               					break;
               				case 2:
               					$day = "wed";
               					break;
               				case 3:
               					$day = "thu";
               					break;
               				case 4:
               					$day = "fri";
               					break;
               				case 5:
               					$day = "sat";
               					break;
               				case 6:
               					$day = "sun";
               					break;
               		
               			}
               		
               			// $arrTiming['restid'] = '';
               			$arrTiming[$j]['holiday'] = 0;
               			$arrTiming[$j]['day'] = $day ;
               			 
               			$arrTiming[$j]['morning_open_time'] = date('H:i:s',strtotime($this->input->post('mstart_time')));
               			$arrTiming[$j]['morning_closing_time'] = date('H:i:s',strtotime($this->input->post('mclose_time')));
               			$arrTiming[$j]['evening_open_time'] = date('H:i:s',strtotime($this->input->post('estart_time')));
               			$arrTiming[$j]['evening_closing_time'] = date('H:i:s',strtotime($this->input->post('eclose_time')));
               		}
               	}
                
                /****/
                
		$charge = $this->input->post('charge');
		$lower_limit = $this->input->post('lower_limit');
		$upper_limit = $this->input->post('upper_limit');
		$from_rad = $this->input->post('from_rad');
		$to_rad = $this->input->post('to_rad');
		$from_time_rad = $this->input->post('from_time_rad');
		$to_time_rad = $this->input->post('to_time_rad');
		$mon = $this->input->post('mon');
		$tue = $this->input->post('tue');
		$wed = $this->input->post('wed');
		$thu = $this->input->post('thu');
		$fri = $this->input->post('fri');
		$sat = $this->input->post('sat');
		$sun = $this->input->post('sun');
		$from_mov_rad = $this->input->post('from_mov_rad');
		$to_mov_rad = $this->input->post('to_mov_rad');
		$amount = $this->input->post('amount');
		$slabs = array();
		$mov = array();
		$mov_radius = array();
		for ($i = 0; $i < count($charge); $i++) {
			if($from_rad[$i] >= 0 && $to_rad[$i] > 0 && $lower_limit[$i] >= 0 && $upper_limit[$i] > 0 && $charge[$i] >= 0) {
				$slabs[] = array('from_rad'=>$from_rad[$i],'to_rad'=>$to_rad[$i],'lower_limit'=>$lower_limit[$i],'upper_limit'=>$upper_limit[$i],'charge'=>$charge[$i]);
				$mov_radius[] = array('from_rad'=>$from_rad[$i],'to_rad'=>$to_rad[$i]);
			}
		}
		$mov_radius = array_map("unserialize", array_unique(array_map("serialize", $mov_radius)));
		$mov_radius = array_values($mov_radius);
		foreach ($mov_radius as $mov_rad) {
			$max_charge = 250000;
			foreach ($slabs as $slab) {
				if(($mov_rad['from_rad'] == $slab['from_rad']) && ($mov_rad['to_rad'] == $slab['to_rad']) ) {
					if($slab['lower_limit'] < $max_charge) {
						$max_charge = $slab['lower_limit'];
					}
				}
			}
			$mov_rad['amount'] = $max_charge;
			$mov[] = $mov_rad;
		}
		$deliverytime = array();
		for ($i = 0; $i < count($from_time_rad); $i++) {
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $mon[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'mon','time'=>$mon[$i]);
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $tue[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'tue','time'=>$tue[$i]);
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $wed[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'wed','time'=>$wed[$i]);
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $thu[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'thu','time'=>$thu[$i]);
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $fri[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'fri','time'=>$fri[$i]);
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $sat[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'sat','time'=>$sat[$i]);
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $sun[$i] > 0)
			$deliverytime[] = array('from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'sun','time'=>$sun[$i]);
		}
		
		
		
		/*for ($i = 0; $i < count($amount); $i++) {
			if($from_mov_rad[$i] >= 0 && $to_mov_rad[$i] > 0 && $amount[$i] >= 0)
			$mov[] = array('from_rad'=>$from_mov_rad[$i],'to_rad'=>$to_mov_rad[$i],'amount'=>$amount[$i]);
		}*/
		
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
        $billing['is_trial'] = $this->input->post('is_trial');
		if(!empty($this->input->post('trial_start_date')))
		$billing['trial_start_date'] = date('Y-m-d',strtotime($this->input->post('trial_start_date')));
		if(!empty($this->input->post('trial_end_date')))
		$billing['trial_end_date'] = date('Y-m-d',strtotime($this->input->post('trial_end_date')));
		$billing['hard_copy'] = $this->input->post('hard_copy');
		$billing['delivery_type'] = $this->input->post('delivery_type');
		$billing['company_name'] = $this->input->post('company_name');
		
		$cycle_date = date('Y-m-d',strtotime($this->input->post('cycle_effective_date')));
		$gateway_charge = $this->input->post('gateway_charge');
		$gateway_date = date('Y-m-d',strtotime($this->input->post('gateway_effective_date')));
		$billing_fields = array();
		$billing_fields[] = array('billing_field'=>'cycle_effective_date','value'=>$billing['billing_cycle'],'from_date'=>$cycle_date);
		$billing_fields[] = array('billing_field'=>'gateway_effective_date','value'=>$gateway_charge,'from_date'=>$gateway_date);
		
		$params = array();
		$params['rest'] = $rest;
		$params['contact'] = $contacts;
		$params['property'] = $property;
		$params['slabs'] = $slabs;
		$params['time'] = $deliverytime;
		$params['mov'] = $mov;
		$params['billing'] = $billing;
		$params['billingfields'] = $billing_fields;
        if($property['is_custom_time'] == 1){
           	$params['timings'] = $arrTiming;
        }
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->addRestaurant($params);
		//******************************  Code by rohit***********************************
		
		/*$geo['fenceid']=0;
		$rest['is_geofancy']=0;
		
		$d=$this->input->post('latlong');
		$data =array();
		$i=0;
		foreach ($d as $item)
		{
			$t = explode(',',$item);
			$data[$i]=array('latitude' => $t[0],'longitude'=>$t[1]);
			$i++;
		
		}
		
		if($response['status']==1)
		{
		$geo['latitude'] = $this->input->post('latitude');
		$geo['longitude'] = $this->input->post('longitude');
		$geo['restid'] = $response['id'];
		$geo['fence_pos'] = json_encode($data);
		$this->load->library('zyk/RestaurantLib');
		//$response = $this->restaurantlib->updateRestaurantGeo($rest);
		$this->restaurantlib->savegeo($geo);
		}*/
		
		//*****************************************************************
		echo json_encode($response);
		
		
	}
	
	public function editRestaurant($id) {
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$logs = $this->restaurantlib->getLogsByrestid($id);
		$this->load->library('zyk/adminauth');
		$user = $this->adminauth->getUserList();
		$cities = $this->general->getCities();
		$areas = $this->general->getAreas();
		//$cuisines = $this->general->getCuisines();
		$details = $this->restaurantlib->getRestaurantBasicDetails($id);
		$restcuisines = $this->restaurantlib->getRestaurantCuisines($id);
		$contacts = $this->restaurantlib->getRestaurantContacts($id);
		$props = $this->restaurantlib->getRestaurantProperties($id);
		$slabs = $this->restaurantlib->getRestaurantSlabs($id);
		$deltimes = $this->restaurantlib->getRestaurantDelTime($id);
		$mov = $this->restaurantlib->getRestaurantMov($id);
		$bconfig = $this->restaurantlib->getRestaurantBillingConfig($id);               
		$cycle = $this->restaurantlib->getRestaurantBillingField($id,'cycle_effective_date');
		$gateway = $this->restaurantlib->getRestaurantBillingField($id,'gateway_effective_date');               
		$config = $this->restaurantlib->getRestaurantConfig($id);
		
        if($props[0]['is_custom_time'] == "1"){
         	$timings = $this->restaurantlib->getRestaurantCustomTimings($id);
        }
		$score = $config[0]['basic'] + $config[0]['contact'] + $config[0]['property'] + $config[0]['del_slab'] + $config[0]['del_mov'] + $config[0]['del_time'] + $config[0]['billing'] + $config[0]['menu'];
		$progress = ($score/8)*100;  
		$coords = json_decode($details[0]['fence'],true);  
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		//$this->template->set('cuisines',$cuisines);
		$this->template->set('basic',$details);
		$this->template->set('coords',$coords);
		$this->template->set('contacts',$contacts);
		$this->template->set('restcuisines',$restcuisines);
		$this->template->set('props',$props);              
		$this->template->set('slabs',$slabs);
		$this->template->set('deltimes',$deltimes);
		$this->template->set('movs',$mov);
		$this->template->set('bconfig',$bconfig);
		$this->template->set('cycle',$cycle);
		$this->template->set('gateway',$gateway);
		$this->template->set('progress',$progress);
		$this->template->set('logs',$logs);
		$this->template->set('users',$user);
       	if($props[0]['is_custom_time'] == "1"){
          	$this->template->set('timings',$timings);
        }
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurants/RestaurantEdit');
	}
	
	public function updateRestaurantBasicInfo() {
		$rest = array();
		$rest['id'] = $this->input->post('restid');
		$rest['cityid'] = $this->input->post('cityid');
		$rest['areaid'] = $this->input->post('areaid');
		$rest['name'] = $this->input->post('name');
		$rest['address'] = $this->input->post('address');
		$rest['landmark'] = $this->input->post('landmark');
		$rest['pincode'] = $this->input->post('pincode');
		if(!empty($this->input->post('locality')))
		$rest['locality'] = $this->input->post('locality');
		if(!empty($this->input->post('latitude')))
		$rest['latitude'] = $this->input->post('latitude');
		if(!empty($this->input->post('longitude')))
		$rest['longitude'] = $this->input->post('longitude');
		if(!empty($this->input->post('radius')))
		$rest['radius'] = $this->input->post('radius');
		$rest['packaging_charge'] = $this->input->post('packaging_charge');
        $rest['promote'] = $this->input->post('is_promote');
        $rest['is_veg'] = $this->input->post('is_veg');
        $rest['is_coupon_applicable'] = $this->input->post('is_coupon_applicable');
		$rest['created_date'] = date('Y-m-d H:i:s');
		$rest['cuisine'] = implode(",",$this->input->post('cuisines'));
              
		if (!empty($_FILES['logo']['name'])) {
			$profilelocation = 'assets/images/restaurant/logo/';
			$logo_image = uploadImage($_FILES['logo'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'logo');
			if($logo_image['status'] == 1) {
				$rest['logo'] =  $logo_image['image'];
			} else {
				$errors = array();
				$error = array("logo"=>$logo_image['msg']);
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
		$rest['comment'] = $this->input->post('comment');
		$response = $this->restaurantlib->updateRestaurantDetails($rest);
		echo json_encode($response);
	}
	
	public function updateRestaurantContactInfo() {
		$contacts = array();
		$contacts['restid'] = $this->input->post('restid');
		$contacts['comment'] = $this->input->post('comment');
		$contacts['landline_1'] = $this->input->post('landline_1');
		$contacts['landline_2'] = $this->input->post('landline_2');
		$contacts['landline_3'] = $this->input->post('landline_3');
		$contacts['landline_4'] = $this->input->post('landline_4');
		$contacts['owner_name'] = $this->input->post('owner_name');
		$contacts['owner_mobile'] = $this->input->post('owner_mobile');
		$contacts['manager_1_name'] = $this->input->post('manager_1_name');
		$contacts['manager_1_mobile'] = $this->input->post('manager_1_mobile');
		$contacts['manager_2_name'] = $this->input->post('manager_2_name');
		$contacts['manager_2_mobile'] = $this->input->post('manager_2_mobile');
		$contacts['order_notify_mobile'] = $this->input->post('order_notify_mobile');
		$contacts['invoice_notify_mobile'] = $this->input->post('invoice_notify_mobile');
		$contacts['order_notify_email'] = $this->input->post('order_notify_email');
		$contacts['invoice_notify_email'] = $this->input->post('invoice_notify_email');
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->updateRestaurantContacts($contacts);
		echo json_encode($response);
	}
	
	public function updateRestaurantProperties() {
		$property = array();
		$property['restid'] = $this->input->post('restid');
		$property['comment'] = $this->input->post('comment');
		$property['economic_category'] = $this->input->post('economic_category');
		$property['order_placing_mode'] = $this->input->post('order_placing_mode');
		$property['online_payment'] = $this->input->post('online_payment');
		$property['mstart_time'] = date('H:i:s',strtotime($this->input->post('mstart_time')));
		$property['mclose_time'] = date('H:i:s',strtotime($this->input->post('mclose_time')));
		$property['estart_time'] = date('H:i:s',strtotime($this->input->post('estart_time')));
		$property['eclose_time'] = date('H:i:s',strtotime($this->input->post('eclose_time')));
		$property['vat'] = $this->input->post('vat');
		$property['tax'] = $this->input->post('tax');
		$property['service_charge'] = $this->input->post('service_charge');
		$property['is_packaging_tax'] = $this->input->post('is_packaging_tax');
        $property['is_custom_time'] = $this->input->post('cboCustomTime');
        $property['source'] = $this->input->post('cboSource');
        $property['services'] = "";           
        if (is_array($this->input->post('restservice'))) {
          	foreach($this->input->post('restservice') as $value){
          		$property['services'] .= $value."," ;
          	}
        } else {
          	$property['services'] = $this->input->post('restservice');
        }
        $property['services'] = rtrim($property['services'],',');
              
		$this->load->library('zyk/RestaurantLib');
		$response = $this->restaurantlib->updateRestaurantProperties($property);
		$this->restaurantlib->deleteRestaurantTimings($property['restid']);
       	$arrTiming = array();
       	if($property['is_custom_time'] == 1){
        	for($j = 0; $j <=6;$j ++){
            	switch ($j) {
                  	case 0:
                      	$day = "mon";
                        break;
                  	case 1:
                       	$day = "tue";
                        break;
                   	case 2:
                      	$day = "wed";
                       	break;
                   	case 3:
                      	$day = "thu";
                        break;
                   	case 4:
                      	$day = "fri";
                        break;
                  	case 5:
                       	$day = "sat";
                       	break;
                  	case 6:
                    	$day = "sun";
                       	break;

           		} 
                    
               	$arrTiming[$j]['restid'] = $this->input->post('restid');
                $arrTiming[$j]['holiday'] = $this->input->post('chkholiday'.($j+1) );
                $arrTiming[$j]['day'] = $day ;
                $mopen = 'mopen_time'.($j+1);
                $mclose = 'mclose_time'.($j+1);
                $eopen = 'eopen_time'.($j+1);
                $eclose = 'eclose_time'.($j+1);
                     
                $arrTiming[$j]['morning_open_time'] = date('H:i:s',strtotime($this->input->post($mopen )));;
                $arrTiming[$j]['morning_closing_time'] = date('H:i:s',strtotime($this->input->post($mclose )));
                $arrTiming[$j]['evening_open_time'] = date('H:i:s',strtotime($this->input->post($eopen )));
                $arrTiming[$j]['evening_closing_time'] =  date('H:i:s',strtotime($this->input->post($eclose)));
         	} 
     	} else {
     		for($j = 0; $j <=6;$j ++){
            	switch ($j) {
                  	case 0:
                      	$day = "mon";
                        break;
                  	case 1:
                       	$day = "tue";
                        break;
                   	case 2:
                      	$day = "wed";
                       	break;
                   	case 3:
                      	$day = "thu";
                        break;
                   	case 4:
                      	$day = "fri";
                        break;
                  	case 5:
                       	$day = "sat";
                       	break;
                  	case 6:
                    	$day = "sun";
                       	break;

           		} 
           		$arrTiming[$j]['restid'] = $this->input->post('restid');
              	$arrTiming[$j]['holiday'] = 0;
               	$arrTiming[$j]['day'] = $day ;
               			 
               	$arrTiming[$j]['morning_open_time'] = date('H:i:s',strtotime($this->input->post('mstart_time')));
               	$arrTiming[$j]['morning_closing_time'] = date('H:i:s',strtotime($this->input->post('mclose_time')));
               	$arrTiming[$j]['evening_open_time'] = date('H:i:s',strtotime($this->input->post('estart_time')));
               	$arrTiming[$j]['evening_closing_time'] = date('H:i:s',strtotime($this->input->post('eclose_time')));
          	}
      	}
      	$response2 = $this->restaurantlib->addRestaurantTimings($arrTiming);
       	echo json_encode($response);
	}
	
	public function updateRestaurantDeliveryInfo() {
		$config = array();
		$restid = $this->input->post('restid');
		$charge = $this->input->post('charge');
		$lower_limit = $this->input->post('lower_limit');
		$upper_limit = $this->input->post('upper_limit');
		$from_rad = $this->input->post('from_rad');
		$to_rad = $this->input->post('to_rad');
		$from_time_rad = $this->input->post('from_time_rad');
		$to_time_rad = $this->input->post('to_time_rad');
		$mon = $this->input->post('mon');
		$tue = $this->input->post('tue');
		$wed = $this->input->post('wed');
		$thu = $this->input->post('thu');
		$fri = $this->input->post('fri');
		$sat = $this->input->post('sat');
		$sun = $this->input->post('sun');
		$from_mov_rad = $this->input->post('from_mov_rad');
		$to_mov_rad = $this->input->post('to_mov_rad');
		$amount = $this->input->post('amount');
		$slabs = array();
		$mov = array();
		$mov_radius = array();
		for ($i = 0; $i < count($charge); $i++) {
			if($from_rad[$i] >= 0 && $to_rad[$i] > 0 && $lower_limit[$i] >= 0 && $upper_limit[$i] > 0 && $charge[$i] >= 0) {
				$slabs[] = array('restid'=>$restid,'from_rad'=>$from_rad[$i],'to_rad'=>$to_rad[$i],'lower_limit'=>$lower_limit[$i],'upper_limit'=>$upper_limit[$i],'charge'=>$charge[$i],'comment'=>$this->input->post('comment'));
				$mov_radius[] = array('restid'=>$restid,'from_rad'=>$from_rad[$i],'to_rad'=>$to_rad[$i],'comment'=>$this->input->post('comment'));
			}
		}
		$mov_radius = array_map("unserialize", array_unique(array_map("serialize", $mov_radius)));
		$mov_radius = array_values($mov_radius);
		foreach ($mov_radius as $mov_rad) {
			$max_charge = 250000;
			foreach ($slabs as $slab) {
				if(($mov_rad['from_rad'] == $slab['from_rad']) && ($mov_rad['to_rad'] == $slab['to_rad']) ) {
					if($slab['lower_limit'] < $max_charge) {
						$max_charge = $slab['lower_limit'];
					}
				}
			}
			$mov_rad['amount'] = $max_charge;
			$mov[] = $mov_rad;
		}
		$deliverytime = array();
		for ($i = 0; $i < count($from_time_rad); $i++) {
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $mon[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'mon','time'=>$mon[$i],'comment'=>$this->input->post('comment'));
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $tue[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'tue','time'=>$tue[$i],'comment'=>$this->input->post('comment'));
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $wed[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'wed','time'=>$wed[$i],'comment'=>$this->input->post('comment'));
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $thu[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'thu','time'=>$thu[$i],'comment'=>$this->input->post('comment'));
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $fri[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'fri','time'=>$fri[$i],'comment'=>$this->input->post('comment'));
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $sat[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'sat','time'=>$sat[$i],'comment'=>$this->input->post('comment'));
			if($from_time_rad[$i] >= 0 && $to_time_rad[$i] > 0 && $sun[$i] > 0)
				$deliverytime[] = array('restid'=>$restid,'from_rad'=>$from_time_rad[$i],'to_rad'=>$to_time_rad[$i],'day'=>'sun','time'=>$sun[$i],'comment'=>$this->input->post('comment'));
		}
		
		/*for ($i = 0; $i < count($amount); $i++) {
			if($from_mov_rad[$i] >= 0 && $to_mov_rad[$i] > 0 && $amount[$i] >= 0)
				$mov[] = array('restid'=>$restid,'from_rad'=>$from_mov_rad[$i],'to_rad'=>$to_mov_rad[$i],'amount'=>$amount[$i]);
		}*/
		if(count($slabs) > 0) {
			$config['del_slab'] = 1;
			$config['restid'] = $restid;
		}
		if(count($mov) > 0) {
			$config['del_mov'] = 1;
			$config['restid'] = $restid;
		}
		if(count($deliverytime) > 0) {
			$config['del_time'] = 1;
			$config['restid'] = $restid;
		}
		$config['comment'] = $this->input->post('comment');
		$this->load->library('zyk/RestaurantLib');
		if(count($mov) > 0)
		$this->restaurantlib->updateRestaurantMov($mov);
		if(count($deliverytime) > 0)
		$this->restaurantlib->updateRestaurantDeliveryTime($deliverytime);
		if(count($slabs) > 0)
		$this->restaurantlib->updateRestaurantSlabs($slabs);
		if(count($mov) > 0 || count($deliverytime) > 0 || count($slabs) > 0)
		$this->restaurantlib->updateRestaurantConfig($config);
		$map['status'] = 1;
		$map['msg'] = 'Updated successfully.';
		// Added by Rohit singh
		$latlongstr = $this->input->post('geofencestr');
		$latlongarr = explode("#",$latlongstr);
		$geofence = array();
		$i = 1;
		foreach ($latlongarr as $latlong) {
			$fence = array();
			$latlangpair = explode(",",$latlong);
			$fence['restid'] = $restid;
			$fence['fence_pos'] = $i;
			$fence['latitude'] = $latlangpair[0];
			$fence['longitude'] = $latlangpair[1];
			$geofence[] = $fence;
			$i++;
		}
		
		$basic = array();
		$basic['id'] = $restid;
		$basic['cuisine'] = '';
		$basic['comment'] = $this->input->post('comment');
		$basic['have_gf'] = $this->input->post('have_gf');
		$basic['fence'] = json_encode($geofence);
		$basic['locality'] = $this->input->post('locality');
		$basic['latitude'] = $this->input->post('latitude');
		$basic['longitude'] = $this->input->post('longitude');
		$basic['radius'] = $this->input->post('radius');
		$response = $this->restaurantlib->updateRestaurantDetails($basic);
		echo json_encode($map);
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
                $billing['is_trial'] = $this->input->post('is_trial');
		if(!empty($this->input->post('trial_start_date')))
			$billing['trial_start_date'] = date('Y-m-d',strtotime($this->input->post('trial_start_date')));
		if(!empty($this->input->post('trial_end_date')))
			$billing['trial_end_date'] = date('Y-m-d',strtotime($this->input->post('trial_end_date')));
		$billing['hard_copy'] = $this->input->post('hard_copy');
		$billing['delivery_type'] = $this->input->post('delivery_type');
		$billing['comment'] = $this->input->post('comment');
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
		$rest = array();
		$rest['id'] = $restid;
		$rest['comment'] = $this->input->post('comment');
		$rest['delivery_type'] = $this->input->post('delivery_type');
		$this->restaurantlib->updateRestaurantDetails($rest);
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
}
