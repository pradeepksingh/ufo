<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Lead_Model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function addLead($lead) {

		$this->db->insert ( TABLES::$LEAD, $lead);
		$data ['status'] = 1;
		$data ['id'] = $this->db->insert_id ();
		$data ['msg'] = "Added successfully";
		return $data;
		
	}
	function updateLead($data) {
		$this->db->where('id', $data['id']);
		$this->db->update ( TABLES::$LEAD, $data);
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
	function getAllLeads() {
		$this->db->select('a.*, b.name as source, b.id as source_id, c.status_name as lead_status, c.id as lead_status_id, d.first_name, d.last_name, d.id as executive_id, e.name as size, e.id as property_size_id');
		$this->db->from(TABLES::$LEAD.' as a');
		$this->db->join(TABLES::$LEAD_SOURCE.' as b', 'a.source = b.id', 'left');
		$this->db->join(TABLES::$LEAD_STATUS.' as c', 'a.lead_status_id = c.id', 'left');
		$this->db->join(TABLES::$ADMIN_USER.' as d', 'a.executive_id = d.id', 'left');
		$this->db->join(TABLES::$PROPERTY_SIZE.' as e', 'a.property_size = e.id', 'left');
		$this->db->where('a.status', 1);
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getUserList()
	{
		
		$this->db->select('*')
		->from(TABLES::$ADMIN_USER);
		//$this->db->where('user_role', '2');
		$this->db->where('status', '1');
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		//print_r($result);
		//exit;
		return $result;
	}
	public function getLeadSource()
	{
		$this->db->select('*')
		->from(TABLES::$LEAD_SOURCE);
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		//print_r($result);
		//exit;
		return $result;
	}
	public function getPropertySize()
	{
		$this->db->select('*')
		->from(TABLES::$PROPERTY_SIZE);
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		//print_r($result);
		//exit;
		return $result;
	}
	public function getLeadStatus()
	{
		$this->db->select('*')
		->from(TABLES::$LEAD_STATUS);
		$this->db->where('is_active', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		//print_r($result);
		//exit;
		return $result;
	}
	function getLeadById($id) {
		$this->db->select('a.*, b.name as source, b.id as source_id, c.status_name as lead_status, c.id as lead_status_id, d.first_name, d.last_name, d.id as executive_id , d.email as executive_email, e.name as size, e.id as property_size_id');
		$this->db->from(TABLES::$LEAD.' as a');
		$this->db->join(TABLES::$LEAD_SOURCE.' as b', 'a.source = b.id', 'left');
		$this->db->join(TABLES::$LEAD_STATUS.' as c', 'a.lead_status_id = c.id', 'left');
		$this->db->join(TABLES::$ADMIN_USER.' as d', 'a.executive_id = d.id', 'left');
		$this->db->join(TABLES::$PROPERTY_SIZE.' as e', 'a.property_size = e.id', 'left');
		$this->db->where('a.id', $id);
		$this->db->where('a.status', 1);
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	/* ****************** Status ****************************/
	
	function addLeadStatus($status) {
		
		$this->db->insert ( TABLES::$LEAD_STATUS, $status);
		$data ['status'] = 1;
		$data ['id'] = $this->db->insert_id ();
		$data ['msg'] = "Added successfully";
		return $data;
		
	}
	public function getAllLeadStatus()
	{
		$this->db->select('a.*, b.first_name, b.last_name,');
		$this->db->from(TABLES::$LEAD_STATUS.' as a');
		$this->db->join(TABLES::$ADMIN_USER.' as b', 'a.created_by = b.id');
		$this->db->order_by('a.created_date');		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getStatusById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLES::$LEAD_STATUS);
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function updateStatus($data) {
		$this->db->where('id', $data['id']);
		$this->db->update ( TABLES::$LEAD_STATUS, $data);
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
	/************************************  Comment **************************************/
	public function getUserCommentByLeadId($id)
	{
		$this->db->select('a.*, b.first_name, b.last_name, b.email, b.user_role');
		$this->db->from(TABLES::$LEAD_COMMENT.' as a');
		$this->db->join(TABLES::$ADMIN_USER.' as b', 'a.created_by = b.id', 'left');
		$this->db->where('a.lead_id', $id);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.id', 'ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function commentLead($data) {
		
		$this->db->insert ( TABLES::$LEAD_COMMENT, $data);
		$data ['status'] = 1;
		$data ['id'] = $this->db->insert_id ();
		$data ['msg'] = "Added successfully";
		return $data;
		
	}
	function updateCommentLead($data) {
		$this->db->where('id', $data['id']);
		$this->db->update ( TABLES::$LEAD_COMMENT, $data);
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
	function deleteCommentLead($data) {
		$this->db->where('id', $data['id']);
		$this->db->update ( TABLES::$LEAD_COMMENT, $data);
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
	
	/************************************* Property ************************************/
	
	function addPropertySize($status) {
		
		$this->db->insert ( TABLES::$PROPERTY_SIZE, $status);
		$data ['status'] = 1;
		$data ['id'] = $this->db->insert_id ();
		$data ['msg'] = "Added successfully";
		return $data;
		
	}
	public function getAllPropertySize()
	{
		$this->db->select('a.*, b.first_name, b.last_name,');
		$this->db->from(TABLES::$PROPERTY_SIZE.' as a');
		$this->db->join(TABLES::$ADMIN_USER.' as b', 'a.created_by = b.id');
		$this->db->order_by('a.id');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getPropertySizeById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLES::$PROPERTY_SIZE);
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function updatePropertySize($data) {
		$this->db->where('id', $data['id']);
		$this->db->update ( TABLES::$PROPERTY_SIZE, $data);
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
	
	/************************************* Sources ************************************/
	
	function addSource($status) {
		
		$this->db->insert ( TABLES::$LEAD_SOURCE, $status);
		$data ['status'] = 1;
		$data ['id'] = $this->db->insert_id ();
		$data ['msg'] = "Added successfully";
		return $data;
		
	}
	public function getAllSource()
	{
		$this->db->select('a.*, b.first_name, b.last_name,');
		$this->db->from(TABLES::$LEAD_SOURCE.' as a');
		$this->db->join(TABLES::$ADMIN_USER.' as b', 'a.created_by = b.id');
		$this->db->order_by('a.id', 'ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getSourceById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLES::$LEAD_SOURCE);
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function updateSource($data) {
		$this->db->where('id', $data['id']);
		$this->db->update ( TABLES::$LEAD_SOURCE, $data);
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
	
	public function changeLeadStatus($status)
		{
			$this->db->insert ( TABLES::$LEAD_STATUS_HISTORY, $status);
			$data ['status'] = 1;
			$data ['id'] = $this->db->insert_id ();
			$data ['msg'] = "Added successfully";
			//return $data;
		}
	public function leadPriorityHistory($lead_id)
		{
			$this->db->select('a.*, b.first_name, b.last_name, b.email, b.mobile');
			$this->db->from(TABLES::$LEAD_STATUS_HISTORY.' as a');
			$this->db->join(TABLES::$ADMIN_USER.' as b',' a.created_by= b.id', 'left');
			$this->db->where('a.lead_id', $lead_id);
			$this->db->where('a.type', 1);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
	public function leadStatusHistory($lead_id)
		{
			$this->db->select('a.*, b.first_name, b.last_name, b.email, b.mobile, c.status_name ');
			$this->db->from(TABLES::$LEAD_STATUS_HISTORY.' as a');
			$this->db->join(TABLES::$ADMIN_USER.' as b',' a.created_by= b.id', 'left');
			$this->db->join(TABLES::$LEAD_STATUS.' as c',' a.changed_id= c.id', 'left');
			$this->db->where('a.lead_id', $lead_id);
			$this->db->where('a.type', 2);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
	public function leadExecutiveHistory($lead_id)
		{
			$this->db->select('a.*, b.first_name, b.last_name, b.email, b.mobile, c.first_name as executive_fname, c.last_name as executive_lname, c.email as executive_email, c.mobile as executive_mobile');
			$this->db->from(TABLES::$LEAD_STATUS_HISTORY.' as a');
			$this->db->join(TABLES::$ADMIN_USER.' as b',' a.created_by= b.id', 'left');
			$this->db->join(TABLES::$ADMIN_USER.' as c',' a.changed_id= c.id', 'left');
			$this->db->where('a.lead_id', $lead_id);
			$this->db->where('a.type', 2);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
}