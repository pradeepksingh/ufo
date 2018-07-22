<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class UFO_Model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	/* ****************** UFO ****************************/
	
	function addUFOID($data) {
		
		$result = array();
		$this->db->select ('*');
		$this->db->from(TABLES::$UFOID);
		$this->db->where ('ufoid', $data['ufoid'] );
		$query = $this->db->get ();
		$check = $query->result_array();
		//print_r($check);
		if(count($check) > 0 ){
			$result['status'] = 0;
			$result['msg']= 'UFOID already exist.';
		} else {
			$this->db->insert ( TABLES::$UFOID, $data);
			$result['status'] = 1;
			$result['id'] = $this->db->insert_id ();
			$result['msg'] = "Added successfully";
			
		}
		return $result;
		
	}
	public function getAllUFOID()
	{
		$this->db->select('a.*, b.first_name, b.last_name,');
		$this->db->from(TABLES::$UFOID.' as a');
		$this->db->join(TABLES::$ADMIN_USER.' as b', 'a.created_by = b.id');
		$this->db->order_by('a.created_date','DESC');		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getUFOIDById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLES::$UFOID);
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function updateUFOID($data) {
		$id = $data['id'];
		$this->db->select ('*');
		$this->db->from(TABLES::$UFOID);
		$this->db->where ('ufoid', $data['ufoid'] );
		$this->db->where ('id != ', $id, FALSE );
		$query = $this->db->get ();
		$check = $query->result_array();
		unset($data['id']);
		if(count($check) > 0 ){
			$result['status'] = 0;
			$result['msg'] = 'UFOID with same name is exist.';
			
		}else{
			$this->db->where('id', $id);
			$this->db->update ( TABLES::$UFOID, $data);
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
		}
		return $result;
	}
	public function getAvailableUFOID()
	{
		$this->db->select('*');
		$this->db->from(TABLES::$UFOID);
		$this->db->where('status','1');
		$this->db->where('is_available','1');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
}