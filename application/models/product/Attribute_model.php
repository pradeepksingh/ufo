<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Attribute_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	
	
	public function addAttributeGroup($attrgroup) {
		$data = array ();
		$params = array (
				'name' => $attrgroup['name']
		);
		$this->db->select ( 'attribute_group_id' )->from ( TABLES::$ATTRIBUTE_GROUP)->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ATTRIBUTE_GROUP, $attrgroup);
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Attribute Group name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveAttributeGroup() {
		
		$this->db->select ( 'attribute_group_id, name' )->from ( TABLES::$ATTRIBUTE_GROUP)->where ('status', 1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
		
	public function getAttributeGroupById($id) {
		$this->db->select ( '*' )->from ( TABLES::$ATTRIBUTE_GROUP );
		$this->db->where ('attribute_group_id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateAttributeGroup($item) {
		$data = array ();
		$params = array (
				'name' => $item ['name'],
				'attribute_group_id !=' => $item ['attribute_group_id']
		);
		$this->db->select ( 'attribute_group_id' )->from ( TABLES::$ATTRIBUTE_GROUP )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'attribute_group_id', $item ['attribute_group_id'] );
			$this->db->update ( TABLES::$ATTRIBUTE_GROUP, $item );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Attribute group name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function addAttribute($attr) {
		$data = array ();
		$params = array (
				'name' => $attr['name']
		);
		$this->db->select ( 'attribute_id' )->from ( TABLES::$ATTRIBUTE)->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ATTRIBUTE, $attr);
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Attribute name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveAttribute() {
	
		$this->db->select ( '*' )->from ( TABLES::$ATTRIBUTE)->where ('status', 1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAttributeById($id) {
		$this->db->select ( '*' )->from ( TABLES::$ATTRIBUTE );
		$this->db->where ('attribute_id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateAttribute($item) {
		$data = array ();
		$params = array (
				'name' => $item ['name'],
				'attribute_id !=' => $item ['attribute_id']
		);
		$this->db->select ( 'attribute_id' )->from ( TABLES::$ATTRIBUTE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'attribute_id', $item ['attribute_id'] );
			$this->db->update ( TABLES::$ATTRIBUTE, $item );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Attribute name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	
	
	public function addCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'parent_id' => $cat ['parent_id'],
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
		$this->db->select ( 'a.id, a.name, a.status, b.id as parent_id, b.name as parent_name' )->from ( TABLES::$MENU_MAIN_CATEGORY.' as a' )->join(TABLES::$MENU_MAIN_CATEGORY.' as b', 'a.parent_id = b.id', 'Left');
		$this->db->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveCategories1() {
		$this->db->select ( 'a.id, a.name, a.parent_id' )->from ( TABLES::$MENU_MAIN_CATEGORY.' as a' );
		$this->db->order_by ('a.id','ASC');
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
	
	
	
	public function productAttribute($attrgrp) {
		echo $attrgrp['attribute_group_id'];
		$this->db->select ( '*' )->from ( TABLES::$ATTRIBUTE )->where('attribute_group_id', $attrgrp['attribute_group_id']);
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		//print_r($result);
		return $result;
	}
	
}