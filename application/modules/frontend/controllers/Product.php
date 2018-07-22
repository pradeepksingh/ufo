<?php
require(APPPATH."/third_party/Pusher.php");
include_once(APPPATH."/third_party/easepay-lib.php");
class Product extends MX_Controller {
	private $MERCHANT_KEY;
	private $SALT;
	private $ENV;
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
		$app_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		//$this->MERCHANT_KEY = 'F4AQW0W27W';
		//$this->SALT = 'BU1GHIKDXT';
		//$this->ENV = 'prod';
	}
	
	public function getCartSession() {
		$temp = $this->session->userdata('cartsession');
		if($temp != null && $temp != '') {
			return $this->session->userdata('cartsession');
		}else {
			$this->session->set_userdata('cartsession', md5(date(DATE_RFC822).time()));
			return $this->session->userdata('cartsession');
		}
	}
	
	public function index() {
		$this->load->library('zyk/ProductLib');
		$products = $this->productlib->getAllActiveProducts();
		$this->template->set('products', $products);
		$this->template->set('page', 'buynow/buynow');
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Products' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('buyNow/buynow');
		
	}
	
	public function productdetails($id) {
		$this->load->library('zyk/ProductLib');
		$products= $this->productlib->getProductDetails($id);
		$product_images = $this->productlib->getProductImages($id);
		$product_devices = $this->productlib->getProductKitDevices($id);
		$product_offers = $this->productlib->getProductOffers($id);
		$product_components = $this->productlib->getProductComponents($id);
		$product_specs = $this->productlib->getProductTechSpecs($id);
		$this->template->set('products', $products);
		$this->template->set('product_images', $product_images);
		$this->template->set('product_devices', $product_devices);
		$this->template->set('product_offers', $product_offers);
		$this->template->set('product_components', $product_components);
		$this->template->set('product_specs', $product_specs);
		$this->template->set ( 'page', 'buynow/productdetail' );
		$this->template->set ( 'description', 'prodcut description' );
		$this->template->set_theme('default_theme');
		// $this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('buyNow/productdetail');
	}
	
	public function purchaseflow() {
		if (! isset ( $_SESSION ['olouserid'] )) {
			redirect ( base_url () );
		}
		
		$this->load->library ( 'zyk/UserLoginLib' );
		$this->load->library('zyk/CartLib','cartlib');
		$userid = $_SESSION ['olouserid'];
		$cartmap['session_cookie'] = $this->getCartSession();
		$cart = $this->cartlib->getProductOrderCart($cartmap);
		$useraddress = $this->userloginlib->getAddressById ( $userid );
		$wallet = $this->userloginlib->getWalletBalance ( $userid );
		$this->template->set ( 'cart', $cart );
		$this->template->set ( 'useraddress', $useraddress );
		$this->template->set ( 'wallet', $wallet );
		$this->template->set ( 'page', 'buynow/purchase-flow' );
		$this->template->set ( 'description', 'Purchase Flow' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('buyNow/purchase-flow');
	}
	
	public function getusersavedaddress($id) {
		$this->load->library ( 'zyk/UserLoginLib' );
		$useraddress = $this->userloginlib->getAddressById ( $id );
		$this->template->set('useraddress',$useraddress);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('buyNow/pages/savedaddress','',true);
	}
	
	public function getsaveaddressById($id) {
		$this->load->library ( 'zyk/UserLoginLib' );
		$address = $this->userloginlib->getAddressByAddressId ( $id );
		$this->template->set('address',$address);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('buyNow/pages/shippingdetails','',true);
	}
	
	public function checkpincode() {
		$pincode = $this->input->post('pincode');
		$this->load->library('zyk/General');
		$date = date('Y-m-d');
		if($pincode != "") {
			$areas = $this->general->getAreasByPincode($pincode);
			if($areas[0]['status'] == 1) {
				$resp = array();
				$resp['areaid']= $areas[0]['id'];
				$resp['name'] = $areas[0]['name'];
				$resp['pincode'] = $areas[0]['pincode'];
	
				$resp['msg'] = "Product is available in your area";
				$resp["status"] = 1;
			} else {
				$resp["msg"] = "Product is not available in your area";
				$resp["status"] = 0;
			}
	
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "Pincode is empty";
		}
		echo json_encode($resp);
	}
	
	
	
}