<?php
class AttributeLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function ItemByCatId($cat_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getItemByCatId ( $cat_id );
		return $response;
	}
	
	public function addAttributeGroup($atrgroup) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->addAttributeGroup($atrgroup);
		return $result;
	}
	
	public function getActiveAttributeGroup() {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->getActiveAttributeGroup();
		return $result;
	}
		
	public function getAttributeGroupById($id) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->getAttributeGroupById($id);
		return $result;
	}
	
	public function updateAttributeGroup($data) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->updateAttributeGroup($data);
		return $result;
	}
	
	public function addAttribute($attr) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->addAttribute($attr);
		return $result;
	}
	
	public function getActiveAttribute() {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->getActiveAttribute();
		return $result;
	}
	
	public function getAttributeById($id) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->getAttributeById($id);
		return $result;
	}
	
	public function updateAttribute($data) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->updateAttribute($data);
		return $result;
	}
	
	//Add Attribute at Product Page
	
	public function productAttribute($attrgrp) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->productAttribute($attrgrp);
		return $result;
	}
	
	public function addCategory($cat) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->addCategory ($cat);
		return $result;
	}
	
	public function updateCategory($cat) {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$result = $this->CI->attributemodel->updateCategory ( $cat );
		return $result;
	}
	
	public function getActiveCategories() {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$response = $this->CI->attributemodel->getActiveCategories (  );
		return $response;
	}
	public function getActiveCategories1() {
		$this->CI->load->model ( 'product/Attribute_model', 'attributemodel' );
		$response = $this->CI->attributemodel->getActiveCategories1(  );
		return $response;
	}
	
	public function getActiveVendors() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getActiveVendors (  );
		return $response;
	}
	
	public function getCategoryById($cat_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getCategoryById ( $cat_id );
		return $response;
	}
	
	public function getSubCatByCatId($cat_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getSubCatByCatId ( $cat_id );
		return $response;
	}
	
	public function addSubCategory($cat) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$result = $this->CI->productmodel->addSubCategory ($cat);
		return $result;
	}
	
	public function updateSubCategory($cat) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$result = $this->CI->productmodel->updateSubCategory ( $cat );
		return $result;
	}
	
	public function getActiveSubCategories() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getActiveSubCategories (  );
		return $response;
	}
	
	public function getSubCategoryById($cat_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getSubCategoryById ( $cat_id );
		return $response;
	}
	
	public function getItemById($itemid) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getItemById ( $itemid );
		return $response;
	}
	
	public function getActiveItemsByCatId($cat_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getActiveItemsByCatId ( $cat_id );
		return $response;
	}
	
	public function getActiveItems() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getActiveItems ( );
		return $response;
	}
	
	public function searchItemName($name) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->searchItemName ( $name );
		return $response;
	}
	
	public function getItemCategory($item_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getItemCategory ( $item_id );
		return $response;
	}
	
}