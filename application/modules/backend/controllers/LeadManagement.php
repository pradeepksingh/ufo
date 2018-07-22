<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class LeadManagement extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/AttributeLib', 'attributelib' );
	}
	
	public function index() {
		$this->load->library('zyk/Lead', 'lead');
		$leads = $this->lead->getAllLeads();
		$this->template->set('leads',$leads);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('lead/leads-listing');
	}
	public function leadForm() {
		
		$this->load->library('zyk/Lead', 'lead');
		$executives = $this->lead->getUserList();
		$this->template->set('executives',$executives);
		$leadSource = $this->lead->getLeadSource();
		$this->template->set('leadSource',$leadSource);
		$propertySize = $this->lead->getPropertySize();
		$this->template->set('propertySize',$propertySize);
		$leadStatus = $this->lead->getLeadStatus();
		$this->template->set('leadStatus',$leadStatus);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('lead/lead-form');
	}
	public function addLead() {
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$priority = $this->input->post('priority');
		$property_type = $this->input->post('property_type');
		$property_size= $this->input->post('property_size');
		$source= $this->input->post('source');
		$message = $this->input->post('message');
		$executive_id = $this->input->post('executive_id');
		$lead_status_id = $this->input->post('lead_status_id');
		$data = array();
		$data = array(
				'name' => $name,
				'email' => $email,
				'mobile' => $mobile,
				'property_type' => $property_type,
				'property_size' => $property_size,
				'message' => $message ,
				'source' => $source,
				'executive_id' => $executive_id,
				'lead_status_id' => $lead_status_id,
				'created_by' => $admin_id,
				'priority' => $priority,
				'status' => 1
		);
		$this->load->library('zyk/Lead', 'lead');
		$response = $this->lead->addLead($data);
		if($response['id'] > 0){
			$result['status'] = '1';
			$result['msg'] = 'Lead added succesfully.';
		}else {
			$result['status'] = '0';
			$result['msg'] = 'Please try again.';
		}
		echo json_encode($result);
// 		$this->template->set_theme('default_theme');
// 		$this->template->set_layout ('backend')
// 		->title ( 'Administrator | Product' )
// 		->set_partial ( 'header', 'partials/header' )
// 		->set_partial ( 'leftnav', 'partials/sidebar' )
// 		->set_partial ( 'footer', 'partials/footer' );
// 		$this->template->build ('lead/lead-form');
	}
	
	public function editLead($id) {
		$this->load->library('zyk/Lead', 'lead');
		$leads = $this->lead->getLeadById($id);
		$this->template->set('leads',$leads);
		$executives = $this->lead->getUserList();
		$this->template->set('executives',$executives);
		$leadSource = $this->lead->getLeadSource();
		$this->template->set('leadSource',$leadSource);
		$propertySize = $this->lead->getPropertySize();
		$this->template->set('propertySize',$propertySize);
		$leadStatus = $this->lead->getLeadStatus();
		$this->template->set('leadStatus',$leadStatus);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('lead/edit-lead');
	}
	
	public function updateLead($id){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$priority = $this->input->post('priority');
		$property_type = $this->input->post('property_type');
		$property_size= $this->input->post('property_size');
		$source= $this->input->post('source');
		$message = $this->input->post('message');
		$executive_id = $this->input->post('executive_id');
		$lead_status_id = $this->input->post('lead_status_id');
		$data = array();
		$data = array(
				'id' => $id,
				'name' => $name,
				'email' => $email,
				'mobile' => $mobile,
				'property_type' => $property_type,
				'property_size' => $property_size,
				'message' => $message ,
				'source' => $source,
				'priority' => $priority,
				'executive_id' => $executive_id,
				'lead_status_id' => $lead_status_id,
				'updated_by' => $admin_id,
				'status' => 1,
		);
		$this->load->library('zyk/Lead', 'lead');
		$response = $this->lead->updateLead($data);
		echo json_encode($response);
	}
	public function viewLead($id){
		$this->load->library('zyk/Lead', 'lead');
		$leads = $this->lead->getLeadById($id);
		$this->template->set('leads',$leads);
		$comments = $this->lead->getUserCommentByLeadId($id);
		$this->template->set('comments',$comments);
		$executives = $this->lead->getUserList();
		$this->template->set('executives',$executives);
		$leadStatus = $this->lead->getLeadStatus();
		$this->template->set('leadStatus',$leadStatus);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('lead/view-lead');
	}
	public function commentLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$lead_id = $this->input->post('lead_id');
		$comment = $this->input->post('comment');
		$data = array();
		$data = array(
				'comment' => $comment,
				'lead_id' => $lead_id,
				'created_by' => $admin_id,
				'status' => 1,
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->commentLead($data);
		if($result['status']==1){
			$comments = $this->lead->getUserCommentByLeadId($lead_id);
			$this->template->set('comments',$comments);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false);
			$html= $this->template->build ('lead/pages/comment', '', true);
			echo $html;
		}
		//echo json_encode($result);
	}
	public function updateCommentLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$id = $this->input->post('id');
		$lead_id = $this->input->post('lead_id');
		$comment = $this->input->post('comment');
		$data = array();
		$data = array(
				'id' => $id,
				'comment' => $comment,
				'lead_id' => $lead_id,
				'updated_by' => $admin_id,
				'status' => 1,
				
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->updateCommentLead($data);
		if($result['status']==1){
			$comments = $this->lead->getUserCommentByLeadId($lead_id);
			$this->template->set('comments',$comments);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false);
			$html= $this->template->build ('lead/pages/comment', '', true);
			echo $html;
		}
	}
	public function deleteCommentLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$id = $this->input->post('id');
		$lead_id = $this->input->post('lead_id');
		$data = array();
		$data = array(
				'id' => $id,
				'lead_id' => $lead_id,
				'updated_by' => $admin_id,
				'status' => 0
				
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->deleteCommentLead($data);
		if($result['status']==1){
			$comments = $this->lead->getUserCommentByLeadId($lead_id);
			$this->template->set('comments',$comments);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false);
			$html= $this->template->build ('lead/pages/comment', '', true);
			echo $html;
		}
	}
	public function assignLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$user = $this->input->post('user');
		$lead_id = $this->input->post('id');
		$data = array(
				'id' => $lead_id,
				'executive_id' => $user,
				'updated_by' => $admin_id,
				
		);
		$lstatus = array(
				'lead_id' => $lead_id,
				'type' => 3,
				'changed_id' => $user,
				'created_by' => $admin_id,
				'comment'=>'Lead assigned'
		);
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->changeLeadStatus($lstatus);
		$response = $this->lead->updateLead($data);
		if($response['status']==1){
			//$this->lead->sendLeadAssignEmail($data);
		}
		echo json_encode($response);
	}
	public function changeStatusLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$status = $this->input->post('status');
		$lead_id = $this->input->post('id');
		$data = array(
				'id' => $lead_id,
				'lead_status_id' => $status,
				'updated_by' => $admin_id,
				
		);
		$lstatus = array(
				'lead_id' => $lead_id,
				'type' => 2,
				'changed_id' => $status,
				'created_by' => $admin_id,
				'comment'=>'Status changed'
		);
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->changeLeadStatus($lstatus);
		$response = $this->lead->updateLead($data);
		echo json_encode($response);
	}
	public function changePriority(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$priority= $this->input->post('priority');
		$lead_id = $this->input->post('id');
		$data = array(
				'id' => $lead_id,
				'priority' => $priority,
				'updated_by' => $admin_id,
				
		);
		$lstatus = array(
				'lead_id' => $lead_id,
				'type' => 1,
				'changed_id' => $priority,
				'created_by' => $admin_id,
				'comment'=>'Priority changed'
		);
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->changeLeadStatus($lstatus);
		$response = $this->lead->updateLead($data);
		echo json_encode($response);
	}
	
	public function leadHistory($lead_id){
		$this->load->library('zyk/Lead', 'lead');
		$leadHistory = $this->lead->leadHistory($lead_id);
		$this->template->set('leadHistory',$leadHistory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html= $this->template->build ('lead/pages/leadHistory', '', true);
		echo $html;
	}
	public function priorityHistory($lead_id){
		$this->load->library('zyk/Lead', 'lead');
		$leadHistory = $this->lead->leadHistory($lead_id);
		$this->template->set('leadHistory',$leadHistory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html= $this->template->build ('lead/pages/priority-history', '', true);
		echo $html;
	}
	public function statusHistory($lead_id){
		$this->load->library('zyk/Lead', 'lead');
		$leadHistory = $this->lead->leadHistory($lead_id);
		$this->template->set('leadHistory',$leadHistory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html= $this->template->build ('lead/pages/status-history', '', true);
		echo $html;
	}
	
	/***************************** End Lead ***********************************/
	
	/***************************** Status ***********************************/
	
	
	public function newStatus(){
		
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->getAllLeadStatus();
		$this->template->set('leadStatus',$leadStatus);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/StatusAdd');
	}
	
	public function addStatus(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$data = array();
		$data = array(
				'status_name' => $name,
				'is_active' => $status,
				'created_by' => $admin_id,
				
		);
		$this->load->library('zyk/Lead', 'lead'); 
		$result = $this->lead->addLeadStatus($data);
		echo json_encode($result);
	
	}
	public function editStatus($id){
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->getStatusById($id);
		$this->template->set('leadStatus',$leadStatus);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/StatusEdit');
		
	}
	public function updateStatus(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$data = array();
		$data = array(
				'id' => $id,
				'status_name' => $name,
				'is_active' => $status,
				'updated_by' => $admin_id,
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->updateStatus($data);
		echo json_encode($result);
		
	}
	/***************************** End Status ***********************************/
	
	
	/***************************** Admin User ***********************************/
	
	public function newAdminUser(){
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->getAllLeadStatus();
		$this->template->set('leadStatus',$leadStatus);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('employee/addUser');
	}
	public function addAdminUser() {
		$admin_id = $this->session->userdata['adminsession']['id'];
		$fname = $this->input->post('first_name');
		$lname = $this->input->post('last_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$text_password = $this->input->post('password');
		$password = md5 ($text_password);
		$role = $this->input->post('user_role');
		$status = $this->input->post('status');
		$data = array();
		$data = array(
				'first_name' => $fname,
				'last_name' => $lname,
				'email' => $email,
				'mobile' => $mobile,
				'password' => $password,
				'text_password' => $text_password,
				'user_role' => $role,
				'created_by' => $admin_id,
				'status' => $status
		);
		$this->load->library('zyk/Adminauth', 'adminauth');
		$response = $this->adminauth->addAdminUser($data);
		echo json_encode($response);
	}
	
	public function editAdminUser($id) {
		
		$this->load->library('zyk/Adminauth', 'adminauth');
		$users = $this->adminauth->getUserById($id);
		$this->template->set('users',$users);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('employee/editUser');
	}
	
	public function updateAdminUser() {
		$admin_id = $this->session->userdata['adminsession']['id'];
		$id = $this->input->post('id');
		$fname = $this->input->post('first_name');
		$lname = $this->input->post('last_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$text_password = $this->input->post('password');
		$password = md5 ($text_password);
		$role = $this->input->post('user_role');
		$status = $this->input->post('status');
		$data = array();
		$data = array(
				'id' => $id,
				'first_name' => $fname,
				'last_name' => $lname,
				'email' => $email,
				'mobile' => $mobile,
				'password' => $password,
				'text_password' => $text_password,
				'user_role' => $role,
				'created_by' => $admin_id,
				'status' => $status
		);
		$this->load->library('zyk/Adminauth', 'adminauth');
		$response = $this->adminauth->updateAdminUser($data);
		echo json_encode($response);
	}
	
	/***************************** End Admin ***********************************/
	/***************************** Property ***********************************/
	public function newPropertySize(){
		$this->load->library('zyk/Lead', 'lead');
		$propertySize = $this->lead->getAllPropertySize();
		$this->template->set('propertySize',$propertySize);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/propertySize');
	}
	
	public function addPropertySize(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$data = array();
		$data = array(
				'name' => $name,
				'status' => $status,
				'created_by' => $admin_id,
				
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->addPropertySize($data);
		echo json_encode($result);
		
	}
	public function editPropertySize($id){
		$this->load->library('zyk/Lead', 'lead');
		$propertySize= $this->lead->getPropertySizeById($id);
		$this->template->set('sizes',$propertySize);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/editPropertySize');
		
	}
	public function updatePropertySize(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$data = array();
		$data = array(
				'id' => $id,
				'name' => $name,
				'status' => $status,
				'updated_by' => $admin_id,
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->updatePropertySize($data);
		echo json_encode($result);
		
	}
	
	/***************************** End Property ***********************************/
	
	/***************************** Source ***********************************/
	public function newSource(){
		$this->load->library('zyk/Lead', 'lead');
		$sources= $this->lead->getAllSource();
		$this->template->set('sources',$sources);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/leadSource');
	}
	
	public function addSource(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$data = array();
		$data = array(
				'name' => $name,
				'status' => $status,
				'created_by' => $admin_id,
				
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->addSource($data);
		echo json_encode($result);
		
	}
	public function editSource($id){
		$this->load->library('zyk/Lead', 'lead');
		$sources = $this->lead->getSourceById($id);
		$this->template->set('sources',$sources);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/editLeadSource');
		
	}
	public function updateSource(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$data = array();
		$data = array(
				'id' => $id,
				'name' => $name,
				'status' => $status,
				'updated_by' => $admin_id,
		);
		$this->load->library('zyk/Lead', 'lead');
		$result = $this->lead->updateSource($data);
		echo json_encode($result);
		
	}
	
	/***************************** End Source ***********************************/
	/******************************  API CALLS *********************************/
	public function apicall(){
		$ch = curl_init();
		$weburl = "http://52.66.115.89/api";
		$map = array();
		$map['email'] = 'kundan926@gmail.com';
		$map['mobile_number'] = '+919561495057';
		$map['password'] = 'Phynart1@';
		$map['messaging_token'] = 'xyz';
		$map['type'] = 'Authenticate';
		$map['client_type'] = 'user';
		$map['application_type'] = 'android';
		//$map['reqid'] = 1;
		//$map['route_id'] = 'Transactional';
		//$map['sendondate'] = date('d-m-YTH:i:s');
		$postdata = http_build_query($map);
		$weburl= $weburl."?".$postdata;
		echo $weburl;
		curl_setopt($ch,CURLOPT_URL,  $weburl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$buffer = curl_exec($ch);
		var_dump($buffer);
		// 				if(empty ($buffer))
			// 				{ return false; }
		// 				else
			// 				{
			// 					return true; }
				curl_close($ch);
				print_r($buffer);
				//echo $buffer;
			}
}