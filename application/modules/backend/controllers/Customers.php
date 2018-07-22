<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controller for adding clients and cleint's order.
 * @author pankaj
 *
 */
class Customers extends MX_Controller{
	
	public function __construct() {
		parent::__construct ();
	}
	/**
	 * Get all clients added from frontend and backend
	 * @author pankaj
	 * return client list
	 */
	public function customerList()
	{
		$this->load->library('zyk/CustomerLib','customerlib');
		$customers = $this->customerlib->getUserList();
		$this->template->set('customers',$customers);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Customers' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('customer/customerList');
	} 
	/**
	 * build page for add new client
	 * @author pankaj
	 */
	public function newCustomer(){
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Customer' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('customer/addCustomer');
	}
	/**
	 * adding client from backend
	 * @author pankaj
	 */
	public function addCustomer() {
		//$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$text_password = $this->input->post('password');
		$password = md5 ($text_password);
		$otp  = mt_rand ( 100000, 999999 );
		$coupon_code  = mt_rand ( 100000, 999999 );
		$created_on = date('Y-m-d');
		$last_login = date('Y-m-d H:i:s');
		$data = array();
		$data = array(
				'name' => $name,
				'email' => $email,
				'mobile' => $mobile,
				'password' => $password,
				 'original' => $text_password,
				'otp' => $otp,
				'coupon_code' => $coupon_code,
				'created_on' => $created_on,
				'last_login' => $last_login,
				'source' => 2
		);
		$this->load->library('zyk/CustomerLib', 'customerlib');
		$response = $this->customerlib->addCustomer($data);
		echo json_encode($response);
	}
	
	public function editCustomer($id) {
		$this->load->library('zyk/CustomerLib','customerlib');
		$customers = $this->customerlib->getCustomerById($id);
		$this->template->set('customers',$customers);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Customer' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('customer/editCustomer');
	}
	
	public function updateCustomer() {
		//$admin_id = $this->session->userdata['adminsession']['id'];
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$text_password = $this->input->post('password');
		$otp = $this->input->post('otp');
		$coupon_code = $this->input->post('coupon_code');
		$created_on = $this->input->post('created_on');
		$last_login = $this->input->post('last_login');
		$source = $this->input->post('source');
		$password = md5 ($text_password);
		$data = array();
		$data = array(
				'id' => $id,
				'name' => $name,
				'email' => $email,
				'mobile' => $mobile,
				'password' => $password,
				'original' => $text_password,
				'otp' => $otp,
				'coupon_code' => $coupon_code,
				'created_on' => $created_on,
				'last_login' => $last_login,
				'source' => $source
		);
		$this->load->library('zyk/CustomerLib', 'customerlib');
		$response = $this->customerlib->updateCustomer($data);
		echo json_encode($response);
	}
	
	
	public function newCustomerOrder(){
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Customer' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('customerorders/newOrder');
	}
	
	public function getaddress($id){
		$this->load->library('zyk/CustomerLib','customerlib');
		$customers = $this->customerlib->getCustomerAddressById($id);
	//	print_r($customers);
		echo json_encode($customers);
	}
	
	public function addNewAddress(){
	  $name =	$this->input->post('name');
	 $userId = $this->input->post('userid');
	 $mobile = $this->input->post('mobile');
	 $email = $this->input->post('email');
	 $original = '123456';
	 $password = md5($original);
	 $otp  = mt_rand ( 100000, 999999 );
	 $coupon_code  = mt_rand ( 100000, 999999 );
	 $created_on = date('Y-m-d');
	 $last_login = date('Y-m-d H:i:s');
	 
	 $users = array(
	 	'id' => $userId,
	 	'source' => 2,
	 	'name' => $name,
	 	'email' => $email,
	 	'mobile' => $mobile,
	 	'password' => $password,
	 	'original' => $original,
 		'otp' => $otp,
 		'coupon_code' => $coupon_code,
 		'created_on' => $created_on,
 		'last_login' => $last_login
	 );
	 
	 $addressname = $this->input->post('addressname');
	 $address = $this->input->post('shipperaddress');
	 $aptno = $this->input->post('aptno');
	 $locality = $this->input->post('locality');
	 if( $this->input->post('latitude') != "")
	 	$latitude = $this->input->post('latitude');
	 else 
	 	$latitude = 0;
	 if($this->input->post('longitude') != "")
		 $longitude = $this->input->post('longitude');
	 else 
	 	$longitude = 0;
	 $landmark = $this->input->post('landmark');
	 $pincode = $this->input->post('pincode');
	 $city = $this->input->post('city');
	 $state = $this->input->post('state');
	 $areaId = 0;
	 $addressopt = 0;
	 $newaddress = array(
	 		'address_name' => $addressname,
	 		'userid' => $userId,
	 		'areaid' => $areaId,
	 		'address' => $address,
	 		'apt_no' => $aptno,
	 		'locality' => $locality,
	 		'latitude' => $latitude,
	 		'longitude' => $longitude,
	 		'landmark' => $landmark,
	 		'pincode' => $pincode,
	 		'city' => $city,
	 		'state' => $state,
	 		'address_opt' => $addressopt
	 );
	 $this->load->library('zyk/CustomerLib', 'customerlib');
	 $response = $this->customerlib->addCustomerAddress($users,$newaddress);
	 echo json_encode($response);
	}
	
	public function getProductsByCategory(){
		$id = $this->input->post('id');
		$this->load->library('zyk/CustomerLib','customerlib');
		$customers = $this->customerlib->getProductsByCategory($id);
		//	print_r($customers);
		echo json_encode($customers);
	}
	
	public function getProductsByIds(){
		$id = $this->input->post('id');
		$this->load->library('zyk/CustomerLib','customerlib');
		$customers = $this->customerlib->getProductsByIds($id);
		echo json_encode($customers);
	}
	
	public function addCustomerOrder(){
		
		date_default_timezone_set('Asia/Kolkata');
		$categories = $this->input->post('filer_category_ids');
		$productids = $this->input->post('productids');
		$qty = $this->input->post("quantity");	
		$unitprice = $this->input->post('unitprice');
		$hunitpricetotal = $this->input->post('hunitpricetotal');
		$userid = $this->input->post('newuserid');
		$addressid = $this->input->post('newaddressid');
		$subtotal = $this->input->post('hsubtotal');
		$grandtotal = $this->input->post('grandtotal');
		$default = 0;
		$comment = "";
		$deliverydate = strtotime("+2 days");
		$order = array(
			'restid' => $default,
			'userid' => $userid,
			'areaid' => $default,
			'sub_total' => $subtotal,
			'zyk_discount'=> $default,
			'rest_discount'=> $default,
			'order_tax'=> $default,
			'service_charge'=> $default,
			'delivery_charge' => $default,
			'packaging_charge' => $default,
			'order_amount' => $default,
			'net_total' =>  $default,
			'grand_total' => $grandtotal,
			'invoice_status' =>  $default,
			'total_amount'=> $default,
			'delivery_date' => date('Y-m-d',$deliverydate),
			'delivery_time' =>  date('h:m:s',$deliverydate),
			'created_date' => date('Y-m-d h:m:s'),
			'category_id'=> $default,
			'subcategory_id'=> $default,
			'product_id'=> $default,
			'vendor_id' => $default,
			'manufacture_id' => $default,
			'order_status' => $default,
			'comment' =>$comment
		);
		$this->load->library('zyk/CustomerLib','customerlib');
		$customers = $this->customerlib->addCustomerOrder($order,$addressid,$productids,$qty,$unitprice,$hunitpricetotal);
		echo json_encode($customers);
	}
	
	public function orderList(){
		$this->load->library('zyk/CustomerLib','customerlib');
		$orderlist = $this->customerlib->getOrderList();
		$this->template->set('orderlist',$orderlist);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Customers Order List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('customerorders/orderList');
	}
}