<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Banner extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function zoneList ()
	{
		$this->load->library('zyk/BannerLib');
		$zones = $this->bannerlib->getAllZones();
		$this->template->set('zones',$zones);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/zoneList');
	}
	
	public function assignZoneAreas ()
	{
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Assign Area' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/assignZoneAreas');
	}
	public function bannerList ()
	{
		$this->load->library('zyk/BannerLib');
	
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		
		$banner = $this->bannerlib->getBannerDetail ();
		$this->template->set('banner',$banner);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/bannerList');
	}
	public function promotedBannerList()
	{
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->promotedBannerList ();
		$this->template->set('banner',$banner);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/promotedBannerList');
	}
	public function searchBanner()
	{
		$this->load->library('zyk/BannerLib');
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$banner = $this->bannerlib->searchBanner ($this->input->post('rest_id'));
		$this->template->set('banner',$banner);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/bannerList');
	}
	public function searchPromotedBanner()
	{   
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->load->library('zyk/BannerLib');
		$params = array();
		$params['zone_id'] = $this->input->post('zone_id');
		$params['status'] = $this->input->post('status');
		$banner = $this->bannerlib->searchPromotedBanner ($params);
		$this->template->set('banner',$banner);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/promotedBannerList');
	}
	public function promoteBanner ()
	{
	
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->getRestFromBanner();
		//$banner = $this->bannerib->getBanner();
		//$this->template->set('banner',$banner);
		$this->template->set('rest',$rest);
		$zones = $this->bannerlib->getZones();
		$this->template->set('zones',$zones);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator |Promote Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/promoteBanner');
	}
	
	
	public function addPromoteBanner ()
	{
		$data = array();
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->getBannerByRestaurant ($this->input->get('rest'));
		$data['rest_id'] = $this->input->get('rest');
		$data['priority'] = $this->input->get('priority');
		$data['banner_id'] = $banner[0]['id'];
		$data['zone_id'] = $this->input->get('zone_id');
		$data['status'] = $this->input->get('status');
		$data['start_date'] = date('Y-m-d',strtotime($this->input->get('start_date')));
		$data['end_date'] = date('Y-m-d',strtotime($this->input->get('end_date')));
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->addPromoteBanner ($data);
		redirect('admin/banner/promotebanner');
	}
	
	public function newBanner ()
	{
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator |Add Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/addBanner');
	}
	public function addBanner ()
	{
		$config ['upload_path'] = 'assets/images/restaurant/logo/';
		$config ['allowed_types'] = 'jpg|png';
		$config ['max_size'] = '500';
		$data = array();
		$data['rest_id'] = $this->input->post('restid');
		$data['description'] =  $this->input->post('description');
		$this->load->library ( 'upload', $config );
		
		if ($_FILES ['avatar'] ['name'] != '') {
			$image_path = 'assets/images/banner/';
			$temp_image = explode ( ".", $_FILES ['avatar'] ['name'] );
			$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
			$data ['avatar'] = 'images/banner/'.$image;
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $image_path . $image );
		}
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->addBanner ($data);
		redirect('admin/banner/bannerlist');
		
		
	}
	
	public function editBanner ($id) {
		$this->load->library('zyk/General');
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->getBannerById ($id);
		$cities = $this->general->getCities();
		$rest = $this->bannerlib->getRestByCityId($banner[0]['cityid']);
		$this->template->set('cities',$cities);
		$this->template->set('banner',$banner[0]);
		$this->template->set('rests',$rest);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator |Edit Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/EditBanner');
	}
	
	public function updateBanner ()
	{
		$config ['upload_path'] = 'assets/images/restaurant/logo/';
		$config ['allowed_types'] = 'jpg|png';
		$config ['max_size'] = '500';
		$data = array();
		$data['id'] = $this->input->post('id');
		$data['rest_id'] = $this->input->post('restid');
		$data['description'] =  $this->input->post('description');
		$this->load->library ( 'upload', $config );
	
		if ($_FILES ['avatar'] ['name'] != '') {
			$image_path = 'assets/images/banner/';
			$temp_image = explode ( ".", $_FILES ['avatar'] ['name'] );
			$image = 'image_' . round ( microtime ( true ) ) . '.' . end ( $temp_image );
			$data ['avatar'] = 'images/banner/'.$image;
			move_uploaded_file ( $_FILES ['avatar'] ['tmp_name'], $image_path . $image );
		}
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->updateBanner ($data);
		redirect('admin/banner/bannerlist');
	
	
	}
	
	public function newZone ()
	{
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator |Add Zone' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/addZone');
	}
	public function addZone ()
	{
		$data=array();
		$data['city_id'] = $this->input->get('cityid');
		$data['name'] = $this->input->get('name');
		$data['status'] = $this->input->get('status');
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->addZone ($data);
		
	}
	
	public function editZone ($id)
	{
		$this->load->library('zyk/General');
		$this->load->library('zyk/BannerLib');
		$cities = $this->general->getCities();
		$zones = $this->bannerlib->getZoneById ($id);
		$this->template->set('cities',$cities);
		$this->template->set('zone',$zones[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator |Edit Zone' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/EditZone');
	}
	
	public function updateZone ()
	{
		$data = array();
		$data['id'] = $this->input->get('id');
		$data['city_id'] = $this->input->get('cityid');
		$data['name'] = $this->input->get('name');
		$data['status'] = $this->input->get('status');
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->updateZone ($data);
	
	}
	
	public function getZoneByCityId ()
	{
		$this->load->library('zyk/BannerLib');
		$zone = $this->bannerlib->getZoneByCityId($this->input->get('cityid'));
		echo json_encode($zone);
	}
	public function getAreaNotInZone ()
	{
		$data = array();
		$data["city_id"] = $this->input->get('cityid');
		$data["zone_id"] = $this->input->get('zoneid');
		$this->load->library('zyk/BannerLib');
		$area = $this->bannerlib->getAreaNotInZone($data);
		echo json_encode($area);
		
	}
	public function addAssignZoneArea ()
	{
		$data = array();
		$i=0;
		foreach ($this->input->post('areas[]') as $item)
		{
			$data[$i]['zone_id'] = $this->input->post('zoneid');
			$data[$i]['id'] = $item;
			$i++;
		}
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->addAssignZoneArea($data);
		redirect('admin/banner/zonelist');
	}
	public function getRestByCityId ()
	{
		
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->getRestByCityId($this->input->get('cityid'));
		echo json_encode($rest);
	}
	public function getRestFromBanner ()
	{
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->getRestFromBanner($this->input->get('cityid'));
		echo json_encode($rest);
	}
	public function turnOnZone ($id)
	{
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->turnOnZone($id);
	}
	public function turnOfZone ($id)
	{
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->turnOfZone($id);
	}
	public function turnOnBanner ($id)
	{
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->turnOnBanner($id);
	}
	public function turnOfBanner ($id)
	{
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->turnOfBanner($id);
	}
	public function editPromotedBanner ($id)
	{
		$this->load->library('zyk/BannerLib');
		$rest = $this->bannerlib->getRestFromBanner();
		$banner = $this->bannerlib->getPromotedBannerById($id);
		$this->template->set('rest',$rest);
		$zones = $this->bannerlib->getZones();
		$this->template->set('zones',$zones);
		
		$this->template->set('banner',$banner);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator |Promote Banner' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'banner/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('banner/editPromotedBanner');
		
	}
	public function	updatePromotedBanner()
	{
		$data = array();
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->getBannerByRestaurant ($this->input->get('rest'));
		$data['id'] = $this->input->get('id');
		$data['rest_id'] = $this->input->get('rest');
		$data['priority'] = $this->input->get('priority');
		$data['banner_id'] = $banner[0]['id'];
		$data['zone_id'] = $this->input->get('zone_id');
		$data['status'] = $this->input->get('status');
		$data['start_date'] = date('Y-m-d',strtotime($this->input->get('start_date')));
		$data['end_date'] = date('Y-m-d',strtotime($this->input->get('end_date')));
		$this->load->library('zyk/BannerLib');
		$this->bannerlib->updatePromotedBanner ($data);
		//print_r($data);
		redirect('admin/banner/promotebanner');
	}
	public function getPromotedBannerDetailByRest ($rest_id)
	{
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->getPromotedBannerDetailByRest($rest_id);
		echo json_encode($banner);
	}
	
	public function deletAreaFromZone($area_id)
	{
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->deletAreaFromZone($area_id);
	}
	public function showBanner()
	{
		$this->load->library('zyk/BannerLib');
		$banner = $this->bannerlib->showBanner();
		if(count($banner)>0)
		{
			$i=0;
			foreach ($banner as $item)
			{
			$cityname =   preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$item['city'])));
			$localityname = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$item['locality'])));
			$restname = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$item['rest_name'])));
			
			$banner[$i]['url'] = base_url().$cityname."/".$localityname."/".$restname."-".$item['rid'];
			$i++;
			}
		}
		//print_r($banner);
		echo json_encode($banner);
	}
}