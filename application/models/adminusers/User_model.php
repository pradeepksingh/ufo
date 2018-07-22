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
		$this->db->insert(TABLES::$ADMIN_USER,$data);
		return $this->db->insert_id();
	}
	
	/**
	 * Update admin user
	 * 
	 * @param array $data
	 */
	public function updateUser($data){
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$ADMIN_USER,$data);
	}
	
	/**
	 * Get user detail by id
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function getUserById($id) {
		$this->db->select('*')
			 ->from(TABLES::$ADMIN_USER)
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
	public function getUserDetailByEmail($email) {
		$this->db->select('*')
		->from(TABLES::$ADMIN_USER)
		->where('email',$email);
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
		->from(TABLES::$ADMIN_USER)
		->order_by('id','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
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
		$query = $this->db->update(TABLES::$ADMIN_USER ,$data );
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
		$this->db->select ( 'id,first_name' );
		$this->db->from ( TABLES::$ADMIN_USER);
		$this->db->where ( 'id', $data['uid'] );
		$this->db->where ( 'text_password', $data['oldpassword'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	// turn on ar off user
	
	public function getActiveUsers() {
		$this->db->select('*')
				 ->from(TABLES::$ADMIN_USER)
				 ->where('status',1)
				 ->order_by('first_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addAdminUser($data){
		$result = array();
		$this->db->select ('*');
		$this->db->from(TABLES::$ADMIN_USER);
		$this->db->where ('email', $data['email'] );
		$query = $this->db->get ();
		$check = $query->result_array();
		//print_r($check);
		if(count($check) > 0 ){
			$result['status'] = 0;
			$result['msg']= 'Email Id already exist.';
		} else {
			$this->db->insert ( TABLES::$ADMIN_USER, $data);
			$result['status'] = 1;
			$result['id'] = $this->db->insert_id ();
			$result['msg'] = "Added successfully";
			
		}
		return $result;
	}
	public function updateAdminUser($data){
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$ADMIN_USER,$data);
		$result =array();
		if ($this->db->affected_rows() > 0)
		{
			$result['status'] = 1;
			$result['msg'] = 'Record updated successfully.';
			
		}
		else
		{
			$result['status'] = 0;
			$result['msg'] = 'Please try again.';
		}
		return $result;
	}
	
	
}
