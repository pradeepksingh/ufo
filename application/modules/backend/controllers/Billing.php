<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Billing extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	public function index() {
		$this->load->library ( 'zyk/General' );
		$this->load->library ( 'zyk/BillingLib' );
		$this->load->library ( 'zyk/RestaurantLib' );
		$cities = $this->general->getCities ();
		$areas = $this->general->getAreas ();
		$map = array ();
		// $map['areaid'] = $this->input->get('areaid');
		$restaurants = $this->restaurantlib->getRestaurants ( $map );
		$commlist = $this->billinglib->getCommissionList ( 0 );
		$billitemlist = $this->billinglib->getRestBillingItemList ( 0 );
		
		$this->template->set ( 'commissionobj', $commlist );
		$this->template->set ( 'billingitemobj', $billitemlist );
		$this->template->set ( 'cities', $cities );
		$this->template->set ( 'areas', $areas );
		$this->template->set ( 'restaurants', $restaurants );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/dashboard' );
	}
	
	public function addConfig($restid = "") {
		$id = $restid;
		$this->load->library ( 'zyk/General' );
		$this->load->library ( 'zyk/BillingLib' );
		$this->load->library ( 'zyk/RestaurantLib' );
		$map = array ();
		$cities = $this->general->getCities ();
		$areas = $this->general->getAreas ();
		$cuisines = $this->general->getCuisines ();
		$details = $this->restaurantlib->getRestaurantBasicDetails ( $id );
		$restcuisines = $this->restaurantlib->getRestaurantCuisines ( $id );
		$contacts = $this->restaurantlib->getRestaurantContacts ( $id );
		$props = $this->restaurantlib->getRestaurantProperties ( $id );
		$slabs = $this->restaurantlib->getRestaurantSlabs ( $id );
		$deltimes = $this->restaurantlib->getRestaurantDeliveryTime ( $id );
		$mov = $this->restaurantlib->getRestaurantMov ( $id );
		$bconfig = $this->restaurantlib->getRestaurantBillingConfig ( $id );
		$cycle = $this->restaurantlib->getRestaurantBillingField ( $id, 'cycle_effective_date' );
		$gateway = $this->restaurantlib->getRestaurantBillingField ( $id, 'gateway_effective_date' );
		$config = $this->restaurantlib->getRestaurantConfig ( $id );
		$commlist = $this->billinglib->getCommissionList ( $id );
		$billitemlist = $this->billinglib->getRestBillingItemList ( $id );
		$billinvoices = $this->billinglib->getRestBillingInvoices ( $id );
		// print_r($billitemlist);
		$score = $config [0] ['basic'] + $config [0] ['contact'] + $config [0] ['property'] + $config [0] ['del_slab'] + $config [0] ['del_mov'] + $config [0] ['del_time'] + $config [0] ['billing'] + $config [0] ['menu'];
		$progress = ($score / 8) * 100;
		$billingheads = $this->billinglib->getBillingHeadList ( 0 );
		$this->template->set ( 'billingitemobj', $billitemlist );
		$this->template->set ( 'cities', $cities );
		$this->template->set ( 'areas', $areas );
		$this->template->set ( 'cuisines', $cuisines );
		$this->template->set ( 'basic', $details );
		$this->template->set ( 'contacts', $contacts );
		$this->template->set ( 'restcuisines', $restcuisines );
		$this->template->set ( 'props', $props );
		$this->template->set ( 'slabs', $slabs );
		$this->template->set ( 'deltimes', $deltimes );
		$this->template->set ( 'movs', $mov );
		$this->template->set ( 'bconfig', $bconfig );
		$this->template->set ( 'cycle', $cycle );
		$this->template->set ( 'gateway', $gateway );
		$this->template->set ( 'commissionobj', $commlist );
		$this->template->set ( 'restid', $id );
		$this->template->set ( 'billingheads', $billingheads );
		$this->template->set ( 'billinvoices', $billinvoices );		
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/configuration' );
	}
	public function getServiceTaxList() {
		$this->load->library ( 'zyk/BillingLib' );
		$servicetax = $this->billinglib->getEffServiceTaxList ( 0 );
		$this->template->set ( 'servicetax', $servicetax );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/serviceTaxList' );
	}
	public function newServiceTax() {
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/serviceTaxAdd' );
	}
	public function addServiceTax() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$params ['name'] = $this->input->post ( 'sname' );
		$params ['from_dt'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'effective_dt' ) ) );
		$params ['effective_dt'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'effective_dt' ) ) );
		$params ['tax'] = $this->input->post ( 'tax' );
		$response = $this->billinglib->addEffServiceTax ( $params );
		echo json_encode ( $response );
	}
	public function editServiceTax($id) {
		$this->load->library ( 'zyk/BillingLib' );
		$servicetax = $this->billinglib->getEffServiceTaxList ( $id );
		$this->template->set ( 'servicetax', $servicetax );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/serviceTaxEdit' );
	}
	public function updateServiceTax() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$params ['id'] = $this->input->post ( 'id' );
		$params ['name'] = $this->input->post ( 'sname' );
		$params ['from_dt'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'effective_dt' ) ) );
		//$params ['to_dt'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'to_dt' ) ) );
		$params ['effective_dt'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'effective_dt' ) ) );
		$params ['tax'] = $this->input->post ( 'tax' );
		$response = $this->billinglib->updateEffServiceTax ( $params );
		echo json_encode ( $response );
	}
	
	public function addRestCommission() {
		$params = array ();
		$updarr = array();
		$this->load->library ( 'zyk/BillingLib' );
		// $params['name'] = $this->input->post('comm_name');
		$params ['restid'] = $this->input->post ( 'restid' );
		$response = $this->billinglib->getMaxFromDateByRestComm ( $params ['restid']  );
		$params ['from_date'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'txteffective_date' ) ) );
		
		// $params['to_dt'] = date('Y-m-d',strtotime($this->input->post('to_dt')));
		$params ['effective_date'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'txteffective_date' ) ) );
		$params ['commission_plan'] = $this->input->post ( 'cboRange' );
		$params ['count_amount'] = $this->input->post ( 'cboCntAmt' );
		$params ['lower_limit'] = $this->input->post ( 'lower_limit' );
		$params ['upper_limit'] = $this->input->post ( 'upper_limit' );
		$params ['comm_type'] = $this->input->post ( 'cboCommType' );
		$params ['comm_amt'] = $this->input->post ( 'comm_amt' );
		$params ['comm_amt_zyk'] = $this->input->post ( 'comm_amt_zyk' );
		$response = $this->billinglib->addRestCommission ( $params );
		echo json_encode ( $response );
	}
	
	/*
	 * public function getRestCommissionList(){
	 * $this->load->library('zyk/BillingLib');
	 * $commlist = $this->billinglib->getCommissionList($restid);
	 * $this->template->set('commissionobj',$commlist);
	 * $this->template->set_layout ('backend')
	 * ->title ( 'Administrator | Billing' )
	 * ->set_partial( 'header', 'partials/header' )
	 * ->set_partial( 'leftnav', 'billing/menu' )
	 * ->set_partial( 'footer', 'partials/footer' );
	 * $this->template->build('billing/commissionList');
	 * }
	 */
	public function updateRestCommission() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		
		$params ['id'] = $this->input->post ( 'hdncommid' );
		$params ['restid'] = $this->input->post ( 'restid' );
		$params ['from_date'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'txteffective_date' ) ) );
		$params ['effective_date'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'txteffective_date' ) ) );
		$params ['commission_plan'] = $this->input->post ( 'cboRange' );
		$params ['count_amount'] = $this->input->post ( 'cboCntAmt' );
		$params ['lower_limit'] = $this->input->post ( 'lower_limit' );
		$params ['upper_limit'] = $this->input->post ( 'upper_limit' );
		$params ['comm_type'] = $this->input->post ( 'cboCommType' );
		$params ['comm_amt'] = $this->input->post ( 'comm_amt' );
		$params ['comm_amt_zyk'] = $this->input->post ( 'comm_amt_zyk' );
		$response = $this->billinglib->updateRestCommission ( $params );
		echo json_encode ( $response );
	}
	public function getRestCommission($commid) {
		$params = array ();
		
		$this->load->library ( 'zyk/BillingLib' );
		$commlist = $this->billinglib->getRestCommission ( $commid );
		echo json_encode ( $commlist );
	}
	
	public function saveRestBillingItem() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$billitemid = $this->input->post ( 'billitemid' );
		
		$params ['head_cat_id'] = $this->input->post ( 'cboCat' );
		$params ['head_sub_cat_id'] = $this->input->post ( 'cboSubCat' );
		$params ['restid'] = $this->input->post ( 'rid' );
		$params ['amount'] = $this->input->post ( 'txtamt' );
		$params ['description'] = $this->input->post ( 'txtdesc' );
		$params ['orderId'] = $this->input->post ( 'txtorderid' );
		$params ['item_type'] = $this->input->post ( 'rdoType' );
		$params ['billing_date'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'txtdate' ) ) );
		$params ['status'] = $this->input->post ( 'rdoStatus' );
		$params ['is_service_tax_applicable'] = $this->input->post ( 'rdoServiceTax' );
		$params ['adjustment'] = $this->input->post ( 'rdoAdjustment' );
		$params ['is_separate_invoice'] = $this->input->post ( 'rdoSepInvoice' );
		$params ['billing_frequency'] = $this->input->post ( 'rdoFrequency' );
		if($params ['billing_frequency'] == "")$params ['billing_frequency'] = 0;
		$params ['created_by'] = '';
		$params ['created_on'] = date ( 'Y-m-d' );
		if ($billitemid > 0) {
			$params ['id'] = $billitemid;
			$response = $this->billinglib->updateRestBillingItem ( $params );
		} else {
			$response = $this->billinglib->addRestBillingItem ( $params );
		}
		
		echo json_encode ( $response );
	}
	public function getRestBillingItem($itemid) {
		$params = array ();
		
		$this->load->library ( 'zyk/BillingLib' );
		$feelist = $this->billinglib->getRestBillingItem ( $itemid );
		echo json_encode ( $feelist );
	}
	public function getBillingHeadList() {
		$this->load->library ( 'zyk/BillingLib' );
		$billinghead = $this->billinglib->getBillingHeadList ( 0 );
		$this->template->set ( 'billingheadlist', $billinghead );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/billingHeadList' );
	}
	public function newBillingHead() {
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/billingHeadAdd' );
	}
	public function addBillingHead() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$params ['name'] = $this->input->post ( 'headname' );
		$params ['description'] = $this->input->post ( 'headdescription' );
		$params ['created_on'] = date ( 'Y-m-d' );
		$response = $this->billinglib->addBillingHead ( $params );
		echo json_encode ( $response );
	}
	public function editBillingHead($id) {
		$this->load->library ( 'zyk/BillingLib' );
		$billinghead = $this->billinglib->getBillingHeadList ( $id );
		$this->template->set ( 'billinghead', $billinghead );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/billingHeadEdit' );
	}
	public function updateBillingHead() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$params ['id'] = $this->input->post ( 'id' );
		$params ['name'] = $this->input->post ( 'categoryname' );
		$params ['description'] = $this->input->post ( 'categorydescription' );
		$params ['modified_on'] = date ( 'Y-m-d' );
		$response = $this->billinglib->updateBillingHead ( $params );
		echo json_encode ( $response );
	}
	
	/**
	 * ***
	 */
	public function getBillingSubHeadList() {
		$this->load->library ( 'zyk/BillingLib' );
		$billingsubhead = $this->billinglib->getBillingSubHeadList ( 0 );
		$this->template->set ( 'billingsubheadlist', $billingsubhead );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/billingSubHeadList' );
	}
	public function newBillingSubHead() {
		$this->load->library ( 'zyk/BillingLib' );
		$billinghead = $this->billinglib->getBillingHeadList ( 0 );
		$this->template->set ( 'billinghead', $billinghead );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/billingSubHeadAdd' );
	}
	public function addBillingSubHead() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$params ['head_cat_id'] = $this->input->post ( 'headcat' );
		$params ['name'] = $this->input->post ( 'subheadname' );
		$params ['description'] = $this->input->post ( 'headdescription' );
		$params ['created_on'] = date ( 'Y-m-d' );
		$response = $this->billinglib->addBillingSubHead ( $params );
		echo json_encode ( $response );
	}
	public function editBillingSubHead($id) {
		$this->load->library ( 'zyk/BillingLib' );
		$billingsubhead = $this->billinglib->getBillingSubHeadList ( $id );
		$this->template->set ( 'billingsubhead', $billingsubhead );
		
		$billinghead = $this->billinglib->getBillingHeadList ( 0 );
		$this->template->set ( 'billinghead', $billinghead );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Billing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'billing/billingSubHeadEdit' );
	}
	public function updateBillingSubHead() {
		$params = array ();
		$this->load->library ( 'zyk/BillingLib' );
		$params ['id'] = $this->input->post ( 'id' );
		$params ['head_cat_id'] = $this->input->post ( 'headcat' );
		$params ['name'] = $this->input->post ( 'subcategoryname' );
		$params ['description'] = $this->input->post ( 'categorydescription' );
		$params ['modified_on'] = date ( 'Y-m-d' );
		$response = $this->billinglib->updateBillingSubHead ( $params );
		echo json_encode ( $response );
	}
	public function getBillingSubHeadsByCat() {
		$catid = $this->input->get ( 'catid' );
		$this->load->library ( 'zyk/BillingLib' );
		$subcategory = $this->billinglib->getBillingSubCategoryByCategoryId ( $catid );
		echo json_encode ( $subcategory );
	}
	
	public function getMaxFromDateByRestComm($restid){
		$this->load->library ( 'zyk/BillingLib' );
		$rec = $this->billinglib->getMaxFromDateByRestComm ( $restid );
		return $rec;
	}
	

	
}