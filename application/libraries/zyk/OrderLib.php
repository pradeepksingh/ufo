<?php
class OrderLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function addOrder($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		$orderdata['created_date'] = date('Y-m-d H:i:s');
		/* Apply coupon code here */
		return $this->CI->order->addOrder($orderdata);
	}
	
	public function updateOrder($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateOrder($orderdata);
	}
	
	public function getOrderDetails($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderDetails($orderid);
	}
	
	public function generateInvoice($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->generateInvoice($map);
	}
	
	public function updateOrderByCode($orderdata) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateOrderByCode($orderdata);
	}
	
	public function addOrderCustomer($customer) {
		$this->CI->load->model ('orders/Order_model','order');
		$this->CI->order->addOrderCustomer($customer);
	}
	
	public function addOrderItems($orderitems) {
		$this->CI->load->model ('orders/Order_model','order');
		$this->CI->order->addOrderItems($orderitems);
	}
	
	public function addOrderSubItems($ordersitems) {
		if(count($ordersitems) > 0) {
			$this->CI->load->model ('orders/Order_model','order');
			$this->CI->order->addOrderSubItems($ordersitems);
		}
	}
	
	public function addOrderLog($logs) {
		$this->CI->load->model ('orders/Order_model','order');
		$this->CI->order->addOrderLogs($logs);
	}
	
	public function getOrderLogs($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		$logs = $this->CI->order->getOrderLogs($orderid);
		return $logs;
	}
	
	public function getOrderItems($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		$cartitems = $this->CI->order->getOrderItems($orderid);
		$subitems = $this->CI->order->getAllOrderSubItems($orderid);
		$cart = array();
		$cart['cartitems'] = $cartitems;
		$subtotal = 0;
		$packaging = 0;
		foreach ($cartitems as $key=>$cartitem) {
			$options = array();
			$optioncategory = array();
			$option_cat_name = "";
			$itemset = 0;
			$itemsets = array();
			$itemset_price = 0;
			foreach ($subitems as $subitem) {
				if($cartitem['option_id'] == $subitem['option_id']) {
					if($option_cat_name != "" && $option_cat_name != $subitem['option_cat_name']) {
						$option_cat = array();
						$option_cat['name'] = $option_cat_name;
						$option_cat['items'] = $options;
						$optioncategory[] = $option_cat;
						$options = array();
					}
					if($itemset != 0 && $subitem['itemset'] != $itemset) {
						$item_set_arr = array();
						$item_set_arr['option_category'] = $optioncategory;
						$item_set_arr['itemset'] = $itemset;
						$item_set_arr['itemset_price'] = $itemset_price;
						$itemsets[] = $item_set_arr;
						$optioncategory = array();
						$itemset_price = 0;
					}
					$option = array();
					$option['sub_item_id'] = $subitem['sub_item_id'];
					$option['sub_item_name'] = $subitem['sub_item_name'];
					$option['price'] = $subitem['price'];
					$itemset_price += $subitem['price'];
					$options[] = $option;
					$option_cat_name = $subitem['option_cat_name'];
					$itemset = $subitem['itemset'];
				}
			}
			if(count($options) > 0) {
				$option_cat = array();
				$option_cat['name'] = $option_cat_name;
				$option_cat['items'] = $options;
				$optioncategory[] = $option_cat;
			}
			if(count($optioncategory) > 0) {
				$item_set_arr = array();
				$item_set_arr['option_category'] = $optioncategory;
				$item_set_arr['itemset'] = $itemset;
				$item_set_arr['itemset_price'] = $itemset_price;
				$itemsets[] = $item_set_arr;
			}
			if(count($itemsets) > 0) {
				$cartitems[$key]['itemsets'] = $itemsets;
			} else {
				$cartitems[$key]['itemsets'] = array();
			}
		}
		return $cartitems;
	}
	
	public function getOrderItemDetails1($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		$cartitems = $this->CI->order->getOrderItemDetails($orderid);
		$subitems = $this->CI->order->getAllOrderSubItems($orderid);
		$cart = array();
		$cart['cartitems'] = $cartitems;
		$subtotal = 0;
		$packaging = 0;
		foreach ($cartitems as $key=>$cartitem) {
			$options = array();
			$optioncategory = array();
			$option_cat_name = "";
			$itemset = 0;
			$itemsets = array();
			$itemset_price = 0;
			foreach ($subitems as $subitem) {
				if($cartitem['option_id'] == $subitem['option_id']) {
					if($option_cat_name != "" && $option_cat_name != $subitem['option_cat_name']) {
						$option_cat = array();
						$option_cat['name'] = $option_cat_name;
						$option_cat['items'] = $options;
						$optioncategory[] = $option_cat;
						$options = array();
					}
					if($itemset != 0 && $subitem['itemset'] != $itemset) {
						$item_set_arr = array();
						$item_set_arr['option_category'] = $optioncategory;
						$item_set_arr['itemset'] = $itemset;
						$item_set_arr['itemset_price'] = $itemset_price;
						$itemsets[] = $item_set_arr;
						$optioncategory = array();
						$itemset_price = 0;
					}
					$option = array();
					$option['sub_item_id'] = $subitem['sub_item_id'];
					$option['sub_item_name'] = $subitem['sub_item_name'];
					$option['price'] = $subitem['price'];
					$itemset_price += $subitem['price'];
					$options[] = $option;
					$option_cat_name = $subitem['option_cat_name'];
					$itemset = $subitem['itemset'];
				}
			}
			if(count($options) > 0) {
				$option_cat = array();
				$option_cat['name'] = $option_cat_name;
				$option_cat['items'] = $options;
				$optioncategory[] = $option_cat;
			}
			if(count($optioncategory) > 0) {
				$item_set_arr = array();
				$item_set_arr['option_category'] = $optioncategory;
				$item_set_arr['itemset'] = $itemset;
				$item_set_arr['itemset_price'] = $itemset_price;
				$itemsets[] = $item_set_arr;
			}
			if(count($itemsets) > 0) {
				$cartitems[$key]['itemsets'] = $itemsets;
			} else {
				$cartitems[$key]['itemsets'] = array();
			}
		}
		return $cartitems;
	}
	public function getOrderItemDetails($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		$cartitems = $this->CI->order->getOrderItemDetails($orderid);
		return $cartitems;
	}
	
	public function getOrderCart($ordercode) {
		$this->CI->load->model ('orders/Order_model','order');
		$order_details = $this->CI->order->getOrderDetails($ordercode);
		$cartitems = $this->CI->order->getOrderItems($order_details[0]['orderid']);
		$subitems = $this->CI->order->getAllOrderSubItems($order_details[0]['orderid']);
		$cart = array();
		$cart['cartitems'] = $cartitems;
		$subtotal = 0;
		$packaging = 0;
		foreach ($cartitems as $key=>$cartitem) {
			$options = array();
			$optioncategory = array();
			$option_cat_name = "";
			$itemset = 0;
			$itemsets = array();
			$itemset_price = 0;
			foreach ($subitems as $subitem) {
				if($cartitem['option_id'] == $subitem['option_id']) {
					if($option_cat_name != "" && $option_cat_name != $subitem['option_cat_name']) {
						$option_cat = array();
						$option_cat['name'] = $option_cat_name;
						$option_cat['items'] = $options;
						$optioncategory[] = $option_cat;
						$options = array();
					}
					if($itemset != 0 && $subitem['itemset'] != $itemset) {
						$item_set_arr = array();
						$item_set_arr['option_category'] = $optioncategory;
						$item_set_arr['itemset'] = $itemset;
						$item_set_arr['itemset_price'] = $itemset_price;
						$itemsets[] = $item_set_arr;
						$optioncategory = array();
						$itemset_price = 0;
					}
					$option = array();
					$option['sub_item_id'] = $subitem['sub_item_id'];
					$option['sub_item_name'] = $subitem['sub_item_name'];
					$option['price'] = $subitem['price'];
					$itemset_price += $subitem['price'];
					$options[] = $option;
					$option_cat_name = $subitem['option_cat_name'];
					$itemset = $subitem['itemset'];
				}
			}
			if(count($options) > 0) {
				$option_cat = array();
				$option_cat['name'] = $option_cat_name;
				$option_cat['items'] = $options;
				$optioncategory[] = $option_cat;
			}
			if(count($optioncategory) > 0) {
				$item_set_arr = array();
				$item_set_arr['option_category'] = $optioncategory;
				$item_set_arr['itemset'] = $itemset;
				$item_set_arr['itemset_price'] = $itemset_price;
				$itemsets[] = $item_set_arr;
			}
			if(count($itemsets) > 0) {
				$cartitems[$key]['itemsets'] = $itemsets;
			} else {
				$cartitems[$key]['itemsets'] = array();
			}
		}
		$cart = array();
		$cart['cartitems'] = $cartitems;
		$cart['subtotal'] = $order_details[0]['sub_total'];
		$cart['discount'] = $order_details[0]['zyk_discount'] + $order_details[0]['rest_discount'];
		$cart['rest_discount'] = $order_details[0]['rest_discount'];
		$cart['zyk_discount'] = $order_details[0]['zyk_discount'];
		$cart['tax'] = $order_details[0]['order_tax'];
		$cart['service_charge'] = $order_details[0]['service_charge'];
		$cart['delivery_charge'] = $order_details[0]['delivery_charge'];
		$cart['packaging'] = $order_details[0]['packaging_charge'];
		$cart['ordertotal'] = $order_details[0]['total_amount'];
		$cart['is_takeaway'] = $order_details[0]['is_takeaway'];
		$cart['is_online_paid'] = $order_details[0]['is_online_paid'];
		$cart['payment_status'] = $order_details[0]['payment_status'];
		$cart['delivery_date'] = $order_details[0]['delivery_date'];
		$cart['delivery_time'] = $order_details[0]['delivery_time'];
		$cart['orderid'] = $order_details[0]['orderid'];
		$cart['ordercode'] = $order_details[0]['ordercode'];
		$cart['restname'] = $order_details[0]['restname'];
		$cart['areaname'] = $order_details[0]['areaname'];
		$cart['cityname'] = $order_details[0]['cityname'];
		$cart['rest_address'] = $order_details[0]['rest_address'];
		$cart['rest_landmark'] = $order_details[0]['rest_landmark'];
		$cart['rest_locality'] = $order_details[0]['rest_locality'];
		$cart['restid'] = $order_details[0]['restid'];
		$cart['areaid'] = $order_details[0]['areaid'];
		$cart['name'] = $order_details[0]['name'];
		$cart['email'] = $order_details[0]['email'];
		$cart['mobile'] = $order_details[0]['mobile'];
		$cart['cust_area'] = $order_details[0]['cust_area'];
		$cart['address'] = $order_details[0]['address'];
		$cart['landmark'] = $order_details[0]['landmark'];
		$cart['locality'] = $order_details[0]['locality'];
		$cart['special_instruction'] = $order_details[0]['special_instruction'];
		if($order_details[0]['is_takeaway'] == 0) {
			$cart['order_type'] = 'Home Delivery';
		} else {
			$cart['order_type'] = 'Pickup';
		}
		return $cart;
	}
	
	public function sendNewOrderEmail($order_details) {
		$cart = $this->getOrderCart($order_details['ordercode']);
		$cart['subtotal'] = $order_details['sub_total'];
		$cart['discount'] = $order_details['zyk_discount'] + $order_details['rest_discount'];
		$cart['rest_discount'] = $order_details['rest_discount'];
		$cart['zyk_discount'] = $order_details['zyk_discount'];
		$cart['tax'] = $order_details['order_tax'];
		$cart['service_charge'] = $order_details['service_charge'];
		$cart['delivery_charge'] = $order_details['delivery_charge'];
		$cart['packaging'] = $order_details['packaging_charge'];
		$cart['ordertotal'] = $order_details['total_amount'];
		$cart['is_takeaway'] = $order_details['is_takeaway'];
		$cart['is_online_paid'] = $order_details['is_online_paid'];
		$cart['payment_status'] = $order_details['payment_status'];
		$cart['delivery_date'] = $order_details['delivery_date'];
		$cart['delivery_time'] = $order_details['delivery_time'];
		$cart['orderid'] = $order_details['orderid'];
		$cart['ordercode'] = $order_details['ordercode'];
		$cart['restname'] = $order_details['restname'];
		$cart['areaname'] = $order_details['areaname'];
		$cart['cityname'] = $order_details['cityname'];
		$cart['rest_address'] = $order_details['rest_address'];
		$cart['rest_landmark'] = $order_details['rest_landmark'];
		$cart['rest_locality'] = $order_details['rest_locality'];
		$cart['restid'] = $order_details['restid'];
		$cart['areaid'] = $order_details['areaid'];
		$cart['name'] = $order_details['name'];
		$cart['email'] = $order_details['email'];
		$cart['mobile'] = $order_details['mobile'];
		$cart['cust_area'] = $order_details['cust_area'];
		$cart['address'] = $order_details['address'];
		$cart['landmark'] = $order_details['landmark'];
		$cart['locality'] = $order_details['locality'];
		$cart['special_instruction'] = $order_details['special_instruction'];
		if($order_details['is_takeaway'] == 0) {
			$cart['order_type'] = 'Home Delivery';
		} else {
			$cart['order_type'] = 'Pickup';
		}
		$this->CI->template->set ( 'data', $cart );
		$this->CI->template->set_theme('default_theme');
		$this->CI->template->set_layout (false);
		$html = $this->CI->template->build ('frontend/emails/neworder','',true);
		$this->CI->load->library('fbemail');
		$this->CI->fbemail->load_system_config();
		$this->CI->fbemail->headline = "olotime";
		$this->CI->fbemail->subject = "New Order Acknowledgement from olotime.com";
		$this->CI->fbemail->mctag = '';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $cart['email'];
		return $this->CI->fbemail->send_email( $html );
	}
	
	public function sendOrderConfirmationEmail($order_details) {
		$cart = $this->getOrderCart($order_details['ordercode']);
		$cart['subtotal'] = $order_details['sub_total'];
		$cart['discount'] = $order_details['zyk_discount'] + $order_details['rest_discount'];
		$cart['rest_discount'] = $order_details['rest_discount'];
		$cart['zyk_discount'] = $order_details['zyk_discount'];
		$cart['tax'] = $order_details['order_tax'];
		$cart['service_charge'] = $order_details['service_charge'];
		$cart['delivery_charge'] = $order_details['delivery_charge'];
		$cart['packaging'] = $order_details['packaging_charge'];
		$cart['ordertotal'] = $order_details['total_amount'];
		$cart['is_takeaway'] = $order_details['is_takeaway'];
		$cart['is_online_paid'] = $order_details['is_online_paid'];
		$cart['payment_status'] = $order_details['payment_status'];
		$cart['delivery_date'] = $order_details['delivery_date'];
		$cart['delivery_time'] = $order_details['delivery_time'];
		$cart['orderid'] = $order_details['orderid'];
		$cart['ordercode'] = $order_details['ordercode'];
		$cart['restname'] = $order_details['restname'];
		$cart['areaname'] = $order_details['rest_area'];
		$cart['cityname'] = $order_details['cityname'];
		$cart['rest_address'] = $order_details['rest_address'];
		$cart['rest_landmark'] = $order_details['rest_landmark'];
		$cart['rest_locality'] = $order_details['rest_locality'];
		$cart['restid'] = $order_details['restid'];
		$cart['areaid'] = $order_details['areaid'];
		$cart['name'] = $order_details['name'];
		$cart['email'] = $order_details['email'];
		$cart['mobile'] = $order_details['mobile'];
		$cart['cust_area'] = $order_details['cust_area'];
		$cart['address'] = $order_details['address'];
		$cart['landmark'] = $order_details['landmark'];
		$cart['locality'] = $order_details['locality'];
		$cart['special_instruction'] = $order_details['special_instruction'];		
		if($order_details['is_takeaway'] == 0) {
			$cart['order_type'] = 'Home Delivery';
		} else {
			$cart['order_type'] = 'Pickup';
		}
		$this->CI->template->set ( 'data', $cart );
		$this->CI->template->set_theme('default_theme');
		$this->CI->template->set_layout (false);
		$html = $this->CI->template->build ('frontend/emails/orderconfirmation','',true);
		$this->CI->load->library('fbemail');
		$this->CI->fbemail->load_system_config();
		$this->CI->fbemail->headline = "olotime";
		$this->CI->fbemail->subject = "Your order is confirmed by ".$cart['restname'];
		$this->CI->fbemail->mctag = '';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $cart['email'];
		$items = array();
		if ($order_details['is_takeaway'] == 0) {
			if ($order_details['delivery_type'] == 2) {
				$item_desc = "";
				$item_count = 0;
				$i = 1;
				foreach ($cart['cartitems'] as $item) {
					$singleitem = array();
					$singleitem['Item Name'] = $item['name'];
					$singleitem['Item Rate'] = $item['price'];
					$singleitem['Quantity'] = $item['quantity'];
					$singleitem['Total'] = $item['totalprice'];
					$items['Item'.$i] = $item;
					if($item_desc != "") {
						$item_desc = $item['name'];
						if($item['size'] != 'standard') { 
							$item_desc = $item_desc." (".ucfirst($item['size']).")";
						}
						$item_desc = $item_desc.' - '.$item['quantity'];
					} else {
						$item_desc = $item_desc.', '.$item['name'];
						if($item['size'] != 'standard') {
							$item_desc = $item_desc." (".ucfirst($item['size']).")";
						}
						$item_desc = $item_desc.' - '.$item['quantity'];
					}
					$item_count = $item_count + $item['quantity'];
					$i++;
				}
				$dack = array();
				$dack['task_def'] = 'PND';
				$dack['pickup_customer_name'] = $order_details['restname'];
				$dack['pickup_customer_contact'] = '18002660292';
				$dack['pickup_datetime'] = date('Y-m-d H-i-s');
				$dack['pickup_address'] = $order_details['rest_address'].', '.$order_details['rest_area'].', '.$order_details['rest_landmark'];
				$dack['pickup_nearby_address'] = $order_details['rest_locality'];
				$dack['pickup_mapLat'] = $order_details['rest_latitude'];
				$dack['pickup_mapLng'] = $order_details['rest_longitude'];
				$dack['pickup_customer_id'] = $order_details['restid'];
				$dack['delivery_customer_name'] = $order_details['name'];
				$dack['delivery_customer_contact'] = $order_details['mobile'];
				$dack['delivery_datetime'] = $order_details['delivery_date'].' '.date('H-i-s',strtotime($order_details['delivery_time']));
				if(!empty($order_details['landmark'])) {
					$dack['delivery_address'] = $order_details['address'].', '.$order_details['landmark'];
				} else {
					$dack['delivery_address'] = $order_details['address'];
				}
				$dack['delivery_nearby_address'] = $order_details['locality'];
				$dack['delivery_mapLat'] = $order_details['latitude'];
				$dack['delivery_mapLng'] = $order_details['longitude'];
				$dack['delivery_customer_id'] = $order_details['userid'];
				$dack['invoice_number'] = '';
				$dack['item_description'] = $item_desc;
				$dack['item_info'] = $item_desc;
				$dack['item_quantity'] = $item_count;
				$dack['order_amount'] = $cart['ordertotal'];
				$dack['items'] = json_encode($items);
				$this->CI->load->library('zyk/Dack');
				$this->CI->dack->moveToDack($dack);
			}
		}
		return $this->CI->fbemail->send_email( $html );
	}
	
	public function sendPaymentFailEmail($order_details) {
		$cart = array();
		$cart['orderid'] = $order_details['orderid'];
		$cart['ordercode'] = $order_details['ordercode'];
		$cart['restname'] = $order_details['restname'];
		$cart['areaname'] = $order_details['areaname'];
		$cart['cityname'] = $order_details['cityname'];
		$cart['rest_address'] = $order_details['rest_address'];
		$cart['rest_landmark'] = $order_details['rest_landmark'];
		$cart['rest_locality'] = $order_details['rest_locality'];
		$cart['restid'] = $order_details['restid'];
		$cart['areaid'] = $order_details['areaid'];
		$cart['name'] = $order_details['name'];
		$cart['email'] = $order_details['email'];
		$cart['mobile'] = $order_details['mobile'];
		$cart['cust_area'] = $order_details['cust_area'];
		$cart['address'] = $order_details['address'];
		$cart['landmark'] = $order_details['landmark'];
		$cart['locality'] = $order_details['locality'];
		$cart['special_instruction'] = $order_details['special_instruction'];
		if($order_details['is_takeaway'] == 0) {
			$cart['order_type'] = 'Home Delivery';
		} else {
			$cart['order_type'] = 'Pickup';
		}
		$this->CI->template->set ( 'data', $cart );
		$this->CI->template->set_theme('default_theme');
		$this->CI->template->set_layout (false);
		$html = $this->CI->template->build ('frontend/emails/paymentfailed','',true);
		$this->CI->load->library('fbemail');
		$this->CI->fbemail->load_system_config();
		$this->CI->fbemail->headline = "olotime";
		$this->CI->fbemail->subject = "Oops! Payment has failed for Order [".$order_details['ordercode']."]";
		$this->CI->fbemail->mctag = '';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $cart['email'];
		return $this->CI->fbemail->send_email( $html );
	}
	
	public function sendRestaurantOrderEmail($order_details) {
		if(!empty($order_details['order_notify_email'])) {
			$cart = $this->getOrderCart($order_details['ordercode']);
			$cart['subtotal'] = $order_details['sub_total'];
			$cart['discount'] = $order_details['zyk_discount'] + $order_details['rest_discount'];
			$cart['rest_discount'] = $order_details['rest_discount'];
			$cart['zyk_discount'] = $order_details['zyk_discount'];
			$cart['tax'] = $order_details['order_tax'];
			$cart['service_charge'] = $order_details['service_charge'];
			$cart['delivery_charge'] = $order_details['delivery_charge'];
			$cart['packaging'] = $order_details['packaging_charge'];
			$cart['ordertotal'] = $order_details['total_amount'];
			$cart['is_takeaway'] = $order_details['is_takeaway'];
			$cart['is_online_paid'] = $order_details['is_online_paid'];
			$cart['payment_status'] = $order_details['payment_status'];
			$cart['delivery_date'] = $order_details['delivery_date'];
			$cart['delivery_time'] = $order_details['delivery_time'];
			$cart['orderid'] = $order_details['orderid'];
			$cart['ordercode'] = $order_details['ordercode'];
			$cart['restname'] = $order_details['restname'];
			$cart['areaname'] = $order_details['rest_area'];
			$cart['cityname'] = $order_details['cityname'];
			$cart['rest_address'] = $order_details['rest_address'];
			$cart['rest_landmark'] = $order_details['rest_landmark'];
			$cart['rest_locality'] = $order_details['rest_locality'];
			$cart['restid'] = $order_details['restid'];
			$cart['areaid'] = $order_details['areaid'];
			$cart['name'] = $order_details['name'];
			$cart['email'] = $order_details['email'];
			$cart['mobile'] = $order_details['mobile'];
			$cart['cust_area'] = $order_details['cust_area'];
			$cart['address'] = $order_details['address'];
			$cart['landmark'] = $order_details['landmark'];
			$cart['locality'] = $order_details['locality'];
			if($order_details['is_takeaway'] == 0) {
				$cart['order_type'] = 'Home Delivery';
			} else {
				$cart['order_type'] = 'Pickup';
			}
			if(!empty($order_details['special_instruction']))
			$cart['special_instruction'] = $order_details['special_instruction'];
			$this->CI->template->set ( 'data', $cart );
			$this->CI->template->set_theme('default_theme');
			$this->CI->template->set_layout (false);
			$html = $this->CI->template->build ('frontend/emails/restorderemail','',true);
			$this->CI->load->library('fbemail');
			$this->CI->fbemail->load_system_config();
			$this->CI->fbemail->headline = "olotime";
			$this->CI->fbemail->subject = "You have received an order from olotime.com";
			$this->CI->fbemail->mctag = '';
			$this->CI->fbemail->attachment = 0;
			$this->CI->fbemail->to = $order_details['order_notify_email'];
			return $this->CI->fbemail->send_email( $html );
		}
	}
	
	public function sendOrderCancellationEmail($order_details) {
		$cart = array();
		$cart['reason'] = $order_details['reason'];
		$cart['is_takeaway'] = $order_details['is_takeaway'];
		$cart['is_online_paid'] = $order_details['is_online_paid'];
		$cart['payment_status'] = $order_details['payment_status'];
		$cart['delivery_date'] = $order_details['delivery_date'];
		$cart['delivery_time'] = $order_details['delivery_time'];
		$cart['orderid'] = $order_details['orderid'];
		$cart['ordercode'] = $order_details['ordercode'];
		$cart['restname'] = $order_details['restname'];
		$cart['areaname'] = $order_details['rest_area'];
		$cart['cityname'] = $order_details['cityname'];
		$cart['rest_address'] = $order_details['rest_address'];
		$cart['rest_landmark'] = $order_details['rest_landmark'];
		$cart['rest_locality'] = $order_details['rest_locality'];
		$cart['restid'] = $order_details['restid'];
		$cart['areaid'] = $order_details['areaid'];
		$cart['name'] = $order_details['name'];
		$cart['email'] = $order_details['email'];
		$cart['mobile'] = $order_details['mobile'];
		$cart['cust_area'] = $order_details['cust_area'];
		$cart['address'] = $order_details['address'];
		$cart['landmark'] = $order_details['landmark'];
		$cart['locality'] = $order_details['locality'];
		$cart['special_instruction'] = $order_details['special_instruction'];
		if($order_details['is_takeaway'] == 0) {
			$cart['order_type'] = 'Home Delivery';
		} else {
			$cart['order_type'] = 'Pickup';
		}
		$this->CI->template->set ( 'data', $cart );
		$this->CI->template->set_theme('default_theme');
		$this->CI->template->set_layout (false);
		$html = $this->CI->template->build ('frontend/emails/ordercancelemail','',true);
		$this->CI->load->library('fbemail');
		$this->CI->fbemail->load_system_config();
		$this->CI->fbemail->headline = "olotime";
		$this->CI->fbemail->subject = "Your order[".$order_details['ordercode']."] from ".$order_details['restname']." has been cancelled";
		$this->CI->fbemail->mctag = '';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $order_details['email'];
		return $this->CI->fbemail->send_email( $html );
	}
	
	public function sendNewOrderSMS($details) {
		$this->CI->load->library('Fbsms');
		$map = array();
		$map['mobile'] = $details['mobile'];
		$map['message'] = 'Dear '.$details['name'].' , We have received your order ['.$details['ordercode'].'] . You will receive a confirmation sms once your order will be confirmed.';
		$this->CI->fbsms->sendSms($map);
	}
	
	public function sendDeliveryOrderConfirmationSMS($details) {
		$this->CI->load->library('Fbsms');
		$map = array();
		$map['mobile'] = $details['mobile'];
		$map['message'] = 'Dear '.$details['name'].' , Your order ['.$details['ordercode'].'] has been confirmed. Your order will be delivered by '.date('h:i A',strtotime($details['delivery_time'])).' (Approx.) on '.date('j M Y',strtotime($details['delivery_date'])).' .';
		$this->CI->fbsms->sendSms($map);
	}
	
	public function sendPickUpOrderConfirmationSMS($details) {
		$this->CI->load->library('Fbsms');
		$map = array();
		$map['mobile'] = $details['mobile'];
		$map['message'] = 'Dear '.$details['name'].' , Your order ['.$details['ordercode'].'] has been confirmed. Please pickup your order by '.date('h:i A',strtotime($details['delivery_time'])).' on '.date('j M Y',strtotime($details['delivery_date'])).' from '.$details['rest_address'].' .';
		$this->CI->fbsms->sendSms($map);
	}
	
	public function sendPaymentFailedSMS($details) {
		$this->CI->load->library('Fbsms');
		$map = array();
		$map['mobile'] = $details['mobile'];
		$map['message'] = 'Dear '.$details['name'].', We have not received any payment so far. Please try again or choose COD option.';
		$this->CI->fbsms->sendSms($map);
	}
	
	public function sendOrderCancelSMS($details) {
		$this->CI->load->library('Fbsms');
		$map = array();
		$map['mobile'] = $details['mobile'];
		$map['message'] = 'Dear '.$details['name'].', We are extremely sorry. Your order ['.$details['ordercode'].'] has been cancelled due to '.$details['reason'].' .';
		$this->CI->fbsms->sendSms($map);
	}
	
	public function sendRestaurantDeliveryOrderSMS($details) {
		$delivery_time = date('h:i A',strtotime($details['delivery_time'])). ' '.date('d-m-Y',strtotime($details['delivery_date']));
		$payment_mode = "";
		if($details['is_online_paid'] == 1) {
			$payment_mode = "Online Paid";
		} else {
			$payment_mode = "COD";
		}
		$mobiles = explode(",",$details['order_notify_mobile']);
		$this->CI->load->library('Fbsms');
		foreach ($mobiles as $mobile) {
			$map = array();
			$map['mobile'] = $mobile;
			$map['message'] = 'You have received new delivery order ['.$details['ordercode'].'] from olotime.com. Customer name : '.$details['name'].', Delivery address : '.$details['address'].', Total Amount: '.$details['total_amount'].', Payment : '.$payment_mode.', Delivery Time: '.$delivery_time.'.';
			$this->CI->fbsms->sendSms($map);
		}
	}
	
	public function sendRestaurantPickupOrderSMS($details) {
		$pickup_time = date('h:i A',strtotime($details['delivery_time'])). ' '.date('d-m-Y',strtotime($details['delivery_date']));
		$payment_mode = "";
		if($details['is_online_paid'] == 1) {
			$payment_mode = "Online Paid";
		} else {
			$payment_mode = "COD";
		}
		$mobiles = explode(",",$details['order_notify_mobile']);
		$this->CI->load->library('Fbsms');
		foreach ($mobiles as $mobile) {
			$map = array();
			$map['mobile'] = $mobile;
			$map['message'] = 'You have received new takeaway order ['.$details['ordercode'].'] from olotime.com. Customer name : '.$details['name'].', Mobile : '.$details['mobile'].', Total Amount: '.$details['total_amount'].', Payment : '.$payment_mode.', Pickup Time: '.$pickup_time.'.';
			$this->CI->fbsms->sendSms($map);
		}
	}
	
	
	
	public function getTodaysOrderCount() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getTodaysOrderCount();
	}
	
	public function getPendingOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getPendingOrdersByDate($date);
	}
	
	public function getCompletedOrdersByDate() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getCompletedOrdersByDate();
	}
	
	public function getOrders($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrders($orderid);
	}
	
	public function updateInvoice($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->updateInvoice($map);
	}
	
	public function getCompletedOrders() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getCompletedOrders();
	}
	
	public function getAllOrder() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getAllOrder();
	}
	
	public function getCancelledOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getCancelledOrdersByDate($date);
	}
	
	public function getFailedPaymentOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getFailedPaymentOrdersByDate($date);
	}
	
	public function getPendingPaymentOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getPendingPaymentOrdersByDate($date);
	}
	
	public function getDelOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getDelOrdersByDate($date);
	}
	
	public function getAdvanceOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getAdvanceOrdersByDate($date);
	}
	
	public function getOrderDetailsByOrderId($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderDetailsByOrderId($orderid);
	}
	
	public function searchOrders($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->searchOrder($map);
	}
	
	public function addCancelOrderReason($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->addCancelOrderReason($map);
	}
	
	public function getOrderGatewayDetails($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderGatewayDetails($orderid);
	}
	
	public function getRestaurantTodaysOrders($client_id) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getRestaurantTodaysOrders($client_id);
	}
	
	public function countPendingPaymentOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->countPendingPaymentOrdersByDate($date);
	}
	
	public function countPendingOrdersByDate($date) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->countPendingOrdersByDate($date);
	}
	
	public function getRestaurantTodaysPendingOrders($restid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getRestaurantTodaysPendingOrders($restid);
	}
	
	public function getRestaurantTodaysConfirmedOrders($restid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getRestaurantTodaysConfirmedOrders($restid);
	}
	
	public function getRestaurantTodaysCancelledOrders($restid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getRestaurantTodaysCancelledOrders($restid);
	}
	
	public function isRestaurantFirstOrder($restid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->isRestaurantFirstOrder($restid);
	}
	
	public function isUserFirstOrder($userid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->isUserFirstOrder($userid);
	}
	
	public function searchClientOrders($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->searchClientOrders($map);
	}
	
	public function editform($map) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->editform($map);
	}
	
	public function getOrderProducts($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderProducts($orderid);
	}
	
	public function getbackendorderProduct() {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getbackendorderProduct();
	}
	public function sendInvoiceEmail($data) {
		echo "inside email";
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'Your Order Invoice |Petpedia';
		$this->CI->pkemail->subject = 'Your Order Invoice | Petpedia';
		$this->CI->pkemail->mctag = 'invoice';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $data ['email'];
		$this->CI->template->set ( 'data', $data );
		$this->CI->template->set ( 'page', 'invoice' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/invoice','', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	/* ******************** New Code ***************** */
	
	public function getOrderDetailById($orderid) {
		$this->CI->load->model ('orders/Order_model','order');
		return $this->CI->order->getOrderDetailById($orderid);
	}
	
}