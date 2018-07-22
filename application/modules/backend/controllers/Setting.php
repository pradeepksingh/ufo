<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Setting extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function getCityList() {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CityList');
	}
	
	public function newCity() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CityAdd');
	}
	
	public function addCity() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addCity($params);
		echo json_encode($response);
	}
	
	public function editCity($id) {
		$this->load->library('zyk/General');
		$cities = $this->general->getCityById($id);
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CityEdit');
	}
	
	public function updateCity() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$this->load->library('zyk/General');
		$response = $this->general->updateCity($params);
		echo json_encode($response);
	}
	
	public function turnOnCity($id) {
		$this->load->library('zyk/General');
		$response = $this->general->turnOnCity($id);
		redirect(base_url().'admin/general/citylist');
	}
	
	public function turnOffCity($id) {
		$this->load->library('zyk/General');
		$response = $this->general->turnOffCity($id);
		redirect(base_url().'admin/general/citylist');
	}
	
	public function getCities() {
		$this->load->library('zyk/General');
		$response = $this->general->getCities();
		echo json_encode($response);
	}
	
public function getLocalityList() {
		$this->load->library('zyk/General');
		//$cities = $this->general->getCities();
		$localities = array();
		//if($cityid > 0)
		$localities = $this->general->getAreas();
		//$this->template->set('cities',$cities);
		$this->template->set('localities',$localities);
		//$this->template->set('cityid',$cityid);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/LocalityList');
	}
	
	public function newLocality() {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/LocalityAdd');
	}
	
	public function addLocality() {
		$params = array();
		//$params['cityid'] = $this->input->post('cityid');
		$params['cityid'] = 1;
		$params['name'] = $this->input->post('name');
		$params['pincode'] = $this->input->post('pincode');
		//$params['latitude'] = $this->input->post('latitude');
		//$params['longitude'] = $this->input->post('longitude');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addArea($params);
		echo json_encode($response);
	}
	
	public function editLocality($id) {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$locality = $this->general->getAreasById($id);
		$this->template->set('cities',$cities);
		$this->template->set('locality',$locality);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/LocalityEdit');
	}
	
	public function updateLocality() {
		$params = array();
		$params['id'] = $this->input->post('id');
		//$params['cityid'] = $this->input->post('cityid');
		$params['cityid'] = 1;
		$params['name'] = $this->input->post('name');
		$params['pincode'] = $this->input->post('pincode');
		//$params['latitude'] = $this->input->post('latitude');
		//$params['longitude'] = $this->input->post('longitude');
		$this->load->library('zyk/General');
		$response = $this->general->updateArea($params);
		echo json_encode($response);
	}
	
	public function turnOnLocality($id) {
		$this->load->library('zyk/General');
		$this->general->turnOnArea($id);
		$response = $this->general->getAreasById($id);
		//redirect(base_url().'admin/general/localitylist/'.$response[0]['cityid']);
		redirect(base_url().'admin/general/localitylist/');
	}
	
	public function turnOffLocality($id) {
		$this->load->library('zyk/General');
		$this->general->turnOffArea($id);
		$response = $this->general->getAreasById($id);
		//redirect(base_url().'admin/general/localitylist/'.$response[0]['cityid']);
		redirect(base_url().'admin/general/localitylist/');
	}
	
	public function getLocality() {
		$cityid = $this->input->get('cityid');
		$this->load->library('zyk/General');
		$areas = $this->general->getAreasByCityId($cityid);
		echo json_encode($areas);
	}
	
	public function getCuisineList() {
		$this->load->library('zyk/General');
		$cuisines = $this->general->getCuisines();
		$this->template->set('cuisines',$cuisines);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cuisines' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CuisineList');
	}
	
	public function newCuisine() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CuisineAdd');
	}
	
	public function addCuisine() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addCuisine($params);
		echo json_encode($response);
	}
	
	public function editCuisine($id) {
		$this->load->library('zyk/General');
		$cuisine = $this->general->getCuisineById($id);
		$this->template->set('cuisine',$cuisine);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CuisineEdit');
	}
	
	public function updateCuisine() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$this->load->library('zyk/General');
		$response = $this->general->updateCuisine($params);
		echo json_encode($response);
	}
	
	public function deleteCuisine($id) {
		$this->load->library('zyk/General');
		$this->general->deleteCuisine($id);
		$map['status'] = 1;
		$map['msg'] = 'Cuisine deleted successfully.';
		echo json_encode($map);
	}
       public function getRestro() {          
		$cityid = $this->input->get('cityid');
                $vendorid = $this->input->get('vendorid');
		$this->load->library('zyk/General');
		$areaid  = "";
                $areaid1 = "";
                $cityid1 = "";
                $vendorResto = $this->general->getRestaurantsByVendor($vendorid);
                //print_r($vendorResto);
                $areacity = $this->general->getAreaidandCityidByRestaurant($vendorResto);
               // print_r($areacity);
                $arrRest =array();
                $i =0;
                foreach($areacity as $key =>$value)
                {
                $cityid1=$value['cityid'];
                $areaid1=$value['areaid'];
                } 
                if($areaid=="")$areaid = $areaid1;
                $restaurants = $this->general->getRestByAreaId($areaid);    
                foreach($restaurants as $key =>$value){
                    $arrRest[$i]['restid'] = $value['id'] ;
                    $arrRest[$i]['restname'] = $value['name'] ;
                    $arrRest[$i]['reststatus'] = 0;
                    $i++;                    
                }
             
                $arrVendorRest =explode(',',$vendorResto[0]['restid']);               
                $i =0;
                foreach($arrRest as $key =>$value){
                    if(in_array($value['restid'],$arrVendorRest)){   
                          $arrRest[$i]['reststatus'] =1;
                    }
                     $i++;
                }  
               //print_r($arrRest);
                $arrData['cityid']=$cityid1;
                $arrData['areaid'] =$areaid1;
                $arrfinal = array_merge($arrRest,$arrData);
            
		echo json_encode($arrfinal);
	}
        
        
  	public function getRestaurantByArea() {          
		$areaid = $this->input->get('areaid');               
		$this->load->library('zyk/General');
       	$restaurants = $this->general->getRestByAreaId($areaid); 
        $i = 0;
        $arrRest =array();
        foreach($restaurants as $key =>$value){                    
         	$arrRest[$i]['restid'] = $value['id'] ;
            $arrRest[$i]['restname'] = $value['name'] ; 
            $arrRest[$i]['areaname'] = $value['areaname'] ;
            $i++;                    
       	}
		echo json_encode($arrRest);
	}	
	
	public function getReasonList() {
		$this->load->library('zyk/General');
		$cuisines = $this->general->getActiveReasons();
		$this->template->set('cuisines',$cuisines);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reasons' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/ReasonList');
	}
	
	public function newReason() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reason' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/ReasonAdd');
	}
	
	public function addReason() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addReason($params);
		echo json_encode($response);
	}
	
	public function editReason($id) {
		$this->load->library('zyk/General');
		$cuisine = $this->general->getReasonById($id);
		$this->template->set('cuisine',$cuisine);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reason' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/ReasonEdit');
	}
	
	public function updateReason() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$this->load->library('zyk/General');
		$response = $this->general->updateReason($params);
		echo json_encode($response);
	}
	
	public function deleteReason($id) {
		$this->load->library('zyk/General');
		$this->general->deleteReason($id);
		$map['status'] = 1;
		$map['msg'] = 'Reason deleted successfully.';
		echo json_encode($map);
	}
	
	public function getZones() {
		$cityid = $this->input->get('cityid');
		$this->load->library('zyk/General');
		$zones = $this->general->getZoneByCityId($cityid);
		echo json_encode($zones);
	}
	
	public function getZoneLocality() {
		$zone_id = $this->input->get('zone_id');
		$this->load->library('zyk/General');
		$areas = $this->general->getAreasByZoneId($zone_id);
		echo json_encode($areas);
	}
	
	//................ Added by Tushar Ticket Model..........................
	
	public function tickets() {
		$this->load->library('zyk/General');
		$tickets = $this->general->getAllActiveTickets();
		$this->template->set('tickets',$tickets);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ticket' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/TicketList');
	}
	
	public function newTicket() {
		$this->load->library('zyk/Adminauth');
		$acps = $this->adminauth->getAdminUsers();
		$this->template->set('acps',$acps);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Ticket' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'partials/sidebar' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/TicketAdd');
	}
	
	public function addTicket() {
		$response = array();
		$params = $this->input->post('ticket');
		$this->load->library('zyk/General');
		$ticket = array();
		$ticket['priority'] = $params['priority'];
		$ticket['userid'] = $params['userid'];
		$ticket['orderid'] = $params['orderid'];
		$ticket['subject'] = $params['subject'];
		$ticket['description'] = $params['description'];
		//$ticket['type'] = $params['type'];
		//$ticket['quantity'] = $params['quantity'];
		$ticket['assigned_to'] = $params['assigned_to'];
		$ticket['status'] = $params['status'];
		$ticket['created_date'] = date('Y-m-d H:i:s');
		$ticket['updated_date'] = date('Y-m-d H:i:s');
		$ticket['created_by'] = $this->session->userdata('adminsession')['id'];
		$id = $this->general->addTicket($ticket);
		if(!empty($id)) { 
			$ticket_no = 'TT'.$id;
			$tp = array();
			$tp['ticketid'] = $id;
			$tp['ticket_no'] = $ticket_no;
			$this->general->updateTicket($tp);
			$tsms = array();
			$tsms['name'] = $params['name'];
			$tsms['mobile'] = $params['mobile'];
			//$this->general->sendTicketSMS($tsms);
			$response['status'] = 1;
			$response['msg'] = 'Ticket added successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add Ticket';
		}
		echo json_encode($response);
	}
	
	public function editTicket($ticketid) {
		$this->load->library('zyk/Adminauth');
		$this->load->library('zyk/General');
		$acps = $this->adminauth->getAdminUsers();
		$tickets = $this->general->getTicketById($ticketid);
		$this->template->set('acps',$acps);
		$this->template->set('ticket',$tickets[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					->title ( 'Administrator | Ticket' )
					->set_partial ( 'header', 'partials/header' )
					->set_partial ( 'leftnav', 'partials/sidebar' )
					->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/TicketEdit');
	}
	
	public function updateTicket() {
		$response = array();
		$params = $this->input->post('ticket');
		$this->load->library('zyk/General');
		$ticket = array();
		$ticket['ticketid'] = $params['ticketid'];
		$ticket['priority'] = $params['priority'];
		$ticket['userid'] = $params['userid'];
		$ticket['orderid'] = $params['orderid'];
		$ticket['subject'] = $params['subject'];
		$ticket['description'] = $params['description'];
		//$ticket['type'] = $params['type'];
		//$ticket['quantity'] = $params['quantity'];
		$ticket['assigned_to'] = $params['assigned_to'];
		$ticket['status'] = $params['status'];
		$ticket['resolution'] = $params['resolution'];
		$ticket['updated_date'] = date('Y-m-d H:i:s');
		$flag = $this->general->updateTicket($ticket);
		if($flag) {
			$response['status'] = 1;
			$response['msg'] = 'Ticket updated successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update Ticket';
		}
		echo json_encode($response);
	}
	
	public function getUserByEmail() {
		$email = $this->input->get('email');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByEmail($email);
		echo json_encode($user);
	}
	
	public function getUserByMobile() {
		$mobile = $this->input->get('mobile');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByMobile($mobile);
		echo json_encode($user);
	}
	
	public function getUserByName() {
		$name = $this->input->get('name');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByName($name);
		echo json_encode($user);
	}
	
	public function userDetail($id) {
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfile($id);
		echo json_encode($user[0]);
	}
	
}
