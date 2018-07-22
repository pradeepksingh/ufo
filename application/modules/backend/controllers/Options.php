<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Controller for new menu management management system.
 *
 * @category CI_Controller
 */
class Options extends CI_Controller {
	
	function __construct() {
    	parent::__construct();
    }
    
    public function newOption($restid,$optionid,$size) {
    	$item_name = $this->input->get('item_name');
    	$this->template->set('restid',$restid);
    	$this->template->set('id',$optionid);
    	$this->template->set('size',$size);
    	$this->template->set('name',$item_name);
    	$this->template->set('today',date('Y-m-d'));
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Add New Options' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'restaurants/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('menus/NewMenuOption');
    }
    
    public function addOption() {
    	$option_id = $this->input->post('option_id');
    	$item_size = $this->input->post('item_size');
    	$names = $this->input->post('ocname');
    	$image = $this->input->post('occhoice_type');
    	$optional = $this->input->post('ocoptional_flag');
    	$min = $this->input->post('ocmin_options');
    	$max = $this->input->post('ocmax_options');
    	$sortorder = $this->input->post('ocsortorder');
    	$description = $this->input->post('ocdescription');
    	$map['restid'] = $this->input->post('restid');
    	$map['type'] = 'group';
    	 
    	$ocategories = array();
    	$options = array();
    	$c = 1;
    	 
    	if(is_array($names))
    	{
    		$i = 0;
    		foreach($names as $value)
    		{
    			$c = $i + 1;
    			$oname = $this->input->post('name'.$c);
    			$osize = $this->input->post('size'.$c);
    			$oprice = $this->input->post('price'.$c);
    			$osortorder = $this->input->post('sortorder'.$c);
    			$odefault = $this->input->post('is_default'.$c);
    			$ostart_date = $this->input->post('start_date'.$c);
    			$oend_date = $this->input->post('end_date'.$c);
    			$ostart_time = $this->input->post('start_time'.$c);
    			$oend_time = $this->input->post('end_time'.$c);
    			$opackaging = $this->input->post('packaging'.$c);
    			$ocalories = $this->input->post('calories'.$c);
    			$oimage = $this->input->post('image'.$c);
    			$odescription = $this->input->post('description'.$c);
    			$cnt = 0;
    			foreach($oname as $option)
    			{
    				$end_date1 = ($oend_date[$cnt] != "") ? $oend_date[$cnt] : null;
    				$cost = array('price'=>$oprice[$cnt],'is_default'=>$odefault[$cnt],'size'=>$osize[$cnt],'sortorder'=>$osortorder[$cnt],'start_date'=>$ostart_date[$cnt],'end_date'=>$end_date1,'start_time'=>$ostart_time[$cnt],'end_time'=>$oend_time[$cnt],'calories'=>$ocalories[$cnt],'description'=>$odescription[$cnt]);
    				$options [] = array('sub_item_name'=>$oname[$cnt],'image'=>$oimage[$cnt],'description'=>$odescription[$cnt],'price'=>$cost);
    				$cnt++;
    			}
    			$ocategories [] = array('id'=>$option_id,'size'=>$item_size,'option_cat_name'=>$value,'sortorder'=>$sortorder[$i],'choice_type'=>$image[$i],'description'=>$description[$i],'optional_flag'=>$optional[$i],'min_options'=>$min[$i],'max_options'=>$max[$i],'options'=>$options);
    			unset($options);
    			$i++;
    		}
    	}
    	unset($items);
    	$map['structure'] = $ocategories;
    	$this->load->library('zyk/MenuLib');
    	$this->menulib->addMenuOptions($map);
    	redirect(base_url().'admin/menu/edit/'.$map['restid']);
    }
    
    public function editOption($restid,$optionid,$size) {
    	$this->load->library('zyk/MenuLib');
    	$template = $this->menulib->getOptionTemplate(array('restid'=>$restid,'option_id'=>$optionid));
    	$group = $this->groupOptions($template['categories'], $template['options']);
    	$item_name = $this->input->get('item_name');
    	$this->template->set('restid',$restid);
    	$this->template->set('id',$optionid);
    	$this->template->set('size',$size);
    	$this->template->set('name',$item_name);
    	$this->template->set('today',date('Y-m-d'));
    	$this->template->set('cat_cnt',count($template['categories']));
    	$this->template->set('group',$group);
    	$this->template->set_theme('default_theme');
    	$this->template->set_layout ('backend')
    	->title ( 'Administrator | Add New Options' )
    	->set_partial ( 'header', 'partials/header' )
    	->set_partial ( 'leftnav', 'restaurants/menu' )
    	->set_partial ( 'footer', 'partials/footer' );
    	$this->template->build ('menus/EditMenuOptions');
    }
    
    public function updateOption() {
    	$restid = $this->input->post('restid');
    	$option_id = $this->input->post('option_id');
    	$item_size = $this->input->post('item_size');
    	$names = $this->input->post('ocname');
    	$image = $this->input->post('occhoice_type');
    	$optional = $this->input->post('ocoptional_flag');
    	$option_cat_id = $this->input->post('option_cat_id');
    	$min = $this->input->post('ocmin_options');
    	$max = $this->input->post('ocmax_options');
    	$cat_sub_item_key = $this->input->post('cat_sub_item_key');
    	$sortorder = $this->input->post('ocsortorder');
    	$description = $this->input->post('ocdescription');
    	$map['restid'] = $restid;
    	
    	$ocategories = array();
    	$options = array();
    	$newoptions = array();
    	$newcategories = array();
    	$newcoptions = array();
    	$addcategories = array();
    	$addoptions = array();
    	$c = 1;
    	
    	if(is_array($names))
    	{
    		$i = 0;
    		foreach($names as $value)
    		{
    			$c = $i + 1;
    			if(!empty($option_cat_id[$i]) && $option_cat_id[$i] != null)
    			{
    				$sub_item_id = $this->input->post('sub_item_id'.$c);
    				$oname = $this->input->post('name'.$c);
    				$osize = $this->input->post('size'.$c);
    				$oprice = $this->input->post('price'.$c);
    				$osortorder = $this->input->post('sortorder'.$c);
    				$odefault = $this->input->post('is_default'.$c);
    				$ostart_date = $this->input->post('start_date'.$c);
    				$oend_date = $this->input->post('end_date'.$c);
    				$ostart_time = $this->input->post('start_time'.$c);
    				$oend_time = $this->input->post('end_time'.$c);
    				$opackaging = $this->input->post('packaging'.$c);
    				$ocalories = $this->input->post('calories'.$c);
    				$oimage = $this->input->post('image'.$c);
    				$odescription = $this->input->post('description'.$c);
    				$cnt = 0;
    				foreach($oname as $option)
    				{
    					if(!empty($sub_item_id[$cnt]) && $sub_item_id[$cnt] != null)
    					{
    						$end_date1 = ($oend_date[$cnt] != "") ? $oend_date[$cnt] : null;
    						$cost = array('sub_item_id'=>$sub_item_id[$cnt],'price'=>$oprice[$cnt],'is_default'=>$odefault[$cnt],'size'=>$osize[$cnt],'sortorder'=>$osortorder[$cnt],'start_date'=>$ostart_date[$cnt],'end_date'=>$end_date1,'start_time'=>$ostart_time[$cnt],'end_time'=>$oend_time[$cnt],'calories'=>$ocalories[$cnt],'description'=>$odescription[$cnt]);
    						$options [] = array('sub_item_id'=>$sub_item_id[$cnt],'sub_item_name'=>$oname[$cnt],'image'=>$oimage[$cnt],'description'=>$odescription[$cnt],'price'=>$cost);
    						$cnt++;
    					}
    					else /* new options within the same category*/
    					{
    						$end_date1 = ($oend_date[$cnt] != "") ? $oend_date[$cnt] : null;
    						$cost = array('price'=>$oprice[$cnt],'is_default'=>$odefault[$cnt],'size'=>$osize[$cnt],'sortorder'=>$osortorder[$cnt],'start_date'=>$ostart_date[$cnt],'end_date'=>$end_date1,'start_time'=>$ostart_time[$cnt],'end_time'=>$oend_time[$cnt],'calories'=>$ocalories[$cnt],'description'=>$odescription[$cnt]);
    						$newoptions [] = array('sub_item_name'=>$oname[$cnt],'image'=>$oimage[$cnt],'description'=>$odescription[$cnt],'price'=>$cost,'index'=>$c-1);
    						$cnt++;
    					}
    				}
    				$ocategories [] = array('id'=>$option_id,'size'=>$item_size,'option_cat_id'=>$option_cat_id[$i],'new_sub_item_key'=>$cat_sub_item_key[$i],'option_cat_name'=>$value,'sortorder'=>$sortorder[$i],'choice_type'=>$image[$i],'description'=>$description[$i],'optional_flag'=>$optional[$i],'min_options'=>$min[$i],'max_options'=>$max[$i],'options'=>$options);
    				unset($options);
    			}
    			else /* new options category along with new options*/
    			{
    				$oname = $this->input->post('name'.$c);
    				$osize = $this->input->post('size'.$c);
    				$oprice = $this->input->post('price'.$c);
    				$osortorder = $this->input->post('sortorder'.$c);
    				$odefault = $this->input->post('is_default'.$c);
    				$ostart_date = $this->input->post('start_date'.$c);
    				$oend_date = $this->input->post('end_date'.$c);
    				$ostart_time = $this->input->post('start_time'.$c);
    				$oend_time = $this->input->post('end_time'.$c);
    				$opackaging = $this->input->post('packaging'.$c);
    				$ocalories = $this->input->post('calories'.$c);
    				$oimage = $this->input->post('image'.$c);
    				$odescription = $this->input->post('description'.$c);
    				$cnt = 0;
    				foreach($oname as $option)
    				{
    					$end_date1 = ($oend_date[$cnt] != "") ? $oend_date[$cnt] : null;
    					$cost = array('price'=>$oprice[$cnt],'is_default'=>$odefault[$cnt],'size'=>$osize[$cnt],'sortorder'=>$osortorder[$cnt],'start_date'=>$ostart_date[$cnt],'end_date'=>$end_date1,'start_time'=>$ostart_time[$cnt],'end_time'=>$oend_time[$cnt],'calories'=>$ocalories[$cnt],'description'=>$odescription[$cnt]);
    					$newcoptions [] = array('sub_item_name'=>$oname[$cnt],'image'=>$oimage[$cnt],'description'=>$odescription[$cnt],'price'=>$cost);
    					$cnt++;
    				}
    				$newcategories [] = array('id'=>$option_id,'size'=>$item_size,'option_cat_name'=>$value,'sortorder'=>$sortorder[$i],'choice_type'=>$image[$i],'description'=>$description[$i],'optional_flag'=>$optional[$i],'min_options'=>$min[$i],'max_options'=>$max[$i],'options'=>$newcoptions);
    				unset($newcoptions);
    			}
    			$i++;
    		}
    	
    		if(count($newoptions) > 0)
    		{
    			foreach($newoptions as $option) {
    				$update_index = $this->input->post('cat_sub_item_key');
    				$addoptions [] = array('sub_item_name'=>$option['sub_item_name'],'image'=>$option['image'],'description'=>$option['description'],'price'=>$option['price'],'new_sub_item_key'=>$update_index[$option['index']]);
    			}
    		}
    	}
    	$map['structure'] = $ocategories;
    	$this->load->library('zyk/MenuLib');
    	if(count($newcategories) > 0) {
    		$data['structure'] = $newcategories;
    		$data['restid'] = $restid;
    		$data['type'] = 'group';
    		$this->menulib->addMenuOptions($data);
    	}
    	if(count($addoptions) > 0 ) {
    		$data['structure'] = $addoptions;
    		$data['restid'] = $restid;
    		$data['type'] = 'single';
    		$this->menulib->addMenuOptions($data);
    	}
    	$this->menulib->updateMenuOptions($map);
    	unset($ocategories);unset($items);unset($newcategories);unset($options);unset($newcoptions);unset($newoptions);
    	redirect(base_url().'admin/menu/edit/'.$map['restid']);
    }
    
    public function uploadPopup() {
    	$restid = $this->input->get('restid');
    	$option_id = $this->input->get('option_id');
    	$size = $this->input->get('size');
    	$this->template->set('restid',$restid);
    	$this->template->set('option_id',$option_id);
    	$this->template->set('size',$size);
    	$this->template->set_theme('default_theme');
    	$this->template->set_layout (false);
    	echo $this->template->build ('menus/UploadOptions','',true);
    }
    
    public function uploadOptions() {
    	$restid = $this->input->post('restid');
    	$option_id = $this->input->post('option_id');
    	$item_size = $this->input->post('item_size');
    	$file = $_FILES['menu']['name'];
    	$map['restid'] = $restid;
    	$map['type'] = 'group';
    	$uploadFile = "";
    	if($file != '') {
    		$filename = $restid.'_menu_options_'.basename($file);
    		$uploadFile = FCPATH.'assets/documents/menus/'.$filename;
    		if(!move_uploaded_file($_FILES['menu']['tmp_name'],$uploadFile)){
    			echo 'Menu could not be uploaded';
    			exit;
    		}
    	}
    	$this->load->library('MyExcel');
		$inputFileType = PHPExcel_IOFactory::identify($uploadFile);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($uploadFile);
    	$ocategories = array();
    	$sortorder = 1;
    	$errors = array();
    	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    		foreach ($worksheet->getRowIterator() as $row) {
    			$is_empty = true;
    			for($col = 0; $col < 18; $col++ ){
    				$col_value = trim($worksheet->getCellByColumnAndRow($col, $row->getRowIndex())->getValue());
    				if($col_value != null && strlen($col_value) > 0) {
    					$is_empty = false;
    				}
    			}
    			if (!$is_empty) {
	    			$rowIndex = $row->getRowIndex();
	    			$cell = $worksheet->getCell('A' . $rowIndex);
	    			$ocategory = $cell->getCalculatedValue();
	    			$ocategories[$ocategory]['option_cat_name'] = $ocategory;
	    			if(empty($ocategories[$ocategory]['sortorder']) || $ocategories[$ocategory]['sortorder'] == null)
	    				$ocategories[$ocategory]['sortorder'] = $sortorder++;
	    			$cell = $worksheet->getCell('B' . $rowIndex);
	    			$choice_type = $cell->getCalculatedValue();
	    			if(!is_numeric($choice_type)) {
	    				$error = 'select option chocie type not valid at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$ocategories[$ocategory]['choice_type'] =  $choice_type;
	    			$cell = $worksheet->getCell('C' . $rowIndex);
	    			$optional_flag = $cell->getCalculatedValue();
	    			if(!is_numeric($optional_flag)) {
	    				$error = 'optional format not valid at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$ocategories[$ocategory]['optional_flag'] =  $optional_flag;
	    			$cell = $worksheet->getCell('D' . $rowIndex);
	    			$ocategories[$ocategory]['max_options'] =  $cell->getCalculatedValue();
	    			$cell = $worksheet->getCell('E' . $rowIndex);
	    			$ocategories[$ocategory]['min_options'] =  $cell->getCalculatedValue();
	    			$cell = $worksheet->getCell('F' . $rowIndex);
	    			$ocategories[$ocategory]['description'] =  $cell->getCalculatedValue();
	    			$cell = $worksheet->getCell('G' . $rowIndex);
	    			$item['sub_item_name'] =  $cell->getCalculatedValue();
	    			if($item['sub_item_name'] == null || $item['sub_item_name'] == '') {
	    				$error = 'Option name can not empty at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$cell = $worksheet->getCell('H' . $rowIndex);
	    			$item['size'] =  $cell->getCalculatedValue();
	    			if($item['size'] == null || $item['size']== '') {
	    				$error = 'Option size can not empty at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$cell = $worksheet->getCell('I' . $rowIndex);
	    			$item['price'] =  $cell->getCalculatedValue();
	    			if(!is_numeric($item['price'])) {
	    				$error = 'Option price is empty or invalid at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$cell = $worksheet->getCell('J' . $rowIndex);
	    			$item['is_default'] =   $cell->getCalculatedValue();
	    			$cell = $worksheet->getCell('K' . $rowIndex);
	    			$item['start_date'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
	    			if($item['start_date'] == null || $item['start_date']== '') {
	    				$error = 'Option start date is empty at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$cell = $worksheet->getCell('L' . $rowIndex);
	    			$item['end_date'] =  PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
	    			if($item['end_date'] == '0000-00-00')
	    			{
	    				$error = 'Option End date format incorrect at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			if(strtotime($item['end_date']) - strtotime($item['start_date']) < 0 && trim($item['end_date']) <> "")
	    			{
	    				$error = 'Option End date cannot be lesser than start date at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			if(trim($item['end_date']) == "") $item['end_date'] = null;
	    			$cell = $worksheet->getCell('M' . $rowIndex);
	    			$item['start_time'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
	    			if($item['start_time'] == null || $item['start_time']== '') {
	    				$error = 'Option start time is empty at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$cell = $worksheet->getCell('N' . $rowIndex);
	    			$item['end_time'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
	    			if($item['end_time'] == null || $item['end_time']== '') {
	    				$error = 'Option end time is empty at row '.$rowIndex;
	    				if (! empty ( $error )) {
	    					array_push ( $errors, $error );
	    				}
	    			}
	    			$cell = $worksheet->getCell('O' . $rowIndex);
	    			$item['packaging'] =  $cell->getCalculatedValue();
	    			$cell = $worksheet->getCell('P' . $rowIndex);
	    			$item['calories'] =  $cell->getCalculatedValue();
	    			$item['description'] = '';
	    			$item['image'] = '';
	    			$ocategories[$ocategory]['options'] []  = $item;
	    		}
    		}
    		break;
    	}
    	if(count($errors) > 0) {
    		$data['status'] = 0;
    		$data['error_msg'] = $errors;
    	} else {
	    	foreach($ocategories as $key=>$category) {
	    		$options = $category['options'];
	    		foreach($options as $key2=>$row2)
	    		{
	    			$cost = array('price'=>$row2['price'],'is_default'=>$row2['is_default'],'size'=>$row2['size'],'sortorder'=>$key2+1,'start_date'=>$row2['start_date'],'end_date'=>$row2['end_date'],'start_time'=>$row2['start_time'],'end_time'=>$row2['end_time'],'calories'=>$row2['calories'],'description'=>$row2['description']);
	    			$options[$key2]['price'] = $cost;
	    		}
	    		$ocategories[$key]['options'] = $options;
	    	}
	    	$newocategories = array();
	    	$i = 0;
	    	foreach($ocategories as $key=>$category) {
	    		$category['id'] = $option_id;
	    		$category['size'] = $item_size;
	    		$newocategories [] = $category;
	    	}
	    	$map['structure'] = $newocategories;
	    	$this->load->library('zyk/MenuLib');
	    	$this->menulib->addMenuOptions($map);
	    	$data['msg'] = 'Options uploaded successfully.';
	    	$data['status'] = 1;
    	}
    	echo json_encode($data);
    }
    
    public function downloadOptions($restid,$option_id) {
    	$map['restid'] = $restid;
    	$map['option_id'] = $option_id;
    	$this->load->library('zyk/MenuLib');
    	$template = $this->menulib->getOptionTemplate($map);
    	$filename = FCPATH.'assets/documents/menus/item_options_'.$map['option_id'].'.xls';
    	try {
    		/* generate html and spit out*/
    		$data = array();
    		$batch = array();
    		foreach($template['categories'] as $key1=>$row1)
    		{
    			foreach($template['options'] as $key2=>$row2)
    			{
    				if($row1['new_sub_item_key'] == $row2['new_sub_item_key'])
    				{
    					$batch ['Category'] = $row1['option_cat_name'];
    					$batch ['Choice'] = $row1['choice_type'];
    					$batch ['is Optional'] = $row1['optional_flag'];
    					$batch ['Min Options'] = $row1['min_options'];
    					$batch ['Max Options'] = $row1['max_options'];
    					$batch ['Description'] = $row1['description'];
    					$batch ['Sub Item Name'] = $row2['sub_item_name'];
    					$batch ['Size'] = $row2['size'];
    					$batch ['Price'] = $row2['price'];
    					$batch ['Is Default'] = $row2['is_default'];
    					$batch ['Start Date'] = $row2['start_date'];
    					if(!empty($row2['end_date']))
    					$batch ['End Date'] = $row2['end_date'];
    					else 
    					$batch ['End Date'] = "";
    					$batch ['Start Time'] = $row2['start_time'];
    					$batch ['End Time'] = $row2['end_time'];
    					if(!empty($row2['packaging']))
    					$batch ['Packaging'] = $row2['packaging'];
    					else 
    						$batch ['Packaging'] = 0;
    					$batch ['Calories'] = $row2['calories'];
    					if(!empty($row2['max_options']))
    					$batch ['Max Options'] = $row2['max_options'];
    					else 
    					$batch ['Max Options'] = 0;
    					$data [] = $batch;
    					unset($batch);
    				}
    			}
    		}
    		$this->load->helper('utility');
    		downloadExcel($data,'item_options.xls');
    	}catch(Exception $e) {
    		echo json_encode($data);
    	}
    }
    
    private function groupOptions( $categroies , $options ) {
    	$group = array();
    	$cats = array();
    	$i = 0;
    	foreach($categroies as $key=>$row) {
    		$group [$i] = $row;
    		foreach($options as $key1=>$row1)
    		{
    			if($row1['new_sub_item_key'] == $row['new_sub_item_key'])
    			{
    				$cats [] = $row1;
    			}
    		}
    		$group [$i]['options']  = $cats;
    		unset($cats);
    		$i++;
    	}
    	return $group;
    }
    
}