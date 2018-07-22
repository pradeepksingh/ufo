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
	public function timings_get() 
	{
		$restid = $this->get('restid');
		if(!$restid)
		{
			$this->response(array('error' => 'Invalid request, insufficient parameters!'), 400);
		}
		$this->load->library('zyk/RestaurantLib');
		$timings = $this->restaurantlib->getRestaurantCustomTimings($restid);
		$this->response ( $timings,200);
	}
	
	public function checkdelivery_get() {
		$latitude = $this->get('latitude');
		$longitude = $this->get('longitude');
		$restid = $this->get('restid');
		if(!$latitude)
		{
			$this->response(array('error' => 'Invalid request, insufficient parameters!'), 400);
		}
		if(!$longitude)
		{
			$this->response(array('error' => 'Invalid request, insufficient parameters!'), 400);
		}
		if(!$restid)
		{
			$this->response(array('error' => 'Invalid request, insufficient parameters!'), 400);
		}
		$this->load->library('zyk/RestaurantLib');
		$resp = array();
		$restaurant = $this->restaurantlib->getRestaurantBasicDetails($restid);
		if($restaurant[0]['have_gf'] == 1) {
			$coords = json_decode($restaurant[0]['fence'],true);
			$point = array();
			$point['latitude'] = $latitude;
			$point['longitude'] = $longitude;
			if(count($coords) > 0){
				if($this->is_delivery_geopoint($coords, $point)){
					$resp['status'] = 1;
				} else {
					$resp['status'] = 0;
				}
			}else{
				$distance = getGeoDistance($latitude,$longitude,$restaurant[0]['latitude'],$restaurant[0]['longitude']);
				if($distance <= $restaurant[0]['radius']) {
					$resp['status'] = 1;
				} else {
					$resp['status'] = 0;
				}
			}
		} else {
			$distance = getGeoDistance($latitude,$longitude,$restaurant[0]['latitude'],$restaurant[0]['longitude']);
			if($distance <= $restaurant[0]['radius']) {
				$resp['status'] = 1;
			} else {
				$resp['status'] = 0;
			}
		}
		$this->response ( $resp,200);
	}
	
	public function menupage_get() {
		$this->load->library('zyk/MenuLib');
		$this->load->library('zyk/General');
		$this->load->library('zyk/SearchLib');
		$restid = $this->get('restid');
		if(!$restid)
		{
			$this->response(array('error' => 'Invalid request, insufficient parameters!'), 400);
		}
		$map = array();
		$map['restid'] = $restid;
		$items = $this->menulib->completemenu($restid);
		$area = $this->searchlib->getAreasByRestId($restid);
		$reviews = $this->general->getRestaurantReviews($restid);
		if(!empty($this->get('latitude')) && !empty($this->get('longitude'))) {
			$map['latitude'] = $this->get('latitude');
			$map['longitude'] = $this->get('longitude');
		} else {
			if(count($area)) {
				$map['latitude'] = $area[0]['latitude'];
				$map['longitude'] = $area[0]['longitude'];
			}
		}
		$restaurant = $this->searchlib->getRestaurantDetails($map);
		$resp = array();
		$resp['restaurant'] = $restaurant;
		$resp['items'] = $items;
		$resp['area'] = $area;
		$resp['reviews'] = $reviews;
		$this->response ( $resp,200);
	}
	
	public function checkoutpage_get() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/SearchLib');
		$this->load->library('zyk/UserLoginLib');
		$this->load->library('zyk/CartLib');
		$restid = $this->get('restid');
		$userid = $this->get('userid');
		if(!$restid)
		{
			$this->response(array('error' => 'Invalid request, insufficient parameters!'), 400);
		}
		$map = array();
		$map['restid'] = $restid;
		$area = $this->searchlib->getAreasByRestId($restid);
		if(!empty($this->get('latitude')) && !empty($this->get('longitude'))) {
			$map['latitude'] = $this->get('latitude');
			$map['longitude'] = $this->get('longitude');
		} else {
			if(count($area)) {
				$map['latitude'] = $area[0]['latitude'];
				$map['longitude'] = $area[0]['longitude'];
			}
		}
		$restaurant = $this->searchlib->getRestaurantDetails($map);
		$delivery_time = date('H:i',strtotime('+'.$restaurant[0]['time'].' minutes'));
		$rest_timings = array(
				'mstart_time'=>$restaurant[0]['mstart_time'],
				'mclose_time'=>$restaurant[0]['mclose_time'],
				'estart_time'=>$restaurant[0]['estart_time'],
				'eclose_time'=>$restaurant[0]['eclose_time'],
				'deltime'=>$restaurant[0]['time'],
				'del_time'=>$delivery_time
		);
		$current_time = date('H:i:s');
		if($current_time <= $restaurant[0]['eclose_time']) {
			$current_date = date('Y-m-d');
			$del_timing = getDeliveryTime($rest_timings);
		} else {
			$current_date = date('Y-m-d',strtotime('+1 day'));
			$del_timing = getAdvanceDeliveryTime($rest_timings);
		}
		$del_dates = $this->cartlib->getDeliveryDates($restid,$current_date);
		$areas = $this->general->getAreasByCityId($restaurant[0]['cityid']);
		$resp = array();
		$address = array();
		if(!empty($userid)) {
			$address = $this->userloginlib->getAddressById($userid);
		}
		$resp['restaurant'] = $restaurant;
		$resp['areas'] = $areas;
		$resp['area'] = $area;
		$resp['del_dates'] = $del_dates;
		$resp['del_timing'] = $del_timing;
		$resp['address'] = $address;
		$this->response ( $resp,200);
	}
	
	public function placeorder_post() {
		$this->load->library('zyk/CartLib');
		$this->load->library('zyk/UserLib');
		$email = $this->post('email');
		$mobile = $this->post('mobile');
		$cartmap = array();
		$cartmap['restid'] = $this->post('restid');
		$cartmap['session_cookie'] = $this->post('session_cookie');;
		$cartmap['order_type'] = $this->post('order_type');
		$cartmap['latitude'] = $this->post('latitude');
		$cartmap['longitude'] = $this->post('longitude');
		$cartmap['coupon_code'] = $this->post("coupon_code");
		$cartmap['payment_mode'] = $this->post('payment_mode');
		$cartmap['email'] = $this->post('email');
		$cartmap['mobile'] = $this->post('mobile');
		$cartmap['is_checkout'] = 1;
		$cart = $this->cartlib->getOrderCart($cartmap);
		$oupdate = array();
		if($cart['subtotal'] >= $cart['mov']) {
			$payment_details = array();
			$customer = array();
			$customer['userid'] = $this->post('userid');
			$customer['name'] = $this->post('name');
			$customer['email'] = $this->post('email');
			$customer['mobile'] = $this->post('mobile');
			$customer['areaid'] = $this->post('areaid');
			$customer['locality'] = $this->post('locality');
			$customer['latitude'] = $this->post('latitude');
			$customer['longitude'] = $this->post('longitude');
			$customer['address'] = $this->post('address');
			$customer['landmark'] = $this->post('landmark');
			$customer['special_instruction'] = addslashes(trim($this->post('special_instructions'))); //shinee 26May
			$zyk_discount = $cart['zyk_discount'];
			$rest_discount = $cart['rest_discount'];
			$order = array();
			$order['restid'] = $this->post('restid');
			$order['areaid'] = $this->post('areaid');
			$order['is_takeaway'] = $this->post('order_type');
			if ($this->post('payment_mode') == 1) {
				$payment_details['name'] = $this->input->post('name');
				$payment_details['email'] = $this->input->post('email');
				$payment_details['mobile'] = $this->input->post('mobile');
				if($this->input->post('gateway_type') == 1 ){
					$payment_details['gateway'] = 'payumoney';
				}else if($this->input->post('gateway_type') == 2){
					$payment_details['gateway'] = 'payu';
				}
				$order['is_online_paid'] = 1;
			} else {
				$order['is_online_paid'] = 0;
				$order['payment_status'] = 1;
			}
			$order['delivery_date'] = $this->post("delivery_date");
			$order['delivery_time'] = $this->post("delivery_time");
			$order['coupon_code'] = $this->post("coupon_code");
			$order['sub_total'] = $cart['subtotal'];
			$order['zyk_discount'] = $zyk_discount;
			$order['rest_discount'] = $rest_discount;
			$order['order_tax'] = $cart['tax'];
			$order['service_charge'] = $cart['service_tax'];
			$order['delivery_charge'] = $cart['delivery_charge'];
			$order['packaging_charge'] = $cart['packaging'];
			$order['total_amount'] = $cart['ordertotal'];
			$order['userid'] = $customer['userid'];
			$this->load->library('zyk/OrderLib');
			$orderid = $this->orderlib->addOrder($order);
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			$this->orderlib->updateOrder($oupdate);
			$customer['orderid'] = $orderid;
			$this->orderlib->addOrderCustomer($customer);
			$orderitems = array();
			$ordersubitems = array();
			foreach ($cart['cartitems'] as $oitem) {
				$citem = array();
				$citem['orderid'] = $orderid;
				$citem['itemid'] = $oitem['itemid'];
				$citem['option_id'] = $oitem['option_id'];
				$citem['quantity'] = $oitem['quantity'];
				$citem['size'] = $oitem['size'];
				$citem['price'] = $oitem['price'];
				$citem['packaging_charge'] = $oitem['packaging'];
				$orderitems[] = $citem;
				foreach ($oitem['itemsets'] as $optionmcat) {
					$osubitem = array();
					$osubitem['orderid'] = $orderid;
					$osubitem['itemid'] = $oitem['itemid'];
					$osubitem['option_id'] = $oitem['option_id'];
					$osubitem['itemset'] = $optionmcat['itemset'];
					foreach ($optionmcat['option_category'] as $optioncat) {
						foreach ($optioncat['items'] as $csubitem) {
							$osubitem['sub_item_id'] = $csubitem['sub_item_id'];
							$osubitem['subitem_price'] = $csubitem['price'];
							$ordersubitems[] = $osubitem;
						}
					}
				}
			}
			$this->orderlib->addOrderItems($orderitems);
			$this->orderlib->addOrderSubItems($ordersubitems);
			$payment_details['amount'] = $cart['ordertotal'];
			$payment_details['orderid'] = $orderid;
			$payment_details['ordercode'] = $oupdate['ordercode'];
			$payment_details['referer_id'] = 'olotime';
			if ($this->post('payment_mode') == 1) {
				$this->load->library('zyk/payment/OnlinePayment');
				$data = $this->onlinepayment->startPayment($payment_details);
				$oupdate['pdata'] = $data['data'];
				$oupdate['payment_url'] = $data['payment_url'];
				$oupdate['payment_mode'] = 1;
				$oupdate['restid'] = $order['restid'];
				$oupdate['status'] = 1;
				$oupdate['message'] = 'Your order have been placed successfully.';
				$oupdate['is_verified'] = 1;
			} else {
				$neworder = $this->orderlib->getOrderDetails($orderid);
				$this->orderlib->sendNewOrderSMS($neworder[0]);
				$oupdate['payment_mode'] = 0;
				$oupdate['restid'] = $order['restid'];
				$oupdate['status'] = 1;
				$oupdate['message'] = 'Your order have been placed successfully.';
				$oupdate['is_verified'] = 1;
			}
		} else {
			$errorMsg = array();
			$errors = array();
			$error = array('mov'=>'Rs '.$cart['mov'].' minimum order value required.');
			array_push ( $errors, $error );
			$errorMsg['errors'] = $errors;
			$oupdate['status'] = 0;
			$oupdate['errormsg'] = $errorMsg;
			$oupdate['message'] = 'Rs '.$cart['mov'].' minimum order value required.';
			$oupdate['is_verified'] = 1;
		}
		$this->response ( $oupdate,200);
	}
	
	public function paymentresponse_post() {
		$this->load->library('zyk/payment/OnlinePayment');
		$response = $this->post();
		$payment_status = $response['status'];
		$ordercode = $response['txnid'];
		$amount = $response['amount'];
		$trans_id = $response['txnid'];
		$payment_arr = array();
		$payment_arr['ordercode'] = $response['txnid'];
		$payment_arr['transaction_id'] = $response['mihpayid'];
		$payment_arr['transaction_code'] = $response['status'];
		$payment_arr['transaction_amount'] = $response['amount'];
		$payment_arr['gateway'] = $response['gateway'];
		$omap = array();
		$omap['ordercode'] = $ordercode;
		if ($payment_status == 'success') {
			$omap['status'] = 0;
			$omap['payment_status'] = 1;
			$payment_arr['status'] = 1;
		} else {
			$omap['status'] = 2;
			$omap['payment_status'] = 2;
			$payment_arr['status'] = 2;
		}
		$this->load->library('zyk/OrderLib');
		$this->onlinepayment->storePaymentResponse($payment_arr);
		$this->orderlib->updateOrderByCode($omap);
		$order = $this->orderlib->getOrderDetails($ordercode);
		if($omap['payment_status'] == 2) {
			$this->orderlib->sendPaymentFailedSMS($order[0]);
		}
		$this->response ( $order[0],200);
	}
	
	public function updatepayurl_post() {
		$params = array();
		$params['ordercode'] = $this->post('ordercode');
		$params['pay_url'] = $this->post('pay_url');
		$this->load->library('zyk/payment/OnlinePayment');
		$this->onlinepayment->updateOnlinePayment($params);
		$this->response (array('status'=>1),200);
	}
	
	public function thankyoupage_get() {
		$this->load->library('zyk/OrderLib');
		$ordercode = $this->get('ordercode');
		$session_cookie = $this->get('session_cookie');
		$order = $this->orderlib->getOrderDetails($ordercode);
		if(!empty($session_cookie)) {
			if($order[0]['is_online_paid'] == 1) {
				if($order[0]['payment_status'] == 1) {
					$this->orderlib->sendNewOrderEmail($order[0]);
					$this->orderlib->sendNewOrderSMS($order[0]);
					$map['restid'] = $order[0]['restid'];
					$map['session_cookie'] = $session_cookie;
					$this->load->library('zyk/CartLib');
					$this->cartlib->clearCart($map);
				}
			} else {
				//$this->orderlib->sendNewOrderEmail($order[0]);
				//$this->orderlib->sendNewOrderSMS($order[0]);
				$map['restid'] = $order[0]['restid'];
				$map['session_cookie'] = $session_cookie;
				$this->load->library('zyk/CartLib');
				$this->cartlib->clearCart($map);
			}
		}
		$items = $this->orderlib->getOrderItemDetails($order[0]['orderid']);
		$resp = array();
		$resp['order'] = $order;
		$resp['items'] = $items;
		$this->response ( $resp,200);
	}
	
	public function additem_post() {
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['session_cookie'] = $this->post('session_cookie');
		$map['itemid'] = $this->post('itemid');
		$map['option_id'] = $this->post('option_id');
		$map['quantity'] = $this->post('quantity');
		$map['size'] = $this->post('size');
		$map['price'] = $this->post('price');
		$data = $this->cartlib->addCartItem($map);
		$sub_item_id = $this->post('sub_item_id');
		if(!empty($sub_item_id)) {
			if(is_array($sub_item_id)) {
				$itemset = $this->cartlib->getCartItemSet(
						array('restid'=>$map['restid'],'session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'])
				);
				$sub_price = $this->post('sub_price');
				$subitems = array();
				for($i = 0; $i < count($sub_item_id); $i++) {
					$subitem = array();
					$subitem['restid'] = $map['restid'];
					$subitem['session_cookie'] = $map['session_cookie'];
					$subitem['option_id'] = $map['option_id'];
					$subitem['sub_item_id'] = $sub_item_id[$i];
					$subitem['subitem_price'] = $sub_price[$i];
					if ($itemset > 0) {
						$subitem['itemset'] = $itemset+1;
					} else {
						$subitem['itemset'] = 1;
					}
					$subitems[] = $subitem;
				}
				$this->cartlib->addCartSubItems($subitems);
			}
		}
		unset($map);
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['session_cookie'] = $this->post('session_cookie');
		$map['order_type'] = $this->post('order_type');
		$map['latitude'] = $this->post('latitude');
		$map['longitude'] = $this->post('longitude');
		$map['payment_mode'] = $this->post('payment_mode');
		if(!empty($this->post('coupon_code')))
			$map['coupon_code'] = $this->post('coupon_code');
		if(!empty($this->post('email')))
			$map['email'] = $this->post('email');
		if(!empty($this->post('mobile')))
			$map['mobile'] = $this->post('mobile');
		$result = $this->getCart($map);
		$this->response ( $result,200);
	}
	
	public function removeitem_post() {
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['session_cookie'] = $this->post('session_cookie');
		$map['itemid'] = $this->post('itemid');
		$map['option_id'] = $this->post('option_id');
		$map['quantity'] = $this->post('quantity');
		$itemset = $this->post('itemset');
		$this->cartlib->removeCartItem($map);
		if(!empty($itemset)) {
			if($itemset != "") {
				$subitems = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'itemset'=>$itemset);
				$this->cartlib->removeCartSubItems($subitems);
			}
		}
		unset($map);
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['session_cookie'] = $this->post('session_cookie');
		$map['order_type'] = $this->post('order_type');
		$map['latitude'] = $this->post('latitude');
		$map['longitude'] = $this->post('longitude');
		$map['payment_mode'] = $this->post('payment_mode');
		if(!empty($this->post('coupon_code')))
			$map['coupon_code'] = $this->post('coupon_code');
		if(!empty($this->post('email')))
			$map['email'] = $this->post('email');
		if(!empty($this->post('mobile')))
			$map['mobile'] = $this->post('mobile');
		$result = $this->getCart($map);
		$this->response ( $result,200);
	}
	
	public function getCart($params) {
		$map = array();
		$map['restid'] = $params['restid'];
		$map['session_cookie'] = $params['session_cookie'];
		$map['order_type'] = $params['order_type'];
		$map['latitude'] = $params['latitude'];
		$map['longitude'] = $params['longitude'];
		$map['payment_mode'] = $params['payment_mode'];
		if(!empty($params['coupon_code']))
			$map['coupon_code'] = $params['coupon_code'];
		if(!empty($params['email']))
			$map['email'] = $params['email'];
		if(!empty($params['mobile']))
			$map['mobile'] = $params['mobile'];
		$this->load->library('zyk/CartLib');
		return $this->cartlib->getOrderCart($map);
	}
	
	public function clearcart_get() {
		$map = array();
		$map['restid'] = $this->get('restid');
		$map['session_cookie'] = $this->get('session_cookie');
		$map['order_type'] = $this->get('order_type');
		$map['latitude'] = $this->get('latitude');
		$map['longitude'] = $this->get('longitude');
		$map['payment_mode'] = $this->get('payment_mode');
		if(!empty($this->get('coupon_code')))
			$map['coupon_code'] = $this->get('coupon_code');
		if(!empty($this->get('email')))
			$map['email'] = $this->get('email');
		if(!empty($this->get('mobile')))
			$map['mobile'] = $this->get('mobile');
		$this->load->library('zyk/CartLib');
		$this->cartlib->clearCart($map);
		$result = $this->getCart($map);
		$this->response ( $result,200);
	}
	
	public function applycoupon_get() {
		$cresponse = array();
		$cresponse['status'] = 1;
		$cresponse['data'] = array('status'=>0);
		$params = array();
		$params['coupon_code'] = $this->get('coupon_code');
		$params['restid'] = $this->get('restid');
		$params['date'] = date('Y-m-d');
		$params['time'] = date('H:i:s');
		$params['order_amount'] = $this->get('subtotal');
		$params['email'] = $this->get('email');
		$params['mobile'] = $this->get('mobile');
		if(!empty($this->get('payment_mode'))) {
			$params['payment_mode'] = $this->get('payment_mode');
		} else {
			$params['payment_mode'] = '';
		}
		if(!empty($this->get('coupon_code'))) {
			$this->load->library('zyk/CartLib');
			$cresponse = $this->cartlib->getCouponDiscount($params);
		}
		$map = array();
		$map['restid'] = $this->get('restid');
		$map['session_cookie'] = $this->get('session_cookie');
		$map['order_type'] = $this->get('order_type');
		$map['latitude'] = $this->get('latitude');;
		$map['longitude'] = $this->get('longitude');;
		$map['coupon_code'] = $this->get('coupon_code');
		$map['is_checkout'] = 1;
		$map['payment_mode'] = $this->get('payment_mode');
		if(!empty($this->get('email')))
			$map['email'] = $this->get('email');
		if(!empty($this->get('mobile')))
			$map['mobile'] = $this->get('mobile');
		$this->load->library('zyk/CartLib');
		$cart = $this->cartlib->getOrderCart($map);
		$resp = array();
		$resp['cart'] = $cart;
		$resp['cresponse'] = $cresponse;
		$this->response ( $resp,200);
	}
	
	function is_delivery_geopoint($fence,$point){
		$x = $point['latitude'];
		$y = $point['longitude'];
		$polySides = count($fence);
		$j = $polySides - 1;
			
		$multiple = array();
		$constant = array();
			
		for($i=0; $i<$polySides; $i++) {
			if($fence[$j]['longitude']==$fence[$i]['longitude']) {
				$constant[$i]=$fence[$i]['latitude'];
				$multiple[$i]=0;
			}
			else {
				$constant[$i]=$fence[$i]['latitude']-($fence[$i]['longitude']*$fence[$j]['latitude'])/($fence[$j]['longitude']-$fence[$i]['longitude'])+($fence[$i]['longitude']*$fence[$i]['latitude'])/($fence[$j]['longitude']-$fence[$i]['longitude']);
				$multiple[$i]=($fence[$j]['latitude']-$fence[$i]['latitude'])/($fence[$j]['longitude']-$fence[$i]['longitude']);
			}
			$j=$i;
		}
			
		$polySides = count($fence);
		$j = $polySides - 1;
		$oddNodes = false;
			
		for ($i=0; $i<$polySides; $i++) {
			if (($fence[$i]['longitude']< $y && $fence[$j]['longitude']>=$y
					||   $fence[$j]['longitude']< $y && $fence[$i]['longitude']>=$y)) {
						$oddNodes^=($y*$multiple[$i]+$constant[$i]<$x);
					}
					$j=$i;
		}
			
		return $oddNodes;
	}
	
	public function savereview_post() {
		$this->load->library('zyk/general');
		$ratings = array();
		$ratings['restid'] = $this->post("restid");
		$ratings['userid'] = $this->post("userid");
		$ratings['rating'] = $this->post("rating");
		$ratings['rated_on'] = date('Y-m-d H:i:s');
		$data = $this->general->saveRating($ratings);
		if(!empty($this->input->post("review"))) {
			$reviews = array();
			$reviews['restid'] = $this->post("restid");
			$reviews['userid'] = $this->post("userid");
			$reviews['review'] = $this->post("review");
			$reviews['review_on'] = date('Y-m-d H:i:s');
			$data = $this->general->saveReview($reviews);
		}
		$this->response (array('status'=>1),200);
	}
	
	public function reviews_get() {
		$this->load->library('zyk/general');
		$restid = $this->get("restid");
		$reviews = $this->general->getRestaurantReviews($restid);
		$this->response ( $reviews,200);
	}
	
}