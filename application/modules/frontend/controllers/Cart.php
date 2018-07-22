<?php
class Cart extends MX_Controller {
	
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
		
	}
	
	
	/* ********************* New Implementation ********************* */
	public function getCartSession() {
		$temp = $this->session->userdata('cartsession');
		if($temp != null && $temp != '') {
			return $this->session->userdata('cartsession');
		}else {
			$this->session->set_userdata('cartsession', md5(date(DATE_RFC822).time()));
			return $this->session->userdata('cartsession');
		}
	}
	
	public function getCartCount() {
		$cart_session = $this->getCartSession();
		$map = array();
		$map['session_cookie'] = $cart_session;
		if (!empty($cart_session))
		{
			$this->load->library('zyk/CartLib');
			$data = $this->cartlib->cartItemCount($map);
			if(empty($data['cart_cnt'])) {
				$data['cart_cnt'] = 0;
			}
		} else {
			$data['cart_cnt'] = 0;
		}
		echo json_encode($data);
	}
	
	public function addProductToCart() {
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['session_cookie'] = $this->getCartSession();
		$map['product_id'] = $this->input->post('itemid');
		$map['variant_id'] = $this->input->post('option_id');
		$map['quantity'] = $this->input->post('quantity');
		$map['price'] = $this->input->post('price');
	
		$data = $this->cartlib->addProductToCart($map);
		if(count($data) > 0) {
			$resp['status'] = 1;
			$resp['msg'] = 'Item added to cart';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Item Not added to cart';
		}
		echo json_encode($resp);
	
	}
	
	public function removeProductFromCart() {
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['session_cookie'] = $this->getCartSession();
		$map['product_id'] = $this->input->post('itemid');
		$map['option_id'] = $this->input->post('option_id');
		$map['quantity'] = $this->input->post('quantity');
		$data = $this->cartlib->removeProductToCart($map);
		if($data) {
			$resp['status'] = 1;
			$resp['msg'] = 'Item Removed from cart';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Item Not Remove from cart';
		}
		echo json_encode($resp);
	}
	
	public function deleteProductFromCart() {
		$this->load->library('zyk/CartLib');
		$map = array();
		$map['session_cookie'] = $this->getCartSession();
		$map['product_id'] = $this->input->post('itemid');
		$data = $this->cartlib->deleteProductToCart($map);
		if($data) {
			$resp['status'] = 1;
			$resp['msg'] = 'Item deleted from cart';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Item Not deleted from cart';
		}
		echo json_encode($resp);
	}
	
	public function applyKarmaPoint() {
		$cartmap = array();
		$cartmap['session_cookie'] = $this->getCartSession();
		$cartmap['userid'] = $this->session->userdata('olouserid');
		$payment_mode = $this->input->get('payment_mode');
		if(isset($payment_mode)) {
			$cartmap['payment_mode'] = $payment_mode;
		} else {
			$cartmap['payment_mode'] = '';
		}
		if(!empty($this->input->get('coupon_code')))
			$cartmap['coupon_code'] = $this->input->get('coupon_code');
		$cartmap['applicable_on'] = 1;
		$cartmap['karma_point'] = $this->input->get('karma_point');
		$this->load->library('zyk/CartLib');
		$this->load->library('zyk/UserLoginLib');
		$result = $this->cartlib->getProductOrderCart($cartmap);
		$coupon_discount = $this->cartlib->calculateDiscount($cartmap);
		$final_amount = $result['subtotal'] - $coupon_discount['discount'];
		$status = 1;
		$msg = "Karma discount applied successfully.";
		$wallet = $this->userloginlib->getWalletBalance ( $cartmap['userid'] );
		$result['karma_discount'] = 0;
		if(!empty($wallet[0]['amount'])) {
			if($wallet[0]['amount'] >= $cartmap['karma_point']) {
				if($cartmap['karma_point'] > $final_amount) {
					$status = 0;
					$msg = "You can redeem maximum ".$final_amount." karma points";
				} else {
					$result['karma_discount'] = $cartmap['karma_point'];
				}
			} else {
				$status = 0;
				$msg = "You can redeem maximum ".$wallet[0]['amount']." karma points";
			}
		} else {
			$status = 0;
			$msg = "Sorry you do not have sufficient karma points.";
		}
		$result['discount'] = $coupon_discount['discount'];
		$result['cashback'] = $coupon_discount['cashback'];
		$result['coupon_code'] = $coupon_discount['coupon_code'];
		$cart = $this->getOrderCart($result,$cartmap);
		echo json_encode(array("status"=>$status,"msg"=>$msg,"cart"=>$cart,'karma_discount'=>$result['karma_discount']));
	}
	
	public function applyCoupon() {
		$cartmap = array();
		$cartmap['session_cookie'] = $this->getCartSession();
		$cartmap['userid'] = $this->session->userdata('olouserid');
		$payment_mode = $this->input->get('payment_mode');
		if(isset($payment_mode)) {
			$cartmap['payment_mode'] = $payment_mode;
		} else {
			$cartmap['payment_mode'] = '';
		}
		if(!empty($this->input->get('coupon_code')))
			$cartmap['coupon_code'] = $this->input->get('coupon_code');
		$cartmap['applicable_on'] = 1;
		$cartmap['karma_point'] = $this->input->get('karma_point');
		$this->load->library('zyk/CartLib');
		$this->load->library('zyk/UserLoginLib');
		$result = $this->cartlib->getProductOrderCart($cartmap);
		$coupon_discount = $this->cartlib->calculateDiscount($cartmap);
		$final_amount = $result['subtotal'] - $coupon_discount['discount'];
		$wallet = $this->userloginlib->getWalletBalance ( $cartmap['userid'] );
		$result['karma_discount'] = 0;
		if(!empty($wallet[0]['amount'])) {
			if($wallet[0]['amount'] >= $cartmap['karma_point']) {
				if($cartmap['karma_point'] > $final_amount) {
					$result['karma_discount'] = $final_amount;
				} else {
					$result['karma_discount'] = $cartmap['karma_point'];
				}
			} else {
				$cartmap['karma_discount'] = $wallet[0]['amount'];
				if($cartmap['karma_point'] > $final_amount) {
					$result['karma_discount'] = $final_amount;
				} else {
					$result['karma_discount'] = $cartmap['karma_point'];
				}
			}
		}
		$result['discount'] = $coupon_discount['discount'];
		$result['cashback'] = $coupon_discount['cashback'];
		$result['coupon_code'] = $coupon_discount['coupon_code'];
		$cart = $this->getOrderCart($result,$cartmap);
		echo json_encode(array("status"=>$coupon_discount["status"],"msg"=>$coupon_discount["msg"],"cart"=>$cart,'karma_discount'=>$result['karma_discount']));
	}
	
	public function clearCart() {
		$cartmap = array();
		$cartmap['session_cookie'] = $this->getCartSession();
		$cartmap['userid'] = $this->session->userdata('olouserid');
		$payment_mode = $this->input->get('payment_mode');
		if(isset($payment_mode)) {
			$cartmap['payment_mode'] = $payment_mode;
		} else {
			$cartmap['payment_mode'] = '';
		}
		if(!empty($this->input->get('coupon_code')))
			$cartmap['coupon_code'] = $this->input->get('coupon_code');
		$this->load->library('zyk/CartLib');
		$this->cartlib->clearProductCart($cartmap['session_cookie']);
		$result = $this->cartlib->getProductOrderCart($cartmap);
		echo $this->getOrderCart($result,$cartmap);
	}
	
	
	public function getOrderCart($cart,$cartmap) {
		$this->template->set ( 'cart', $cart );
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		return $this->template->build ('pages/cart','',true);
	}
	
	public function sendOrderOtp() {
		$mobile = $this->input->post('mobile');
		$map = array();
		$map['session_cookie'] = $this->getCartSession();
		$map['otp'] = mt_rand ( 100000, 999999 );
		$this->load->library('zyk/CartLib');
		$this->load->library('Fbsms');
		$id = $this->cartlib->addOrderOTP($map);
		$resp = array();
		if($id) {
			$params = array();
			$params['mobile'] = $mobile;
			$params['message'] = "Your 6 digit verification code for Phynart is ".$map['otp'];
			$this->fbsms->sendSms($params);
			$resp['status'] = 1;
			$resp['msg'] = 'OTP sent to your mobile number.';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Failed to send OTP.';
		}
		echo json_encode($resp);
	}
	
	public function resendOrderOtp() {
		$map = array();
		$map['session_cookie'] = $this->getCartSession();
		$map['otp'] = mt_rand ( 100000, 999999 );
		$mobile = $this->input->post('mobile');
		$this->load->library('zyk/CartLib');
		$this->load->library('Fbsms');
		$id = $this->cartlib->updateOrderOTP($map);
		$resp = array();
		if($id) {
			$params = array();
			$params['mobile'] = $mobile;
			$params['message'] = "Your 6 digit verification code for Phynart is ".$map['otp'];
			$this->fbsms->sendSms($params);
			$resp['status'] = 1;
			$resp['msg'] = 'OTP resent to your mobile number.';
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Failed to resend OTP.';
		}
		echo json_encode($resp);
	}
	
	public function confirmOrderOtp() {
		$otp = $this->input->post('otp');
		$map = array();
		$map['session_cookie'] = $this->getCartSession();
		$map['otp'] = $otp;
		$map['is_valid'] = 1;
		$this->load->library('zyk/CartLib');
		$otps = $this->cartlib->getOrderOTP($map);
		$resp = array();
		if(count($otps) > 0) {
			$resp['status'] = 1;
			$resp['msg'] = 'OTP verified successfully.';
			$this->cartlib->updateOrderOTP($map);
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Invalid OTP.';
		}
		echo json_encode($resp);
	}
	
	public function validateGiftee() {
		$this->load->library('zyk/UserLoginLib');
		$map = array();
		$map['email'] = $this->input->get("email");
		$map['mobile'] = $this->input->get('mobile');
		$user = $this->userloginlib->getProfileByEmailMobile($map);
		$resp = array();
		if(count($user) > 0) {
			$resp['status'] = 1;
			$resp['msg'] = "Valid User";
			$resp['userid'] = $user[0]['id'];
		} else {
			$resp['status'] = 0;
			$resp['msg'] = "Giftee is not registered with us. Giftee should be registered user.";
		}
		echo json_encode($resp);
	}
	
	public function checkout() {
		$this->load->library('zyk/CartLib');
		$this->load->library('zyk/UserLoginLib');
		$this->load->library('zyk/ProductLib');
		$address_id = $this->input->post("address_id");
		$payment_mode = $this->input->post("payment_mode");
		$coupon_code = $this->input->post("coupon_code");
		$referral_code = $this->input->post("referral_code");
		$karma_points = $this->input->post("karma_points");
		$is_gift =  $this->input->post("is_gift");
		$is_gift_wrap = $this->input->post("is_wraping");
		$cartmap['session_cookie'] = $this->getCartSession();
		$cartmap['userid'] = $this->session->userdata('olouserid');
		$cartmap['coupon_code'] = $coupon_code;
		$cartmap['payment_mode'] = $payment_mode;
		$cartmap['referral_code'] = $referral_code;
		$cartmap['karma_points'] = $karma_points;
		$cartmap['applicable_on'] = 1;
		if($payment_mode == 0) {
			if(!$this->cartlib->isMobileVerified($cartmap)) {
				echo json_encode(array("status"=>0,"msg"=>"Please verify your mobile number first."));
				exit;
			}
		}
		if(!empty($coupon_code)) {
			$coupon_discount = $this->cartlib->calculateDiscount($cartmap);
			if($coupon_discount['status'] == 0) {
				$response['message'] = $coupon_discount['msg'];
				$response['status'] = 0;
				echo json_encode($response);
				exit;
			}
		} else {
			$coupon_discount['discount'] = 0;
			$coupon_discount['cashback'] = 0;
		}
		$cart = $this->cartlib->getProductOrderCart($cartmap);
		$in_stock = 1;
		$devices = array();
		foreach ($cart['cartitems'] as $item) {
			if($item['option_id'] != 3) {
				$map = array();
				$map['product_id'] = $item['product_id'];
				$map['quantity'] = $item['cartquantity'];
				$checkin_stock = $this->productlib->isProductQuantityAvailable($map);
				if($checkin_stock == 0) {
					$in_stock = 0;
				}
			}
		}
		if($in_stock == 0) {
			echo json_encode(array("status"=>0,"msg"=>"We are sorry. One of your item is out of stock."));
			exit;
		}
		$subtotal = $cart['subtotal'];
		$product_points = $cart['product_points'];
		$discount = $coupon_discount['discount'];
		$cashback = $coupon_discount['cashback'];
		$final_amount = $subtotal - $discount;
		$wallet = $this->userloginlib->getWalletBalance ( $cartmap['userid'] );
		if(!empty($wallet[0]['amount'])) {
			if($wallet[0]['amount'] >= $karma_points) {
				if($karma_points > $final_amount) {
					$karma_points = $final_amount;
				} else {
					$karma_points = $karma_points;
				}
			} else {
				$karma_points = $wallet[0]['amount'];
				if($karma_points > $final_amount) {
					$karma_points = $final_amount;
				} else {
					$karma_points = $karma_points;
				}
			}
		} else {
			echo json_encode(array("status"=>0,"msg"=>"We are sorry. You do not have sufficient Karma Points."));
			exit;
		}
		if($is_gift) {
			$customer_data = $this->userloginlib->getCustomerDetails($address_id);
			$order = array();
			$order['userid'] = $cartmap['userid'];
			$order['address_id'] = $address_id;
			$order['sub_total'] = $subtotal;
			$order['discount'] = $discount;
			$order['cashback'] = $cashback;
			$order['karma_discount'] = $karma_points;
			$order['order_tax'] = 0;
			$order['service_charge'] = 0;
			$order['delivery_charge'] = 0;
			$order['packaging_charge'] = 0;
			$order['net_total'] = $subtotal;
			$order['grand_total'] = $subtotal - $discount - $karma_points;
			$order['invoice_status'] = 0;
			$order['karma_earned'] = $product_points;
			if($payment_mode == 0) { 
				$order['is_online_paid'] = 0;
			} else {
				$order['is_online_paid'] = 1;
			}
			$order['delivery_date'] = date('Y-m-d',strtotime("+3 days"));
			$order['delivery_time'] = date('H:i:s');
			$order['coupon_code'] = $coupon_code;
			$order['created_date'] = date('Y-m-d');
			$order['source'] = 0;
			$orderid = $this->cartlib->addOrder($order);
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			$this->cartlib->updateOrder($oupdate);
			$customer = array();
			$customer['orderid'] = $orderid;
			$customer['userid'] = $cartmap['userid'];
			$customer['name'] = $customer_data[0]['name'];
			$customer['email'] = $customer_data[0]['email'];
			$customer['mobile'] = $customer_data[0]['mobile'];
			$customer['areaid'] = 0;
			$customer['locality'] = $customer_data[0]['locality'];
			$customer['address'] = $customer_data[0]['address'];
			$customer['landmark'] = $customer_data[0]['landmark'];
			$this->cartlib->addOrderCustomer($customer);
			if($is_gift) {
				$giftee = array();
				$giftee['orderid'] = $orderid;
				$giftee['userid'] = $this->input->post("gi_userid");
				$giftee['first_name'] = $this->input->post("gi_fname");
				$giftee['last_name'] = $this->input->post("gi_lname");
				$giftee['email'] = $this->input->post("gi_email");
				$giftee['mobile'] = $this->input->post("gi_mobile");
				$this->cartlib->addOrderGifteeDetail($giftee);
			}
			$products = array();
			foreach ($cart['cartitems'] as $item) {
				$product = array();
				$product['orderid'] = $orderid;
				$product['product_id'] = $item['product_id'];
				$product['variant_id'] = $item['option_id'];
				$product['quantity'] = $item['cartquantity'];
				$product['price'] = $item['unit_price'];
				$product['total_amount'] = $item['totalprice'];
				$products[] = $product;
				if($item['option_id'] != 3) {
					$map = array();
					$map['product_id'] = $item['product_id'];
					$map['quantity'] = $item['cartquantity'];
					$device_status = $this->productlib->updateDeviceStock($map);
					foreach ($device_status['devices'] as $mydevice) {
						$devices[] = $mydevice;
					}
				}
			}
			$this->cartlib->addOrderProducts($products);
			$orderdevices = array();
			foreach ($devices as $key=>$device) {
				$orderdevice = array();
				$orderdevice['device_id'] = $device['device_id'];
				$orderdevice['device_code'] = $device['device_code'];
				$orderdevice['orderid'] = $orderid;
				$orderdevices[] = $orderdevice;
			}
			$userdevices = array();
			foreach ($devices as $key=>$device) {
				$userdevice = array();
				$userdevice['device_id'] = $device['device_id'];
				$userdevice['device_code'] = $device['device_code'];
				$userdevice['purchase_date'] = date('Y-m-d');
				$userdevice['userid'] = $cartmap['userid'];
				$userdevice['status'] = 0;
				$userdevices[] = $userdevice;
			}
			if(count($orderdevices) > 0) {
				$this->cartlib->addOrderDevices($orderdevices);
			}
			if($orderid > 0) {
				$response['orderid'] = $orderid;
				$response['is_gift'] = 0;
				$response['ordercode'] = $oupdate['ordercode'];
				$response['status'] = 1;
			} else {
				$response['message'] = 'Sorry!! We facing issues in system.';
				$response['status'] = 0;
			}
		} else {
			$order = array();
			$order['userid'] = $cartmap['userid'];
			$order['giftee_id'] = $this->input->post("gi_userid");
			$order['sub_total'] = $subtotal;
			$order['discount'] = $discount;
			$order['cashback'] = $cashback;
			$order['karma_discount'] = $karma_points;
			$order['order_tax'] = 0;
			$order['service_charge'] = 0;
			$order['delivery_charge'] = 0;
			$order['packaging_charge'] = 0;
			$order['net_total'] = $subtotal;
			$order['grand_total'] = $subtotal - $discount - $karma_points;
			$order['karma_earned'] = $product_points;
			if($payment_mode == 0) {
				$order['is_online_paid'] = 0;
			} else {
				$order['is_online_paid'] = 1;
			}
			$order['coupon_code'] = $coupon_code;
			$order['created_date'] = date('Y-m-d');
			$order['source'] = 0;
			$orderid = $this->cartlib->addGiftOrder($order);
			$oupdate = array();
			$oupdate['giftid'] = $orderid;
			$oupdate['giftcode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			$this->cartlib->updateGiftOrder($oupdate);
			$giftee = array();
			$giftee['giftid'] = $orderid;
			$giftee['giftee_id'] = $this->input->post("gi_userid");
			$giftee['first_name'] = $this->input->post("gi_fname");
			$giftee['last_name'] = $this->input->post("gi_lname");
			$giftee['email'] = $this->input->post("gi_email");
			$giftee['mobile'] = $this->input->post("gi_mobile");
			$this->cartlib->addOrderGifteeDetail($giftee);
			$products = array();
			foreach ($cart['cartitems'] as $item) {
				$product = array();
				$product['giftid'] = $orderid;
				$product['product_id'] = $item['product_id'];
				$product['variant_id'] = $item['option_id'];
				$product['quantity'] = $item['cartquantity'];
				$product['price'] = $item['unit_price'];
				$product['total_amount'] = $item['totalprice'];
				$products[] = $product;
				if($item['option_id'] != 3) {
					$map = array();
					$map['product_id'] = $item['product_id'];
					$map['quantity'] = $item['cartquantity'];
					$device_status = $this->productlib->updateDeviceStock($map);
					foreach ($device_status['devices'] as $mydevice) {
						$devices[] = $mydevice;
					}
				}
			}
			$this->cartlib->addGiftProducts($products);
			$orderdevices = array();
			foreach ($devices as $key=>$device) {
				$orderdevice = array();
				$orderdevice['device_id'] = $device['device_id'];
				$orderdevice['device_code'] = $device['device_code'];
				$orderdevice['giftid'] = $orderid;
				$orderdevices[] = $orderdevice;
			}
			if(count($orderdevices) > 0) {
				$this->cartlib->addGiftDevices($orderdevices);
			}
			if($orderid > 0) {
				$response['orderid'] = $orderid;
				$response['is_gift'] = 1;
				$response['ordercode'] = $oupdate['ordercode'];
				$response['status'] = 1;
			} else {
				$response['message'] = 'Sorry!! We facing issues in system.';
				$response['status'] = 0;
			}
		}
		echo json_encode($response);
	}
	
	public function thankYou($ordercode) {
		$cartmap = array();
		$cartmap['session_cookie'] = $this->getCartSession();
		$this->load->library('zyk/CartLib');
		$this->cartlib->clearProductCart($cartmap['session_cookie']);
		$this->session->unset_userdata('cartsession');
		$this->template->set ( 'ordercode', $ordercode );
		$this->template->set ( 'page', 'thankyou' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ("default")
		->title ( 'Thank You' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('thankyou');
	}
	
	
	
}