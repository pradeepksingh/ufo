
<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Job extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index()
	{
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->getAllJob();
		$this->template->set('job',$jobs);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job/joblisting');
	}
	public function candidate($jobid)
	{
		
		$this->load->library('zyk/JobLib');
		$condidate = $this->joblib->getCondidateByJobId($jobid);
		$this->template->set('condidate',$condidate);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job/condidatelisting');
	}
	public function newJob()
	{
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->getAllJob();
		$this->template->set('job',$jobs);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job/newJob');
	}
	public function addJob()
	{
		$data = array();
		$data['position'] = $this->input->post('position');
		$data['heading'] = $this->input->post('heading');
		$data['description'] = $this->input->post('description');
		$data['exprience'] = $this->input->post('exprience');
		$data['status'] = $this->input->post('status');
		//print_r($data);
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->addJob($data);
		redirect('admin/job');
	}
	public function editJob($jobid)
	{
		
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->getJobById($jobid);
		$this->template->set('job',$jobs);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job/editjob');
	}
	public function updateJob()
	{
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['position'] = $this->input->post('position');
		$data['heading'] = $this->input->post('heading');
		$data['description'] = $this->input->post('description');
		$data['exprience'] = $this->input->post('exprience');
		$data['status'] = $this->input->post('status');
		//print_r($data);
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->updateJob($data);
		redirect('admin/job');
	}
	public function turnOnJob($jobid)
	{
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->turnOnJob($jobid);
	}
	public function turnOfJob($jobid)
	{
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->turnOfJob($jobid);
	}
	public function deleteJob( $jobid)
	{
		$this->load->library('zyk/JobLib');
		$jobs = $this->joblib->deleteJob($jobid);
	}
	public function apply()
	{
		$data =array();
		$data['name'] = $this->input->post('name');
		$data['position'] = $this->input->post('position');
		$data['jobid'] = $this->input->post('jobid');
		$data['emailid'] = $this->input->post('emailid');
		$data['message'] = $this->input->post('message');
		
		
		$config ['max_size'] = '400';
		$this->load->library ( 'upload', $config );
		if (isset ( $_FILES ['resume'] )) {
			if ($_FILES ['resume'] != "") {
				$image_path = 'assets/images/resume/';
				$temp_image = explode ( ".", $_FILES ['resume'] ['name'] );
				$image = 'resume_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['resume'] = 'images/resume/'.$image;
				move_uploaded_file ( $_FILES ['resume'] ['tmp_name'], $image_path .$image );
			}
		} else {
			$data ['resume'] = '';
		}
		$data['date'] = Date("Y/m/d");
		$this->load->library('zyk/JobLib');
		
		$jobs = $this->joblib->apply($data);
		echo true;
		
	}
	
}