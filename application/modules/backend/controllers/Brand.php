<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Brand extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper ( 'form' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->load->library ( 'zyk/BrandLib' );
		$brand = $this->brandlib->getBrand ();
		$this->template->set ( 'brand', $brand );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Brand ' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'general/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'brand/BrandList' );
	}
	
	public function newBrand() {

		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library ( 'zyk/BrandLib' );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator |Add Brand ' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'general/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'brand/AddBrand' );
	}
	
	public function addBrand() {
		$data = array ();
		if (!empty ( $_FILES ['logo'] )) {
			if ($_FILES ['logo'] != "") {
				$image_path = 'assets/images/brand/logo/';
				$temp_image = explode ( ".", $_FILES ['logo'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['logo'] = 'images/brand/logo/'.$image;
				move_uploaded_file ( $_FILES ['logo'] ['tmp_name'], $image_path . $image );
			}
		}
		if (!empty ( $_FILES ['background_image'] )) {
			if ($_FILES ['background_image'] != "") {
				$image_path = 'assets/images/brand/background_image/';
				$temp_image = explode ( ".", $_FILES ['background_image'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['background_image'] = 'images/brand/background_image/'.$image;
				move_uploaded_file ( $_FILES ['background_image'] ['tmp_name'], $image_path . $image );
			}
		}
		
		$data ['name'] = $this->input->post ( 'name' );
		$data ['brand_type'] = $this->input->post ( 'brandtype' );
		$data ['description'] = $this->input->post ( 'bdescrip' );
		$data ['title'] = $this->input->post ( 'title' );
		$temp = '';
		$i = 0;
		foreach ( $this->input->post ( 'searchlist' ) as $rest ) {
			if ($i == 0) {
				$temp = $rest;
				$i = 1;
			} else {
				$temp = $temp . ',' . $rest;
			}
		}
		$data ['is_active'] = $this->input->post ( 'active' );
		$data ['item'] = $temp;
		$this->load->library ( 'zyk/BrandLib' );
		$vendors = $this->brandlib->addBrand ( $data );
		redirect ( 'admin/brand/list' );
	}
	
	public function activeBrand() {
		$this->load->library ( 'zyk/BrandLib' );
		$vendors = $this->brandlib->activeBrand ( $this->input->get ( 'id' ) );
		$status [0] ['active'] = true;
		echo json_encode ( $status );
	}
	
	public function deactiveBrand() {
		$this->load->library ( 'zyk/BrandLib' );
		$vendors = $this->brandlib->deactiveBrand ( $this->input->get ( 'id' ) );
		$status [0] ['active'] = true;
		echo json_encode ( $status );
	}
	
	public function updateBrand($id) {
		$this->load->library ( 'zyk/BrandLib' );
		$brand = $this->brandlib->getBrandById ( $id );
        $rest = $this->brandlib->getAllRest ( '' );
        $this->template->set ( 'rest', $rest );
		$this->template->set ( 'brand', $brand );
		$this->template->set_theme ( 'default_theme' );
		$this->template->set_layout ( 'backend' )->title ( 'Administrator |Add Brand ' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'general/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'brand/UpdateBrand' );
	}
	
	public function updateSave() {
		$data = array ();
		if (!empty ( $_FILES ['logo'] )) {
			if ($_FILES ['logo'] != "") {
				$image_path = 'assets/images/brand/logo/';
				$temp_image = explode ( ".", $_FILES ['logo'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['logo'] = 'images/brand/logo/'.$image;
				move_uploaded_file ( $_FILES ['logo'] ['tmp_name'], $image_path . $image );
			}
		}
		if (!empty ( $_FILES ['background_image'] )) {
			if ($_FILES ['background_image'] != "") {
				$image_path = 'assets/images/brand/background_image/';
				$temp_image = explode ( ".", $_FILES ['background_image'] ['name'] );
				$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
				$data ['background_image'] = 'images/brand/background_image/'.$image;
				move_uploaded_file ( $_FILES ['background_image'] ['tmp_name'], $image_path . $image );
			}
		}
		$data ['id'] = $this->input->post ( 'id' );
		$data ['brand_type'] = $this->input->post ( 'brandtype' );
		$data ['name'] = $this->input->post ( 'name' );
		$data ['description'] = $this->input->post ( 'bdescrip' );
		$data ['title'] = $this->input->post ( 'title' );
		$temp = '';
		$i = 0;
		foreach ( $this->input->post ( 'searchlist' ) as $rest ) {
			if ($i == 0) {
				$temp = $rest;
				$i = 1;
			} else {
				$temp = $temp . ',' . $rest;
			}
		}
		$data ['is_active'] = $this->input->post ( 'active' );
		$data ['item'] = $temp;
		$this->load->library ( 'zyk/BrandLib' );
		$this->brandlib->updateSave ( $data );
		redirect ( 'admin/brand/list' );
	}
	
	public function getAllRest() {
		$this->load->library ( 'zyk/BrandLib' );
		if (isset ( $_GET ['item'] )) {
			$rest = $this->brandlib->getAllRest ( $_GET ['item'] );
		} else {
			$rest = $this->brandlib->getAllRest ( '' );
		}
		echo json_encode ( $rest );
	}
	
	public function getAllcusineList() {
		$this->load->library ( 'zyk/BrandLib' );
		$rest = $this->brandlib->getCuisines ( $_GET ['item'] );
		echo json_encode ( $rest );
	}
	
	public function getCityList() {
		$this->load->library ( 'zyk/BrandLib' );
		$rest = $this->brandlib->getCityList ( $_GET ['item'] );
		echo json_encode ( $rest );
	}
	
}