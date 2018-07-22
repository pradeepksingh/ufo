<?php
class CoupanLib {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	public function getAllRestaurant() {
		$this->CI->load->model ( 'general/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getRestaurant ();
		return $areas;
	}
	public function getCouponsByVendorId($a) {
		$this->CI->load->model ( 'general/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getCouponsByVendorsId ( $a );
		return $areas;
	}
	public function getDiscountByVendorId($a) {
		$this->CI->load->model ( 'general/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getDiscountByVendorId ( $a );
		return $areas;
	}
	public function getVendorsById($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$restaurants = $this->CI->coupan->getVendorsById ( $a );
		return $restaurants;
	}
	public function getRastByAreaId($cityid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getRastByAreaId ( $cityid );
		return $areas;
	}
	public function getRestaurant() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$restaurants = $this->CI->coupan->getRestaurant ();
		return $restaurants;
	}
	public function addVendor($aa) {
		// echo $aa['to_time'];
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$this->CI->coupan->addVendor ( $aa );
	}
	public function getVendors() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$vendors = $this->CI->coupan->getVendors ();
		
		return $vendors;
	}
	public function getAllCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$vendors = $this->CI->coupan->getAllCoupons ();
		
		return $vendors;
	}
	
	public function updateCoupon($data) {
		$this->CI->load->model ('coupan/Coupan_model', 'coupan' );
		$response = $this->CI->coupan->updateCoupon ($data);
		return $response;
	}
	
	public function getCouponById($id) {
		$this->CI->load->model ('coupan/Coupan_model', 'coupan' );
		$response = $this->CI->coupan->getCouponById ($id);
		return $response;
	}
	
	public function addCoupon($bb) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->addCoupon ( $bb );
		return $discount;
	}
	public function updateVendor($b) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->updateVendor ( $b );
	}
	public function update($vendor) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->update ( $vendor );
	}
	public function turnoffcoupon($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->turnoffcoupon ( $a );
	}
	public function turnoncoupon($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->turnoncoupon ( $a );
	}
	public function deleteVendor($vendorid) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->deleteVendor ( $vendorid );
	}
	public function offcoupon($coupon_code) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->statusoffcoupon ( $coupon_code );
	}
	public function oncoupon($coupon_code) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->statusoncoupon ( $coupon_code );
	}
	
	public function getActiveSpecificCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		return $this->CI->coupan->getActiveSpecificCoupons ( );
	}
	
	public function getInActiveSpecificCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		return $this->CI->coupan->getInActiveSpecificCoupons ( );
	}
}