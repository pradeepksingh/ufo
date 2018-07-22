<?php
class ReportLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function getAllUser()
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$users = $this->CI->report->getAllUser ( );
		return $users;
	}
	public function searchUser($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$users = $this->CI->report->searchUser ( $data);
		return $users;
	}
	public function OrdervsArea()
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->OrdervsArea ( );
		return $orders;
	}
	public function searchOrdervsArea($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->searchOrdervsArea ( $data);
		return $orders;
	}
	public function searchPaidvsCOD($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->searchPaidvsCOD ( $data);
		return $orders;
	}
	public function searchSuccessfullvsFail ($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->searchSuccessfullvsFail ( $data);
		return $orders;
	}
	public function searchDeliveryvsTakeaway ($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->searchDeliveryvsTakeaway ( $data);
		return $orders;
	}
	public function searchRestaurantsvsOrders ($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->searchRestaurantsvsOrders ( $data);
		return $orders;
	}
	
	public function getRestDeliveryOrders($params) {
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$orders = $this->CI->report->getRestDeliveryOrders ( $params);
		return $orders;
	}
	
	public function bannerReport()
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$report = $this->CI->report->bannerReport ( );
		return $report;
	}
	
	public function searchBannerReport($data)
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$report = $this->CI->report->searchBannerReport ( $data);
		return $report;
	}
	public function subscribeReport()
	{
		$this->CI->load->model ( 'report/Report_model', 'report' );
		$report = $this->CI->report->subscribeReport ( );
		return $report;
	}
	
}
