<?php
class UFOIDLib{
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	
	public function getUFOID()
	{
		$this->CI->load->model ( 'ufo/UFO_Model', 'ufo_model'  );
		$result =$this->CI->ufo_model->getUFOID();
		return $result;
	}
	public function getUFOIDById($id)
	{
		$this->CI->load->model ( 'ufo/UFO_Model', 'ufo_model'  );
		$result =$this->CI->ufo_model->getUFOIDById($id);
		return $result;
	}
	public function updateUFOID($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->ufo_model->updateUFOID($data);
		return $response;
	}
	public function addUFOID($data) {
		$this->CI->load->model ( 'ufo/UFO_Model', 'ufo_model'  );
		$response = $this->CI->ufo_model->addUFOID($data);
		return $response;
	}
	public function getAllUFOID() {
		$this->CI->load->model ( 'ufo/UFO_Model', 'ufo_model'  );
		$response = $this->CI->ufo_model->getAllUFOID();
		return $response;
	}
}
