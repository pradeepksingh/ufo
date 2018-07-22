<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Model API for order management .
 *
 * <p>
 * We are using this model to add/update orders.
 * </p>
 * @package Orders
 * @subpackage orders-model
 * @author pradeep singh
 * @category CI_Model API
 */
class Order_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}


	public function addOrder( $map ) {
		$this->db->insert(TABLES::$ORDER,$map);
		return $this->db->insert_id();
	}
	
	public function updateOrder( $map ) {
		$this->db->where('orderid',$map['orderid']);
		return $this->db->update(TABLES::$ORDER,$map);
		//echo $this->db->last_query();
	}
	
	public function editform( $map ) {
		$this->db->where('orderid',$map['orderid']);
		return $this->db->update(TABLES::$ORDER,$map);
	}
	
	public function generateInvoice($map) {
		$this->db->insert(TABLES::$INVOICE,$map);
		return $this->db->insert_id();
	}
	
	public function updateOrderByCode( $map ) {
		$this->db->where('ordercode',$map['ordercode']);
		return $this->db->update(TABLES::$ORDER,$map);
	}
	
	public function addOrderCustomer( $map ) {
		$this->db->insert(TABLES::$ORDER_CUSTOMER,$map);
	}
	
	public function addOrderItems( $map ) {
		$this->db->insert_batch(TABLES::$ORDER_ITEM,$map);
	}
	
	public function addOrderSubItems( $map ) {
		$this->db->insert_batch(TABLES::$ORDER_SUB_ITEM,$map);
	}
	
	public function getOrderDetailById($ordercode) {
		$this->db->select('a.*,b.name,b.email,b.mobile,b.address', FALSE)
				 ->from(TABLES::$ORDER.' AS a')
				 ->join(TABLES::$ORDER_CUSTOMER.' AS b',' a.orderid = b.orderid','left');
		if(is_numeric($ordercode))
			$this->db->where('a.orderid', $ordercode);
		else 
			$this->db->where('a.ordercode', $ordercode);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function addOnlinePayment($map) {
		$this->db->insert_batch(TABLES::$ONLINE_PAYMENT,$map);
	}
	
	public function updateOnlinePayment($map) {
		$this->db->where('orderid',$map['orderid']);
		return $this->db->update(TABLES::$ONLINE_PAYMENT,$map);
	}
	
	public function getOrderItems($orderid) {
		$this->db->select('a.itemid,a.option_id,a.quantity,a.price,(a.quantity * a.price) as totalprice,(a.quantity *a.packaging_charge) as packaging,a.size,c.name', FALSE)
				 ->from(TABLES::$ORDER_ITEM.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.option_id = b.id','inner')
				 ->join(TABLES::$MENU_ITEM.' AS c','b.itemid = c.id','inner')
				 ->where('a.orderid',$orderid)
				 ->order_by('c.name','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrderItemDetails($orderid) {
		$this->db->select('a.id, a.orderid ,a.itemid,a.option_id,a.quantity,a.price, total_amount, (a.quantity *a.packaging_charge) as packaging,a.size,b.name,b.description', FALSE)
				 ->from(TABLES::$ORDER_ITEM.' AS a')
				 ->join(TABLES::$PRODUCT.' AS b','a.itemid = b.product_id','left')
				 ->where('a.orderid',$orderid)
				 ->order_by('a.itemid','asc');
		$query = $this->db->get();
		
		$result = $query->result_array();
		//echo $this->db->last_query();
		return $result;
	}
	
	public function getAllOrderSubItems($orderid) {
		$this->db->select('a.itemid,a.option_id,a.sub_item_id,a.itemset,b.option_cat_id,b.option_cat_name,b.sortorder as ocatsortorder,c.sub_item_name,a.subitem_price as price');
		$this->db->from(TABLES::$ORDER_SUB_ITEM.' AS a');
		$this->db->join(TABLES::$MENU_OPTION_CATEGORY.' AS b','a.option_id=b.id','inner');
		$this->db->join(TABLES::$MENU_OPTION.' AS c','b.new_sub_item_key=c.new_sub_item_key','inner');
		$this->db->join(TABLES::$MENU_OPTION_PRICE.' AS d','c.sub_item_id=d.sub_item_id','inner');
		$this->db->where('a.sub_item_id=c.sub_item_id','',false);
		$this->db->where('a.orderid',$orderid);
		$this->db->order_by('a.option_id','ASC');
		$this->db->order_by('a.itemset','ASC');
		$this->db->order_by('b.option_cat_id','ASC');
		$this->db->order_by('b.sortorder','ASC');
		$this->db->order_by('c.sub_item_name','ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysOrderCount() {
		$date = date('Y-m-d');
		$this->db->select('count(orderid) as orders,status', FALSE)
				 ->from(TABLES::$ORDER)
				 ->where('delivery_date',$date)
				 ->where('payment_status',1);
		$this->db->group_by('status');
		$this->db->order_by('status','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	
	public function getOrderProducts($orderid) {
		$this->db->select('a.*,b.*')
				->from(TABLES::$ORDER_ITEMS.' AS a')
				->join(TABLES::$PRODUCT.' AS b','b.id=a.product_id','inner')
				->where('a.orderid',$orderid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	
	public function getPendingOrdersByDate($date) {
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				          'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				          'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				          'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				 ->from(TABLES::$ORDER.' AS a')
				 ->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				 ->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				 ->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				 ->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				 ->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				 ->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				 ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
		         ->where('a.delivery_date',$date)
		         ->where('a.status',0)
		         ->where('a.payment_status',1);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
		public function getCompletedOrders() {
		$this->db->select('a.orderid,a.ordercode,a.total_amount,a.status,a.order_status,b.name,b.mobile,b.address,c.name as cat_name,d.name as prod_name,d.sku,
				d.price,d.manufacturer_id,e.name as vendor_name')
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$MENU_CATEGORY.' AS c','a.category_id=c.id','inner')
				->join(TABLES::$PRODUCT.' AS d','a.product_id=d.product_id','inner')
				->join(TABLES::$RESTAURANT.' AS e','a.vendor_id = e.id','left');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function updateInvoice($map) {
		$this->db->where('id',$map['id']);
		return $this->db->update(TABLES::$INVOICE,$map);
		
		// $this->db->insert(TABLES::$INVOICE,$map);
		// echo $this->db->last_query();
	}
	
	public function getOrders($orderid) {
		$this->db->select('a.orderid,a.ordercode,a.status,a.order_amount,a.delivery_charge,a.net_total,a.grand_total,a.zyk_discount,
		a.order_tax,a.service_charge,a.invoice_status,a.order_status,b.name,b.mobile,b.email,b.address,c.name as cat_name,d.name as prod_name,d.sku,
				d.price,d.manufacturer_id,e.name as vendor_name,f.id as invoice_id,f.invoice_date,f.invoice_url')
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$MENU_CATEGORY.' AS c','a.category_id=c.id','inner')
				->join(TABLES::$PRODUCT.' AS d','a.product_id=d.product_id','inner')
				->join(TABLES::$RESTAURANT.' AS e','a.vendor_id = e.id','left')
				->join(TABLES::$INVOICE.' AS f','a.orderid = f.orderid','left')
				// ->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				// ->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				// ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				// ->where('a.delivery_date',$date)
				->where('a.orderid',$orderid);
				//->where('a.payment_status',1);
		// $this->db->order_by('a.delivery_date','desc');
		// $this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getCompletedOrdersByDate() {
		$this->db->select('a.orderid,a.ordercode,a.total_amount,a.order_status,b.name,b.email,b.mobile,b.address,c.name as cat_name,d.name as prod_name,d.sku,
				d.price,d.manufacturer_id,e.name as vendor_name')
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$MENU_CATEGORY.' AS c','a.category_id=c.id','inner')
				->join(TABLES::$PRODUCT.' AS d','a.product_id=d.product_id','inner')
				->join(TABLES::$RESTAURANT.' AS e','a.vendor_id = e.id','left')
				// ->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				// ->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				// ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				// ->where('a.delivery_date',$date)
				->where('a.status',1);
				//->where('a.payment_status',1);
		// $this->db->order_by('a.delivery_date','desc');
		// $this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getCancelledOrdersByDate($date) {
		// $this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				// 'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				// 'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				// 'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				// ->from(TABLES::$ORDER.' AS a')
				// ->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				// ->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				// ->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				// ->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				// ->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				// ->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				// ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				// ->where('a.delivery_date',$date)
				// ->where('a.payment_status',1)
				// ->where('a.status',2);
		// $this->db->order_by('a.delivery_date','desc');
		// $this->db->order_by('a.delivery_time','desc');
		// $query = $this->db->get();
		// $result = $query->result_array();
		// return $result;
		
		$this->db->select('a.orderid,a.ordercode,a.status,b.name,b.email,b.mobile,b.address,c.name as cat_name,d.name as prod_name,d.sku,
				d.price,d.manufacturer_id,e.name as vendor_name')
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$MENU_CATEGORY.' AS c','a.category_id=c.id','inner')
				->join(TABLES::$PRODUCT.' AS d','a.product_id=d.product_id','inner')
				->join(TABLES::$RESTAURANT.' AS e','a.vendor_id = e.id','left')
				// ->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				// ->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				// ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				// ->where('a.delivery_date',$date)
				->where('a.status',2);
				//->where('a.payment_status',1);
		// $this->db->order_by('a.delivery_date','desc');
		// $this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getFailedPaymentOrdersByDate($date) {
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.delivery_date',$date)
				->where('a.is_online_paid',1)
				->where('a.payment_status !=',1)
				->where('a.status',2);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getPendingPaymentOrdersByDate($date) {
		$time = date('H:i:s',strtotime('-15 minutes'));
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.delivery_date >=',$date)
				->where('TIME(a.created_date) <=',$time)
				->where('a.status',0)
				->where('a.is_online_paid',1)
				->where('a.payment_status',0);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getAdvanceOrdersByDate($date) {
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.delivery_date >',$date)
				->where('a.status',0)
				->where('a.payment_status',1);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrderDetailsByOrderId($orderid) {
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,a.payment_status,a.packaging_charge,a.created_date,'.
				'a.sub_total, a.grand_total, a.order_amount, a.order_status, a.invoice_status, a.is_online_paid, a.order_tax,a.service_charge,a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,a.areaid,a.cse_id,b.name,b.email,b.mobile,b.landmark,b.special_instruction,'.
				'b.locality, b.address, b.latitude,b.longitude,b.userid, c.name as customer_name, c.mobile as customer_mobile, f.name cityname,h.first_name as cse_name ', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.userid=b.userid','left')
				->join(TABLES::$USERS.' AS c','a.userid=c.id','left')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','left')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.orderid',$orderid);
		$query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query();
		return $result;
	}
	
	public function addOrderLogs($map) {
		$this->db->insert(TABLES::$ORDER_LOGS,$map);
	}
	
	public function getOrderLogs($orderid) {
		$this->db->select('a.*,b.first_name as cse_name', FALSE)
				 ->from(TABLES::$ORDER_LOGS.' AS a')
				 ->join(TABLES::$ADMIN_USER.' AS b','a.cse_id = b.id','inner')
				 ->where('a.orderid',$orderid);
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function searchOrder($map) {
		if(empty($map['from_date']) && empty($map['to_date'])) {
			$map['from_date'] = date('Y-m-d');
			$map['to_date'] = date('Y-m-d');
		}
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left');
		if(!empty($map['from_date']) && !empty($map['to_date'])) {
			$this->db->where("DATE(a.created_date) BETWEEN '".$map['from_date']."' AND '".$map['to_date']."'",'',false);
		}
		if(!empty($map['orderid'])) {
			if(is_numeric($map['orderid'])) {
				$this->db->where('a.orderid',$map['orderid']);
			} else {
				$this->db->where('a.ordercode',$map['orderid']);
			}
		}
		if(!empty($map['mobile'])) {
			$this->db->where('b.mobile',$map['mobile']);
		}
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		//echo $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function addCancelOrderReason($map) {
		return $this->db->insert(TABLES::$ORDER_CANCEL_REASON,$map);
	}
	
	public function getOrderGatewayDetails($orderid) {
		$this->db->select('gateway', FALSE)
				 ->from(TABLES::$ONLINE_PAYMENT)
				 ->where('orderid',$orderid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getRestaurantTodaysOrders($client_id) {
		$date = date('Y-m-d');
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CLIENT_RESTAURANTS.' AS f','a.restid = f.restid','inner')
				->where('a.delivery_date',$date)
				->where('f.client_id',$client_id);
		$this->db->order_by('a.status','desc');
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function countPendingPaymentOrdersByDate($date) {
		$time = date('H:i:s',strtotime('-15 minutes'));
		$this->db->select('count(a.orderid) as pending_payments', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.delivery_date >=',$date)
				->where('TIME(a.created_date) <=',$time)
				->where('a.status',0)
				->where('a.is_online_paid',1)
				->where('a.payment_status',0);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function countPendingOrdersByDate($date) {
		$this->db->select('count(a.orderid) as pending_orders', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.delivery_date',$date)
				->where('a.status',0)
				->where('a.payment_status',1);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getDelOrdersByDate($date) {
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->where('a.delivery_date',$date)
				->where('a.is_takeaway',0)
				->where('c.delivery_type',2)
				->where('a.status IN(0,1)','',false)
				->where('a.payment_status',1);
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getRestaurantTodaysPendingOrders($restid) {
		$date = date('Y-m-d');
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->where('a.delivery_date',$date)
				->where('a.restid',$restid)
				->where("a.status",0)
				->where('a.payment_status',1);
		$this->db->order_by('a.status','desc');
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getRestaurantTodaysConfirmedOrders($restid) {
		$date = date('Y-m-d');
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->where('a.delivery_date',$date)
				->where('a.restid',$restid)
				->where("a.status",1)
				->where('a.payment_status',1);
		$this->db->order_by('a.status','desc');
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getRestaurantTodaysCancelledOrders($restid) {
		$date = date('Y-m-d');
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->where('a.delivery_date',$date)
				->where('a.restid',$restid)
				->where("a.status",2)
				->where('a.payment_status',1);
		$this->db->order_by('a.status','desc');
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function searchClientOrders($map) {
		$this->db->select('a.orderid,a.ordercode,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.status,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CLIENT_RESTAURANTS.' AS f','a.restid = f.restid','inner')
				->where('f.client_id',$map['client_id']);
		if(!empty($map['from_date']) && !empty($map['to_date'])) {
			$this->db->where("DATE(a.created_date) BETWEEN '".$map['from_date']."' AND '".$map['to_date']."'",'',false);
		}
		if(!empty($map['orderid'])) {
			if(is_numeric($map['orderid'])) {
				$this->db->where('a.orderid',$map['orderid']);
			} else {
				$this->db->where('a.ordercode',$map['orderid']);
			}
		}
		if(!empty($map['mobile'])) {
			$this->db->where('b.mobile',$map['mobile']);
		}
		if(!empty($map['restid'])) {
			$this->db->where('a.restid',$map['restid']);
		}
		
		$this->db->order_by('a.status','desc');
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function isRestaurantFirstOrder($restid) {
		$date = date('Y-m-d');
		$this->db->select('count(orderid) as orders', FALSE)
				 ->from(TABLES::$ORDER)
				 ->where('restid',$restid)
				 ->where('status',1);
		$query = $this->db->get();
		$result = $query->result_array();
		if (count($result) > 0) {
			if ($result[0]['orders'] > 0) {
				return 0;
			} else {
				return 1;
			}
		} else {
			return 1;
		}
	}
	
	public function isUserFirstOrder($userid) {
		$date = date('Y-m-d');
		$this->db->select('count(orderid) as orders', FALSE)
				 ->from(TABLES::$ORDER)
				 ->where('userid',$userid)
				 ->where('status',1);
		$query = $this->db->get();
		$result = $query->result_array();
		if (count($result) > 0) {
			if ($result[0]['orders'] > 0) {
				return 0;
			} else {
				return 1;
			}
		} else {
			return 1;
		}
	}
	
	/* **************************************** Backend Order Flow  Added By Suraj********************* */
	
	public function getProductBackendOrder() {
		$this->db->select ('*')->from ( TABLES::$PRODUCT );
		$this->db->where ('status',1);
		$this->db->where ('quantity !=','0', false);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addOrderByLead($users, $products, $orders, $addresses, $order_customer) {
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$USERS );
		$this->db->where ( 'email', $users['email'] );
		$this->db->or_where ( 'mobile', $users['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count($result) <= 0) {
			$this->db->insert(TABLES::$USERS,$users);
			$user_id = $this->db->insert_id();
		} else {
			$user_id= $result[0]['id'];
		}
		$addresses['userid'] = $user_id;
		$this->db->insert(TABLES::$USER_ADDRESS, $addresses);
		$orders['created_date'] = date('Y-m-d H:i:s');
		$orders['userid'] = $user_id;
		$this->db->insert(TABLES::$ORDER, $orders);
		$order_id = $this->db->insert_id();
		$ordercode['ordercode'] =strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($order_id, 10, 36)) ;
		$this->db->where('orderid', $order_id);
		$this->db->update(TABLES::$ORDER, $ordercode);
		if(!empty($order_customer)){
			$order_customer['userid'] = $user_id;
			$order_customer['orderid'] = $order_id;
			$this->db->insert(TABLES::$ORDER_CUSTOMER, $order_customer);
		}
		print_r($products);
		if(!empty($products)){
			foreach($products as $product){
				$product['orderid'] = $order_id;
				$this->db->insert(TABLES::$ORDER_ITEM, $product);
				$item = $this->db->insert_id();
				//return $item;
			}
			
		}
		
	}
	public function getAllOrder() {
		$this->db->select ('a.*, b.name, b.email, b.mobile');
		$this->db->from ( TABLES::$ORDER.' as a' );
		$this->db->join ( TABLES::$USER.' as b', 'a.userid=b.id', 'left');
		$this->db->where ('a.status',1);
		$this->db->order_by ('a.orderid','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}