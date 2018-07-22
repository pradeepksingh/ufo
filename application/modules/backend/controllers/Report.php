<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Report extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
	
		$this->load->library('zyk/ReportLib');
		$user = $this->reportlib->getAllUser();
		$this->template->set('users',$user);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | User Report' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('user/customerList');
	}
	public function searchUser() {
	    
		$data=array();
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date']=date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		if(!empty($this->input->post('email')))
		{
			$data['email']=$this->input->post('email');
		}
		if(!empty($this->input->post('mobile')))
		{
			$data['mobile']=$this->input->post('mobile');
		}
		
			$data['user']=$this->input->post('user');
		
		//print_r($data['user']);
		$this->load->library('zyk/ReportLib');
		$user = $this->reportlib->searchUser ($data);
		
		echo json_encode($user);
		/*
		$this->template->set_theme ('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | User Report' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/UserReport');
		*/
	}
	public function ordervsArea()
	{
		
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->OrdervsArea();
		$this->template->set('orders',$orders);
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Area vs Order' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/Area-Order');
		
	}
	public function searchOrdervsArea()
	{
		$data=array();
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date']=date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['cityid']=$this->input->post('cityid');
		
		$data['areaid']=$this->input->post('areaid');
		$data['zone_id']=$this->input->post('zone_id');
		//print_r($data);
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchOrdervsArea ($data );
		echo json_encode($orders);
		
	}
	public function paidvsCOD ()
	{
		$data = array();
		$data['from_date'] = date('Y-m-d');
		$data['to_date'] = date('Y-m-d');
		$data['mode'] = '';
		$data['cityid'] = '';
		$data['zone_id'] = '';
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchPaidvsCOD($data);
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('orders',$orders);
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Paid vs COD' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/Paid-COD');
	}
	public function searchPaidvsCOD ()
	{
		$data = array();
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
			
		$data['mode'] = $this->input->post('mode');
		$data['cityid']=$this->input->post('cityid');
		$data['zone_id']=$this->input->post('zone_id');
		
	
		//print_r($data);
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchPaidvsCOD ($data );
		echo json_encode($orders);
		
	}
	public function successfullvsFail()
	{
		$data = array();
		$data['from_date'] = date('Y-m-d');
		$data['to_date'] = date('Y-m-d');
		$data['status'] = null;
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchSuccessfullvsFail ($data );
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Successfull vs Fail' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/Successfull-Fail');
	}
	public function searchSuccessfullvsFail ()
	{
		$data = array();
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['status'] = $this->input->post('status');
		$data['cityid']=$this->input->post('cityid');
		$data['zone_id']=$this->input->post('zone_id');
	
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchSuccessfullvsFail ($data );
		echo json_encode($orders);
	
	}
	public function deliveryvsTakeaway()
	{
		$data = array();
		$data['from_date'] = date('Y-m-d');
		$data['to_date'] = date('Y-m-d');
		$data['status'] = null;
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchDeliveryvsTakeaway ($data );
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Delivery vs Takeaway' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/Delivery-Takeaway');
		
	}
	public function searchDeliveryvsTakeaway ()
	{
		$data = array();
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		
		$data['status'] = $this->input->post('status');
		$data['cityid']=$this->input->post('cityid');
		$data['zone_id']=$this->input->post('zone_id');
	
		//print_r($data);
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchDeliveryvsTakeaway ($data );
		echo json_encode($orders);
	
	}
	
	public function restaurantsvsOrders ()
	{
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->OrdervsArea();
		$this->load->library('zyk/General');
		$this->load->library('zyk/RestaurantLib');
		$cities = $this->general->getCities();
		$areas = $this->general->getAreas();
		$this->load->library('zyk/BannerLib');
		$zone=$this->bannerlib->getAllZones();
		$map = array();
			
		$map['areaid'] = $this->input->get('areaid');
		$rests = $this->restaurantlib->getRestaurants($map);
		$this->template->set('rests',$rests);
		$this->template->set('zone',$zone);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Delivery vs Takeaway' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/Restaurants-Order');
	}
	
	public function searchRestaurantsvsOrders ()
	{
		$data = array();
		
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
			
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date']=date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		if(!empty($this->input->post('restid')))
		{
			$data['restid'] = $this->input->post('restid');
		}
		$data['cityid']=$this->input->post('cityid');
		$data['zone_id']=$this->input->post('zone_id');
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->searchRestaurantsvsOrders ($data );
		echo json_encode($orders);
	
	}
	
	public function getRestDeliveryStats() {
		$params = array();
		if (!empty($this->input->post("from_date"))) {
			$params['from_date'] = date('Y-m-d',strtotime($this->input->post("from_date")));
		} else {
			$params['from_date'] = date('Y-m-d');
		}
		if (!empty($this->input->post("to_date"))) {
			$params['to_date'] = date('Y-m-d',strtotime($this->input->post("to_date")));
		} else {
			$params['to_date'] = date('Y-m-d');
		}
		if($this->input->post('is_online_paid') == '') {
			$params['is_online_paid'] = '';
		} else {
			$params['is_online_paid'] = $this->input->post('is_online_paid');
		}
		$params['status'] = 1;
		$this->load->library('zyk/ReportLib');
		$orders = $this->reportlib->getRestDeliveryOrders($params);
		$codamount = 0;
		$online_amount = 0;
		$codorders = 0;
		$oporders = 0;
		foreach ($orders as $order) {
			if($order['is_online_paid'] == 0) {
				$codorders++;
				$codamount = $codamount + $order['order_amount'];
			} else {
				$oporders++;
				$online_amount = $online_amount + $order['order_amount'];
			}
		}
		$this->template->set('orders',$orders);
		$this->template->set('codorders',$codorders);
		$this->template->set('oporders',$oporders);
		$this->template->set('codamount',$codamount);
		$this->template->set('opamount',$online_amount);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Rest Delivery Orders' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'report/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/RestDeliveryOrders');
	}
	
	public function bannerReport()
	{
		$this->load->library('zyk/ReportLib');
		$report = $this->reportlib->bannerReport();
		$this->template->set('report',$report);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Delivery vs Takeaway' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/banner-report');
	}
	
	public function searchBannerReport()
	{
		$data=array();
		if(!empty($this->input->post('from_date')))
		{
			$data['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
				
		}
		if(!empty($this->input->post('to_date')))
		{
			$data['to_date']=date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		$this->load->library('zyk/ReportLib');
		$report = $this->reportlib->searchBannerReport($data);
		echo json_encode($report);
	}
	public function subscribeReport()
	{
		$this->load->library('zyk/ReportLib');
		$report = $this->reportlib->subscribeReport();
		$this->template->set('users',$report);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Delivery vs Takeaway' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'report/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('report/SubscribeReport');
	}
	
}
