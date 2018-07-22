<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Quotation API
 *
 * <p>
 * We are using this model to add, update, delete and get quotes.
 * </p>
 *
 * @package Quotes
 * @author Pradeep Singh
 * @copyright Copyright &copy; 2015, FreightBazaar
 * @category CI_Model API
*/
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Add admin user
	 * 
	 * @param array $data
	 * @return inetger id
	 */
	public function addUser($data) {
		$this->db->insert(TABLES::$CLIENT_USER,$data);
		return $this->db->insert_id();
	}
	
	/**
	 * Update admin user
	 * 
	 * @param array $data
	 */
	public function updateUser($data){
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$CLIENT_USER,$data);
	}
	
	/**
	 * Get user detail by id
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function getUserById($id) {
		$this->db->select('*')
			 ->from(TABLES::$CLIENT_USER)
		     ->where('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * Get user detail by email
	 * 
	 * @param string $email
	 * @return array
	 */
	public function getUserDetailByUsername($uname) {
		$this->db->select('*')
				 ->from(TABLES::$CLIENT_USER)
				 ->where('username',$uname);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * Get all admin users
	 * 
	 * @return array
	 */
	public function getUsers() {
		$this->db->select('*')
				 ->from(TABLES::$CLIENT_USER)
				 ->order_by('id','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getClients() {
		$this->db->select('*')
				 ->from(TABLES::$CLIENT_USER);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getClientRestaurants($client_id) {
		$this->db->select('a.*,b.name as restname,c.name as areaname')
				 ->from(TABLES::$CLIENT_RESTAURANTS.' AS a')
				 ->join(TABLES::$RESTAURANT.' AS b','a.restid=b.id','inner')
				 ->join(TABLES::$AREA.' AS c','b.areaid=c.id','inner')
				 ->where('a.id',$client_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addClientRestaurant($data) {
		$this->db->insert_batch(TABLES::$CLIENT_RESTAURANTS,$data);
	}
	
	public function deleteClientRestaurant($client_id) {
		$this->db->where('client_id',$client_id);
		$this->db->delete(TABLES::$CLIENT_RESTAURANTS);
	}
	
	/**
	 * edit password
	 *
	 * @return array
	 */
	public function editPassword($data)
	{
		$oldpassword = $data['oldpassword'];
		unset($data['oldpassword']);
		$this->db->where ( 'id', $data['uid'] );
		$this->db->where ( 'text_password', $oldpassword );
		unset($data['uid']);
		$query = $this->db->update(TABLES::$CLIENT_USER ,$data );
		//echo $this->db->last_query();
		if($query)
			return 1;
		else
			return 0;
	}
	
	/**
	 * fetch password
	 *
	 * @return array
	 */
	public function checkPassword($data)
	{
		//print_r($data);
		$this->db->select ( 'id,username' );
		$this->db->from ( TABLES::$CLIENT_USER);
		$this->db->where ( 'id', $data['uid'] );
		$this->db->where ( 'text_password', $data['oldpassword'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}
