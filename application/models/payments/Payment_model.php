<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * Payment Model
 *
 * <p>
 * We are using this model to add, update, delete and get payments.
 * </p>
 *
 * @package Loads
 * @author Pradeep Singh
 * @copyright Copyright &copy; 2015, FreightBazaar
 * @category CI_Model API
 */
class Payment_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	
	public function addPayment($params) {
		$this->db->select('id')->from(TABLES::$ONLINE_PAYMENT);
		$this->db->where ('orderid',$params['orderid']);
		$query = $this->db->get();
		$result = $query->result_array ();
		if(count($result) <= 0) {
			$this->db->insert( TABLES::$ONLINE_PAYMENT, $params );
		} else {
			$this->db->where ('orderid',$params['orderid']);
			$this->db->update( TABLES::$ONLINE_PAYMENT, $params );
		}
	}
	
	public function updatePayment($params) {
		$this->db->where ('ordercode',$params['ordercode']);
		$this->db->update( TABLES::$ONLINE_PAYMENT, $params );
	}
	
	public function getPaymentDetails($ordercode) {
		$this->db->select('*')->from(TABLES::$ONLINE_PAYMENT);
		$this->db->where ('ordercode',$ordercode);
		$query = $this->db->get();
		$result = $query->result_array ();
		return $result;
	}
	
}