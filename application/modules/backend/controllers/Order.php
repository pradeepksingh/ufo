<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Order extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getTodaysOrderCount();
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'orders/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/dashboard');
	}
	
	public function invoice($orderid) {
		echo "inside";
			$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrders($orderid);
		$products = $this->orderlib->getOrderProducts($orderid);
		$this->template->set('order',$orders[0]);
		//	$this->template->set('invoice_number',$invoice_id);
			$this->template->set('products',$products);
	$this->template->set_theme('default_theme');
	$this->template->set_layout (false)
						   ->title ( 'Administrator | Generate Invoice' );
	$html = $this->template->build ('orders/InvoiceDetails','',true);
	}
	
	public function pendingOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getPendingOrdersByDate($current_date);
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/PendingOrders');
	}
	
	public function completedOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getCompletedOrdersByDate();
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/CompletedOrders');
	}
	
	public function allOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getAllOrder();
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/AllOrders');
	}
	
	public function cancelledOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getCancelledOrdersByDate($current_date);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/CancelledOrders');
	}
	
	public function paymentFailedOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getFailedPaymentOrdersByDate($current_date);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'orders/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/PaymentFailedOrders');
	}
	
	public function pendingPaymentOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getPendingPaymentOrdersByDate($current_date);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'orders/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/pPaymentOrders');
	}
	
	public function advanceOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getAdvanceOrdersByDate($current_date);
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'orders/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/AdvanceOrders');
	}
	
	public function delOrders() {
		$current_date = date('Y-m-d');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getDelOrdersByDate($current_date);
		$this->template->set('page','porders');
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'orders/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/DeliveryOrders');
	}
	
	public function searchOrders() {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->searchOrders(array());
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Order Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'orders/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/SearchOrders');
	}
	
	public function search() {
		$this->load->library('zyk/OrderLib');
		$map = array();
		if(!empty($this->input->post("from_date")))
		$map['from_date'] = date('Y-m-d',strtotime($this->input->post("from_date")));
		if(!empty($this->input->post("to_date")))
		$map['to_date'] = date('Y-m-d',strtotime($this->input->post("to_date")));
		$map['orderid'] = $this->input->post("orderid");
		$map['mobile'] = $this->input->post("mobile");
		$orders = $this->orderlib->searchOrders($map);
		echo json_encode($orders);
	}
	
	public function viewOrder ($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/General');
		$this->load->library('zyk/Lead');
		$ufoids = $this->lead->getAvailableUFOID();
		$this->template->set('ufoids',$ufoids);
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		if(empty($orders[0]['cse_id']) || $orders[0]['cse_id'] == null) {
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['cse_id'] = $this->session->userdata('adminsession')['id'];
			$this->orderlib->updateOrder($orderdata);
		}
		$cartitems = $this->orderlib->getOrderItemDetails($orderid);
		$logs = $this->orderlib->getOrderLogs($orderid);
		$reasons = $this->general->getActiveReasons();
		$gateway = array();
		print_r($orders[0]['is_online_paid']);
		if($orders[0]['is_online_paid'] == 1) {
			$gateway = $this->orderlib->getOrderGatewayDetails($orderid);
		}
		$this->template->set('order',$orders[0]);
		$this->template->set('cartitems',$cartitems);
		$this->template->set('reasons',$reasons);
		$this->template->set('logs',$logs);
		$this->template->set('gateway',$gateway);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Order Dashboard' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'orders/menu' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/OrderDetails');
	}
	
	public function placeOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$this->orderlib->sendRestaurantOrderEmail($orders[0]);
		$flag = $this->orderlib->sendOrderConfirmationEmail($orders[0]);
		$response = array();
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['status'] = 1;
		$this->orderlib->updateOrder($orderdata);
		if($orders[0]['is_takeaway'] == 1) {
			$this->orderlib->sendPickUpOrderConfirmationSMS($orders[0]);
			$this->orderlib->sendRestaurantPickupOrderSMS($orders[0]);
		} else {
			$this->orderlib->sendDeliveryOrderConfirmationSMS($orders[0]);
			$this->orderlib->sendRestaurantDeliveryOrderSMS($orders[0]);
		}
		$logs = array();
		$logs['orderid'] = $orderid;
		$logs['comment'] = $this->input->get('comment');
		$logs['created_date'] = date('Y-m-d H:i:s');
		$logs['cse_id'] = $this->session->userdata('adminsession')['id'];
		$this->orderlib->addOrderLog($logs);
		$response['status'] = 1;
		$response['message'] = 'Order Placed to restaurant.';
		echo json_encode($response);
	}
	
	public function cancelOrder($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$orders[0]['reason'] = $this->input->get('comment');
		$flag = $this->orderlib->sendOrderCancellationEmail($orders[0]);
		$response = array();
		if($flag) {
			$csms = array();
			$csms['name'] = $orders[0]['name'];
			$csms['mobile'] = $orders[0]['mobile'];
			$csms['restname'] = $orders[0]['restname'];
			$csms['ordercode'] = $orders[0]['ordercode'];
			$csms['reason'] = $orders[0]['reason'];
			$this->orderlib->sendOrderCancelSMS($csms);
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['status'] = 2;
			$this->orderlib->updateOrder($orderdata);
			$corder = array();
			$corder['orderid'] = $orderid;
			$corder['reason_id'] = $this->input->get('reason_id');
			$this->orderlib->addCancelOrderReason($corder);
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = $this->input->get('comment');
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['cse_id'] = $this->session->userdata('adminsession')['id'];
			$this->orderlib->addOrderLog($logs);
			$response['status'] = 1;
			$response['message'] = 'Order cancelled.';
		} else {
			$response['status'] = 0;
			$response['message'] = 'Failed to cancel order.';
		}
		echo json_encode($response);
	}
	
	public function isRestaurantFirstOrder($restid) {
		$this->load->library('zyk/OrderLib');
		echo $this->orderlib->isRestaurantFirstOrder($restid);
	}
	
	public function isUserFirstOrder($userid) {
		$this->load->library('zyk/OrderLib');
		echo $this->orderlib->isUserFirstOrder($userid);
	}
	
	public function clientOrders() {
		$this->load->library('zyk/ClientOrderLib');
		$orders = $this->clientorderlib->getClientOrders();
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Order Dashboard' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'orders/menu' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/ClientOrders');
	}
	public function clientOrderDetail($id) {
		$this->load->library('zyk/ClientOrderLib');
		$this->load->library('zyk/General');
		
		$orders = $this->clientorderlib->getClientOrderDetail($id);
		
		if(empty($orders[0]['cse_id']) || $orders[0]['cse_id'] == null) {
			$orderdata = array();
			$orderdata['id'] = $id;
			$orderdata['cse_id'] = $this->session->userdata('adminsession')['id'];
			$this->clientorderlib->updateClientOrder($orderdata);
		}
		$reasons = $this->general->getActiveReasons();
		$this->template->set('order',$orders[0]);
		$this->template->set('reasons',$reasons);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Order Dashboard' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'orders/menu' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/ClientOrderDetail');
	}
	
	public function acceptClientOrder($orderid) {
		$this->load->library('zyk/ClientOrderLib');
		$params = array();
		$params['id'] = $orderid;
		$params['status'] = 1;
		$result = $this->clientorderlib->updateClientOrder($params);
		if ($result) {
			$response['status'] = 1;
			$response['msg'] = 'Order Accepted successfully.';
			$orders = $this->clientorderlib->getClientOrderDetail($orderid);
			$order_details = $orders[0];
			$dack = array();
			$dack['task_def'] = 'PND';
			$dack['pickup_customer_name'] = $order_details['restname'];
			$dack['pickup_customer_contact'] = '18002660292';
			$dack['pickup_datetime'] = date('Y-m-d H-i-s');
			$dack['pickup_address'] = $order_details['address'].', '.$order_details['areaname'].', '.$order_details['landmark'];
			$dack['pickup_nearby_address'] = $order_details['rest_locality'];
			$dack['pickup_mapLat'] = $order_details['rest_latitude'];
			$dack['pickup_mapLng'] = $order_details['rest_longitude'];
			$dack['pickup_customer_id'] = $order_details['restid'];
			$dack['delivery_customer_name'] = $order_details['name'];
			$dack['delivery_customer_contact'] = $order_details['mobile'];
			$dack['delivery_datetime'] = date('Y-m-d H-i-s',strtotime('+45 minutes',strtotime($order_details['created_date'])));
			$dack['delivery_address'] = $order_details['delivery_address'];
			$dack['delivery_nearby_address'] = $order_details['locality'];
			$dack['delivery_mapLat'] = $order_details['latitude'];
			$dack['delivery_mapLng'] = $order_details['longitude'];
			$dack['delivery_customer_id'] = $order_details['restid'];
			$dack['invoice_number'] = '';
			$dack['item_description'] = $order_details['order_items'];
			$dack['item_info'] = '';
			$dack['item_quantity'] = null;
			$this->load->library('zyk/Dack');
			$this->dack->moveToDack($dack);
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to accept order.';
		}
		echo json_encode($response);
	}
	
	public function rejectClientOrder($orderid) {
		$this->load->library('zyk/ClientOrderLib');
		$params = array();
		$params['id'] = $orderid;
		$params['status'] = 2;
		$params['reason_id'] = $this->input->get('reason_id');
		$result = $this->clientorderlib->updateClientOrder($params);
		if ($result) {
			$response['status'] = 1;
			$response['msg'] = 'Order Rejected successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to reject order.';
		}
		echo json_encode($response);
	}
	
	public function newOrder() {
		$this->load->library('zyk/RestaurantLib');
		$this->load->library('zyk/ClientOrderLib');
		$restaurant = $this->restaurantlib->getRestaurants(array('status'=>1));
		$category = $this->clientorderlib->getCategory();
		$this->template->set('restaurants',$restaurant);
		$this->template->set('category',$category);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | New Order' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'partials/sidebar' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/NewOrder');
	}
	
	public function addOrder() {
		$response = array();
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['mobile'] = $this->input->post('mobile');
		$params['email'] = $this->input->post('email');
		$params['delivery_address'] = $this->input->post('delivery_address');
		$params['order_items'] = $this->input->post('order_items');
		$params['locality'] = $this->input->post('locality');
		$params['latitude'] = $this->input->post('latitude');
		$params['longitude'] = $this->input->post('longitude');
		$params['is_online_paid'] = $this->input->post('is_online_paid');
		$params['order_amount'] = $this->input->post('order_amount');
		$params['created_date'] = date('Y-m-d H:i:s');
		$params['status'] = 0;
		$this->load->library('zyk/ClientOrderLib');
		$result = $this->clientorderlib->addOrder($params);
		if ($result) {
			$response['status'] = 1;
			$response['msg'] = 'Order added successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add order.';
		}
		echo json_encode($response);
	}
	
		public function editform()
	{
		$data['orderid'] = $this->input->post('chkid');
		$data['order_status'] = $this->input->post('status');
		$data['comment'] = $this->input->post('comment');
		$this->load->library('zyk/OrderLib');
			$boolvalue = $this->orderlib->editform($data);
			if($boolvalue == 1)
			{
				//$map['status'] = 1;      
				$map['msg'] = "Updated successfully";
				redirect(base_url()."admin/order/completedorders");
			}
			else
			{
				//$map['status'] = 0;
				$map['msg'] = "Failed to update";
			}
		
		echo json_encode($map);
	}
	
	public function updateOrderStatus($orderid) {
		
		$status = $this->input->post('status');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrders($orderid);
		//print_r($orders);
		$products = $this->orderlib->getOrderProducts($orderid);
		//print_r($products);
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['order_status'] = $status;
		$this->orderlib->editform($orderdata);
		$response['status'] = 1;
		$response['msg'] = 'Order Status Updated Successfully.';
		
	    if($orders[0]['invoice_status'] == 0) {
			//$items = $this->orderlib->getOrderItems($orderid);
			//$adjustment = $this->input->post('adjustment');
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['order_amount'] = $orders[0]['order_amount'];
			//$orderdata['zyk_discount'] = $dis;
			//$orderdata['adjustment'] = $adjustment;
			$orderdata['delivery_charge'] = 40;
			$orderdata['net_total'] = $orders[0]['order_amount'] + $orderdata['delivery_charge'];
			$orderdata['grand_total'] = $orderdata['net_total'];
			$invoice  = array();
			$invoice['orderid'] = $orders[0]['orderid'];
			$invoice['order_amount'] = $orders[0]['order_amount'];
			//$invoice['discount'] = $orderdata['zyk_discount'];
			$invoice['service_tax'] = $orders[0]['service_charge'];
			$invoice['net_total'] = $orderdata['net_total'];
			//$invoice['adjustment'] = $orderdata['adjustment'];
			$invoice['grand_total'] = $orderdata['grand_total'];
			$invoice['invoice_date'] = date('Y-m-d H:i:s');
			$invoice['status'] = 0;
			$invoice_id = $this->orderlib->generateInvoice($invoice);
			if($invoice_id > 0) {
				$orderdata['invoice_status'] = 1;
			}
			$this->orderlib->updateOrder($orderdata);
			$orders[0]['order_amount'] = $orderdata['order_amount'];
			$orders[0]['grand_total'] = $orderdata['grand_total'];
			$orders[0]['net_total'] = $orderdata['net_total'];
			$orders[0]['delivery_charge'] = $orderdata['delivery_charge'];
			//$orders[0]['adjustment'] = $orderdata['adjustment'];
			$orders[0]['discount'] = $orderdata['zyk_discount'];
			$this->template->set('order',$orders[0]);
			$this->template->set('invoice_number',$invoice_id);
			$this->template->set('products',$products);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false)
						   ->title ( 'Administrator | Generate Invoice' );
			$html = $this->template->build ('orders/InvoiceDetails','',true);
			$file_name = "invoice_".$invoice_id.".pdf";
			$this->load->library('MyPdfLib');
			$url = $this->mypdflib->getPdf($html,$file_name);
			// $payment_url = base_url().'paynow/'.$orderid;
			$newinvoice = array();
			$newinvoice['id'] = $invoice_id;
			$newinvoice['invoice_url'] = $url;
			$this->orderlib->updateInvoice($newinvoice);
			$data = array();
			$data['name'] = $orders[0]['name'];
			$data['bill_amount'] = $orders[0]['grand_total'];
			$data['invoice_url'] = $url;
			//$data['payment_url'] = $payment_url;
			$data['email'] = $orders[0]['email'];
			$data['mobile'] = $orders[0]['mobile'];
			$this->orderlib->sendInvoiceEmail($data);
			//echo $success;
			//$this->orderlib->sendInvoiceSMS($data);
			/*$data['name'] = $orders[0]['name'];
			$data['email'] = $orders[0]['email'];
			$data['mobile'] = $orders[0]['mobile'];
			$data['amount'] = $orders[0]['grand_total'];
			$data['orderid'] = $orderid;
			$this->load->library ( 'mylib/PaymentLib' );
			$resp = $this->paymentlib->getPaymentUrl($data);*/
			// $logs = array();
			// $logs['orderid'] = $orderid;
			// $logs['comment'] = 'Invoice Generated';
			// $logs['created_date'] = date('Y-m-d H:i:s');
			// $logs['created_by'] = $this->session->userdata('adminsession')['id'];
			// $this->orderlib->addOrderLogs($logs);
			//$response['test'] = 'Order Invocie Send Successfully.';
			
		} 
		
		echo json_encode($response);
	}
	
	public function orderDetail($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailById($orderid);
		$products = $this->orderlib->getOrderProducts($orderid);
		$this->template->set('order',$orders[0]);
		$this->template->set('products',$products);
		$this->template->set('logs',array());
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Order Dashboard' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'partials/sidebar' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('orders/OrderDetails');
	}
	
	public function generateInvoice($orderid) {
		$dis=$this->input->get('discount');
		//echo "discount=".$dis;
		$response = array();
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetails($orderid);
		if($orders[0]['invoice_status'] == 0) {
			//$items = $this->orderlib->getOrderItems($orderid);
			//$adjustment = $this->input->post('adjustment');
			$orderdata = array();
			$orderdata['orderid'] = $orderid;
			$orderdata['order_amount'] = $orders[0]['order_amount'];
			$orderdata['zyk_discount'] = $dis;
			//$orderdata['adjustment'] = $adjustment;
			$orderdata['delivery_charge'] = 40;
			$orderdata['net_total'] = $orders[0]['order_amount'] + $orderdata['delivery_charge'] - $dis;
			$orderdata['grand_total'] = $orderdata['net_total'];
			$invoice  = array();
			$invoice['orderid'] = $orders[0]['orderid'];
			$invoice['order_amount'] = $orders[0]['order_amount'];
			$invoice['discount'] = $orderdata['zyk_discount'];
			$invoice['service_tax'] = $orders[0]['service_charge'];
			$invoice['net_total'] = $orderdata['net_total'];
			//$invoice['adjustment'] = $orderdata['adjustment'];
			$invoice['grand_total'] = $orderdata['grand_total'];
			$invoice['invoice_date'] = date('Y-m-d H:i:s');
			$invoice['status'] = 0;
			$invoice_id = $this->orderlib->generateInvoice($invoice);
			if($invoice_id > 0) {
				$orderdata['invoice_status'] = 1;
			}
			$this->orderlib->updateOrder($orderdata);
			$orders[0]['order_amount'] = $orderdata['order_amount'];
			$orders[0]['grand_total'] = $orderdata['grand_total'];
			$orders[0]['net_total'] = $orderdata['net_total'];
			$orders[0]['delivery_charge'] = $orderdata['delivery_charge'];
			//$orders[0]['adjustment'] = $orderdata['adjustment'];
			$orders[0]['discount'] = $orderdata['zyk_discount'];
			$this->template->set('order',$orders[0]);
			$this->template->set('invoice_number',$invoice_id);
			//$this->template->set('items',$items);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false)
						   ->title ( 'Administrator | Generate Invoice' );
			$html = $this->template->build ('orders/InvoiceDetails','',true);
			$file_name = "invoice_".$invoice_id.".pdf";
			$this->load->library('MyPdfLib');
			$url = $this->mypdflib->getPdf($html,$file_name);
			// $payment_url = base_url().'paynow/'.$orderid;
			$newinvoice = array();
			$newinvoice['id'] = $invoice_id;
			$newinvoice['invoice_url'] = $url;
			$this->orderlib->updateInvoice($newinvoice);
			// $data = array();
			// $data['name'] = $orders[0]['name'];
			// $data['bill_amount'] = $orders[0]['grand_total'];
			// $data['invoice_url'] = $url;
			// $data['payment_url'] = $payment_url;
			// $data['email'] = $orders[0]['email'];
			// $data['mobile'] = $orders[0]['mobile'];
			// $this->orderlib->sendInvoiceEmail($data);
			// $this->orderlib->sendInvoiceSMS($data);
			/*$data['name'] = $orders[0]['name'];
			$data['email'] = $orders[0]['email'];
			$data['mobile'] = $orders[0]['mobile'];
			$data['amount'] = $orders[0]['grand_total'];
			$data['orderid'] = $orderid;
			$this->load->library ( 'mylib/PaymentLib' );
			$resp = $this->paymentlib->getPaymentUrl($data);*/
			// $logs = array();
			// $logs['orderid'] = $orderid;
			// $logs['comment'] = 'Invoice Generated';
			// $logs['created_date'] = date('Y-m-d H:i:s');
			// $logs['created_by'] = $this->session->userdata('adminsession')['id'];
			// $this->orderlib->addOrderLogs($logs);
			if(!empty($invoice_id)) {
				$response['status'] = 1;
				$response['msg'] = 'Invoice Generated Successfully.';
			} else {
				$response['status'] = 1;
				$response['msg'] = 'Failed to generate invoice.';
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Invoice already generated.';
		}
		echo json_encode($response);
	}
	
}
