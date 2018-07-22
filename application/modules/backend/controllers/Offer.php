<?php
class Offer extends MX_Controller {
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
		$this->load->library ( 'zyk/OfferLib' );
		$offers = $this->offerlib->getOfferList ( );
		$this->template->set('offer',$offers);
		$logs = $this->offerlib->getOfferLogs ( );
		$this->template->set('log',$logs);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Offer List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('offer/OfferList');
		
	}
	public function addOffer()
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
		$this->template->build ('offer/AddOffer');
	
	}
	public function saveOffer()
	{
		
		$data = array();
		$data['restid'] = $this->input->post('restid');
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['url'] = $this->input->post('url');
		$data['coupon_code'] = $this->input->post('coupon_code');
		$data['status'] = $this->input->post('status');
		$data['priority'] = $this->input->post('priority');
		if($this->input->post('offer_type')==1)
		{
			$data['offer_type'] = 1;
			$data['position'] = $this->input->post('position');
		}
		else
		{
			$data['offer_type'] = 0;
			
		}
		
		$config = array();
		$config ['allowed_types'] = 'jpg|png|gif';
		$config ['max_size'] = '200';
		$this->load->library ( 'upload', $config );
		if (isset ( $_FILES ['avatar'] )) {
			if ($_FILES ['avatar'] != "") {
				$image_path = 'assets/images/offer/';
				$temp_image = explode ( ".", $_FILES ['avatar'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['avatar'] = 'images/offer/'.$image;
				move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $image_path .$image );
			}
		} else {
			$data ['avatar'] = '';
		}
		//print_r($data);
		$this->load->library ( 'zyk/OfferLib' );
		$this->offerlib->saveOffer ( $data );
		//print_r($data);
		redirect('admin/offer/offerlist');
	}
	public function turnOnOffer( $id )
	{
		$data = array();
		$data['restid'] = $this->input->get('restid');
		$data['id'] = $id;
		$this->load->library ( 'zyk/OfferLib' );
		$this->offerlib->turnOnOffer ( $data );
	}
	public function turnOfOffer( $id )
	{
		$data = array();
		$data['restid'] = $this->input->get('restid');
		$data['id'] = $id;
		$this->load->library ( 'zyk/OfferLib' );
		$this->offerlib->turnOfOffer ( $data );
	}
	public function deleteOffer( $id )
	{
		$data['restid'] = $this->input->get('restid');
		$data['id'] = $id;
		$this->load->library ( 'zyk/OfferLib' );
		$this->offerlib->deleteOffer ( $data );
	}
	public function editOffer($id)
	{	$this->load->library ( 'zyk/OfferLib' );
		$offer = $this->offerlib->getOfferById ($id );
		//print_r($offer);
		$this->load->library('zyk/General');
		$this->load->library ( 'zyk/RestaurantOfferLib' );
		$cities = $this->general->getCities();
	
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
		$this->template->build ('offer/EditOffer');
	}
	public function updateOffer()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['restid'] = $this->input->post('restid');
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['url'] = $this->input->post('url');
		$data['coupon_code'] = $this->input->post('coupon_code');
		$data['status'] = $this->input->post('status');
		$data['priority'] = $this->input->post('priority');
		if($this->input->post('offer_type')==1)
		{
			$data['offer_type'] = 1;
			$data['position'] = $this->input->post('position');
		}
		else
		{
			$data['offer_type'] = 0;
				
		}
		$config = array();
		$config ['allowed_types'] = 'jpg|png|gif';
		$config ['max_size'] = '200';
		$this->load->library ( 'upload', $config );
		if (!$_FILES['avatar1']['size'] == 0 && $_FILES['avatar1']['error'] == 0)
		{
			$image_path = 'assets/images/offer/';
			$temp_image = explode ( ".", $_FILES ['avatar1'] ['name'] );
			$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
			$data ['avatar'] = 'images/offer/'.$image;
			move_uploaded_file ( $_FILES ['avatar1'] ['tmp_name'], $image_path .$image );
		}
		
		
		//print_r($data);
		$this->load->library ( 'zyk/OfferLib' );
		$this->offerlib->updateOffer ( $data );
		redirect('admin/offer/offerlist');
	}
	
	
}