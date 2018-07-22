<?php
class ProductLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function getItemByCatId($cat_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getItemByCatId ( $cat_id );
		return $response;
	}
	
	public function addCategory($cat) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$result = $this->CI->productmodel->addCategory ($cat);
		return $result;
	}
	
	public function updateCategory($cat) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$result = $this->CI->productmodel->updateCategory ( $cat );
		return $result;
	}
	
	public function getActiveCategories() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getActiveCategories (  );
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
	
	
	// Added By suraj to add product
	
	
	//NEW CODE ADDDED 30-05-2017
	
	public function getCustomByID($id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getCustomByID($id);
		return $response;
	}
	
	public function getCustommainByID($id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getCustommainByID($id);
		return $response;
	}
	
	public function getProductByID($id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$prod = $this->CI->productmodel->getProductByID($id);
		$product_kit = $this->CI->productmodel->getProductKitByID($id);
		$product_sub = $this->CI->productmodel->getProductSubsByID($id);
		$product_custom = $this->CI->productmodel->getProductCustomByID($id);
		$images = $this->CI->productmodel->getProductImages($id);
		$category = $this->CI->productmodel->getProductCategory($id);
		$prod['0']['is_special'] = 0;
		$specialDate = date('Y-m-d');
		$specialDate =date('Y-m-d', strtotime($specialDate));;
		//echo $paymentDate; // echos today!
		$startDate = date('Y-m-d', strtotime($prod['0']['special_from_date']));
		$endDate = date('Y-m-d', strtotime($prod['0']['special_to_date']));
		if (($specialDate > $startDate) && ($specialDate< $endDate))
		{
			$prod['0']['is_special'] =1;
		}
		
		$startAvailDate = date('Y-m-d', strtotime($prod['0']['date_from_available']));
		$endAvailDate = date('Y-m-d', strtotime($prod['0']['date_to_available']));
		$prod['0']['is_available'] = 0;
		if (($specialDate > $startAvailDate) && ($specialDate < $endAvailDate) && ($prod['0']['status']==1) && ($prod['0']['quantity'] > 0))
		{
			$prod['0']['is_available'] =1;
		}
		
		
		$response = array();
		$products = array ();
		
		foreach ( $prod as $key => $row ) {
			$products [$key] = $row;
			$products [$key]['base_image'] = 0;
			$pro_images = array();
			foreach($images as $image){
				if($image['product_id'] == $row['product_id']) {
					$pro_images[] = $image;
					//$pro_images[] = $image['is_base'];
					if($image['is_base']==1){
						$products [$key]['base_image'] = $image['image'];
					}
				}
			}
			if($products [$key]['base_image']==0){
				
			}
			
			$products [$key]['images'] = $pro_images;
			$pro_category = array();
			foreach($category as $cate){
				if($cate['product_id'] == $row['product_id']){
					$pro_category[] = $cate;
				}
			}
			
			$products [$key]['category'] = $pro_category;
			$products [$key]['product_kit'] =$product_kit;
			$products [$key]['product_sub'] =$product_sub;
			$products [$key]['customs'] =$product_custom;
		}
		//$products['bookmark'] = $bookmark;
		$response = $products;
		return $response;
		
		//return $response;
	}
	
	public function getSubscription() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getSubscription();
		return $response;
	}
	
	public function getAllProducts() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response =array();
		$response['individuals']= $this->CI->productmodel->getIndividualProduct();
		$response['kits']= $this->CI->productmodel->getKitProduct();
		$response['subscription']= $this->CI->productmodel->getSubProduct();
		return $response;
	}
	
	public function getProductKitByProductID($productid) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductKitByID($productid);
		return $response;
	}
	
	
	/* **************** New Implementation ********************** */
	public function getProducts() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProducts();
		return $response;
	}
	
	public function getProductDetails($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductDetails($product_id);
		return $response;
	}
	
	public function getActiveDevices() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getActiveDevices();
		return $response;
	}
	
	public function getAllActiveProducts() {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getAllActiveProducts();
		$products = array();
		foreach ($response as $product) {
			if($product['type'] == 1) {
				$products['individuals'][] = $product;
			} elseif ($product['type'] == 2) {
				$products['kits'][] = $product;
			} elseif ($product['type'] == 3) {
				$products['subscription'][] = $product;
			}
		}
		return $products;
	}
	
	public function addProduct($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProduct($data);
		return $response;
	}
	
	public function updateProduct($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->updateProduct($data);
		return $response;
	}
	
	public function addProductSeo($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProductSeo($data);
		return $response;
	}
	
	public function updateProductSeo($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->updateProductSeo($data);
		return $response;
	}
	
	public function getProductSeo($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductSeo($product_id);
		return $response;
	}
	
	public function addProductOffers($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProductOffers($data);
		return $response;
	}
	
	public function deleteProductOffers($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->deleteProductOffers($product_id);
		return $response;
	}
	
	public function getProductOffers($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductOffers($product_id);
		return $response;
	}
	
	public function addProductImages($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProductImages($data);
		return $response;
	}
	
	public function deleteProductImages($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->deleteProductImages($product_id);
		return $response;
	}
	
	public function getProductImages($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductImages($product_id);
		return $response;
	}
	
	public function addDevice($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addDevice($data);
		return $response;
	}
	
	public function updateDevice($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->updateDevice($data);
		return $response;
	}
	
	public function addProductDevices($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProductDevices($data);
		return $response;
	}
	
	public function deleteProductDevices($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->deleteProductDevices($product_id);
		return $response;
	}
	
	public function getProductDevices($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductDevices($product_id);
		return $response;
	}
	
	public function getProductKitDevices($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductKitDevices($product_id);
		return $response;
	}
	
	public function updateProductStock($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->updateProductStock($product_id);
		return $response;
	}
	
	public function isProductQuantityAvailable($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->isProductQuantityAvailable($product_id);
		return $response;
	}
	
	public function updateDeviceStock($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->updateDeviceStock($product_id);
		return $response;
	}
	
	public function addProductComponents($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProductComponents($data);
		return $response;
	}
	public function updateProductComponent($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->updateProductComponent($data);
		return $response;
	}
	
	public function deleteProductComponents($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->deleteProductComponents($product_id);
		return $response;
	}
	
	public function deleteProductComponentById($id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->deleteProductComponentById($id);
		return $response;
	}
	
	public function getProductComponents($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductComponents($product_id);
		return $response;
	}
	
	public function addProductTechSpecs($data) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->addProductTechSpecs($data);
		return $response;
	}
	
	public function deleteProductTechSpecs($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->deleteProductTechSpecs($product_id);
		return $response;
	}
	
	public function getProductTechSpecs($product_id) {
		$this->CI->load->model ( 'product/Product_model', 'productmodel' );
		$response = $this->CI->productmodel->getProductTechSpecs($product_id);
		return $response;
	}
	
	
	
}