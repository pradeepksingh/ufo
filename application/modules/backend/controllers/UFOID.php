<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class UFOID extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/Lead', 'lead' );
	}
	
	public function index() {
		$this->load->library('zyk/Lead', 'lead');
		$ufoids = $this->lead->getAllUFOID();
		$this->template->set('ufoids',$ufoids);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/UFOList');
	}
	
	/***************************** UFO ***********************************/
	
	
	public function newUFOID(){
		
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/UFOAdd');
	}
	
	public function addUFOID(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$ufoid= $this->input->post('ufoid');
		$status = $this->input->post('status');
		$data = array();
		$data = array(
				'ufoid' => $ufoid,
				'status' => 1,
				'is_available' => $status,
				'created_by' => $admin_id,
				
		);
		$result = $this->lead->addUFOID($data);
		echo json_encode($result);
	
	}
	public function editUFOID($id){
		
		$ufoids = $this->lead->getUFOIDById($id);
		$this->template->set('ufoids',$ufoids);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/UFOEdit');
		
	}
	public function updateUFOID(){
		$date = date('Y-m-d H:i:s');
		$admin_id = $this->session->userdata['adminsession']['id'];
		$ufoid = $this->input->post('ufoid');
		$status = $this->input->post('status');
		$availabe = $this->input->post('availibility');
		$id = $this->input->post('id');
		$data = array();
		$data = array(
				'id' => $id,
				'ufoid' => $ufoid,
				'status' => 1,
				'is_available' => $status,
				'updated_by' => $admin_id,
				'updated_date' => $date,
				
		);
		$result = $this->lead->updateUFOID($data);
		echo json_encode($result);
		
	}
	
	/* ************************************ Order ************************ */
	
	public function createOrderByLeadId($id){
		$leadCustomer = $this->lead->getLeadById($id);
		$this->template->set('customers',$leadCustomer);
		$this->load->library('zyk/OrderLib', 'order' );
		$products = $this->order->getProductBackendOrder($id);
		$this->template->set('products',$products);
		$ufoids = $this->lead->getAvailableUFOID();
		$this->template->set('ufoids',$ufoids);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/createOrder');
	}
	
	public function createOrder(){
		$this->load->library('zyk/OrderLib', 'order' );
		$products = $this->order->getProductBackendOrder();
		$this->template->set('products',$products);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/NewOrder');
	}
	
	public function addOrder(){
		$data= array();
		$users =array();
		$products =array();
		$orders =array();
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$address = $this->input->post('address');
		$locality = $this->input->post('locality');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$password = MD5($this->input->post('mobile'));
		$text_pass = $this->input->post('mobile');
		$product_id = $this->input->post('product_name');
		$qty = $this->input->post('qty');
		$unitPrice = $this->input->post('unit-price');
		$rowTotal = $this->input->post('rowTotalPrice');
		$subtotal = $this->input->post('subTotal');
		$grandTotal = $this->input->post('Grand_Total');
		$discount = $this->input->post('discount-price');
		//print_r($product_id);
		
		$cpt = count($product_id);
		for($i=0 ; $i <= $cpt-1; $i++){
			$product = array();
			$product=array(
					'itemid' => $product_id[$i],
					'quantity' => $qty[$i],
					'price' => $unitPrice[$i],
					'total_amount' => $rowTotal[$i],
			);
			//print_r($product);
			$products[] =$product;
		}
		$users =array(
				'name' => $name,
				'email' =>$email,
				'mobile' => $mobile,
				'password' => $password,
				'source' => 3,
				'status' =>1
		);
		
		$order_customer =array();
		 $order_customer = array(
		 		'name' => $name,
		 		'email' =>$email,
		 		'mobile' => $mobile,
		 		'source' => 3,
		 		'address' => $address,
		 		'locality' => $locality,
		 		'latitude' => $latitude,
		 		'longitude' => $longitude
		 		
		 );
		$addresses = array();
		$addresses = array(
				'address' => $address,
				'locality' => $locality,
				'latitude' => $latitude,
				'longitude' => $longitude
				
		);
		$orders= array(
				'sub_total' => $subtotal,
				'grand_total' => $grandTotal,
				'rest_discount' => $discount,
				'status' => 1,
				
		); 
		
		$data['users'] = $users;
		$data['products'] = $products;
		$data['orders'] = $orders;
		
		
		$this->load->library('zyk/OrderLib', 'order' );
		$result = $this->order->addOrderByLead($users, $products, $orders, $addresses, $order_customer);
		redirect('admin/order');
	}
	
	public function availableUFO(){
		$leadCustomer = $this->lead->getLeadById($id);
		$ufoids = $this->lead->getAvailableUFOID();
		$result =$this->template->set('ufoids',$ufoids);
		echo json_encode($reult);
	}
}