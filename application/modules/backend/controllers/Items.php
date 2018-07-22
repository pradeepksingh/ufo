<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Controller for new menu management management system.
 *
 * @category CI_Controller
 */
class Items extends CI_Controller {
	
	function __construct() {
    	parent::__construct();
    }
    
    public function newMenu() {
    	$restid = $this->input->get('restid');
    	$id = $this->input->get('id');
    	$catname = $this->input->get('catname');
    	$this->template->set('restid',$restid);
    	$this->template->set('id',$id);
    	$this->template->set('name',$catname);
    	$this->template->set('today',date('Y-m-d'));
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('menus/AddMenu','',true);
    }
    
    public function addMainCategory() {
    
    	$map['restid'] = $this->input->post('restid');
    	$map['name'] = $this->input->post('newmname');
    	$map['sortorder'] = $this->input->post('newmsortorder');
    	$map['description'] = $this->input->post('newmdescription');
    	if (!empty($_FILES['newcimage']['name'])) {
    		$profilelocation = 'assets/images/menu/maincategory/';
    		$logo_image = uploadImage($_FILES['newcimage'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'maincategory');
    		if($logo_image['status'] == 1) {
    			$map['image'] =  $logo_image['image'];
    		} else {
    			$errors = array();
    			$error = array("image"=>$logo_image['msg']);
    			if (! empty ( $error )) {
    				array_push ( $errors, $error );
    			}
    			$errorMsg["errors"] = $errors;
    			$logo_image['errormsg'] = $errorMsg;
    			echo json_encode($logo_image);
    			exit;
    		}
    	}
    	$type = 'maincategory';
    	$this->load->library('zyk/MenuLib');
    	$data = $this->menulib->addsection($type,$map);
    	$data['status'] = 1;
    	echo json_encode($data);
    }
    
    public function updateMainCategory() {
    	$map['id'] = $this->input->post('pk');
    	$map['name'] = $this->input->post('value');
    	$this->load->library('zyk/MenuLib');
    	$data = $this->menulib->updateMainCategory($map);
    	$data['status'] = 1;
    	echo json_encode($data);
    }
    
    public function addCategory() {
    	$map['menu_mcat_id'] = $this->input->post('new_menu_mcat_id');
    	//$map['restid'] = $this->input->post('restid');
    	$map['name'] = $this->input->post('newcname');
    	$map['sortorder'] = $this->input->post('newcsortorder');
    	$map['description'] = $this->input->post('newcdescription');
    	$type = 'category';
    	
    	if (!empty($_FILES['newcimage']['name'])) {
    		$profilelocation = 'assets/images/menu/maincategory/';
    		$logo_image = uploadImage($_FILES['newcimage'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'maincategory');
    		if($logo_image['status'] == 1) {
    			$map['image'] =  $logo_image['image'];
    		} else {
    			$errors = array();
    			$error = array("image"=>$logo_image['msg']);
    			if (! empty ( $error )) {
    				array_push ( $errors, $error );
    			}
    			$errorMsg["errors"] = $errors;
    			$logo_image['errormsg'] = $errorMsg;
    			echo json_encode($logo_image);
    			exit;
    		}
    	}
    	$this->load->library('zyk/MenuLib');
    	$data = $this->menulib->addsection($type,$map);
    	$data['status'] = 1;
    	echo json_encode($data);
    }
    public function updateCategory() {
    	$map['id'] = $this->input->post('id');
    	$map['name'] = $this->input->post('name');
    	$map['sortorder'] = $this->input->post('sortorder');
    	$this->load->library('zyk/MenuLib');
    	$data = $this->menulib->updateCategory($map);
    	$data['status'] = 1;
    	echo json_encode($data);
    }
    
    public function editCategoryImage() {
    	$id = $this->input->get('id');
    	$this->template->set('id',$id);
    	$this->template->set_theme('default_theme');
    	$this->template->set_layout (false);
    	echo $this->template->build ('menus/EditCategoryImage','',true);
    }
    
    public function updateCategoryImage() {
    	$map['id'] = $this->input->post('cat_id');
    	if (!empty($_FILES['cat_image']['name'])) {
    		$profilelocation = 'assets/images/menu/category/';
    		$logo_image = uploadImage($_FILES['cat_image'],$profilelocation,array('jpeg','jpg','png','gif'),2097152,'category');
    		if($logo_image['status'] == 1) {
    			$map['image'] =  $logo_image['image'];
    		} else {
    			$errors = array();
    			$error = array("image"=>$logo_image['msg']);
    			if (! empty ( $error )) {
    				array_push ( $errors, $error );
    			}
    			$errorMsg["errors"] = $errors;
    			$logo_image['errormsg'] = $errorMsg;
    			echo json_encode($logo_image);
    			exit;
    		}
    	}
    	$this->load->library('zyk/MenuLib');
    	$data = $this->menulib->updateCategory($map);
    	$data['status'] = 1;
    	echo json_encode($data);
    }
    
	public function addMenu() {
    	$items = $this->input->post('itemid');
    	$catid = $this->input->post('catid');
    	$name = $this->input->post('name');
    	$sortorder = $this->input->post('sort');
    	$desription = $this->input->post('desription');
    	$prices = $this->input->post('price');
    	$start_time = $this->input->post('start_time');
    	$end_time = $this->input->post('end_time');
    	$start_date = $this->input->post('start_date');
    	$end_date = $this->input->post('end_date');
    	$calories = $this->input->post('color');
    	$packaging = $this->input->post('packaging');
    	$image = $this->input->post('image');
    	$has_options = $this->input->post('has_options');
    	$size = $this->input->post('size');
    	$restid = $this->input->post('restid');
    	$vat_tax = $this->input->post('vat_tax');
    	$service_tax = $this->input->post('service_tax');
    	$update = array();
    	$add = array();
    	$cnt = 0;
    	$output = $this->input->post('output');
    	foreach($name as $value) {
    			$end_date1 = ($end_date[$cnt] != "") ? $end_date[$cnt] : null;
    			$price = array('price'=>$prices[$cnt],'start_date'=>$start_date[$cnt],'size'=>$size[$cnt],'end_date'=>$end_date1,'description'=>$desription[$cnt],'start_time'=>$start_time[$cnt],'end_time'=>$end_time[$cnt],'has_options'=>$has_options[$cnt],'packaging'=>$packaging[$cnt],'color'=>$calories[$cnt]);
    			$add [] = array('name'=>$name[$cnt],'sortorder'=>$sortorder[$cnt],'restid'=>$restid,'menu_cat_id'=>$catid,'description'=>$desription[$cnt],'image'=>$image[$cnt],'video_url'=>'','vat_tax'=>$vat_tax[$cnt],'service_tax'=>$service_tax[$cnt],'price'=>$price);
    			$cnt++;
    	}
    	$this->load->library('zyk/MenuLib');
    	$data = $this->menulib->additems($add);
    	if($output != 'json')
    		redirect(base_url().'admin/menu/edit/'.$restid);
    	else 
    		echo json_encode($data);
    }
    
    public function updateMenu() {
    
    	$items = $this->input->post('itemid');
    	$option_id = $this->input->post('option_id');
    	$catid = $this->input->post('catid');
    	$name = $this->input->post('name');
    	$sortorder = $this->input->post('sort');
    	$desription = $this->input->post('desription');
    	$price = $this->input->post('price');
    	$start_time = $this->input->post('start_time');
    	$end_time = $this->input->post('end_time');
    	$start_date = $this->input->post('start_date');
    	$end_date = $this->input->post('end_date');
    	$calories = $this->input->post('color');
    	$packaging = $this->input->post('packaging');
    	$image = $this->input->post('image');
    	$is_duplicate = $this->input->post('is_duplicate');
    	$has_options = $this->input->post('has_options');
    	$size = $this->input->post('size');
    	$restid = $this->input->post('restid');
    	$img_count = count($_FILES['image']['name']);
    	$vat_tax = $this->input->post('vat_tax');
    	$service_tax = $this->input->post('service_tax');
    	for($i=0; $i < $img_count; $i++) {
	    	if (!empty($_FILES['image']['name'][$i])) {
	    		$original_file_name = clean(basename($_FILES['image']['name'][$i]));
	    		$files = explode(".",$original_file_name);
	    		$file_extention = end($files);
	    		$target_file = 'assets/images/menu/item/';
	    		$file_name = microtime(true).'_item.'.$file_extention;
	    		$target_file = $target_file.$file_name;
	    		if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
	    			$image[$i] = "images/menu/item/".$file_name;
	    		}
	    	} 
    	}
    
    	$update = array();
    	$add = array();
    	$newprice = array();
    	$cnt = 0;
    	foreach($items as $value) {
    		if($value == null || $value == 0)
    		{
    			$end_date1 = ($end_date[$cnt] != "") ? $end_date[$cnt] : null;
    			$cost = array('price'=>$price[$cnt],'start_date'=>$start_date[$cnt],'size'=>$size[$cnt],'sortorder'=>$sortorder[$cnt],'end_date'=>$end_date1,'description'=>$desription[$cnt],'start_time'=>$start_time[$cnt],'end_time'=>$end_time[$cnt],'has_options'=>$has_options[$cnt],'packaging'=>$packaging[$cnt],'color'=>$calories[$cnt]);
    			$add [] = array('name'=>$name[$cnt],'sortorder'=>$sortorder[$cnt],'restid'=>$restid,'menu_cat_id'=>$catid[$cnt],'description'=>$desription[$cnt],'image'=>$image[$cnt],'video_url'=>'','vat_tax'=>$vat_tax[$cnt],'service_tax'=>$service_tax[$cnt],'price'=>$cost);
    		}
    		else
    		{
    			$end_date1 = ($end_date[$cnt] != "") ? $end_date[$cnt] : null;
    			if($is_duplicate[$cnt] == 0)
    			{
    				$cost = array('id'=>$option_id[$cnt],'itemid'=>$value,'price'=>$price[$cnt],'start_date'=>$start_date[$cnt],'size'=>$size[$cnt],'sortorder'=>$sortorder[$cnt],'end_date'=>$end_date1,'description'=>$desription[$cnt],'start_time'=>$start_time[$cnt],'end_time'=>$end_time[$cnt],'has_options'=>$has_options[$cnt],'packaging'=>$packaging[$cnt],'color'=>$calories[$cnt]);
    				$update [] = array('id'=>$value,'name'=>$name[$cnt],'sortorder'=>$sortorder[$cnt],'restid'=>$restid,'menu_cat_id'=>$catid[$cnt],'description'=>$desription[$cnt],'image'=>$image[$cnt],'video_url'=>'','vat_tax'=>$vat_tax[$cnt],'service_tax'=>$service_tax[$cnt],'price'=>$cost);
    			}
    			else //duplicate item for a new size/price/time/date
    			{
    				$newprice [] = array('itemid'=>$value,'price'=>$price[$cnt],'start_date'=>$start_date[$cnt],'size'=>$size[$cnt],'sortorder'=>$sortorder[$cnt],'end_date'=>$end_date1,'description'=>$desription[$cnt],'start_time'=>$start_time[$cnt],'end_time'=>$end_time[$cnt],'has_options'=>$has_options[$cnt],'packaging'=>$packaging[$cnt],'color'=>$calories[$cnt]);
    			}
    		}
    		$cnt++;
    	}
    	$this->load->library('zyk/MenuLib');
    	if(count($newprice) > 0)
    	{
    		$data = $this->menulib->addprice($newprice);
    	}
    	if(count($add) > 0)
    	{
    		$data = $this->menulib->additems($add);
    		$data = $this->menulib->updateitems($update);
    	}
    	else
    	{
    		$data = $this->menulib->updateitems($update);
    	}
    	redirect(base_url().'admin/menu/edit/'.$restid);
    }
    
}