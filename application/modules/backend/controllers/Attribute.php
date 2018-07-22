<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Attribute extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/AttributeLib', 'attributelib' );
	}
	
	public function index() {
		/*$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);*/
		$this->load->library('zyk/AttributeLib');
		$attrgroups = $this->attributelib->getActiveAttributeGroup();
		$this->template->set('attrgroups',$attrgroups);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeGroupList');
	}
	
	public function newAttributeGroup() {
		$this->load->library('zyk/ProductLib', 'productlib' );
		/* $vendors = $this->productlib->getActiveVendors();
		$this->template->set('vendors', $vendors); */
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeGroupAdd');

	}
	
	public function addAttributeGroup() {
		$data['name'] = $this->input->post('name');
		//$data['vendor_id'] = $this->input->post('vendor_id');
		$data['sort_order'] = $this->input->post('sort_order');
		$data['status'] = $this->input->post('status');
		$response = $this->attributelib->addAttributeGroup($data);
			   
		echo json_encode($response);
				
		/* $this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeGroupAdd');*/
	}
	
	public function editAttributeGroup($id) {
		$this->load->library('zyk/AttributeLib', 'attributelib' );
		$attrgroup = $this->attributelib->getAttributeGroupById($id);
		$this->template->set('attrgroup', $attrgroup); 
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeGroupEdit');
	
	}
	
	
	public function updateAttributeGroup() {
		$data['attribute_group_id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		//$data['vendor_id'] = $this->input->post('vendor_id');
		$data['sort_order'] = $this->input->post('sort_order');
		$data['status'] = $this->input->post('status');
		
		$response = $this->attributelib->updateAttributeGroup($data);
	
		echo json_encode($response);
		
	}
	
	public function listAttribute() {
		$this->load->library('zyk/AttributeLib');
		$attribute = $this->attributelib->getActiveAttribute();
		$this->template->set('attribute',$attribute);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeList');
	}
	
	public function newAttribute() {
		$attrgroups = $this->attributelib->getActiveAttributeGroup();
		$this->template->set('attrgroups', $attrgroups);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeAdd');
		
	}
	
	public function addAttribute() {
		$data['name'] = $this->input->post('name');
		$data['attribute_group_id'] = $this->input->post('attribute_group_id');
		$data['sort_order'] = $this->input->post('sort_order');
		$data['value'] = $this->input->post('atr_value');
		$data['status'] = $this->input->post('status');
		$response = $this->attributelib->addAttribute($data);
		
		echo json_encode($response);
		
		/*$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeAdd');*/
	}
	
	public function editAttribute($id) {
		$this->load->library('zyk/AttributeLib', 'attributelib' );
		$attrgroups = $this->attributelib->getActiveAttributeGroup();
		$this->template->set('attrgroups', $attrgroups);
		$attribute = $this->attributelib->getAttributeById($id);
		$this->template->set('attribute', $attribute);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/AttributeEdit');
	
	}
	
	public function updateAttribute() {
		$data['attribute_id'] = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['attribute_group_id'] = $this->input->post('attribute_group_id');
		$data['sort_order'] = $this->input->post('sort_order');
		$data['value'] = $this->input->post('value');
		$data['status'] = $this->input->post('status');
		$data['date_modified'] = date('Y-m-d H:i:s');
		$response = $this->attributelib->updateAttribute($data);
		
		echo json_encode($response);
	
	}
	
	public function productAttribute() {
		$data['attribute_group_id'] = $this->input->get('attribute_group_id');
		$attributes = $this->attributelib->productAttribute($data);
		$this->template->set('attributes', $attributes);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('pages/ProductAttribute','',true);
	}
	
		
	public function getCategoryList() {
		$this->load->library('zyk/ProductLib');
		$categories = $this->attributelib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/CategoryList');
	}
	
	public function newCategory() {
		$this->load->library('zyk/ProductLib');
		$vendors = $this->productlib->getActiveVendors();
		$this->template->set('vendors',$vendors);
		$categories = $this->productlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/CategoryAdd');
	}
	
	public function addCategory() {
		$params = array();
		$params['name'] = $this->input->post('name');
		//$params['vendor_id'] = $this->input->post('vendor_id');
		$params['parent_id'] = $this->input->post('parent_id');
		$params['description'] = $this->input->post('description');
		$params['meta_title'] = $this->input->post('meta_title');
		$params['meta_keyword'] = $this->input->post('meta_keyword');
		$params['meta_description'] = $this->input->post('meta_description');
		$params['sort_order'] = $this->input->post('sort_order');
		$params['status'] = $this->input->post('status');
		$params['date_added'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/Attribute');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/category/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->attributelib->addCategory($params);
		echo json_encode($response);
	}
	
	public function editCategory($id) {
		$this->load->library('zyk/ProductLib');
		$parentcategory = $this->productlib->getActiveCategories();
		$this->template->set('pcategory',$parentcategory);
		$categories = $this->productlib->getCategoryById($id);
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | CategoryEdit' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/CategoryEdit');
	}
	
	public function updateCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		//$params['vendor_id'] = $this->input->post('vendor_id');
		$params['parent_id'] = $this->input->post('parent_id');
		$params['description'] = $this->input->post('description');
		$params['meta_title'] = $this->input->post('meta_title');
		$params['meta_keyword'] = $this->input->post('meta_keyword');
		$params['meta_description'] = $this->input->post('meta_description');
		$params['sort_order'] = $this->input->post('sort_order');
		$params['status'] = $this->input->post('status');
		$params['date_added'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/Attribute');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/category/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->attributelib->updateCategory($params);
		echo json_encode($response);
	} 
			
	/* public function getSubCategoryList($cat_id=0) {
		$this->load->library('zyk/ProductLib');
		if($cat_id == 0) {
			$subcat = array();
		} else {
			$subcat = $this->productlib->getSubCatByCatId($cat_id);
		}
		$categories = $this->productlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set('cat_id',$cat_id);
		$this->template->set('subcat',$subcat);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Items' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/SubCategoryList');
	}
	
	public function newSubCategory() {
		$this->load->library('zyk/ProductLib');
		$vendors = $this->productlib->getActiveVendors();
		$this->template->set('vendors',$vendors);
		$categories = $this->productlib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Category' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/SubCategoryAdd');
	}
	
	public function addSubCategory() { 
		$params = array();
		$params['cat_id'] = $this->input->post('cat_id');
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$params['created_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/productlib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/category/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->productlib->addSubCategory($params);
		echo json_encode($response);
	}
	
	public function editSubCategory($id) {
		$this->load->library('zyk/ProductLib');
		$categories = $this->productlib->getActiveCategories();
		$subcat = $this->productlib->getSubCategoryById($id);
		$this->template->set('categories',$categories);
		$this->template->set('subcat',$subcat[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Items' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/SubCategoryEdit');
	}
	
	public function updateSubCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['cat_id'] = $this->input->post('cat_id');
		$params['name'] = $this->input->post('name');
		$params['updated_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ProductLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/category/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$params['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}
		$response = $this->productlib->updateSubCategory($params);
		echo json_encode($response);
	}  */
	
}