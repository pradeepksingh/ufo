<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require(APPPATH."/third_party/Pusher.php");

/**
 * Cart API
 * @author Pradeep Singh
 * @package users
 *
 */
class Api extends REST_Controller {
	private $CI;
	
	public function session_get($restid) {
		$map = array();
		$map['session_cookie'] = md5(date(DATE_RFC822).time().$restid);
		$this->response ( $map,200);
	}
	
	public function count_get() {
		$map = array();
		$map['restid'] = $this->get('restid');
		$map['session_cookie'] = $this->get('session_cookie');
		if (!empty($this->get('session_cookie')))
		{
			$this->load->library('zyk/CartLib');
			$data = $this->cartlib->cartItemCount($map);
			if(empty($data['cart_cnt'])) {
				$data['cart_cnt'] = 0;
			}
		} else {
			$data['cart_cnt'] = 0;
		}
		$this->response ( $data,200);
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
		$result = $this->getCartCount($map);
		$this->response ( $data,200);
	}
	
	public function additems_post() {
		$this->load->library('zyk/CartLib');
		$items = json_decode($this->post('items'),true);
		$item_batch = array();
		$sub_item_batch = array();
		foreach ($items as $item) {
			$map = array();
			$map['restid'] = $this->post('restid');
			$map['session_cookie'] = $this->post('session_cookie');
			$map['itemid'] = $item['itemid'];
			$map['option_id'] = $item['option_id'];
			$map['quantity'] = $item['quantity'];
			$map['size'] = $item['size'];
			$map['price'] = $item['price'];
			$item_batch[] = $map;
			if(count($item['subitems']) > 0) {
				foreach ($item['subitems'] as $subitems) {
					$subitem = array();
					$subitem['restid'] = $map['restid'];
					$subitem['session_cookie'] = $map['session_cookie'];
					$subitem['option_id'] = $map['option_id'];
					$subitem['itemid'] = $map['itemid'];
					$subitem['sub_item_id'] = $subitems['sub_item_id'];
					$subitem['subitem_price'] = $subitems['sub_item_price'];
					$subitem['itemset'] = $subitems['item_set'];
					$sub_item_batch[] = $subitem;
				}
			}
		}
		$item_map = array();
		$item_map['restid'] = $this->post('restid');
		$item_map['session_cookie'] = $this->post('session_cookie');
		$item_map['items'] = $item_batch;
		$sitem_map = array();
		$sitem_map['restid'] = $this->post('restid');
		$sitem_map['session_cookie'] = $this->post('session_cookie');
		$sitem_map['subitems'] = $sub_item_batch;
		if(count($item_batch) > 0)
		$this->cartlib->addCartItemBatch($item_map);
		if(count($sub_item_batch) > 0)
		$this->cartlib->addCartSubItemBatch($sitem_map);
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
		$this->load->library('zyk/CartLib');
		$cart = $this->cartlib->getOrderCart($map);
		$this->response ( $cart,200);
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
		$result = $this->getCartCount($map);
		$this->response ( $data,200);
	}
	
	public function cart_get() {
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
		$cart = $this->cartlib->getOrderCart($map);
		$this->response ( $cart,200);
	}
	
	public function getCartCount ($map) {
		$data = $this->cartlib->cartItemCount($map);
		if(empty($data['cart_cnt'])) {
			$data['cart_cnt'] = 0;
		}
		return $data;
	}
	
	public function increaseitem_post() {
		$this->load->library('zyk/CartLib');
		$order_type = $this->post('order_type');
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['session_cookie'] = $this->post('session_cookie');
		$map['itemid'] = $this->post('itemid');
		$map['option_id'] = $this->post('option_id');
		$this->cartlib->increaseItemQuantity($map);
		$map['itemset'] = $this->post('item_set');
		if(!empty($map['itemset'])) {
			$oldsubitems = $this->cartlib->getCartSubitemsByItemSet($map);
			$itemset = $this->cartlib->getCartItemSet(
					array('restid'=>$map['restid'],'session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'])
			);
			$subitems = array();
			foreach ($oldsubitems as $oldsubitem) {
				$subitem = array();
				$subitem['restid'] = $map['restid'];
				$subitem['session_cookie'] = $map['session_cookie'];
				$subitem['itemid'] = $map['itemid'];
				$subitem['option_id'] = $map['option_id'];
				$subitem['sub_item_id'] = $oldsubitem['sub_item_id'];
				$subitem['subitem_price'] = $oldsubitem['subitem_price'];
				if ($itemset > 0) {
					$subitem['itemset'] = $itemset+1;
				} else {
					$subitem['itemset'] = 1;
				}
				$subitems[] = $subitem;
			}
			$this->cartlib->addCartSubitems($subitems);
		}
		$params = array();
		$params['restid'] = $this->post('restid');
		$params['session_cookie'] = $this->post('session_cookie');
		$params['order_type'] = $this->post('order_type');
		$params['latitude'] = $this->post('latitude');
		$params['longitude'] = $this->post('longitude');
		$params['payment_mode'] = $this->post('payment_mode');
		if(!empty($this->post('coupon_code')))
			$params['coupon_code'] = $this->post('coupon_code');
		if(!empty($this->post('email')))
			$params['email'] = $this->post('email');
		if(!empty($this->post('mobile')))
			$params['mobile'] = $this->post('mobile');
		$this->load->library('zyk/CartLib');
		$cart = $this->cartlib->getOrderCart($params);
		$this->response ( $cart,200);
	}
	
	public function decreaseitem_post() {
		$this->load->library('zyk/CartLib');
		$order_type = $this->post('order_type');
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['session_cookie'] = $this->post('session_cookie');
		$map['itemid'] = $this->post('itemid');
		$map['option_id'] = $this->post('option_id');
		$this->cartlib->removeCartItem($map);
		$itemset = $this->post('item_set');
		if(!empty($itemset)) {
			if($itemset != "") {
				$subitems = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'itemset'=>$itemset);
				$this->cartlib->removeCartSubItems($subitems);
			}
		}
		$params = array();
		$params['restid'] = $this->post('restid');
		$params['session_cookie'] = $this->post('session_cookie');
		$params['order_type'] = $this->post('order_type');
		$params['latitude'] = $this->post('latitude');
		$params['longitude'] = $this->post('longitude');
		$params['payment_mode'] = $this->post('payment_mode');
		if(!empty($this->post('coupon_code')))
			$params['coupon_code'] = $this->post('coupon_code');
		if(!empty($this->post('email')))
			$params['email'] = $this->post('email');
		if(!empty($this->post('mobile')))
			$params['mobile'] = $this->post('mobile');
		$this->load->library('zyk/CartLib');
		$cart = $this->cartlib->getOrderCart($params);
		$this->response ( $cart,200);
	}
	
	public function applycoupon_post() {
		$this->load->library('zyk/CartLib');
		$params = array();
		$params['coupon_code'] = $this->post('coupon_code');
		$params['restid'] = $this->post('restid');
		$params['date'] = date('Y-m-d');
		$params['time'] = date('H:i:s');
		$params['order_amount'] = $this->post('itemtotal');
		$params['email'] = $this->post('email');
		$params['mobile'] = $this->post('mobile');
		$payment_mode = $this->post('payment_mode');
		if(isset($payment_mode)) {
			$params['payment_mode'] = $payment_mode;
		} else {
			$params['payment_mode'] = '';
		}
		$cresponse = $this->cartlib->getCouponDiscount($params);
		if($cresponse['status'] == 1) {
			$params = array();
			$params['restid'] = $this->post('restid');
			$params['session_cookie'] = $this->post('session_cookie');
			$params['order_type'] = $this->post('order_type');
			$params['latitude'] = $this->post('latitude');
			$params['longitude'] = $this->post('longitude');
			$params['payment_mode'] = $this->post('payment_mode');
			if(!empty($this->post('coupon_code')))
				$params['coupon_code'] = $this->post('coupon_code');
			if(!empty($this->post('email')))
				$params['email'] = $this->post('email');
			if(!empty($this->post('mobile')))
				$params['mobile'] = $this->post('mobile');
			$this->load->library('zyk/CartLib');
			$cart = $this->cartlib->getOrderCart($params);
			$cresponse['cart'] = $cart;
		}
		$this->response ( $cresponse,200);
	}
	
	public function initcheckout_post() {
		$this->load->library('zyk/SearchLib');
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['restid'] = $this->post('restid');
		$map['latitude'] = $this->post('latitude');
		$map['longitude'] = $this->post('longitude');
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
		$del_dates = $this->cartlib->getDeliveryDates($map['restid'],$current_date);
		unset($restaurant[0]['fence']);
		unset($restaurant[0]['Old_id']);
		unset($del_timing['select_dropdn']);
		$resp = array();
		$resp['restaurant'] = $restaurant[0];
		$resp['delivery_dates'] = $del_dates;
		$resp['delivery_timings'] = $del_timing;
		$this->response ( $resp,200);
	}
	
	public function plcaeorder_post() {
		$this->load->library('zyk/CartLib');
		$this->load->library('zyk/UserLib');
		$email = $this->post('email');
		$mobile = $this->post('mobile');
		$del_check = array();
		$del_check['restid'] = $this->post('restid');
		$del_check['latitude'] = $this->post('latitude');
		$del_check['longitude'] = $this->post('longitude');
		$restid = $del_check['restid'];
		$is_valid = $this->cartlib->checkDeliveryArea($del_check);
		if ($is_valid) {
			$cartmap = array();
			$cartmap['restid'] = $this->post('restid');
			$cartmap['session_cookie'] = $this->post('session_cookie');
			$cartmap['order_type'] = $this->post('order_type');
			$cartmap['latitude'] = $this->post('latitude');
			$cartmap['longitude'] = $this->post('longitude');
			$cartmap['coupon_code'] = $this->post("coupon_code");
			$cartmap['payment_mode'] = $this->post('payment_mode');
			$cartmap['email'] = $this->post('email');
			$cartmap['mobile'] = $this->post('mobile');
			$cartmap['is_checkout'] = 1;
			$cart = $this->cartlib->getOrderCart($cartmap);
			if($cart['subtotal'] >= $cart['mov']) {
				$is_mobile_verified = $this->post('is_valid_mobile');
				if ($is_mobile_verified == 0) {
					if ($this->post('payment_mode') == 1) {
						$is_mobile_verified = $this->userlib->isMobileVerified($email,$mobile);
					}
				}
				if ($is_mobile_verified == 1) {
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
					$newaddress = array();
					if(!empty($this->post('is_new_address'))) {
						if($this->post('is_new_address') == 1) {
							$newaddress['userid'] = $customer['userid'];
							$newaddress['address_name'] = 'Order Address';
							$newaddress['areaid'] = $customer['areaid'];
							$newaddress['locality'] = $customer['locality'];
							$newaddress['latitude'] = $customer['latitude'];
							$newaddress['longitude'] = $customer['longitude'];
							$newaddress['address'] = $customer['address'];
							$newaddress['landmark'] = $customer['landmark'];
						}
					}
					$zyk_discount = $cart['zyk_discount'];
					$rest_discount = $cart['rest_discount'];
					$order = array();
					$order['restid'] = $this->post('restid');
					$order['areaid'] = $this->post('areaid');
					$order['is_takeaway'] = $this->post('order_type');
					if ($this->post('payment_mode') == 1) {
						$payment_details['name'] = $this->post('name');
						$payment_details['email'] = $this->post('email');
						$payment_details['mobile'] = $this->post('mobile');
						$payment_details['gateway'] = $this->post('gateway_name');;
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
					if(empty($customer['userid'])) {
						$user = array();
						$user['name'] = $customer['name'];
						$user['email'] = $customer['email'];
						$user['mobile'] = $customer['mobile'];
						$user['otp'] = rand(100000,999999);
						$user['password'] = md5(random36());
						$userid = $this->userlib->signupUser($user);
						$customer['userid'] = $userid;
						$order['userid'] = $userid;
					} else {
						$order['userid'] = $customer['userid'];
					}
					$this->load->library('zyk/OrderLib');
					$orderid = $this->orderlib->addOrder($order);
					$oupdate = array();
					$oupdate['orderid'] = $orderid;
					$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
					$this->orderlib->updateOrder($oupdate);
					$customer['orderid'] = $orderid;
					$this->orderlib->addOrderCustomer($customer);
					if(count($newaddress) > 0) {
						$this->userlib->addAddress($newaddress);
					} 
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
					$payment_details['referer_id'] = 'zyk';
					if ($this->post('payment_mode') == 1) {
						$this->load->library('zyk/payment/OnlinePayment');
						$data = $this->onlinepayment->startPayment($payment_details);
						if($payment_details['gateway'] == 'payumoney') {
							$data['data']['surl'] = base_url().'api/payu/payment/response.json';
							$data['data']['furl'] = base_url().'api/payu/payment/fail.json';
							$data['data']['curl'] = base_url().'api/payu/payment/response.json';
						}
						$oupdate['pdata'] = $data['data'];
						//$oupdate['payment_url'] = $data['payment_url'];
						$oupdate['payment_mode'] = 1;
						$oupdate['restid'] = $order['restid'];
						$oupdate['status'] = 1;
						$oupdate['message'] = 'Your order have been placed successfully.';
						$oupdate['is_verified'] = 1;
					} else {
						$neworder = $this->orderlib->getOrderDetails($oupdate['ordercode']);
						$this->orderlib->sendNewOrderEmail($neworder[0]);
						$this->orderlib->sendNewOrderSMS($neworder[0]);
						$map['restid'] = $restid;
						$map['session_cookie'] = $this->session->userdata('cartsession');
						$this->load->library('zyk/CartLib');
						$this->cartlib->clearCart($map);
						$this->session->set_userdata('cartsession', '');
						$this->session->set_userdata($restid.'order_type',null);
						$this->notifyOrder();
						$this->notifyOrderToClient($neworder[0]['orderid'],$restid);
						$oupdate['payment_mode'] = 0;
						$oupdate['restid'] = $order['restid'];
						$oupdate['status'] = 1;
						$oupdate['message'] = 'Your order have been placed successfully.';
						$oupdate['is_verified'] = 1;
					}
				} else {
					$errorMsg = array();
					$errors = array();
					$error = array('otp'=>'Restaurant do not delivers to this locality.');
					array_push ( $errors, $error );
					$errorMsg['errors'] = $errors;
					$oupdate['status'] = 0;
					$oupdate['errormsg'] = $errorMsg;
					$oupdate['message'] = 'Please verify your OTP.';
					$oupdate['is_verified'] = 0;
					$otpMap = array();
					$otpMap['mobile'] = $this->post('mobile');
					$otpMap['otp'] = rand(100000,999999);
					$oupdate['valid_otp'] = $otpMap['otp'];
					$this->userlib->sendOTPSMS($otpMap);
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
		} else {
			$errorMsg = array();
			$errors = array();
			$error = array('locality'=>'Restaurant do not delivers to this locality.');
			array_push ( $errors, $error );
			$errorMsg['errors'] = $errors;
			$oupdate['status'] = 0;
			$oupdate['errormsg'] = $errorMsg;
			$oupdate['message'] = 'Restaurant do not delivers to this locality.';
			$oupdate['is_verified'] = 1;
		}
		$this->response ( $oupdate,200);
	}
	
	public function paymentupdate_post() {
		$payment_arr = array();
		$payment_arr['ordercode'] = $this->post("ordercode");
		$payment_arr['transaction_id'] = $this->post("transaction_id");
		$payment_arr['transaction_code'] = $this->post("transaction_code");
		$payment_arr['transaction_amount'] = $this->post("transaction_amount");
		$payment_arr['gateway'] = $this->post("gateway_name");
		$payment_status = $this->post("payment_status");
		$ordercode = $this->post("ordercode");
		$restid = $this->post("restid");
		$omap = array();
		$omap['ordercode'] = $ordercode;
		if ($payment_status == 1) {
			$omap['status'] = 0;
			$omap['payment_status'] = 1;
			$payment_arr['status'] = 1;
		} else {
			$omap['status'] = 2;
			$omap['payment_status'] = 2;
			$payment_arr['status'] = 2;
		}
		$this->load->library('zyk/OrderLib');
		$this->load->library('zyk/payment/OnlinePayment');
		$this->onlinepayment->storePaymentResponse($payment_arr);
		$this->orderlib->updateOrderByCode($omap);
		$order = $this->orderlib->getOrderDetails($ordercode);
		$resp = array();
		if($omap['payment_status'] == 2) {
			$this->orderlib->sendPaymentFailEmail($order[0]);
			$this->orderlib->sendPaymentFailedSMS($order[0]);
			$resp['status'] = 0;
			$resp['msg'] = 'Payment Failed.';
			$resp['ordercode'] = $ordercode;
		} else {
			$this->orderlib->sendNewOrderEmail($order[0]);
			$this->orderlib->sendNewOrderSMS($order[0]);
			$map['restid'] = $restid;
			$map['session_cookie'] = $this->post('session_cookie');
			$this->load->library('zyk/CartLib');
			$this->cartlib->clearCart($map);
			$this->notifyOrder();
			$this->notifyOrderToClient($order[0]['orderid'],$restid);
			$resp['status'] = 1;
			$resp['msg'] = 'Payment Successful.';
			$resp['ordercode'] = $ordercode;
		}
		$this->response ( $resp,200);
	}
	
	public function paymentresponse_post() {
		$this->load->library('zyk/payment/OnlinePayment');
		$response = $this->post();
		error_log(json_encode($response),0);
		$payment_status = $response['status'];
		$ordercode = $response['txnid'];
		$amount = $response['net_amount_debit'];
		$trans_id = $response['mihpayid'];
		$response['gateway'] = 'payumoney';
		$payment_arr = array();
		$payment_arr['ordercode'] = $ordercode;
		$payment_arr['transaction_id'] = $trans_id;
		$payment_arr['transaction_code'] = $payment_status;
		$payment_arr['transaction_amount'] = $amount;
		$payment_arr['gateway'] = 'payumoney';
		$omap = array();
		$omap['ordercode'] = $ordercode;
		$is_valid_payment = $this->onlinepayment->verifyPayUPayment($response);
		if ($is_valid_payment) {
			if ($payment_status == 'success') {
				$omap['status'] = 0;
				$omap['payment_status'] = 1;
				$payment_arr['status'] = 1;
			} else {
				$omap['status'] = 2;
				$omap['payment_status'] = 2;
				$payment_arr['status'] = 2;
			}
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
			$this->orderlib->sendPaymentFailEmail($order[0]);
			$this->orderlib->sendPaymentFailedSMS($order[0]);
		} else if($omap['payment_status'] == 1) {
			$this->orderlib->sendNewOrderEmail($order[0]);
			$this->orderlib->sendNewOrderSMS($order[0]);
		}
		$payment_status = $response['status'];
		if ($payment_status == 'success') {
			$this->template->set ( 'pstatus', 1 );
		} else {
			$this->template->set ( 'pstatus', 2 );
		}
		$this->template->set ( 'response', $response );
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		if($payment_arr['gateway'] == 'payumoney') {
			$html = $this->template->build ('frontend/payumoneyresponse','',true);
		} else {
			$html = $this->template->build ('frontend/payuresponse','',true);
		}
		echo $html;
		//redirect(base_url().'order/summary/'.$ordercode);
	}
	
	public function orderdetail_get($ordercode) {
		$this->load->library('zyk/OrderLib');
		$order = $this->orderlib->getOrderDetails($ordercode);
		$this->response ( $order[0],200);
	}
	
	public function deliverytimings_get() {
		$restid = $this->get('restid');
		$deltime = $this->get('delivery_time');
		$del_date = $this->get('delivery_date');
		$this->load->library('zyk/CartLib');
		$timings = $this->cartlib->getRestDeliveryTime($restid,$deltime,$del_date);
		unset($timings['select_dropdn']);
		$this->response ( $timings,200);
	}
	
	public function checkarea_get() {
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['restid'] = $this->get('restid');
		$map['latitude'] = $this->get('latitude');
		$map['longitude'] = $this->get('longitude');
		$is_valid = $this->cartlib->checkDeliveryArea($map);
		$data = array();
		if($is_valid) {
			$data['status'] = 1;
			$data['message'] = 'Restaurant Delivers to this locality.';
		} else {
			$data['status'] = 0;
			$data['message'] = 'Restaurant do not delivers to this locality.';
		}
		$this->response ( $data,200);
	}
	
	public function generatechecksum_post() {
		$this->load->library('zyk/payment/OnlinePayment');
		$checkSum = $this->onlinepayment->getChecksumFromArray($_POST);
		echo json_encode(array("CHECKSUMHASH" => $checkSum,"ORDER_ID" => $_POST["ORDER_ID"], "payt_STATUS" => "1"));
	}
	
	public function verifychecksum_post() {
		$this->load->library('zyk/payment/OnlinePayment');
		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = FALSE;
		$paramList = $_POST;
		$return_array = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
		$isValidChecksum = $this->onlinepayment->veryfyChecksumForPaytm($paramList,$paytmChecksum);
		$return_array["IS_CHECKSUM_VALID"] = $isValidChecksum ? "Y" : "N";
		unset($return_array["CHECKSUMHASH"]);
		$encoded_json = htmlentities(json_encode($return_array));
		echo '<html>'
			 +'<head>'
			 +'<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-I">'
			 +'<title>Paytm</title>'
			 +'<script type="text/javascript">'
			 +'function response(){ return document.getElementById("response").value; }'
			 +'</script>'
			 +'</head>'
			 +'<body>Redirect back to the app<br>'
  			 +'<form name="frm" method="post">'
    		 +'<input type="hidden" id="response" name="responseField" value="'.$encoded_json.'">'
  			 +'</form></body></html>';
	}
	
	public function getpayuhash_post() {
		$this->load->library('zyk/payment/OnlinePayment');
		$params = $_POST;
		error_log(json_encode($params),0);
		$checkSum = $this->onlinepayment->getPayUhashes($params);
		error_log(json_encode($checkSum),0);
		$this->response ( $checkSum,200);
	}
	
	public function getpayumoneyhash_post() {
		$this->load->library('zyk/payment/OnlinePayment');
		$params = $_POST;
		error_log(json_encode($params),0);
		$checkSum = $this->onlinepayment->getPayUMoneyhashes($params);
		error_log(json_encode($checkSum),0);
		$this->response ( $checkSum,200);
	}
	
	public function notifyOrder() {
		/*$options = array(
				'cluster' => 'ap1',
				'encrypted' => true
		);
		$pusher = new Pusher(
				'feb80626a1c08897aa15',
				'c35f6da30441a09a3c39',
				'207592',
				$options
		);
	
		$data['message'] = 'neworder#New Order Received';
		$result = $pusher->trigger('crm_broadcast', 'crm_broadcast_event', $data);
		*/
	}
	
	public function notifyOrderToClient($orderId,$restid) {
		/*$options = array(
				'cluster' => 'ap1',
				'encrypted' => true
		);
		$pusher = new Pusher(
				'feb80626a1c08897aa15',
				'c35f6da30441a09a3c39',
				'207592',
				$options
		);
	
		$data['message'] = 'neworder#'.$orderId.'#'.$restid;
		$result = $pusher->trigger('crm_broadcast', 'client_broadcast_event', $data);
		*/
	}
}