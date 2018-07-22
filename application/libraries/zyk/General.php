<?php
class General {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	public function getCities() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cities = $this->CI->settings->getAllCities ();
		return $cities;
	}
	public function getRestaurantsByVendor($vendorid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getRestaurantsByVendor ( $vendorid );
		return $areas;
	}
	public function getCityById($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cities = $this->CI->settings->getCityById ( $id );
		return $cities;
	}
	public function turnOnCity($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOnCity ( $id );
	}
	public function turnOffCity($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOffCity ( $id );
	}
	public function addCity($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addCity ( $params );
		return $response;
	}
	public function updateCity($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateCity ( $params );
		return $response;
	}
	
	public function getAreasByPincode($pincode) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$data = $this->CI->settings->checkLocalitiesbyPincode ($pincode);
		if (count ( $data ) > 0) {
			$data [0] ['status'] = 1;
			$data[0]['msg'] = 'Location is found';
		} else {
			$data [0] ['status'] = 0;
			$data[0]['msg'] = 'Location is not Found';
		}
		return $data;
		//return $areas;
	}
	
	public function getAreas() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getAllLocalities ();
		return $areas;
	}
	public function getAreasByCityId($cityid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getAreasByCityId ( $cityid );
		return $areas;
	}
	public function getAreasById($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getLocalityById ( $id );
		return $areas;
	}
	public function addArea($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addLocality ( $params );
		return $response;
	}
	public function updateArea($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateLocality ( $params );
		return $response;
	}
	public function turnOnArea($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOnLocality ( $id );
	}
	public function turnOffArea($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOffLocality ( $id );
	}
	/*public function getCuisines() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cuisines = $this->CI->settings->getAllCuisines ();
		return $cuisines;
	}*/
	public function getCuisineById($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cuisines = $this->CI->settings->getCuisineById ( $id );
		return $cuisines;
	}
	public function addCuisine($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addCuisine ( $params );
		return $response;
	}
	public function updateCuisine($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateCuisine ( $params );
		return $response;
	}
	public function deleteCuisine($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->deleteCuisine ( $id );
	}
	public function getRestByAreaId($cityid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getRestByAreaId ( $cityid );
		return $areas;
	}
	public function getAreaidandCityidByRestaurant($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getAreaidandCityidByRestaurant ( $a );
		return $areas;
	}
	public function addReason($params) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->addReason($params);
		return $response;
	}
	
	public function updateReason($params) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->updateReason($params);
		return $response;
	}
	
	public function deleteReason($id) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$this->CI->settings->deleteReason($id);
	}
	
	public function getActiveReasons() {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->getActiveReasons();
		return $response;
	}
	
	public function getReasonById($id) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->getReasonById($id);
		return $response;
	}
	
	public function getCuisinesByArea($arealist) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cuisines = $this->CI->settings->getCuisinesByArea($arealist);
		return $cuisines;
	}
		
	public function getZoneByCityId($cityid)
	{
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$zone = $this->CI->settings->getZoneByCityId($cityid);
		return $zone;
	}
	public function getAreaByZoneId ($zoneid)
	{
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$area = $this->CI->settings->getAreaByZoneId($zoneid);
		return $area;
	}
	public function getRestaurantByZoneId($zoneid)
	{
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$restaurant = $this->CI->settings->getRestaurantByZoneId($zoneid);
		return $restaurant;
	}
	
	public function saveContactUs($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->saveContactUs($params);
		$map = array();
		if($result) {
			$map['status'] = 1;
			$map['message'] = 'Query added successfully.';
		} else {
			$map['status'] = 0;
			$map['message'] = 'Failed to add query.';
		}
		return $map;
	}
	
	public function addFeedback($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->addFeedback($params);
		$map = array();
		if($result) {
			$map['status'] = 1;
			$map['message'] = 'Feedback added successfully.';
		} else {
			$map['status'] = 0;
			$map['message'] = 'Failed to add feedback.';
		}
		return $map;
	}
	
	public function getAreasByZoneId($zone_id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getAreasByZoneId ( $zone_id );
		return $areas;
	}
	
	public function saveRating($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->saveRating ( $params );
		return $result;
	}
	
	public function saveReview($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->saveReview ( $params );
		return $result;
	}
	
	public function getRestaurantReviews($restid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->getRestaurantsReviews ( $restid );
		return $result;
	}
	
	//................ Added by Tushar Ticket Model..........................
	
	public function addTicket($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addTicket ($params);
		return $response;
	}
	
	public function updateTicket($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateTicket ($params);
		return $response;
	}
	
	public function getAllTickets() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getAllTickets ();
		return $response;
	}
	
	public function getAllActiveTickets() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getAllActiveTickets ();
		return $response;
	}
	
	public function getTicketById($ticketid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getTicketById ($ticketid);
		return $response;
	}
	
	public function sendTicketSMS($details) {
		$sms_msg = "Hi ".$details ['name'].", We would like to acknowledge that we have received your complaint and we will get back to you shortly. Regards, The Moustache Laundry";
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	
}
