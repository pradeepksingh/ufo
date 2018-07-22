<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Product_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function addItem($item) {
		$data = array ();
		$params = array (
				'name' => $item ['name'],
				'cat_id' => $item['cat_id'],
				'subcat_id' => $item['subcat_id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ITEM )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ITEM, $item );
			$data ['status'] = 1;
			$data ['id'] = $this->db->insert_id ();
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Item name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateItem($item) {
		$data = array ();
		$params = array (
				'name' => $item ['name'],
				'cat_id' => $item['cat_id'],
				'id !=' => $item ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ITEM )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $item ['id'] );
			$this->db->update ( TABLES::$ITEM, $item );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Item name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function turnOffItem($id) {
		$item ['status'] = 0;
		$this->db->where ( 'id', $id );
		return $this->db->update ( TABLES::$ITEM, $item );
	}
	
	public function turnOnItem($id) {
		$item ['status'] = 1;
		$this->db->where ( 'id', $id );
		return $this->db->update ( TABLES::$ITEM, $item );
	}
	
	public function getItemByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category,c.name as subcategory' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$MENU_MAIN_CATEGORY.' AS b', 'a.cat_id=b.id','left' )
				 ->join ( TABLES::$MENU_CATEGORY.' AS c', 'a.subcat_id=c.id','left' )
		         ->where ( 'a.cat_id', $cat_id );
		$this->db->group_by ('a.id','ASC');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_MAIN_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MENU_MAIN_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_MAIN_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$MENU_MAIN_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveVendors() {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveCategories() {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_CATEGORY );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MENU_MAIN_CATEGORY );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getSubCatByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category' )
		->from ( TABLES::$MENU_CATEGORY.' AS a' )
		->join ( TABLES::$MENU_MAIN_CATEGORY.' AS b', 'a.menu_mcat_id=b.id','inner' )
		->where ( 'a.menu_mcat_id', $cat_id );
		$this->db->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addSubCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'cat_id' => $cat ['cat_id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MENU_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateSubCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'cat_id !=' => $cat ['cat_id'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$MENU_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$MENU_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveSubCategories() {
		$this->db->select ( '*' )->from ( TABLES::$MENU_CATEGORY );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getSubCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MENU_CATEGORY );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function getItemById($itemid) {
		$this->db->select ( '*' )->from ( TABLES::$ITEM );
		$this->db->where ('id',$itemid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveItemsByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$MENU_MAIN_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
				 ->where ( 'a.cat_id', $cat_id );
		$this->db->where ('a.status',1);
		$this->db->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveItems() {
		$this->db->select ( 'a.*,b.name as category' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$MENU_MAIN_CATEGORY.' AS b', 'a.cat_id=b.id','inner' );
		$this->db->where ('a.status',1);
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function searchItemName($name) {
		$this->db->select ( 'a.id,a.name,a.cat_id,b.name as category' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$MENU_MAIN_CATEGORY.' AS b', 'a.cat_id=b.id','inner' );
		$this->db->like ( 'a.name', $name,'both' );
		$this->db->where ('a.status',1);
		$this->db->order_by ('a.name','ASC');
		$this->db->group_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getItemCategory($item_id) {
		$this->db->select ( 'cat_id' )
				 ->from ( TABLES::$ITEM);
		$this->db->where ('id',$item_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	// new code added 30-05-2017
	
	
	public function getCustomByID($id) {
		$this->db->select ( 'a.id as id1,a.title as title1,a.price,a.sort_order as sort_order1,b.*' )
						->from ( TABLES::$PRODUCT_CUSTOM_VALUE.' AS a' )
						 ->join ( TABLES::$PRODUCT_CUSTOM_MAIN.' AS b', 'a.custom_id=b.id','left' )
		                ->where ( 'a.product_id', $id )->order_by('b.id','ASC');
		               // ->group_by ('b.id','ASC');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProductByID($id) { 
		$this->db->select ( 'a.*,c.id as vendorid,c.name as vendor,d.manufacturer_id as manufactureid,d.name as manufacture,f.attribute_group_id as attr_id,f.name as attrname' )
						->from ( TABLES::$PRODUCT.' AS a' )
						//->join ( TABLES::$MENU_MAIN_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
		                ->join ( TABLES::$VENDOR.' AS c', 'a.vendor_id=c.id','left' )
		                ->join ( TABLES::$MANUFACTURE.' AS d', 'a.manufacturer_id=d.manufacturer_id','left' )
						//->join ( TABLES::$PRODUCT_IMAGE.' AS e', 'a.product_id=e.product_id','left' )
						->join ( TABLES::$ATTRIBUTE_GROUP.' AS f', 'a.attribute_group_id=f.attribute_group_id','left' )
						//->join ( TABLES::$PRODUCT_CATEGORY.' AS b', 'a.product_id=b.product_id','left' )
					    //->join ( TABLES::$MENU_MAIN_CATEGORY.' AS g', 'g.id=b.category_id','left' )
		                ->where ( 'a.product_id', $id );
		//$this->db->select ( '*' )->from ( TABLES::$PRODUCT );
		//$this->db->where ('product_id',$id);
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProductCategory($id) {
		$this->db->select ( 'b.*' );
		$this->db->from ( TABLES::$PRODUCT . ' AS a' );
		$this->db->join ( TABLES::$PRODUCT_CATEGORY . ' AS b', 'a.product_id=b.product_id', 'inner' );
		$this->db->join ( TABLES::$MENU_MAIN_CATEGORY.' AS c', 'c.id=b.category_id','left' );
		$this->db->where( 'a.product_id', $id );
		//->join ( TABLES::$PRODUCT_CATEGORY.' AS b', 'a.product_id=b.product_id','left' )
		//->join ( TABLES::$MENU_MAIN_CATEGORY.' AS g', 'g.id=b.category_id','left' )
        //$this->db->where("(a.user_id IN (".$where_clause.") OR a.user_id = ".$data['user_id'].")", '', FALSE);
		//$this->db->order_by ( "b.post_id", "desc" );
		//$this->db->order_by ( "b.id", "asc" );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	/*public function getProductImages($id) {
		$this->db->select ( 'b.*' );
		$this->db->from ( TABLES::$PRODUCT . ' AS a' );
		$this->db->join ( TABLES::$PRODUCT_IMAGE . ' AS b', 'a.product_id=b.product_id', 'inner' );
		$this->db->where( 'a.product_id', $id );
		//$this->db->where("(a.user_id IN (".$where_clause.") OR a.user_id = ".$data['user_id'].")", '', FALSE);
		//$this->db->order_by ( "b.post_id", "desc" );
		//$this->db->order_by ( "b.id", "asc" );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}*/
	
	public function getProductSubsByID($id) {
		$this->db->select ( 'a.*, b.*' );
		$this->db->from ( TABLES::$PRODUCT_SUBSCRIPTION . ' AS a' );
		$this->db->join ( TABLES::$SUBSCRIPTION . ' AS b', 'a.subs_id=b.id', 'left' );
		$this->db->where( 'a.product_id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProductCustomByID($id) {
		$this->db->select ( 'a.*' );
		$this->db->from ( TABLES::$PRODUCT_CUSTOM_VALUE. ' AS a' );
		$this->db->where( 'a.product_id', $id );
		$this->db->where('a.price >', '0');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProductKitByID($id) {
		$this->db->select ( 'a.*, b.name, b.price, b.quantity as avail_quantity' );
		$this->db->from ( TABLES::$PRODUCT_KIT . ' AS a' );
		$this->db->join ( TABLES::$PRODUCT . ' AS b', 'a.kit_product_id=b.product_id', 'left' );
		$this->db->where( 'a.product_id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getSubscription() {
		$this->db->select ( '*' )->from ( TABLES::$SUBSCRIPTION );
		$this->db->where ('status',1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getIndividualProduct() {
		$this->db->select ( 'a.*,b.image,b.is_base' );
		$this->db->from ( TABLES::$PRODUCT.' as a');
		$this->db->join ( TABLES::$PRODUCT_IMAGE.' as b', 'a.product_id = b.product_id', 'inner');
		$this->db->where( 'a.product_type', 1 );
		$this->db->where( 'b.is_base', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		//echo $this->db->last_query();
		return $result;
	}
	
	public function getKitProduct() {
		$this->db->select ( 'a.*,b.image,b.is_base' );
		$this->db->from ( TABLES::$PRODUCT.' as a');
		$this->db->join ( TABLES::$PRODUCT_IMAGE.' as b', 'a.product_id = b.product_id', 'inner');
		$this->db->where( 'a.product_type', 2 );
		$this->db->where( 'b.is_base', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getSubProduct() {
		$this->db->select ( 'a.*,b.image,b.is_base' );
		$this->db->from ( TABLES::$PRODUCT.' as a');
		$this->db->join ( TABLES::$PRODUCT_IMAGE.' as b', 'a.product_id = b.product_id', 'inner');
		$this->db->where( 'a.product_type', 3 );
		$this->db->where( 'b.is_base', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	/* ****************************** New Implementations ************************ */
	
	public function getActiveDevices() {
		$this->db->select ( '*' )->from ( TABLES::$DEVICE_INFO );
		$this->db->where ('status',1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function getProductDetails($product_id) {
		$this->db->select ( 'a.*' )
				 ->from ( TABLES::$PRODUCT.' AS a');
		$this->db->where ('a.id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllActiveProducts() {
		$this->db->select ( 'a.*,b.image' );
		$this->db->from ( TABLES::$PRODUCT.' as a');
		$this->db->join ( TABLES::$PRODUCT_IMAGE.' as b', 'a.id = b.product_id', 'inner');
		$this->db->where( 'a.status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProducts() {
		$this->db->select ( 'a.*' )
		->from ( TABLES::$PRODUCT.' AS a');
		//$this->db->join ( TABLES::$PRODUCT_PACKS.' as b', 'a.id = b.product_id', 'inner');
		$this->db->order_by ('a.id','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addProduct($data) {
		$params = array (
				'sku' => $data['sku'],
		);
		$this->db->select ( 'sku' )->from ( TABLES::$PRODUCT )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$PRODUCT, $data);
			$product_id = $this->db->insert_id();
			return $product_id;
		} else {
			return 0;
		}
	}
	
	public function updateProduct($data) {
		$this->db->where('id',$data['id']);
		return $this->db->update ( TABLES::$PRODUCT, $data);
	}
	
	public function addProductSeo($data) {
		return $this->db->insert ( TABLES::$PRODUCT_SEO, $data);
	}
	
	public function updateProductSeo($data) {
		$this->db->where('product_id',$data['product_id']);
		return $this->db->update ( TABLES::$PRODUCT_SEO, $data);
	}
	
	public function getProductSeo($product_id) {
		$this->db->select ( 'a.*' )
				 ->from ( TABLES::$PRODUCT_SEO.' AS a');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addProductOffers($data) {
		return $this->db->insert_batch ( TABLES::$PRODUCT_PACKS, $data);
	}
	
	public function deleteProductOffers($product_id) {
		$this->db->where('product_id',$product_id);
		return $this->db->delete ( TABLES::$PRODUCT_PACKS);
	}
	
	public function getProductOffers($product_id) {
		$this->db->select ( 'a.*' )
		->from ( TABLES::$PRODUCT_PACKS.' AS a');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addProductImages($data) {
		return $this->db->insert_batch ( TABLES::$PRODUCT_IMAGE, $data);
	}
	
	public function deleteProductImages($product_id) {
		$this->db->where('product_id',$product_id);
		return $this->db->delete ( TABLES::$PRODUCT_IMAGE);
	}
	
	public function getProductImages($product_id) {
		$this->db->select ( 'a.*' )
		->from ( TABLES::$PRODUCT_IMAGE.' AS a');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addDevice($data) {
		$this->db->insert ( TABLES::$DEVICE_INFO, $data);
		return $this->db->insert_id();
	}
	
	public function updateDevice($data) {
		$this->db->where('id',$data['id']);
		return $this->db->update ( TABLES::$DEVICE_INFO, $data);
	}
	
	public function addProductDevices($data) {
		return $this->db->insert_batch ( TABLES::$PRODUCT_DEVICES, $data);
	}
	
	public function deleteProductDevices($product_id) {
		$this->db->where('product_id',$product_id);
		return $this->db->delete ( TABLES::$PRODUCT_DEVICES);
	}
	
	public function getProductDevices($product_id) {
		$this->db->select ( 'a.*,b.name,b.price' )
				 ->from ( TABLES::$PRODUCT_DEVICES.' AS a');
		$this->db->join( TABLES::$DEVICE_INFO.' AS b','a.device_id=b.id','inner');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProductKitDevices($product_id) {
		$this->db->select ( 'a.*,b.name,b.price,b.image,b.product_id as main_product_id' )
				 ->from ( TABLES::$PRODUCT_DEVICES.' AS a');
		$this->db->join( TABLES::$DEVICE_INFO.' AS b','a.device_id=b.id','inner');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateProductStock($product_id) {
		$this->db->select ( 'a.*,count(b.device_code) as available_qty' )
		->from ( TABLES::$PRODUCT_DEVICES.' AS a');
		$this->db->join( TABLES::$DEVICE_INVENTORY.' AS b','a.device_id=b.device_id','inner');
		$this->db->where ('a.product_id',$product_id);
		$this->db->where ('b.status',0);
		$this->db->group_by('a.device_id');
		$query = $this->db->get ();
		$result = $query->result_array ();
		$in_stock = 1;
		foreach ($result as $key=>$row) {
			if($row['quantity'] < $row['available_qty']) {
				$in_stock = 0;
			}
		}
		$params = array();
		$params['is_instock'] = $in_stock;
		$this->db->where('id',$product_id);
		return $this->db->update ( TABLES::$PRODUCT, $params);
	}
	
	
	public function isProductQuantityAvailable($map) {
		$this->db->select ( 'a.*,count(b.device_code) as available_qty' )
		->from ( TABLES::$PRODUCT_DEVICES.' AS a');
		$this->db->join( TABLES::$DEVICE_INVENTORY.' AS b','a.device_id=b.device_id','inner');
		$this->db->where ('a.product_id',$map['product_id']);
		$this->db->where ('b.status',0);
		$this->db->group_by('a.device_id');
		$query = $this->db->get ();
		$result = $query->result_array ();
		$in_stock = 1;
		if(count($result) > 0) {
			foreach ($result as $key=>$row) {
				if(($map['quantity']*$row['quantity']) > $row['available_qty']) {
					$in_stock = 0;
				}
			}
		} else {
			$in_stock = 0;
		}
		return $in_stock;
	}
	
	public function updateDeviceStock($map) {
		$this->db->select ( 'a.*,count(b.device_code) as available_qty' )
		->from ( TABLES::$PRODUCT_DEVICES.' AS a');
		$this->db->join( TABLES::$DEVICE_INVENTORY.' AS b','a.device_id=b.device_id','inner');
		$this->db->where ('a.product_id',$map['product_id']);
		$this->db->where ('b.status',0);
		$this->db->group_by('a.device_id');
		$query = $this->db->get ();
		$result = $query->result_array ();
		$resp = array();
		$responses = array();
		$in_stock = 1;
		if(count($result) <= 0){
			$in_stock = 0;
		}
		foreach ($result as $key=>$row) {
			$limit = $map['quantity']*$row['quantity'];
			if(($map['quantity']*$row['quantity']) > $row['available_qty']) {
				$in_stock = 0;
			}
			$this->db->select ( 'a.*' )
					 ->from ( TABLES::$DEVICE_INVENTORY.' AS a');
			$this->db->where ('a.device_id',$row['device_id']);
			$this->db->where ('a.status',0);
			$this->db->order_by('a.added_date','ASC');
			$this->db->limit($limit);
			$query = $this->db->get ();
			$devices = $query->result_array ();
			foreach ($devices as $device) {
				$response['device_id'] = $device['device_id'];
				$response['device_code'] = $device['device_code'];
				$response['status'] = 1;
				$response['sold_date'] = date('Y-m-d');
				$responses[] = $response;
			}
		}
		if($in_stock) { 
			if(count($responses) > 0) {
				$this->db->update_batch ( TABLES::$DEVICE_INVENTORY, $responses,'device_code');
				$resp['status'] = 0;
				$resp['msg'] = "Updated in stock";
				$resp['devices'] = $responses;
				
				$this->db->select ( 'a.*,SUM((CASE WHEN b.status = 0 THEN 1 ELSE 0 END)) as available_qty' )
				->from ( TABLES::$PRODUCT_DEVICES.' AS a');
				$this->db->join( TABLES::$DEVICE_INVENTORY.' AS b','a.device_id=b.device_id','left');
				$this->db->where ('a.product_id',$map['product_id']);
				$this->db->group_by('a.device_id');
				$query = $this->db->get ();
				$result = $query->result_array ();
				$in_stock = 1;
				foreach ($result as $key=>$row) {
					$limit = $map['quantity']*$row['quantity'];
					if(($row['quantity']) > $row['available_qty']) {
						$in_stock = 0;
					}
				}
				if(count($result) <= 0){
					$in_stock = 0;
				}
				if($in_stock == 0) {
					$update = array();
					$update['is_instock'] = 0;
					$this->db->where('id',$map['product_id']);
					$this->db->update ( TABLES::$PRODUCT, $update);
				}
			} else {
				$resp['status'] = 0;
				$resp['msg'] = "Product is out of stock now. (Limited quantity).";
			}
		} else {
			$resp['status'] = 0;
			$resp['msg'] = "Product is out of stock now. (Limited quantity).";
		}
		return $resp;
	}
	
	public function addProductComponents($data) {
		return $this->db->insert_batch ( TABLES::$PRODUCT_COMPONENT, $data);
	}
	
	public function updateProductComponent($data) {
		$this->db->where('id',$data['id']);
		return $this->db->update ( TABLES::$PRODUCT_COMPONENT, $data);
	}
	
	public function deleteProductComponents($product_id) {
		$this->db->where('product_id',$product_id);
		return $this->db->delete ( TABLES::$PRODUCT_COMPONENT);
	}
	
	public function deleteProductComponentById($id) {
		$this->db->where('id',$id);
		return $this->db->delete ( TABLES::$PRODUCT_COMPONENT);
	}
	
	public function getProductComponents($product_id) {
		$this->db->select ( 'a.*' )
		->from ( TABLES::$PRODUCT_COMPONENT.' AS a');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addProductTechSpecs($data) {
		return $this->db->insert_batch ( TABLES::$PRODUCT_TECH_SPEC, $data);
	}
	
	public function deleteProductTechSpecs($product_id) {
		$this->db->where('product_id',$product_id);
		return $this->db->delete ( TABLES::$PRODUCT_TECH_SPEC);
	}
	
	public function getProductTechSpecs($product_id) {
		$this->db->select ( 'a.*' )
		->from ( TABLES::$PRODUCT_TECH_SPEC.' AS a');
		$this->db->where ('a.product_id',$product_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	
}