<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Coupan extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/CoupanLib');
		$coupons = $this->coupanlib->getAllCoupons();
		$this->template->set('coupons',$coupons);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Coupan Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupan/CouponList');
	}
	public function getCouponByVendorId()
	{
		$vendorid = $this->input->get('vendorid');
		$this->load->library('zyk/CoupanLib');
		$areas = $this->general->getCouponByVendorId($vendorid);
		echo json_encode($areas);	
	}
	
	public function getRastro() {
		$areaid = $this->input->get('areaid');
		$this->load->library('zyk/CoupanLib');
		$areas = $this->general->getRastByAreaId($areaid);
		echo json_encode($areas);
	}
	
	public function add()
	{
		$this->load->library('zyk/CoupanLib');
		$data = $this->input->post('coupon');
		$data['start_date'] = date('Y-m-d',strtotime($data['start_date']));
		$data['end_date'] = date('Y-m-d',strtotime($data['end_date']));
		$data['status'] = 1;
		$data['created_date'] = date('Y-m-d H:i:s');
		$id = $this->coupanlib->addCoupon($data);
		$response = array();
		if(!empty($id)) {
			$response['status'] = 1;
			$response['msg'] = "Coupon added successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add coupon.";
		}
		echo json_encode($response);
	}
	
   	public function update()
    {
    	$this->load->library('zyk/CoupanLib');
      	$data = $this->input->post('coupon');
		$data['start_date'] = date('Y-m-d',strtotime($data['start_date']));
		$data['end_date'] = date('Y-m-d',strtotime($data['end_date']));
		$data['status'] = 1;
		$data['updated_date'] = date('Y-m-d H:i:s');
		$flag = $this->coupanlib->updateCoupon($data);
		$response = array();
		if($flag) {
			$response['status'] = 1;
			$response['msg'] = "Coupon updated successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to update coupon.";
		}
		echo json_encode($response);
  	}
  	
	public function updateCoupon($a)
	{
		$this->load->library('zyk/General');
		$this->load->library('zyk/CoupanLib');
		$coupons = $this->coupanlib->getCouponById($a);
		$this->template->set('coupon',$coupons[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Coupan Dashboard' )
			->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupan/CouponEdit');
	}
	
	public function addCoupon()
	{
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$cities = $this->general->getCities();
		$areas = $this->general->getAreas();
		
		$this->template->set('cities',$cities);
		$this->template->set('areas',$areas);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Coupan Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupan/CouponNew');
	}
	
	public function newCoupon()
	{
		$coupon = array();
		$coupon['vendor_id'] = $this->input->post('vendor');
		$coupon['coupon_code'] = $this->input->post('coupon_code');
		$coupon['status'] = $this->input->post('status');
		$this->load->library('zyk/CoupanLib');
	    $this->coupanlib->addCoupon($coupon);
	    $this->index();
	}
	
	public function editVendor($a)
	{   $this->load->library('zyk/General');
		$this->load->library('zyk/CoupanLib');
		$vendors = $this->coupanlib->getVendorsById($a);
		$this->template->set('vendors',$vendors);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Coupan Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'coupan/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupan/EditVendor');
		
	}
	
	public function updateVendor()
	{

		$vendor = array();
		$vendor['id']= $this->input->post('id');
		$vendor['title'] = $this->input->post('title');
		$vendor['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		$vendor['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		$vendor['from_time'] = date('H:i:s',strtotime($this->input->post('from_time')));
		$vendor['to_time'] = date('H:i:s',strtotime($this->input->post('totime')));
		$vendor['is_multiple'] = $this->input->post('is_multiple');
		$vendor['is_specific'] = $this->input->post('is_specific');
		$vendor['minimum_order_value'] = $this->input->post('minimum_order_value');
		$vendor['restid'] = $this->input->post('restaurant');
		$vendor['is_day_specific'] = $this->input->post('is_day_specific');
		$vendor['status'] = $this->input->post('status');
		$this->load->library('zyk/CoupanLib');
	    $this->coupanlib->updateVendor($vendor);
	    $this->index();
		
	}
	
   	public function turnoncoupon($id)
   	{
      	$this->load->library('zyk/CoupanLib');
      	$data = array();
		$data['status'] = 1;
		$data['id'] = $id;
		$data['updated_date'] = date('Y-m-d H:i:s');
		$flag = $this->coupanlib->updateCoupon($data);
		$response = array();
		if($flag) {
			$response['status'] = 1;
			$response['msg'] = "Coupon turned on successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to turn on coupon.";
		}
		echo json_encode($response);
   	}
   	
   	public function turnoffcoupon($id)
   	{
     	$this->load->library('zyk/CoupanLib');
     	$data = array();
		$data['status'] = 0;
		$data['id'] = $id;
		$data['updated_date'] = date('Y-m-d H:i:s');
		$flag = $this->coupanlib->updateCoupon($data);
		$response = array();
		if($flag) {
			$response['status'] = 1;
			$response['msg'] = "Coupon turned off successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to turn off coupon.";
		}
		echo json_encode($response);
   	}
   	
   	public function deleteVendor($vendorid)
    {
      	$this->load->library('zyk/CoupanLib');
	   	$this->coupanlib->deleteVendor($vendorid);
   	}
   	
   	public function statusoncoupon($coupon_code)
    {
      	$this->load->library('zyk/CoupanLib');
	    $this->coupanlib->oncoupon($coupon_code);
   	}
   	
   	public function statusoffcoupon($coupon_code)
   	{ 
      	$this->load->library('zyk/CoupanLib');
	    $this->coupanlib->offcoupon($coupon_code);
   	}
   	
   	public function turnOnRestDeal() {
   		$this->load->library('zyk/CoupanLib');
   		$vendors = $this->coupanlib->getActiveSpecificCoupons();
   		$restaurants = array();
   		foreach ($vendors as $key=>$row) {
   			$rest_arr = explode(",",$row['restid']);
   			foreach ($rest_arr as $value) {
   				$restaurant = array();
     			$restaurant['id'] = $value;
     			$restaurant['has_deal'] = 1;
     			$restaurants[] = $restaurant;
   			}
   		}
   		if(count($restaurants) > 0) {
   			$this->load->library('zyk/RestaurantLib');
   			$this->restaurantlib->batchUpdateRestaurants($restaurants);
   		}
   	}
   	
   	public function turnOffRestDeal() {
   		$this->load->library('zyk/CoupanLib');
   		$vendors = $this->coupanlib->getInActiveSpecificCoupons();
   		$restaurants = array();
   		foreach ($vendors as $key=>$row) {
   			$rest_arr = explode(",",$row['restid']);
   			foreach ($rest_arr as $value) {
   				$restaurant = array();
   				$restaurant['id'] = $value;
   				$restaurant['has_deal'] = 0;
   				$restaurants[] = $restaurant;
   			}
   		}
   		if(count($restaurants) > 0) {
   			$this->load->library('zyk/RestaurantLib');
   			$this->restaurantlib->batchUpdateRestaurants($restaurants);
   		}
   	}
	
}
