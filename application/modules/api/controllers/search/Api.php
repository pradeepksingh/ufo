<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	public function search_post() 
	{
		$data = array();
		$data['latitude'] = $this->post('latitude');
		$data['longitude'] = $this->post('longitude');
		if(!empty($data['latitude']) && !empty($data['longitude'])) {
			$this->load->library('zyk/SearchLib');
			$restaurants = $this->searchlib->searchRestaurants($data);
			$restids = "";
			foreach ($restaurants as $rest) {
				if ($restids == "") {
					$restids = $rest['id'];
				} else {
					$restids = $restids.','.$rest['id'];
				}
			}
			if($restids != "")
				$area_cuisines = $this->searchlib->getRestaurantsCuisinesByIds($restids);
			else
				$area_cuisines = array();
			if(count($restaurants) > 0) {
				$this->load->library('zyk/general');
				$area = $this->general->getAreasById($restaurants[0]['areaid']);
				if(count($area) > 0) {
					$this->load->library('zyk/BannerLib');
					$sponsered = $this->bannerlib->getBannerByZone($area[0]['zone_id']);
				} else {
					$sponsered = array();
				}
			} else {
				$sponsered = array();
			}
			$response = array();
			$response['status'] = 1;
			$response['restaurants'] = $restaurants;
			$response['cuisines'] = $area_cuisines;
			$response['sponsored'] = $sponsered;
		} else {
			$response = array();
			$response['status'] = 0;
			$response['message'] = 'Latitude and longitude required.';
		}
		$this->response ( $response,200);
	}
	
	public function filter_post()
	{
		$map = array();
		$map['latitude'] = $this->post('latitude');
		$map['longitude'] = $this->post('longitude');
		if(!empty($map['latitude']) && !empty($map['longitude'])) {
			$this->load->library('zyk/SearchLib');
			$map['cuisines'] = $this->post('cuisines');
			$map['mainfilter'] = $this->post('mainfilter');
			if(!empty($this->post('minOrderValue')))
				$map['minFee'] = $this->post('minOrderValue');
			else 
				$map['minFee'] = 0;
			if(!empty($this->post('maxOrderValue')))
				$map['maxFee'] = $this->post('maxOrderValue');
			if(!empty($this->post('veg')))
				$map['veg'] = $this->post('veg');
			if(!empty($this->post('mov')))
				$map['mov'] = $this->input->post('mov');
			if(!empty($this->post('online')))
				$map['online'] = $this->post('online');
			if(!empty($this->post('offers')))
				$map['offers'] = $this->post('offers');
			$restaurants = $this->searchlib->searchRestaurants($map);
			$response = array();
			$response['status'] = 1;
			$response['restaurants'] = $restaurants;
		} else {
			$response = array();
			$response['status'] = 0;
			$response['message'] = 'Latitude and longitude required.';
		}
		$this->response ( $response,200);
	}
	
	public function bannerads_get() {
		$zone_id = $this->get('zone_id');
		if(!empty($zone_id)) {
			$this->load->library('zyk/BannerLib');
			$banner = $this->bannerlib->getBannerByZone($zone_id);
			$response = array();
			$response['status'] = 1;
			$response['banners'] = $banner;
		} else {
			$response = array();
			$response['status'] = 0;
			$response['message'] = 'Zone Id is required.';
		}
		$this->response ( $response,200);
	}
	
	public function restaurant_get() {
		$this->load->library('zyk/SearchLib');
		$map = array();
		$map['restid'] = $this->get('restid');
		$map['latitude'] = $this->get('latitude');
		$map['longitude'] = $this->get('longitude');
		$restaurant = $this->searchlib->getRestaurantDetails($map);
		unset($restaurant[0]['fence']);
		unset($restaurant[0]['Old_id']);
		$this->response ( $restaurant[0],200);
	}
	
	public function searchclient_post()
	{
		$data = array();
		$data['client_id'] = $this->post('client_id');
		$data['latitude'] = $this->post('latitude');
		$data['longitude'] = $this->post('longitude');
		if(!empty($data['latitude']) && !empty($data['longitude'])) {
			$this->load->library('zyk/SearchLib');
			$restaurants = $this->searchlib->searchClientRestaurants($data);
			if(count($restaurants) > 0) {
				$response = array();
				$response['status'] = 1;
				$response['restaurants'] = $restaurants;
			} else {
				$response = array();
				$response['status'] = 0;
				$response['message'] = 'Sorry we do not deliver to your location.';
			}
		} else {
			$response = array();
			$response['status'] = 0;
			$response['message'] = 'Latitude and longitude required.';
		}
		$this->response ( $response,200);
	}
	
}