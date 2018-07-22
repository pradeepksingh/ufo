<?php
class Lead {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	
	public function addLead($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->addLead ($data);
		return $response;
	}
	public function getAllLeads() {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getAllLeads();
		return $response;
	}
	
	public function sendTicketSMS($details) {
		$sms_msg = "Hi ".$details ['name'].", We would like to acknowledge that we have received your complaint and we will get back to you shortly. Regards, The Moustache Laundry";
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	public function getUserList(){
		$this->CI->load->model ( 'lead/Lead_Model', 'lead_model'  );
		$result =$this->CI->lead_model->getUserList();
		return $result;
	}
	public function getLeadSource()
	{
		$this->CI->load->model ( 'lead/Lead_Model', 'lead_model'  );
		$result =$this->CI->lead_model->getLeadSource();
		return $result;
	}
	public function getPropertySize()
	{
		$this->CI->load->model ( 'lead/Lead_Model', 'lead_model'  );
		$result =$this->CI->lead_model->getPropertySize();
		return $result;
	}
	public function getLeadStatus()
	{
		$this->CI->load->model ( 'lead/Lead_Model', 'lead_model'  );
		$result =$this->CI->lead_model->getLeadStatus();
		return $result;
	}
	public function getLeadById($id)
	{
		$this->CI->load->model ( 'lead/Lead_Model', 'lead_model'  );
		$result =$this->CI->lead_model->getLeadById($id);
		return $result;
	}
	public function updateLead($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->updateLead($data);
		return $response;
	}
	public function addLeadStatus($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->addLeadStatus($data);
		return $response;
	}
	public function getAllLeadStatus() {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getAllLeadStatus();
		return $response;
	}
	public function getStatusById($id) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getStatusById($id);
		return $response;
	}
	public function updateStatus($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->updateStatus($data);
		return $response;
	}
	public function getUserCommentByLeadId($id) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getUserCommentByLeadId($id);
		return $response;
	}
	public function commentLead($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->commentLead($data);
		return $response;
	}
	public function updateCommentLead($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->updateCommentLead($data);
		return $response;
	}
	public function deleteCommentLead($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->deleteCommentLead($data);
		return $response;
	}
	public function addPropertySize($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->addPropertySize($data);
		return $response;
	}
	public function getPropertySizeById($id) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getPropertySizeById($id);
		return $response;
	}
	public function updatePropertySize($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->updatePropertySize($data);
		return $response;
	}
	public function getAllPropertySize() {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getAllPropertySize();
		return $response;
	}
	
	public function addSource($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->addSource($data);
		return $response;
	}
	public function getSourceById($id) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getSourceById($id);
		return $response;
	}
	public function updateSource($data) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->updateSource($data);
		return $response;
	}
	public function getAllSource() {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->getAllSource();
		return $response;
	}
	public function changeLeadStatus($status) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response = $this->CI->lead_model->changeLeadStatus($status);
		return $response;
	}
	public function leadHistory($lead_id) {
		$this->CI->load->model('lead/Lead_Model', 'lead_model' );
		$response['priorities'] = $this->CI->lead_model->leadPriorityHistory($lead_id);
		$response['leadStatus'] = $this->CI->lead_model->leadStatusHistory($lead_id);
		$response['executives'] = $this->CI->lead_model->leadExecutiveHistory($lead_id);
		return $response;
	}
	
	
	/******************************** Email *********************************/
	
	public function sendLeadAssignEmail($lead){
		$leads = $this->getLeadDetailsById($lead['id']);
		$this->CI->template->set ( 'data', $leads);
		$this->CI->template->set_theme('default_theme');
		$this->CI->template->set_layout (false);
		$html = $this->CI->template->build ('backend/emails/leadassign','',true);
		$this->CI->load->library('fbemail');
		$this->CI->fbemail->load_system_config();
		$this->CI->fbemail->headline = "Lead Assign";
		$this->CI->fbemail->subject = "A new lead assigned to you.";
		$this->CI->fbemail->mctag = '';
		$this->CI->fbemail->attachment = 0;
		$this->CI->fbemail->to = $leads['executive_email'];
		return $this->CI->fbemail->send_email( $html );
		
	}
	
	
	/* ************************************************* UFO *******************************/
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
		$this->CI->load->model ( 'ufo/UFO_Model', 'ufo_model'  );
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
	public function getAvailableUFOID() {
		$this->CI->load->model ( 'ufo/UFO_Model', 'ufo_model'  );
		$response = $this->CI->ufo_model->getAvailableUFOID();
		return $response;
	}
	
}
