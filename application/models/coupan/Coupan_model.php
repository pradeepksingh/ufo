<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Coupan_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function getAllCoupons() {
		$this->db->select ( '*' )->from ( TABLES::$COUPON)
		->order_by ( 'start_date', 'DESC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCouponById($id) {
		$this->db->select ( '*' )->from ( TABLES::$COUPON )
		->where('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addCoupon($coupon) {
		$this->db->insert(TABLES::$COUPON,$coupon);
		return $this->db->insert_id();
	}
	
	public function updateCoupon($coupon) {
		$this->db->where('id',$coupon['id']);
		return $this->db->update(TABLES::$COUPON,$coupon);
	}
	
	public function statusoffcoupon($coupon_code) {
		$coupon = array ();
		$coupon ['status'] = 1;
		$this->db->where ( 'coupon_code', $coupon_code );
		$this->db->update ( TABLES::$COUPON, $coupon );
	}
	
	public function statusoncoupon($coupon_code) {
		$coupon = array ();
		$coupon ['status'] = 0;
		$this->db->where ( 'coupon_code', $coupon_code );
		$this->db->update ( TABLES::$COUPON, $coupon );
	}
	
	public function getCouponDetailByCode($coupon_code, $date) {
		$this->db->select ( 'a.*' )->from ( TABLES::$COUPON . ' AS a' );
		$this->db->where ( 'a.coupon_code', $coupon_code );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( "'" . $date . "' BETWEEN a.start_date AND a.end_date", "", false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getOrdersByCouponCode($map) {
		if(!empty($map['userid'])) {
			$this->db->select('a.orderid', FALSE)
					 ->from(TABLES::$ORDER.' AS a')
					 ->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid')
					 ->where('a.coupon_code',$map['coupon_code'])
					 ->where("a.userid",$map['userid'])
					 ->where('a.status IN(0,1)','',false);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		} else {
			return array();
		}
	}
	
	public function getUserOrders($map) {
		if(!empty($map['userid'])) {
			$this->db->select('a.orderid', FALSE)
					 ->from(TABLES::$ORDER.' AS a')
					 ->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid')
					 ->where("a.userid",$map['userid'])
					 ->where('a.status',1);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		} else {
			return array();
		}
	}
	
	
	
}