<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Model API for cart management .
 *
 * <p>
 * We are using this model to assign, unassign, change and get delivery status of orders.
 * </p>
 * @package Orders cart
 * @subpackage cart-model
 * @category CI_Model API
 */
	class Cart_model extends CI_Model {
		
		function __construct() {
			parent::__construct();
		}

		/**
         * Function for getting order cart session.
         *
         * @access private
         * @return cookie session record
         * @version 1.0001
         */
		public function getCartSession( $id ) {
			return md5(date(DATE_RFC822).time().$id);
		}
		
		public function addSubItemsToCart( $map ) {
			$this->db->insert(TABLES::$ORDER_SUB_CART,$map);
			return $map;
		}
		
		public function getSubCartItem( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->select('*')
			->from(TABLES::$ORDER_SUB_CART)
			->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}

		public function removeSubItemsFromCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}
		
		/*public function removeSubItemSetFromCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'itemset'=>$map['itemset']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		} */

		 /**
         * Function for adding order items to session cart.
         *
         * @access public
         * @param array map
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function addItemToCart( $map) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->select('COUNT(*) as count')->from(TABLES::$ORDER_CART)->where($params);
	    	$query = $this->db->get();
	    	$result = $query->result_array();
			if($result[0]['count'] <=0 ) {
				$this->db->insert(TABLES::$ORDER_CART,$map);
			}else {
				//$this->increaseItemQuantity( $map  );
				$this->updateItemQuantity( $map );
			}
			return $map;
		}
		
	    public function getOrderTotal( $map ) {
	    	$params = array('a.session_cookie'=>$map['cart_session']);
	    	$this->db->select('SUM(a.quantity*b.price) AS total',FALSE)
	    		     ->from(TABLES::$ORDER_CART.' AS a')
	    		     ->join(TABLES::$MENU_ITEM_TABLE.' AS b','a.itemid = b.id','inner')
	    		     ->where($params)
	    		     ->group_by('a.session_cookie');
			$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
	    }

		
		/**
         * Function for removing items from order session cart.
         *
         * @access public
         * @param integer itemid
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function removeItemFromCart( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->select('quantity')->from(TABLES::$ORDER_CART)->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if(count($result) > 0) {
				if ($result[0]['quantity'] <=1 ) {
					$this->db->where($params);
					$this->db->delete(TABLES::$ORDER_CART);
				} else {
					$quantity = $result[0]['quantity'];
					$qty = array();
					$qty['quantity'] = $quantity - 1;
					$this->db->where($params);
					$this->db->update(TABLES::$ORDER_CART,$qty);
				}
			}
		}
		
		public function deleteItemFromCart( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_CART);
		}

		/**
         * Function for updating item quantity in order cart.
         *
         * @access public
         * @param array itemMap
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function updateItemQuantity( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->where($params);
			$qty = array('quantity'=>$map['quantity']);
			$this->db->update(TABLES::$ORDER_CART,$qty);
		}
		
		public function increaseItemQuantity($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'itemid'=>$map['itemid'],'option_id'=>$map['option_id']);
			$this->db->select('quantity')->from(TABLES::$ORDER_CART)->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if(count($result) > 0) {
				$quantity = $result[0]['quantity'];
				$qty = array();
				$qty['quantity'] = $quantity;
				$this->db->where($params);
				$this->db->update(TABLES::$ORDER_CART,$qty);
			}
		}

		  /**
         * Function for getting order cart.
         *
         * @access public
         * @param integer restid
         * @return array array of multi result set
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function getOrderCart( $map ) {
		 	$params = array('a.session_cookie'=>$map['session_cookie']);
		 	$this->db->select('a.itemid,a.option_id,a.quantity as cartquantity,a.price as cartprice,(a.quantity * a.price) as totalprice,b.*', FALSE)
		 			 ->from(TABLES::$ORDER_CART.' AS a')
		 			 ->join(TABLES::$PRODUCT.' AS b','a.itemid = b.product_id','inner')
		 			 ->where($params);
		 			 //->order_by('c.name','asc');
		 	$query = $this->db->get();
		 	//echo $this->db->last_query();
			$result = $query->result_array();
			return $result;
		}
		
		/* public function getOrderCart( $map ) {
			$params = array('a.session_cookie'=>$map['session_cookie'],'a.restid'=>$map['restid']);
			$this->db->select('a.itemid,a.option_id,a.quantity,b.price,(a.quantity * b.price) as totalprice,(a.quantity *b.packaging) as packaging,a.size,c.name,c.description,c.vat_tax,c.service_tax', FALSE)
			->from(TABLES::$ORDER_CART.' AS a')
			->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.option_id = b.id','inner')
			->join(TABLES::$MENU_ITEM.' AS c','b.itemid = c.id','inner')
			->where($params)
			->order_by('c.name','asc');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}  */
		
		public function getOrderSubItemsBySubcat( $map ) {
		 	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid']);
		 	$this->db->select('a.itemid,GROUP_CONCAT(DISTINCT b.sub_item_name SEPARATOR ",") as subitems,c.price,SUM(c.price) as subprice,b.sub_cat_name,b.itemset', FALSE)
		 			 ->from(TABLES::$ORDER_CART.' AS a')
					 ->join(TABLES::$ORDER_SUB_CART.' AS b',' a.session_cookie = b.session_cookie','left')
 					 ->join(TABLES::$ORDER_SUB_ITEM.' AS c','b.sub_item_id = c.sub_item_id','left')
 					 ->where($params)
 					 ->where('b.sub_item_key = c.sub_item_key')
 					 ->where('a.itemid','b.itemid',FALSE)
 					 ->group_by('b.itemid')
 					 ->group_by('b.itemset')
		 			 ->group_by('b.sub_cat_name');

		 	$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function getGlobalIdByItemId( $itemid ) {
			$params = array('id'=>$itemid);
			$this->db->select('global_id')
					 ->from(TABLES::$MENU_ITEM_TABLE)
					 ->where($params);
		
			$query = $this->db->get();
			$result = $query->result_array();
			return $result[0]['global_id'];
		}

		public function getOrderSubCart( $map) {
		 	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid']);
		 	$this->db->select('a.itemid,a.sub_item_id,a.sub_item_key,a.itemset,b.price')
		 			 ->from(TABLES::$ORDER_SUB_CART.' AS a')
		 			 ->join(TABLES::$ORDER_SUB_ITEM.' AS b','b.sub_item_id = a.sub_item_id','left')
		 			 ->where($params)
		 			 ->where('a.sub_item_key = b.sub_item_key');
		 	$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function getOrderSubCartByItemSet( $map ) {
			$params = array('session_cookie'=>$map['cart_session'],'restid'=>$map['restid']);
			$this->db->select('itemid,MAX(itemset) as items')
					->from(TABLES::$ORDER_SUB_CART)
					->where($params)
					->group_by('itemid');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}

		 /**
         * Function for checking order cart.
         *
         * @access public
         * @param integer restid
         * @return array array of multi result set
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function checkOrderCart( $restid , $cart_session) {
			 	$params = array('a.session_cookie'=>$cart_session,'a.restid'=>$restid);
			 	$this->db->select('a.itemid,a.quantity,b.name,b.price,(a.quantity * b.price) as total,(a.quantity *b.packaging) as packaging,c.name as category',FALSE)
			 			 ->from(TABLES::$ORDER_CART.' AS a')
			 			 ->join(TABLES::$MENU_ITEM_TABLE.' AS b','a.itemid = b.id','inner')
			 			 ->join(TABLES::$CATEGORY_TABLE.' AS c','b.catid = c.id','inner')
			 			 ->where($params)
			 			 ->order_by('b.name','asc')
			 			 ->order_by('c.id','asc');
			 	$query = $this->db->get();
				$result = $query->result_array();
				return $result;
		}

		  /**
         * Function for clearing order cart.
         *
         * @access public
         * @param integer restid
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function clearOrderCart( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_CART);
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}

			  /**
         * Function for clearing order cart.
         *
         * @access public
         * @param integer restid
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function clearOrderSubCart(  $map ) {
			$params = array('session_cookie'=>$map['cart_session']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}
		 /**
         * Function for getting item from order cart.
         *
         * @access public
         * @param integer restid
         * @param integer itemid
         * @return array array of single result set
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function getItemFromCart( $map ) {
		 	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid'],'a.itemid'=>$map['itemid']);
		 	$this->db->select('a.itemid,a.restid,a.quantity,b.catid,b.name,b.price,(a.quantity * b.price) as total,(a.quantity *b.packaging) as packaging,b.sub_cat', FALSE)
		 			 ->from(TABLES::$ORDER_CART.' AS a')
		 			 ->join(TABLES::$MENU_ITEM_TABLE.' AS b','a.itemid = b.id','inner')
		 			 ->where($params)->order_by('b.name','asc');
		 	$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}
		
		
		/* ************************ Order Cart ******************** */
		
		public function getOrderItemCount( $map ) {
			$params = array('session_cookie'=>$map['session_cookie']);
			$this->db->select('sum(quantity) as cart_count', FALSE)
					 ->from(TABLES::$ORDER_CART)
					 ->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function addProductToCart($map) {

			$this->db->select ( 'a.*,b.unit_price' )
					 ->from ( TABLES::$PRODUCT_PACKS.' AS a');
			$this->db->join( TABLES::$PRODUCT.' AS b','a.product_id=b.id','inner');
			$this->db->where ('a.product_id',$map['product_id']);
			$this->db->where ("a.from_date <= '".date('Y-m-d')."' AND (a.to_date >= '".date('Y-m-d')."' OR a.to_date IS NULL OR a.to_date ='0000-00-00')",'',false);
			$this->db->order_by('a.quantity','DESC');
			$query = $this->db->get ();
			$result = $query->result_array ();
			$this->db->select ( '*' )
					 ->from ( TABLES::$ORDER_CART);
			$this->db->where ('session_cookie',$map['session_cookie']);
			$query = $this->db->get ();
			$cart = $query->result_array ();
			if(count($cart) <= 0) {
				if(count($result) > 0) {
					$map['price'] = $this->getProductPriceByQuantity($result,$map['quantity'],$map['price']);
				} else {
					$map['price'] = $map['price'] * $map['quantity'];
				}
				if($map['quantity'] > 0) { 
					return $this->db->insert(TABLES::$ORDER_CART,$map);
				} else {
					return 0;
				}
			} else {
				$quantity = $map['quantity'];
				$quantity = $quantity + $cart[0]['quantity'];
				$map['quantity'] = $quantity;
				if(count($result) > 0) {
					$map['price'] = $this->getProductPriceByQuantity($result,$quantity,$map['price']);
				} else {
					$map['price'] = $map['price'] * $map['quantity'];
				}
				$this->db->where('session_cookie',$map['session_cookie']);
				$this->db->where('product_id',$map['product_id']);
				return $this->db->update(TABLES::$ORDER_CART,$map);
			}
		}
		
		public function updateProductToCart($map) {
			$this->db->select ( 'a.*,b.unit_price' )
					 ->from ( TABLES::$PRODUCT_PACKS.' AS a');
			$this->db->join( TABLES::$PRODUCT.' AS b','a.product_id=b.id','inner');
			$this->db->where ('a.product_id',$map['product_id']);
			$this->db->where ("a.from_date <= '".date('Y-m-d')."' AND (a.to_date >= '".date('Y-m-d')."' OR a.to_date IS NULL OR a.to_date ='0000-00-00')",'',false);
			$this->db->order_by('a.quantity','DESC');
			$query = $this->db->get ();
			$result = $query->result_array ();
			$this->db->select ( '*' )
			->from ( TABLES::$ORDER_CART);
			$this->db->where ('session_cookie',$map['session_cookie']);
			$query = $this->db->get ();
			$cart = $query->result_array ();
			if(count($cart) <= 0) {
				if(count($result) > 0) {
					$map['price'] = $this->getProductPriceByQuantity($result,$map['quantity'],$map['price']);
				} else {
					$map['price'] = $map['price'] * $map['quantity'];
				}
				if($map['quantity'] > 0) {
					return $this->db->insert(TABLES::$ORDER_CART,$map);
				} else {
					return 0;
				}
			} else {
				$quantity = $map['quantity'];
				if($quantity > 0) { 
					if(count($result) > 0) {
						$map['price'] = $this->getProductPriceByQuantity($result,$quantity,$map['price']);
					} else {
						$map['price'] = $map['price'] * $map['quantity'];
					}
					$this->db->where('session_cookie',$map['session_cookie']);
					$this->db->where('product_id',$map['product_id']);
					return $this->db->update(TABLES::$ORDER_CART,$map);
				} else {
					$this->db->where('session_cookie',$map['session_cookie']);
					$this->db->where('product_id',$map['product_id']);
					return $this->db->delete(TABLES::$ORDER_CART);
				}
			}
		}
		
		public function removeProductToCart($map) {
			$this->db->select ( 'a.*,b.unit_price' )
					 ->from ( TABLES::$PRODUCT_PACKS.' AS a');
			$this->db->join( TABLES::$PRODUCT.' AS b','a.product_id=b.id','inner');
			$this->db->where ('a.product_id',$map['product_id']);
			$this->db->where ("a.from_date <= '".date('Y-m-d')."' AND (a.to_date >= '".date('Y-m-d')."' OR a.to_date IS NULL OR a.to_date ='0000-00-00')",'',false);
			$this->db->order_by('a.quantity','DESC');
			$query = $this->db->get ();
			$result = $query->result_array ();
			$quantity = $map['quantity'] - 1;
			$map['quantity'] = $quantity;
			if($quantity > 0) {
				if(count($result) > 0) {
					$map['price'] = $this->getProductPriceByQuantity($result,$quantity,$map['price']);
				} else {
					$map['price'] = $map['price'] * $map['quantity'];
				}
				$this->db->where('session_cookie',$map['session_cookie']);
				$this->db->where('product_id',$map['product_id']);
				return $this->db->update(TABLES::$ORDER_CART,$map);
			} else {
				$this->db->where('session_cookie',$map['session_cookie']);
				$this->db->where('product_id',$map['product_id']);
				return $this->db->delete(TABLES::$ORDER_CART);
			}
		}
		
		public function deleteProductToCart($map) {
			$this->db->where('session_cookie',$map['session_cookie']);
			$this->db->where('product_id',$map['product_id']);
			return $this->db->delete(TABLES::$ORDER_CART);
		}
		
		public function clearProductCart($session_cookie) {
			$this->db->where('session_cookie',$session_cookie);
			$this->db->delete(TABLES::$ORDER_CART);
		}
		
		public function getProductOrderCart($map) {
			$this->db->select ( 'a.product_id,a.variant_id as option_id,a.quantity as cartquantity,b.unit_price as cartprice,(a.price) as totalprice,((b.unit_price*a.quantity) - a.price) as savings,b.*,c.image' )->from ( TABLES::$ORDER_CART.' AS a');
			$this->db->join( TABLES::$PRODUCT.' AS b','a.product_id=b.id','inner');
			$this->db->join( TABLES::$PRODUCT_IMAGE.' AS c','a.product_id=c.product_id','inner');
			$this->db->where ('a.session_cookie',$map['session_cookie']);
			$this->db->group_by('b.id');
			$query = $this->db->get ();
			return $cart = $query->result_array ();
		}
		
		public function getProductOrderCartByType($map) {
			$this->db->select ( 'a.product_id,a.variant_id as option_id,a.quantity as cartquantity,b.unit_price as cartprice,(a.price) as totalprice,((b.unit_price*a.quantity) - a.price) as savings,b.*,c.image' )->from ( TABLES::$ORDER_CART.' AS a');
			$this->db->join( TABLES::$PRODUCT.' AS b','a.product_id=b.id','inner');
			$this->db->join( TABLES::$PRODUCT_IMAGE.' AS c','a.product_id=c.product_id','inner');
			$this->db->where ('a.session_cookie',$map['session_cookie']);
			if(!empty($map['cat_id']))
			$this->db->where ('b.type',$map['cat_id']);
			$this->db->group_by('b.id');
			$query = $this->db->get ();
			return $cart = $query->result_array ();
		}
		
		
		
		public function getProductPriceByQuantity($variants,$quantity,$unit_price) {
			$price = 0;
			foreach ($variants as $variant) {
				$qty = $variant['quantity'];
				$quotient = (int)($quantity / $qty);
    			$remainder = $quantity % $qty;
    			if($quotient > 0) {
    				$price = $price + $quotient * $variant['price'];
    			}
    			$quantity = $remainder;
			}
			if($quantity > 0) {
				$price = $price + $quantity * $unit_price;
			}
			return $price;
		}
		
		public function addOrderOTP($map) {
			$params = array('session_cookie'=>$map['session_cookie']);
			$this->db->select('*')
					 ->from(TABLES::$ORDER_OTP)
					 ->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if(count($result) <= 0) {
				$this->db->insert(TABLES::$ORDER_OTP,$map);
				return 1;
			} else {
				$this->db->where('session_cookie',$map['session_cookie']);
				return $this->db->update(TABLES::$ORDER_OTP,$map);
			}
		}
		
		public function updateOrderOTP($map) {
			$this->db->where('session_cookie',$map['session_cookie']);
			return $this->db->update(TABLES::$ORDER_OTP,$map);
		}
		
		public function getOrderOTP($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'otp'=>$map['otp']);
			$this->db->select('*')
					 ->from(TABLES::$ORDER_OTP)
					 ->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function isMobileVerified($map) {
			$params = array('session_cookie'=>$map['session_cookie']);
			$this->db->select('*')
					 ->from(TABLES::$ORDER_OTP)
					 ->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if(count($result) > 0) {
				if($result[0]['is_valid'] == 1) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 0;
			}
		}
		
		public function addOrder($map) {
			$this->db->insert(TABLES::$ORDER,$map);
			return $this->db->insert_id();
		}
		
		public function updateOrder($map) {
			$this->db->where('orderid',$map['orderid']);
			return $this->db->update(TABLES::$ORDER,$map);
		}
		
		public function addOrderCustomer($map) {
			$this->db->insert(TABLES::$ORDER_CUSTOMER,$map);
		}
		
		public function addOrderGifteeDetail($map) {
			$this->db->insert(TABLES::$ORDER_GIFTEE_DETAILS,$map);
		}
		
		public function addOrderProducts($products) {
			$this->db->insert_batch(TABLES::$ORDER_ITEMS,$products);
		}
		
		public function addOrderDevices($devices) {
			$this->db->insert_batch(TABLES::$ORDER_DEVICES,$devices);
		}
		
		public function addUserDevices($devices) {
			$this->db->insert_batch(TABLES::$USER_DEVICES,$devices);
		}
		
		public function addGiftOrder($map) {
			$this->db->insert(TABLES::$GIFT_ORDER,$map);
			return $this->db->insert_id();
		}
		
		public function updateGiftOrder($map) {
			$this->db->where('giftid',$map['giftid']);
			return $this->db->update(TABLES::$GIFT_ORDER,$map);
		}
		
		public function addGiftProducts($products) {
			$this->db->insert_batch(TABLES::$GIFT_ITEMS,$products);
		}
		
		public function addGiftDevices($devices) {
			$this->db->insert_batch(TABLES::$GIFT_DEVICES,$devices);
		}
		

	}
?>