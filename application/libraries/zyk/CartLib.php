<?php
class CartLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	
	public function addOrderOTP($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$id = $this->CI->cart->addOrderOTP($map);
		return $id;
	}
	
	public function updateOrderOTP($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$id = $this->CI->cart->updateOrderOTP($map);
		return $id;
	}
	
	public function getOrderOTP($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$otps = $this->CI->cart->getOrderOTP($map);
		return $otps;
	}
	
	public function isMobileVerified($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$is_valid = $this->CI->cart->isMobileVerified($map);
		return $is_valid;
	}
	
	public function cartItemCount($map) {
		if(empty($map['session_cookie']))
		{
			$data['cart_cnt'] = 0;
		}
		if(empty($restid))
		{
			$data['cart_cnt'] = 0;
		}
		$this->CI->load->model('orders/Cart_model','cart');
		$cart = $this->CI->cart->getOrderItemCount( $map );
		if(count($cart) > 0) {
			$data['cart_cnt'] = $cart[0]['cart_count'];
		}else {
			$data['cart_cnt'] = 0;
		}
		return $data;
	}
	
	public function addProductToCart($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addProductToCart($map);
		return $response;
	}
	
	public function updateProductToCart($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->updateProductToCart($map);
		return $response;
	}
	
	public function removeProductToCart($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->removeProductToCart($map);
		return $response;
	}
	
	public function deleteProductToCart($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->deleteProductToCart($map);
		return $response;
	}
	
	public function clearProductCart($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->clearProductCart($map);
		return $response;
	}
	
	public function getProductOrderCart($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$cartitems = $this->CI->cart->getProductOrderCart($map);
		$response = array();
		$cart = array();
		$subtotal = 0;
		$savings = 0;
		$product_points = 0;
		foreach ( $cartitems as $key => $row ) {
			$subtotal += $row['totalprice'];
			$product_points +=  $row['karma_points'];
			$savings += $row['savings'];
			$cart [$key] = $row;
		}
		$response['discount'] = 0;
		$response['cashback'] = 0;
		$response['coupon_code'] = "";
		$response['cartitems'] = $cart;
		$response['savings'] =  $savings;
		$response['product_points'] =  $product_points;
		$response['subtotal'] =  $subtotal;
		return $response;
	}
	
	public function calculateDiscount($map) {
		$response = array();
		$flag = 1;
		$msg = "Coupon Applied.";
		$discount = 0;
		$cashback = 0;
		$this->CI->load->model ('coupan/Coupan_model', 'coupon');
		$this->CI->load->model('orders/Cart_model','cart');
		$map['date'] = date('Y-m-d');
		if(!empty($map['coupon_code'])) {
			$coupons = $this->CI->coupon->getCouponDetailByCode($map['coupon_code'],$map['date']);
			$ordercoupons = $this->CI->coupon->getOrdersByCouponCode($map);
			if(count($coupons) > 0) {
				if(count($ordercoupons) >= $coupons[0]['count_per_user']) {
					$flag = 0;
					$msg = "You have already used this coupon";
				} else {
					if($map['applicable_on'] != $coupons[0]['applicable_on'] && $coupons[0]['applicable_on'] != 0) {
						if($coupons[0]['applicable_on'] == 1) {
							$flag = 0;
							$msg = "This coupon is applicable on website only";
						} else if($coupons[0]['applicable_on'] == 2) {
							$flag = 0;
							$msg = "This coupon is applicable on APP only";
						}
					} else {
						$userorders = $this->CI->coupon->getUserOrders($map);
						if($coupons[0]['is_new_user'] == 1 && count($userorders) > 0) {
							$flag = 0;
							$msg = "This coupon is valid for new users only";
						} else {
							$flag = 1;
							$msg = "Coupon applied successfully;";
						}
					}
				}
			} else {
				$flag = 0;
				$msg = "Invalid OR Expired Coupon Code";
			}
			$response['coupon_code'] = $map['coupon_code'];
		} else {
			$flag = 0;
			$msg = "Coupon code required.";
			$response['coupon_code'] = '';
		}
		
		if($flag == 1) {
			if($coupons[0]['coupon_type'] == 1) {
				$map['cat_id'] = $coupons[0]['cat_id'];
				$cartitems = $this->CI->cart->getProductOrderCartByType($map);
				$subtotal = 0;
				foreach ( $cartitems as $key => $row ) {
					$subtotal += $row['totalprice'];
				}
				if($subtotal > 0) {
					if($coupons[0]['discount_type'] == 0) {
						$discount = $subtotal * $coupons[0]['discount']/100;
					} else {
						$discount = $coupons[0]['discount'];
					}
					
					if($coupons[0]['cashback_type'] == 0) {
						$cashback = $subtotal * $coupons[0]['cashback']/100;
					} else {
						$cashback = $coupons[0]['cashback'];
					}
				} else {
					$flag = 0;
					if($coupons[0]['cat_id'] == 0) {
						$discount = 0;
						$cashback = 0;
						$msg = "Coupon Valid on Devices only.";
					} else if($coupons[0]['cat_id'] == 1) {
						$discount = 0;
						$cashback = 0;
						$msg = "Coupon Valid on Kit only.";
					} else if($coupons[0]['cat_id'] == 2) {
						$discount = 0;
						$cashback = 0;
						$msg = "Coupon Valid on Subscriptions only.";
					}
				}
			} else {
				$map['cat_id'] = $coupons[0]['cat_id'];
				$cartitems = $this->CI->cart->getProductOrderCartByType($map);
				$subtotal = 0;
				foreach ( $cartitems as $key => $row ) {
					$subtotal += $row['totalprice'];
				}
				if($coupons[0]['discount_type'] == 0) {
					$discount = $subtotal * $coupons[0]['discount']/100;
				} else {
					$discount = $coupons[0]['discount'];
				}
				$cashback = 0;
			}
			if($coupons[0]['max_discount'] < $discount) {
				$discount = $coupons[0]['max_discount'];
			}
			if($coupons[0]['max_cashback'] < $cashback) {
				$cashback = $coupons[0]['max_cashback'];
			}
		} else {
			$discount = 0;
			$cashback = 0;
		}
		if($flag == 1) {
			$response['discount'] = $discount;
			$response['cashback'] = $cashback;
			$response['msg'] = $msg;
			$response['status'] = 1;
		} else {
			$response['discount'] = $discount;
			$response['cashback'] = $cashback;
			$response['msg'] = $msg;
			$response['status'] = 0;
		}
		return $response;
	}
	
	
	public function addOrder($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addOrder($map);
		return $response;
	}
	
	public function updateOrder($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->updateOrder($map);
		return $response;
	}
	
	public function addOrderCustomer($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addOrderCustomer($map);
		return $response;
	}
	
	public function addOrderGifteeDetail($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addOrderGifteeDetail($map);
		return $response;
	}
	
	public function addOrderProducts($products) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addOrderProducts($products);
		return $response;
	}
	
	public function addOrderDevices($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addOrderDevices($map);
		return $response;
	}
	
	public function addUserDevices($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addUserDevices($map);
		return $response;
	}
	
	public function addGiftOrder($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addGiftOrder($map);
		return $response;
	}
	
	public function updateGiftOrder($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->updateGiftOrder($map);
		return $response;
	}
	
	public function addGiftProducts($products) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addGiftProducts($products);
		return $response;
	}
	
	public function addGiftDevices($map) {
		$this->CI->load->model('orders/Cart_model','cart');
		$response = $this->CI->cart->addGiftDevices($map);
		return $response;
	}
	
	
}