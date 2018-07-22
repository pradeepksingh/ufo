<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	public function login_post() 
	{
		$data = array();
		$data['username'] = $this->post('username');
		$data['password'] = $this->post('password');
		
		$this->load->library('zyk/Clientauth');
		$userdata = $this->clientauth->login($data);
		$this->response ( $userdata,200);
	}
	
	public function orderDashboard_get($client_id) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getRestaurantTodaysOrders($client_id);
		$this->response ( $orders,200);
	}
	
	public function pendingOrders_get($restid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getRestaurantTodaysPendingOrders($restid);
		$this->response ( $orders,200);
	}
	
	public function confirmedOrders_get($restid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getRestaurantTodaysConfirmedOrders($restid);
		$this->response ( $orders,200);
	}
	
	public function cancelledOrders_get($restid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getRestaurantTodaysCancelledOrders($restid);
		$this->response ( $orders,200);
	}
	
	public function orderDetail_get($orderid) {
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/General');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$cartitems = $this->orderlib->getOrderItemDetails($orderid);
		$logs = $this->orderlib->getOrderLogs($orderid);
		$reasons = $this->general->getActiveReasons();
		$gateway = array();
		if($orders[0]['is_online_paid'] == 1) {
			$gateway = $this->orderlib->getOrderGatewayDetails($orderid);
		}
		$order = array();
		if(count($orders) > 0) {
			$order = $orders[0];
			$order['cartitems'] = $cartitems;
			$order['reasons'] = $reasons;
			if(count($gateway) > 0)
			$order['payment_gateway'] = $gateway[0]['gateway'];
			else 
			$order['payment_gateway'] = '';
		}
		$this->response ( $order,200);
	}
	
	public function orderInfo_get($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$this->response ( $orders[0],200);
	}
	
	public function acceptOrder_post($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		//$flag = $this->orderlib->sendOrderConfirmationEmail($orders[0]);
		$response = array();
		$orderdata = array();
		$orderdata['orderid'] = $orderid;
		$orderdata['status'] = 1;
		$this->orderlib->updateOrder($orderdata);
		if($orders[0]['is_takeaway'] == 1) {
			$this->orderlib->sendPickUpOrderConfirmationSMS($orders[0]);
		} else {
			$this->orderlib->sendDeliveryOrderConfirmationSMS($orders[0]);
		}
		$response['status'] = 1;
		$response['message'] = 'Order confirmed.';
		$this->response ( $response,200);
	}
	
	public function rejectOrder_post($orderid) {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
		$orders[0]['reason'] = $this->post('comment');
		$flag = true;
		//$flag = $this->orderlib->sendOrderCancellationEmail($orders[0]);
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
			$corder['reason_id'] = $this->post('reason_id');
			$this->orderlib->addCancelOrderReason($corder);
			$response['status'] = 1;
			$response['message'] = 'Order cancelled.';
		} else {
			$response['status'] = 0;
			$response['message'] = 'Failed to cancel order.';
		}
		$this->response ( $response,200);
	}
	
	public function searchClientOrders_post() {
		$params = array();
		$params['client_id'] = $this->post('client_id');
		if(!empty($this->post('restid')))
		$params['restid'] = $this->post('restid');
		if(!empty($this->post('from_date')))
		$params['from_date'] = $this->post('from_date');
		if(!empty($this->post('to_date')))
		$params['to_date'] = $this->post('to_date');
		if(!empty($this->post('mobile')))
		$params['mobile'] = $this->post('mobile');
		if(!empty($this->post('orderid')))
		$params['orderid'] = $this->post('orderid');
		if(!empty($this->post('status')))
		$params['status'] = $this->post('status');
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->searchClientOrders($params);
		$this->response ( $orders,200);
	}
	
	public function orderReasons_get() {
		$this->load->library('zyk/General');
		$reasons = $this->general->getActiveReasons();
		$this->response ( $reasons,200);
	}
	
	public function contact_post() {
		$params = array();
		$params['restid'] = $this->post('restid');
		$params['email'] = $this->post('email');
		$params['mobile'] = $this->post('mobile');
		$params['subject'] = $this->post('subject');
		$params['description'] = $this->post('description');
		$this->load->library('zyk/General');
		$result = $this->general->saveContactUs($params);
		$this->response ( $result,200);
	}
	
	public function feedback_post() {
		$params = array();
		$params['restid'] = $this->post('restid');
		$params['email'] = $this->post('email');
		$params['name'] = $this->post('name');
		$params['description'] = $this->post('description');
		$this->load->library('zyk/General');
		$result = $this->general->addFeedback($params);
		$this->response ( $result,200);
	}
	
	public function restlist_get($client_id) {
		$this->load->library('zyk/clientauth');
		$rests = $this->clientauth->getClientRestaurants($client_id);
		$this->response ( $rests,200);
	}
	
	public function menuitems_get($restid) {
		$this->load->library('zyk/MenuLib');
		try {
			$template = $this->menulib->getMenuTemplate($restid);
			$items = $this->menulib->getMenuItems($restid);
			$group = $this->groupItems($template['mcategories'], $template['categories'],$items);
		}catch(Exception $e) {
			$group = array();
		}
		$this->response ( $group,200);
	}
	
	public function turnoffmenu_get($size_id,$restid) {
		$this->load->library('zyk/MenuLib');
		$this->menulib->turnOffItem($size_id,$restid);
		$response = array();
		$response['status'] = 1;
		$response['msg'] = "Item Turned Off";
		$this->response ( $response,200);
	}
	
	public function turnonmenu_get($size_id,$restid) {
		$this->load->library('zyk/MenuLib');
		$this->menulib->turnOnItem($size_id,$restid);
		$response = array();
		$response['status'] = 1;
		$response['msg'] = "Item Turned On";
		$this->response ( $response,200);
	}
	
	private function groupItems( $mcategories, $categories , $items)
	{
		$group = array();
		$cats = array();
		$item = array();
		$i = 0;
		foreach($mcategories as $key=>$row) {
			$group [$i] = $row;
			$c = 0;
			foreach($categories as $key1=>$row1)
			{
				if($row1['menu_mcat_id'] == $row['id'])
				{
					$cats[$c] = $row1;
					$item = array();
					foreach($items as $key2=>$row2)
					{
						if($row2['menu_cat_id'] == $row1['id'])
						{
							$item [] = $row2;
						}
					}
					if(!empty($item) && count($item) > 0)
						$cats[$c]['items'] = $item;
					if(empty($item) || count($item) <= 0) {
						unset($cats[$c]);
					}else {
						$c++;
					}
					unset($item);
				}
			}
			if(count($cats) > 0)
				$group [$i]['categories']  = $cats;
			if(count($cats) <=0) {
				unset($group [$i]);
			}else {
				$i++;
			}
			unset($cats);
		}
		return $group;
	}
	
}

	