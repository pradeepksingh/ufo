<?php
class RestaurantOffer extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$current_lang = $this->session->userdata('my_lang');
		if(!$current_lang) {
			$current_lang = 'english';
			$this->session->set_userdata('my_lang','english');
		}
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper('mylang');
		$this->lang->load($current_lang.'_home_page_lang', $current_lang);
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index()
	{
		$params = array();
		if($this->input->get('status') != "") {
			$params['status'] = $this->input->get('status');
		} else {
			$params['status'] = '';
		}
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		
		//$offers = $this->restaurantofferlib->getRestOfferList ( );
		$offers = $this->restaurantofferlib->searchOffers($params);
		$logs = $this->restaurantofferlib->getOfferLogs ( );
		$this->template->set('log',$logs);
		$this->template->set('offer',$offers);
		$this->template->set('status',$params['status']);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Offer List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurantoffer/RestaurantOfferList');
		
	}
	public function newOffer()
	{
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Add Offer' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurantoffer/AddRestaurantOffer');
	
	}
	
	public function addOffer()
	{
		$data = array();
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		$data['restid'] = $this->input->post('restid');
		$data['status'] = $this->input->post('status');
		$data['discount_type'] = $this->input->post('discount_type');
		$data['max_discount'] = $this->input->post('max_discount');
		$data['mov'] = $this->input->post('mov');
		$data['payment_mode'] = $this->input->post('payment_mode');
		$data['discount_by_zk'] = $this->input->post('discount_by_zk');
		$data['discount_by_rest'] = $this->input->post('discount_by_rest');
		$config = array();
		$config ['allowed_types'] = 'jpg|png|gif';
		$config ['max_size'] = '200';
		$this->load->library ( 'upload', $config );
		if (isset ( $_FILES ['avatar'] )) {
			if ($_FILES ['avatar'] != "") {
				$image_path = 'assets/images/restaurantoffer/';
				$temp_image = explode ( ".", $_FILES ['avatar'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['image'] = 'images/restaurantoffer/'.$image;
				move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $image_path .$image );
			}
		} else {
			$data ['image'] = '';
		}
		
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$this->restaurantofferlib->addOffer ( $data );
		$restaurants = array();
		$restaurant = array();
		$restaurant['id'] = $data['restid'];
		$restaurant['has_deal'] = 1;
		$restaurants[] = $restaurant;
		$current_date = date('Y-m-d');
		if($data['from_date'] <= $current_date && $data['to_date'] >= $current_date) {
			$restaurants = array();
			$restaurant = array();
			$restaurant['id'] = $data['restid'];
			if($data['status'] == 1) {
				$restaurant['has_deal'] = 1;
			} else {
				$restaurant['has_deal'] = 0;
			}
			$restaurants[] = $restaurant;
			$this->load->library('zyk/RestaurantLib');
			$this->restaurantlib->batchUpdateRestaurants($restaurants);
		}
		redirect('admin/restaurantoffers');
	}
	// Activate offer
	public function turnOnOffer( $id )
	{
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$this->restaurantofferlib->turnOn ( $id );
		$offer = $this->restaurantofferlib->getOfferById ($id );
		$restaurants = array();
		$restaurant = array();
		$restaurant['id'] = $offer[0]['restid'];
		$restaurant['has_deal'] = 1;
		$restaurants[] = $restaurant;
		if(count($restaurants) > 0) {
			$current_date = date('Y-m-d');
			if($offer[0]['from_date'] <= $current_date && $offer[0]['to_date'] >= $current_date) {
				$this->load->library('zyk/RestaurantLib');
				$this->restaurantlib->batchUpdateRestaurants($restaurants);
			}
		}
	}
	// Deactivate offer
	public function turnOfOffer( $id )
	{
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$this->restaurantofferlib->turnOf ( $id );
		$offer = $this->restaurantofferlib->getOfferById ($id );
		$restaurants = array();
		$restaurant = array();
		$restaurant['id'] = $offer[0]['restid'];
		$restaurant['has_deal'] = 0;
		$restaurants[] = $restaurant;
		if(count($restaurants) > 0) {
			$current_date = date('Y-m-d');
			if($offer[0]['from_date'] <= $current_date && $offer[0]['to_date'] >= $current_date) {
				$this->load->library('zyk/RestaurantLib');
				$this->restaurantlib->batchUpdateRestaurants($restaurants);
			}
		}
	}
	
	public function deleteOffer( $id )
	{
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$this->restaurantofferlib->deleteOffer ( $id );
		$offer = $this->restaurantofferlib->getOfferById ($id );
		$restaurants = array();
		$restaurant = array();
		$restaurant['id'] = $offer[0]['restid'];
		$restaurant['has_deal'] = 0;
		$restaurants[] = $restaurant;
		if(count($restaurants) > 0) {
			$current_date = date('Y-m-d');
			if($offer[0]['from_date'] <= $current_date && $offer[0]['to_date'] >= $current_date) {
				$this->load->library('zyk/RestaurantLib');
				$this->restaurantlib->batchUpdateRestaurants($restaurants);
			}
		}
	}
	
	public function editOffer($id)
	{
		$this->load->library('zyk/General');
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$cities = $this->general->getCities();
		$offer = $this->restaurantofferlib->getOfferById ($id );
		$zones = $this->general->getZoneByCityId ($offer[0]['cityid']);
		$restaurants = $this->general->getRestaurantByZoneId ($offer[0]['zone_id']);
		$this->template->set('cities',$cities);
		$this->template->set('zones',$zones);
		$this->template->set('restaurants',$restaurants);
		$this->template->set('offer',$offer);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Offer List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('restaurantoffer/EditRestaurantOffer');
	}
	
	public function updateOffer()
	{
	
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		$data['restid'] = $this->input->post('restid');
		$data['status'] = $this->input->post('status');
		$data['discount_type'] = $this->input->post('discount_type');
		$data['max_discount'] = $this->input->post('max_discount');
		$data['mov'] = $this->input->post('mov');
		$data['payment_mode'] = $this->input->post('payment_mode');
		$data['discount_by_zk'] = $this->input->post('descount_by_zk');
		$data['discount_by_rest'] = $this->input->post('descount_by_rest');
		$config = array();
		$config ['allowed_types'] = 'jpg|png|gif';
		$config ['max_size'] = '200';
		$this->load->library ( 'upload', $config );
		if (!$_FILES['avatar']['size'] == 0 && $_FILES['avatar1']['error'] == 0)
		{
			$image_path = 'assets/images/restaurantoffer/';
			$temp_image = explode ( ".", $_FILES ['avatar'] ['name'] );
			$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
			$data ['image'] = 'images/restaurantoffer/'.$image;
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $image_path .$image );
		}
		
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$this->restaurantofferlib->updateOffer ( $data );
		$current_date = date('Y-m-d');
		if($data['from_date'] <= $current_date && $data['to_date'] >= $current_date) {
			$restaurants = array();
			$restaurant = array();
			$restaurant['id'] = $data['restid'];
			if($data['status'] == 1) {
				$restaurant['has_deal'] = 1;
			} else {
				$restaurant['has_deal'] = 0;
			}
			$restaurants[] = $restaurant;
			print_r($restaurant);
			$this->load->library('zyk/RestaurantLib');
			$this->restaurantlib->batchUpdateRestaurants($restaurants);
		}
		redirect('admin/restaurantoffers');
	}
	
	public function getZoneByCityId()
	{
		$this->load->library ( 'zyk/General' );
		$zone = $this->general->getZoneByCityId ( $this->input->get('cityid'));
		echo json_encode($zone);
	}
	
	public function getRestaurantByZoneId()
	{
		$this->load->library ( 'zyk/General' );
		$restaurant = $this->general->getRestaurantByZoneId ( $this->input->get('zoneid') );
		echo json_encode($restaurant);
	}
	
}
