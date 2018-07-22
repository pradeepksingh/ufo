<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Global_config {
	private $CI;
	private $fb_config;
	
	function load_config() {
		$this->CI = &get_instance();
		$app_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->CI->template->set('google_api_key',$app_config['google_api_key']);
		if($this->CI->router->directory=="../modules/frontend/controllers/"){
	        $this->CI->template->set('olouserid',$this->CI->session->userdata('olouserid'));
			$this->CI->template->set('olousername',$this->CI->session->userdata('olousername'));
			$this->CI->template->set('olouseremail',$this->CI->session->userdata('olouseremail'));
			$this->CI->template->set('olousermobile',$this->CI->session->userdata('olousermobile'));
		} else if($this->CI->router->directory=="../modules/backend/controllers/"){
			$this->CI->load->library('zyk/OrderLib');
			//$cp_orders = $this->CI->orderlib->countPendingOrdersByDate(date('Y-m-d'));
			//$cp_payments = $this->CI->orderlib->countPendingPaymentOrdersByDate(date('Y-m-d'));
			$cp_orders = array();
			$cp_payments = array();
			if(count($cp_payments) > 0)
				$this->CI->template->set('zkpending_payments',$cp_payments[0]['pending_payments']);
			else
				$this->CI->template->set('zkpending_payments',0);
			if(count($cp_orders) > 0)
				$this->CI->template->set('zkpending_orders',$cp_orders[0]['pending_orders']);
			else 
				$this->CI->template->set('zkpending_orders',0);
		} else if ($this->CI->router->directory=="../modules/varuna/controllers/") {
			$this->CI->template->set('olouserid',$this->CI->session->userdata('olouserid'));
			$this->CI->template->set('olousername',$this->CI->session->userdata('olousername'));
			$this->CI->template->set('olouseremail',$this->CI->session->userdata('olouseremail'));
			$this->CI->template->set('olousermobile',$this->CI->session->userdata('olousermobile'));
		}
	}
	
	function initilize_config() {
		$this->CI->template->set('base_url',base_url());
		$this->CI->load->library('session');
		$this->CI->load->helper('cookie');
	}
	
}
