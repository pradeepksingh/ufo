<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Product extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ProductLib', 'productlib');
	}
	/* *************** New Implementation **************** */
	public function index() {
		$allProducts = $this->productlib->getActiveDevices();
		$this->template->set('allProducts',$allProducts);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/ProductAdd');
	}
	
	public function addProduct(){
		$this->load->library('product/ProductLib', 'productlib' );
		$product = array();
		$product['type'] = $this->input->post('product_type');
		$product['name'] = $this->input->post('name');
		$product['sku'] = $this->input->post('sku');
		$product['long_description'] = $this->input->post('description');
		$product['short_description'] = $this->input->post('short_description');
		$new_from_date = $this->input->post('new_from_date');
		$new_to_date = $this->input->post('new_to_date');
		$product['isnew_start_date'] = date('Y-m-d',strtotime($new_from_date));
		$product['isnew_end_date'] = date('Y-m-d',strtotime($new_to_date));
		$product['unit_price'] = $this->input->post('unit_price');
		$product['karma_points'] = $this->input->post('karma_points');
		$product['min_quantity'] = $this->input->post('minimum_quantity');
		$product['status'] = $this->input->post('status');
		$product['created_date'] = date('Y-m-d H:i:s');
		$product['modified_date'] = date('Y-m-d H:i:s');
		$product_id = $this->productlib->addProduct($product);
		if($product_id == 0) {
			echo json_encode(array("status"=>0,"msg"=>"Product already added."));
		} else {
			$seo['product_id'] = $product_id;
			$seo['meta_title'] = $this->input->post('meta_title');
			$seo['meta_keyword'] = $this->input->post('meta_keyword');
			$seo['meta_description'] = $this->input->post('meta_description');
			$this->productlib->addProductSeo($seo);
			
			$title = $this->input->post('fTitle');
			$qty = $this->input->post('fQty');
			$price = $this->input->post('fPrice');
			$is_recommended = $this->input->post('frecommend');
			$sort_order = $this->input->post('fsort_order');
			$from_date = $this->input->post('ffrom_date');
			$to_date = $this->input->post('fto_date');
			$offers = array();
			foreach ($title as $key=>$value) {
				$offer = array();
				$offer['product_id'] = $product_id;
				$offer['title'] = $value;
				$offer['quantity'] = $qty[$key];
				$offer['price'] = $price[$key];
				$offer['is_recommended'] = $is_recommended[$key];
				$offer['sortorder'] = $sort_order[$key];
				if(!empty($from_date[$key])) { 
					$offer['from_date'] = date('Y-m-d',strtotime($from_date[$key]));
				} else {
					$offer['from_date'] = date('Y-m-d');
				}
				if(!empty($to_date[$key])) {
					$offer['to_date'] = date('Y-m-d',strtotime($to_date[$key]));
				} else {
					$offer['to_date'] = "";
				}
				if(!empty($value) && !empty($qty[$key]) && !empty($price[$key]))
				$offers[] = $offer;
			}
			if(count($offers) > 0) {
				$this->productlib->addProductOffers($offers);
			}
			
			$images = array();
			$files = $_FILES;
			$cpt = 0;
			//if(!empty($_FILES ['userfile'] ['name'])) {
				$cpt = count ( $_FILES ['userfile'] ['name'] );
				$data['images'] =array();
				for($i = 0; $i < $cpt; $i ++) {
					$_FILES ['userfile'] ['name'][$i];
					$_FILES ['user'] ['name'] = $_FILES ['userfile'] ['name'] [$i];
					$_FILES ['user'] ['type'] = $_FILES ['userfile'] ['type'] [$i];
					$_FILES ['user'] ['tmp_name'] = $_FILES ['userfile'] ['tmp_name'] [$i];
					$_FILES ['user'] ['error'] = $_FILES ['userfile'] ['error'] [$i];
					$_FILES ['user'] ['size'] = $_FILES ['userfile'] ['size'] [$i];
				
					$config = array ();
					$config ['upload_path'] = 'assets/images/product/';
					$config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
					$config ['max_size'] = 204800;
					$config ['max_width'] = 10048;
					$config ['max_height'] = 10048;
				
					$this->load->library ( 'upload', $config );
					if ($this->upload->do_upload ( 'user' )) {
						$image = array();
						$image['product_id'] = $product_id;
						$image['image'] = 'images/product/' . $this->upload->data ( 'file_name' );
						$image['is_base'] = 0;
						$image['sort_order'] = $i;
						$images[] = $image;
					} else {
						$error = array('error' => $this->upload->display_errors());
					}
				}
			//}
			if(count($images) > 0) {
				$this->productlib->addProductImages($images);
			}
			if($product['type'] == 1) {
				$product_details = array();
				$tech_specs = array();
				$component_names = $this->input->post("component_name");
				foreach ($component_names as $key=>$name) {
					if(!empty($name) && !empty($_FILES ['component_image'] ['name'] [$key])) {
						$_FILES ['component'] ['name'] = $_FILES ['component_image'] ['name'] [$key];
						$_FILES ['component'] ['type'] = $_FILES ['component_image'] ['type'] [$key];
						$_FILES ['component'] ['tmp_name'] = $_FILES ['component_image'] ['tmp_name'] [$key];
						$_FILES ['component'] ['error'] = $_FILES ['component_image'] ['error'] [$key];
						$_FILES ['component'] ['size'] = $_FILES ['component_image'] ['size'] [$key];
						
						$config = array ();
						$config ['upload_path'] = 'assets/images/product/components/';
						$config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
						$config ['max_size'] = 204800;
						$config ['max_width'] = 10048;
						$config ['max_height'] = 10048;
						
						$this->load->library ( 'upload', $config );
						if ($this->upload->do_upload ( 'component' )) {
							$product_detail = array();
							$product_detail['name'] = $name;
							$product_detail['product_id'] = $product_id;
							$product_detail['image'] = 'images/product/components/' . $this->upload->data ( 'file_name' );
							$product_details[] = $product_detail;
						} else {
							$error = array('error' => $this->upload->display_errors());
						}
					}
				}
				$attrs = $this->input->post("attr_name");
				$attr_vals = $this->input->post("attr_value");
				foreach ($attrs as $key=>$attr) {
					if(!empty($attr) && !empty($attr_vals[$key])) {
						$tech_spec = array();
						$tech_spec['product_id'] = $product_id;
						$tech_spec['attr_name'] = $attr;
						$tech_spec['attr_value'] = $attr_vals[$key];
						$tech_specs[] = $tech_spec;
					}
				}
				if(count($product_details) > 0) {
					$this->productlib->addProductComponents($product_details);
				}
				if(count($tech_specs) > 0) {
					$this->productlib->addProductTechSpecs($tech_specs);
				}
				$device = array();
				$device['product_id'] = $product_id;
				$device['name'] = $product['name'];
				$device['sku'] = $product['sku'];
				$device['price'] = $product['unit_price'];
				if(count($images) > 0) {
					$device['image'] = $images[0]['image'];
				}
				$device['status'] = $product['status'];
				$device['created_by'] = $this->session->userdata['adminsession']['id'];
				$device['created_date'] = $product['created_date'];
				$device_id = $this->productlib->addDevice($device);
				$product_devices = array();
				$product_device = array();
				$product_device['product_id'] = $product_id;
				$product_device['device_id'] = $device_id;
				$product_device['quantity'] = 1;
				$product_devices[] = $product_device;
				$this->productlib->addProductDevices($product_devices);
			}
			if($product['type'] == 2) {
				$device_ids = $this->input->post('kit_product_name');
				$device_qtys = $this->input->post('kit_qty');
				$product_devices = array();
				foreach ($device_ids as $key=>$value) {
					$product_device = array();
					$product_device['product_id'] = $product_id;
					$product_device['device_id'] = $value;
					$product_device['quantity'] = $device_qtys[$key];
					$product_devices[] = $product_device;
				}
				if(count($product_devices) > 0) {
					$this->productlib->addProductDevices($product_devices);
				}
			}
			echo json_encode(array("status"=>1,"msg"=>"Product added successfully."));
		}
	}
	
	
	public function productEdit($id) {
		$allProducts =  $this->productlib->getActiveDevices();
		$this->template->set('allProducts',$allProducts);
		$products = $this->productlib->getProductDetails($id);
		$images = $this->productlib->getProductImages($id);
		$seo = $this->productlib->getProductSeo($id);
		$offers = $this->productlib->getProductOffers($id);
		$devices = $this->productlib->getProductDevices($id);
		$components = $this->productlib->getProductComponents($id);
		$techspecs = $this->productlib->getProductTechSpecs($id);
		$this->template->set('products',$products);
		$this->template->set('images',$images);
		$this->template->set('seo',$seo);
		$this->template->set('offers',$offers);
		$this->template->set('components',$components);
		$this->template->set('techspecs',$techspecs);
		$this->template->set('devices',$devices);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/ProductEdit');
	}
	
	
	public function updateProduct(){
		$this->load->library('product/ProductLib', 'productlib' );
		$product = array();
		$product['id'] = $this->input->post('product_id');
		$product['type'] = $this->input->post('product_type');
		$product['name'] = $this->input->post('name');
		$product['sku'] = $this->input->post('sku');
		$product['long_description'] = $this->input->post('description');
		$product['short_description'] = $this->input->post('short_description');
		$new_from_date = $this->input->post('new_from_date');
		$new_to_date = $this->input->post('new_to_date');
		$product['isnew_start_date'] = date('Y-m-d',strtotime($new_from_date));
		$product['isnew_end_date'] = date('Y-m-d',strtotime($new_to_date));
		$product['unit_price'] = $this->input->post('unit_price');
		$product['karma_points'] = $this->input->post('karma_points');
		$product['min_quantity'] = $this->input->post('minimum_quantity');
		$product['status'] = $this->input->post('status');
		$product['modified_date'] = date('Y-m-d H:i:s');
		$product_id = $product['id'];
		$this->productlib->updateProduct($product);
		if($product_id == 0) {
			echo json_encode(array("status"=>0,"msg"=>"Product already added."));
		} else {
			$seo['product_id'] = $product_id;
			$seo['meta_title'] = $this->input->post('meta_title');
			$seo['meta_keyword'] = $this->input->post('meta_keyword');
			$seo['meta_description'] = $this->input->post('meta_description');
			$this->productlib->updateProductSeo($seo);
				
			$title = $this->input->post('fTitle');
			$qty = $this->input->post('fQty');
			$price = $this->input->post('fPrice');
			$is_recommended = $this->input->post('frecommend');
			$sort_order = $this->input->post('fsort_order');
			$from_date = $this->input->post('ffrom_date');
			$to_date = $this->input->post('fto_date');
			$offers = array();
			foreach ($title as $key=>$value) {
				$offer = array();
				$offer['product_id'] = $product_id;
				$offer['title'] = $value;
				$offer['quantity'] = $qty[$key];
				$offer['price'] = $price[$key];
				$offer['is_recommended'] = $is_recommended[$key];
				$offer['sortorder'] = $sort_order[$key];
				if(!empty($from_date[$key])) {
					$offer['from_date'] = date('Y-m-d',strtotime($from_date[$key]));
				} else {
					$offer['from_date'] = date('Y-m-d');
				}
				if(!empty($to_date[$key])) {
					$offer['to_date'] = date('Y-m-d',strtotime($to_date[$key]));
				} else {
					$offer['to_date'] = "";
				}
				if(!empty($value) && !empty($qty[$key]) && !empty($price[$key]))
				$offers[] = $offer;
			}
			if(count($offers) > 0) {
				$this->productlib->deleteProductOffers($product_id);
				$this->productlib->addProductOffers($offers);
			}
				
			$images = array();
			$files = $_FILES;
			$cpt = 0;
			if(!empty($_FILES ['userfile'] ['name'])) {
				$cpt = count ( $_FILES ['userfile'] ['name'] );
				$data['images'] =array();
				for($i = 0; $i < $cpt; $i ++) {
					$_FILES ['userfile'] ['name'][$i];
					$_FILES ['user'] ['name'] = $_FILES ['userfile'] ['name'] [$i];
					$_FILES ['user'] ['type'] = $_FILES ['userfile'] ['type'] [$i];
					$_FILES ['user'] ['tmp_name'] = $_FILES ['userfile'] ['tmp_name'] [$i];
					$_FILES ['user'] ['error'] = $_FILES ['userfile'] ['error'] [$i];
					$_FILES ['user'] ['size'] = $_FILES ['userfile'] ['size'] [$i];
		
					$config = array ();
					$config ['upload_path'] = 'assets/images/product/';
					$config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
					$config ['max_size'] = 204800;
					$config ['max_width'] = 10048;
					$config ['max_height'] = 10048;
		
					$this->load->library ( 'upload', $config );
					if ($this->upload->do_upload ( 'user' )) {
						$image = array();
						$image['product_id'] = $product_id;
						$image['image'] = 'images/product/' . $this->upload->data ( 'file_name' );
						$image['is_base'] = 0;
						$image['sort_order'] = $i;
						$images[] = $image;
					} else {
						$error = array('error' => $this->upload->display_errors());
					}
				}
				if(count($images) > 0) {
					$this->productlib->deleteProductImages($product_id);
					$this->productlib->addProductImages($images);
				}
			}
			if($product['type'] == 1) {
				$product_details_new = array();
				$tech_specs = array();
				$component_names = $this->input->post("component_name");
				$component_ids = $this->input->post("component_id");
				$i = 0;
				foreach ($component_names as $key=>$name) {
					if(!empty($name)) {
						$product_detail = array();
						$product_detail['name'] = $name;
						$product_detail['product_id'] = $product_id;
						if($component_ids[$key] > 0) { 
							if(!empty($_FILES ['component_image_'.$component_ids[$key]] ['name'])) {
								$_FILES ['component'] ['name'] = $_FILES ['component_image_'.$component_ids[$key]] ['name'];
								$_FILES ['component'] ['type'] = $_FILES ['component_image_'.$component_ids[$key]] ['type'];
								$_FILES ['component'] ['tmp_name'] = $_FILES ['component_image_'.$component_ids[$key]] ['tmp_name'];
								$_FILES ['component'] ['error'] = $_FILES ['component_image_'.$component_ids[$key]] ['error'];
								$_FILES ['component'] ['size'] = $_FILES ['component_image_'.$component_ids[$key]] ['size'];
						
								$config = array ();
								$config ['upload_path'] = 'assets/images/product/components/';
								$config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
								$config ['max_size'] = 204800;
								$config ['max_width'] = 10048;
								$config ['max_height'] = 10048;
						
								$this->load->library ( 'upload', $config );
								if ($this->upload->do_upload ( 'component' )) {
									$product_detail['image'] = 'images/product/components/' . $this->upload->data ( 'file_name' );
								} else {
									$error = array('error' => $this->upload->display_errors());
								}
							}
						} else {
							if(!empty($_FILES ['component_image'] ['name'] [$i])) {
								$_FILES ['component'] ['name'] = $_FILES ['component_image'] ['name'] [$i];
								$_FILES ['component'] ['type'] = $_FILES ['component_image'] ['type'] [$i];
								$_FILES ['component'] ['tmp_name'] = $_FILES ['component_image'] ['tmp_name'] [$i];
								$_FILES ['component'] ['error'] = $_FILES ['component_image'] ['error'] [$i];
								$_FILES ['component'] ['size'] = $_FILES ['component_image'] ['size'] [$i];
							
								$config = array ();
								$config ['upload_path'] = 'assets/images/product/components/';
								$config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
								$config ['max_size'] = 204800;
								$config ['max_width'] = 10048;
								$config ['max_height'] = 10048;
							
								$this->load->library ( 'upload', $config );
								if ($this->upload->do_upload ( 'component' )) {
									$product_detail['image'] = 'images/product/components/' . $this->upload->data ( 'file_name' );
									$product_details_new[] = $product_detail;
								} else {
									$error = array('error' => $this->upload->display_errors());
								}
								$i++;
							}
						}
						if($component_ids[$key] > 0) { 
							$product_detail['id'] = $component_ids[$key];
							$this->productlib->updateProductComponent($product_detail);
						}
					}
				}
				$attrs = $this->input->post("attr_name");
				$attr_vals = $this->input->post("attr_value");
				foreach ($attrs as $key=>$attr) {
					if(!empty($attr) && !empty($attr_vals[$key])) {
						$tech_spec = array();
						$tech_spec['product_id'] = $product_id;
						$tech_spec['attr_name'] = $attr;
						$tech_spec['attr_value'] = $attr_vals[$key];
						$tech_specs[] = $tech_spec;
					}
				}
				if(count($product_details_new) > 0) {
					$this->productlib->addProductComponents($product_details_new);
				}
				if(count($tech_specs) > 0) {
					$this->productlib->deleteProductTechSpecs($product_id);
					$this->productlib->addProductTechSpecs($tech_specs);
				}
				$device = array();
				$device['id'] = $this->input->post('device_id');
				$device['name'] = $product['name'];
				$device['sku'] = $product['sku'];
				$device['price'] = $product['unit_price'];
				if(count($images) > 0) {
					$device['image'] = $images[0]['image'];
				}
				$device['status'] = $product['status'];
				$this->productlib->updateDevice($device);
			}
			if($product['type'] == 2) {
				$device_ids = $this->input->post('kit_product_name');
				$device_qtys = $this->input->post('kit_qty');
				$product_devices = array();
				foreach ($device_ids as $key=>$value) {
					$product_device = array();
					$product_device['product_id'] = $product_id;
					$product_device['device_id'] = $value;
					$product_device['quantity'] = $device_qtys[$key];
					$product_devices[] = $product_device;
				}
				if(count($product_devices) > 0) {
					$this->productlib->deleteProductDevices($product_id);
					$this->productlib->addProductDevices($product_devices);
				}
			}
			echo json_encode(array("status"=>1,"msg"=>"Product updated successfully."));
		}
	}
	
	public function deleteComponent() {
		$this->load->library('product/ProductLib', 'productlib' );
		$id = $this->input->post("id");
		$is_deleted = $this->productlib->deleteProductComponentById($id);
		if($is_deleted) {
			echo json_encode(array("status"=>1,"msg"=>"Component deleted successfully."));
		} else {
			echo json_encode(array("status"=>0,"msg"=>"Failed to delete component."));
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	/* ********************* New Implementation End ***************** */
	
	
	
	
	
	
	public function getCategoryList() {
		$categories = $this->productlib->getActiveCategories();
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
		$vendors = $this->productlib->getActiveVendors();
		$this->template->set('vendors',$vendors);
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
		$params['status'] = 1;
		$params['created_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ProductLib');
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
		$response = $this->productlib->addCategory($params);
		echo json_encode($response);
	}
	
	public function editCategory($id) {
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
		$item['updated_on'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/ProductLib');
		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/service/';
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
		$response = $this->productlib->updateCategory($params);
		echo json_encode($response);
	} 
			
	public function getSubCategoryList($cat_id=0) {
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
	} 
	
	
	
	//NEW CODE ADDDED 30-05-2017
	
	public function productList() {
		$products = $this->productlib->getProducts();
		$this->template->set('products',$products);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Product' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('product/ProductList');
	}
	
	public function uploadMenu($productid) {
		$this->template->set('productid',$productid);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('product/Upload','',true);
	}
	
	public function customEdit($id) {
		//$this->load->library('zyk/RestaurantLib','restaurantlib');
		$customs = $this->productlib->getCustomByID($id);
		//$customsmain = $this->productlib->getCustommainByID($id);
		$this->template->set('customs',$customs);
	//	$this->template->set('customsmain',$customsmain);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('product/Custom','',true);
	}
	
	public function import() {
		$errors = array();
		$errorMsg = array();
		$map = array();
		$type = $this->input->post('type',TRUE);
		$productid = 1;
		$file = $_FILES['menu']['name'];
		if($file != '') {
			$filename = $productid.'_menu_export_'.basename($file);
			$uploadFile = FCPATH.'assets/documents/menus/'.$filename;
			if(!move_uploaded_file($_FILES['menu']['tmp_name'],$uploadFile)){
				$data['message'] = 'Menu could not be uploaded';
				$data['status'] = 0;
				echo json_encode($data);
				exit;
			}
		}else {
			$data['message'] = 'Please select menu to be uploaded';
			$data['status'] = 0;
			echo json_encode($data);
			exit;
		}
		$this->load->library('MyExcel');
		//require_once APPPATH.'third_party/Excel/PHPExcel.php';
		$inputFileType = PHPExcel_IOFactory::identify($uploadFile);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($uploadFile);
		$mcategories = array();
		$categories = array();
		$mnames = array();
		$cname = array();
		$items = array();
		$batch = array();
		$i = 0;
		$j = 0;
		$k = 0;
		$c = 0;
		$item_cnt = 0;
		if($type == 'new') //add
		{
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			//	print_r($worksheet->getTitle());
				if($worksheet->getTitle() == 'Basic')
				{
				//	echo "inside if";
					$categories = array();
					foreach ($worksheet->getRowIterator() as $row) {
						$is_empty = true;
						for($col = 0; $col < 12; $col++ ){
							$col_value = trim($worksheet->getCellByColumnAndRow($col, $row->getRowIndex())->getValue());
							if($col_value != null && strlen($col_value) > 0) {
								$is_empty = false;
							}
						}
						if (!$is_empty) {
							$rowIndex = $row->getRowIndex();
					
							$cell = $worksheet->getCell('A' . $rowIndex);
							$category = ucfirst($cell->getCalculatedValue());
							$categories[ucfirst($worksheet->getTitle()).'_'.$category]['name'] = $category;
					
							$cell = $worksheet->getCell('B' . $rowIndex);
							$item['name'] =  ucfirst($cell->getCalculatedValue());
							if($item['name'] == null || $item['name'] == '') {
								$error = 'Item name is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('C' . $rowIndex);
							$item['sku'] =  ucfirst($cell->getCalculatedValue());
							if($item['sku'] == null || $item['sku'] == '') {
								$error = 'SKU is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('D' . $rowIndex);
							$item['description'] =  ucfirst($cell->getCalculatedValue());
							if($item['description'] == null || $item['description'] == '') {
								$error = 'Description is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('E' . $rowIndex);
							$item['short_description'] =  ucfirst($cell->getCalculatedValue());
							if($item['short_description'] == null || $item['short_description'] == '') {
								$error = 'Short description is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
								
							// $cell = $worksheet->getCell('F' . $rowIndex);
							// $item['new_from_date'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
							// if($item['new_from_date'] == null || $item['new_from_date']== '') {
							// $item['new_from_date'] = date('Y-m-d');
							// }
							// $cell = $worksheet->getCell('G' . $rowIndex);
							// $item['new_to_date'] =  PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
							// if($item['new_to_date'] == '0000-00-00')
							// {
							// $error = 'End date format incorrect at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							// if (! empty ( $error )) {
							// array_push ( $errors, $error );
							// }
							// }
							// if((strtotime($item['new_to_date']) - strtotime($item['new_from_date']) < 0) && trim($item['new_to_date']!=""))//SDA 28thAug
							// {
							// $error = 'End date cannot be lesser than start date at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							// if (! empty ( $error )) {
							// array_push ( $errors, $error );
							// }
							// }
					
							$cell = $worksheet->getCell('H' . $rowIndex);
							$item['price'] =  $cell->getCalculatedValue();
							if($item['price'] == '' || (!is_numeric($item['price']) && substr_count($item['price'],'-') <= 0)) {
								$error = 'Item price is empty or invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('I' . $rowIndex);
							$item['special_price'] =  $cell->getCalculatedValue();
							if($item['special_price'] == '' || (!is_numeric($item['special_price']) && substr_count($item['special_price'],'-') <= 0)) {
								$error = 'Item price is empty or invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							// $cell = $worksheet->getCell('J' . $rowIndex);
							// $item['special_from_date'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
							// if($item['special_from_date'] == null || $item['special_from_date']== '') {
							// $item['special_from_date'] = date('Y-m-d');
							// }
							// $cell = $worksheet->getCell('K' . $rowIndex);
							// $item['special_to_date'] =  PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
							// if($item['special_to_date'] == '0000-00-00')
							// {
							// $error = 'End date format incorrect at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							// if (! empty ( $error )) {
							// array_push ( $errors, $error );
							// }
							// }
							// if((strtotime($item['special_to_date']) - strtotime($item['special_from_date']) < 0) && trim($item['special_to_date']!=""))//SDA 28thAug
							// {
							// $error = 'End date cannot be lesser than start date at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							// if (! empty ( $error )) {
							// array_push ( $errors, $error );
							// }
							// }
								
							$cell = $worksheet->getCell('K' . $rowIndex);
							$item['quantity'] =  ucfirst($cell->getCalculatedValue());
							if($item['quantity'] == null || $item['quantity'] == '') {
								$error = 'Qyantity is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('L' . $rowIndex);
							$item['minimum_quantity'] =  ucfirst($cell->getCalculatedValue());
							if($item['minimum_quantity'] == null || $item['minimum_quantity'] == '') {
								$error = 'Minimum Quantity is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('M' . $rowIndex);
							$item['vendor_id'] =  ucfirst($cell->getCalculatedValue());
							if($item['vendor_id'] == null || $item['vendor_id'] == '') {
								$error = 'Vendor Id is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('N' . $rowIndex);
							$item['manufacturer_id'] =  ucfirst($cell->getCalculatedValue());
							if($item['manufacturer_id'] == null || $item['manufacturer_id'] == '') {
								$error = 'Manufacturer Id is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('O' . $rowIndex);
							$item['status'] =  ucfirst($cell->getCalculatedValue());
							if($item['status'] == null || $item['status'] == '') {
								$error = 'Status is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('P' . $rowIndex);
							$item['meta_title'] =  ucfirst($cell->getCalculatedValue());
							if($item['meta_title'] == null || $item['meta_title'] == '') {
								$error = 'Meta Title is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('Q' . $rowIndex);
							$item['meta_keyword'] =  ucfirst($cell->getCalculatedValue());
							if($item['meta_keyword'] == null || $item['meta_keyword'] == '') {
								$error = 'Meta keyword is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$cell = $worksheet->getCell('R' . $rowIndex);
							$item['meta_description'] =  ucfirst($cell->getCalculatedValue());
							if($item['meta_description'] == null || $item['meta_description'] == '') {
								$error = 'Meta description is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
					
							$categories[ucfirst($worksheet->getTitle()).'_'.$category]['items'] []  = $item;
							$cell = $worksheet->getCell('S' . $rowIndex);
							$item['sortorder'] =  $cell->getCalculatedValue();
						}
					}
					if(count($categories) > 0)
						$mcategories[$i]['categories'] = $categories;
					unset($categories);
					$i++;
					//print_r($mcategories);
				}
				
				
				if($worksheet->getTitle() == 'Product')
				{
					//echo "inside custom";
					$categories1 = array();
					foreach ($worksheet->getRowIterator() as $row) {
						$is_empty = true;
						for($col = 0; $col < 12; $col++ ){
							$col_value = trim($worksheet->getCellByColumnAndRow($col, $row->getRowIndex())->getValue());
							if($col_value != null && strlen($col_value) > 0) {
								$is_empty = false;
							}
						}
						if (!$is_empty) {
							$rowIndex = $row->getRowIndex();
							
						$cell = $worksheet->getCell('A' . $rowIndex);
							$item1['product_id'] =  ucfirst($cell->getCalculatedValue());
							if($item1['product_id'] == null || $item1['product_id'] == '') {
								$error = 'Product Id is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
							
						$cell = $worksheet->getCell('B' . $rowIndex);
						$item1['category_id'] =  ucfirst($cell->getCalculatedValue());
						if($item1['category_id'] == null || $item1['category_id'] == '') {
							$error = 'Category Id is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						
						$cell = $worksheet->getCell('C' . $rowIndex);
						$item1['title'] =  ucfirst($cell->getCalculatedValue());
						if($item1['title'] == null || $item1['title'] == '') {
							$error = 'Title is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						
						$cell = $worksheet->getCell('D' . $rowIndex);
						$item1['is_required'] =  ucfirst($cell->getCalculatedValue());
						if($item1['is_required'] == null || $item1['is_required'] == '') {
							$error = 'Is Required is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						
						$cell = $worksheet->getCell('E' . $rowIndex);
						$item1['sort_order'] =  ucfirst($cell->getCalculatedValue());
						if($item1['sort_order'] == null || $item1['sort_order'] == '') {
							$error = 'Sort Order is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						
						
								
							$categories1[ucfirst($worksheet->getTitle())]['items1'] []  = $item1;
							$cell = $worksheet->getCell('F' . $rowIndex);
							$item1['sortorder'] =  $cell->getCalculatedValue();
						}
					}
					if(count($categories1) > 0)
						$mcategories1[$j]['categories1'] = $categories1;
					unset($categories1);
					$j++;
					
				}
				
		
				if($worksheet->getTitle() == 'Custom')
				{
					//echo "inside custom";
					$categories2 = array();
					foreach ($worksheet->getRowIterator() as $row) {
						$is_empty = true;
						for($col = 0; $col < 12; $col++ ){
							$col_value = trim($worksheet->getCellByColumnAndRow($col, $row->getRowIndex())->getValue());
							if($col_value != null && strlen($col_value) > 0) {
								$is_empty = false;
							}
						}
						if (!$is_empty) {
							$rowIndex = $row->getRowIndex();
							
							$cell = $worksheet->getCell('A' . $rowIndex);
							$item2['product_id'] =  ucfirst($cell->getCalculatedValue());
							if($item2['product_id'] == null || $item2['product_id'] == '') {
								$error = 'Product id is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
				
							$cell = $worksheet->getCell('B' . $rowIndex);
							$item2['custom_id'] =  ucfirst($cell->getCalculatedValue());
							if($item2['custom_id'] == null || $item2['custom_id'] == '') {
								$error = 'Custom id is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
							
							$cell = $worksheet->getCell('C' . $rowIndex);
							$item2['title1'] =  ucfirst($cell->getCalculatedValue());
							if($item2['title1'] == null || $item2['title1'] == '') {
								$error = 'Title is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
				
							$cell = $worksheet->getCell('D' . $rowIndex);
							$item2['price1'] =  ucfirst($cell->getCalculatedValue());
							if($item2['price1'] == null || $item2['price1'] == '') {
								$error = 'Price is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
				
							$cell = $worksheet->getCell('E' . $rowIndex);
							$item2['sort_order1'] =  ucfirst($cell->getCalculatedValue());
							if($item2['sort_order1'] == null || $item2['sort_order1'] == '') {
								$error = 'Sort Order is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
								if (! empty ( $error )) {
									array_push ( $errors, $error );
								}
							}
				
							$categories2[ucfirst($worksheet->getTitle())]['items2'] []  = $item2;
							$cell = $worksheet->getCell('F' . $rowIndex);
							$item2['sortorder'] =  $cell->getCalculatedValue();
						}
					}
					if(count($categories2) > 0)
						$mcategories2[$k]['categories2'] = $categories2;
					unset($categories2);
					$k++;
					//print_r($mcategories1);
					/*if (count($errors) > 0)
					 {
					 $map['message'] = 'Failed to upload menu.';
					 $map['status'] = 0;
					 $map['errors'] = $errors;
					 }
					 else
					 {*/
					$menu = array();
					$menu['structure'] = $mcategories;
					//print_r($menu);
					$menu1 = array();
					$menu1['structure1'] = $mcategories1;
					//print_r($menu1);
					$menu2 = array();
					$menu2['structure2'] = $mcategories2;
					//print_r($menu2);
					$this->load->library('zyk/MenuLib');
					$map = $this->menulib->uploadMenu($menu,$menu1,$menu2);
					//}
				}
				
			}
			
			
			echo json_encode($map);
		}
	}
	
	
}