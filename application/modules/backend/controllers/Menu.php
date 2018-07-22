<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Controller for new menu management management system.
 *
 * @category CI_Controller
 */
class Menu extends CI_Controller {
	
	function __construct() {
    	parent::__construct();
    }
	
	public function index() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/MenuLib');
		$cityid = $this->input->get('cityid');
		$restaurants = array();
		$areas = array();
		$cities = $this->general->getCities();
		$map = array();
		$map['areaid'] = $this->input->get('areaid');
		$restaurants = $this->menulib->getRestaurants('');
		if($this->input->get('areaid') > 0) {
			$restaurants = $this->menulib->getRestaurants($map);
			if($cityid > 0)
			$areas = $this->general->getAreasByCityId($cityid);
		}
		
		$this->template->set('cities',$cities);
		$this->template->set('areaid',$map['areaid']);
		$this->template->set('cityid',$cityid);
		$this->template->set('areas',$areas);
		$this->template->set('restaurants',$restaurants);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Restaurants' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('menus/MenuList');
	}
	
	public function searchMenu() {
		$this->load->library('zyk/MenuLib');
		$map['areaid'] = $this->input->get('areaid');
		$map['status'] = $this->input->get('status');
		$restaurants = $this->menulib->getRestaurants($map);
		echo json_encode($restaurants);
	}
	
	public function uploadMenu($restid) {
		$this->template->set('restid',$restid);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('menus/Upload','',true);
	}
	
	public function updateMenu($restid) {
		$this->template->set('restid',$restid);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('menus/Update','',true);
	}
	
	public function import() {
		$errors = array();
		$errorMsg = array();
		$map = array();
		$type = $this->input->post('type',TRUE);
		$restid = $this->input->post('restid',TRUE);
		$file = $_FILES['menu']['name'];
		if($file != '') {
			$filename = $restid.'_menu_export_'.basename($file);
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
		$c = 0;
		$item_cnt = 0;
		if($type == 'new') //add
		{
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				$mcategories[$i]['name'] = ucfirst($worksheet->getTitle());
				$mcategories[$i]['sortorder'] = $i+1;
				$mcategories[$i]['restid'] = $restid;
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
						$item['size'] =  $cell->getCalculatedValue();
						if($item['size'] == null || $item['size']== '') {
							$error = 'Item size is empty at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						$cell = $worksheet->getCell('D' . $rowIndex);
						$item['price'] =  $cell->getCalculatedValue();
						if($item['price'] == '' || (!is_numeric($item['price']) && substr_count($item['price'],'-') <= 0)) {
							$error = 'Item price is empty or invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						$cell = $worksheet->getCell('E' . $rowIndex);
						$item['start_date'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
						if($item['start_date'] == null || $item['start_date']== '') {
							$item['start_date'] = date('Y-m-d');
						}
						$cell = $worksheet->getCell('F' . $rowIndex);
						$item['end_date'] =  PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
						if($item['end_date'] == '0000-00-00')
						{
							$error = 'End date format incorrect at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						if((strtotime($item['end_date']) - strtotime($item['start_date']) < 0) && trim($item['end_date']!=""))//SDA 28thAug
						{
							$error = 'End date cannot be lesser than start date at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
						$cell = $worksheet->getCell('G' . $rowIndex);
						$item['start_time'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
						if($item['start_time'] == null || $item['start_time']== '') {
							$item['start_time'] = '00:00';
						}
						$cell = $worksheet->getCell('H' . $rowIndex);
						$item['end_time'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
						if($item['end_time'] == null || $item['end_time']== '') {
							$item['end_time'] = '23:59';
						}
						$cell = $worksheet->getCell('I' . $rowIndex);
						$item['packaging'] =  $cell->getCalculatedValue();
						$cell = $worksheet->getCell('J' . $rowIndex);
						$item['color'] =  $cell->getCalculatedValue();
						$cell = $worksheet->getCell('K' . $rowIndex);
						$item['description'] =  $cell->getCalculatedValue();
						$cell = $worksheet->getCell('L' . $rowIndex);
						$item['is_dry'] =  $cell->getCalculatedValue();
						$cell = $worksheet->getCell('M' . $rowIndex);
						if(!empty($cell->getCalculatedValue()))
							$item['vat_tax'] =  $cell->getCalculatedValue();
						else 
							$item['vat_tax'] =  0;
						$cell = $worksheet->getCell('N' . $rowIndex);
						if(!empty($cell->getCalculatedValue()))
							$item['service_tax'] =  $cell->getCalculatedValue();
						else 
							$item['service_tax'] =  0;
						$categories[ucfirst($worksheet->getTitle()).'_'.$category]['items'] []  = $item;
						$cell = $worksheet->getCell('O' . $rowIndex);
						$item['sortorder'] =  $cell->getCalculatedValue();
					}
				}
				if(count($categories) > 0)
				$mcategories[$i]['categories'] = $categories;
				unset($categories);
				$i++;
			}
			
			if (count($errors) > 0) {
				$map['message'] = 'Failed to upload menu.';
				$map['status'] = 0;
				$map['errors'] = $errors;
			} else {
				$menu = array();
				$menu['restid'] = $restid;
				$menu['acpuser'] = $this->session->userdata('adminsession')['id'];
				$menu['structure'] = $mcategories;
				$this->load->library('zyk/MenuLib');
				$map = $this->menulib->uploadMenu($menu);
			}
			echo json_encode($map);
		}
	}
	
	public function importUpdate() {
		$errors = array();
		$errorMsg = array();
		$map = array();
		$type = $this->input->post('type',TRUE);
		$restid = $this->input->post('restid',TRUE);
		$file = $_FILES['menu']['name'];
		if($file != '') {
			$filename = $restid.'_menu_export_'.basename($file);
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
		$c = 0;
		$item_cnt = 0;
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$mcat = explode("#",$worksheet->getTitle());
			foreach ($worksheet->getRowIterator() as $row) {
				$is_empty = true;
				for($col = 0; $col < 16; $col++ ){
					$col_value = $worksheet->getCellByColumnAndRow($col, $row->getRowIndex())->getValue();
					if($col_value != null && strlen($col_value) > 0) {
						$is_empty = false;
					}
				}
				if (!$is_empty) {
					if(!empty($mcat[1])) {
						$item['mcatid'] = $mcat[1];
					} else {
						$item['mcatid'] = null;
					}
					$item['mcategory'] = ucfirst($mcat[0]);
					$rowIndex = $row->getRowIndex();
					$cell = $worksheet->getCell('A' . $rowIndex);//category id
					$item['catid'] = $cell->getCalculatedValue();
					if($item['catid'] != null)
					{
						if(!is_numeric($item['catid'])) {
							$error = 'Category format invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
							if (! empty ( $error )) {
								array_push ( $errors, $error );
							}
						}
					}
					$cell = $worksheet->getCell('B' . $rowIndex);//category id
					$item['category'] = ucfirst($cell->getCalculatedValue());
						
					$cell = $worksheet->getCell('C' . $rowIndex);//option_id
					$item['itemid'] = $cell->getCalculatedValue();
					if($item['itemid'] != '' && !is_numeric($item['itemid'])) {
						$error = 'Item ID format invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
						if (! empty ( $error )) {
							array_push ( $errors, $error );
						}
					}
					$cell = $worksheet->getCell('D' . $rowIndex);//itemid
					$item['option_id'] = $cell->getCalculatedValue();
					if($item['option_id'] != '' && !is_numeric($item['option_id'])) {
						$error = 'OptionID format invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
						if (! empty ( $error )) {
							array_push ( $errors, $error );
						}
					}
					$cell = $worksheet->getCell('E' . $rowIndex);
					$item['name'] = ucfirst($cell->getCalculatedValue());
					$cell = $worksheet->getCell('F' . $rowIndex);
					$item['price'] = $cell->getCalculatedValue();
					if($item['price'] == '' || (!is_numeric($item['price']) && substr_count($item['price'],'-') <= 0)) {
						$error = 'Price format invalid at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
						if (! empty ( $error )) {
							array_push ( $errors, $error );
						}
					}
					$cell = $worksheet->getCell('G' . $rowIndex);
					$item['size'] = $cell->getCalculatedValue();
					$cell = $worksheet->getCell('H' . $rowIndex);
					$item['description'] = $cell->getFormattedValue();
					$cell = $worksheet->getCell('I' . $rowIndex);
					$item['posItemID'] = $cell->getCalculatedValue();
					$cell = $worksheet->getCell('J' . $rowIndex);
					$item['start_date'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
					if($item['start_date'] == null || $item['start_date']== '') {
						$item['start_date'] = date('Y-m-d');
					}
					$cell = $worksheet->getCell('K' . $rowIndex);
					$item['end_date'] = $cell->getCalculatedValue();
					if($item['end_date'] != "")
						$item['end_date'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
					else
						$item['end_date'] = null;
					if($item['end_date'] == '0000-00-00')
					{
						$error = 'End date format incorrect at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
						if (! empty ( $error )) {
							array_push ( $errors, $error );
						}
					}
					if((strtotime($item['end_date']) - strtotime($item['start_date']) < 0) && trim($item['end_date']!="")) //SDA 28thAug
					{
						$error = 'End date cannot be lesser than start date at row '.$rowIndex.' of sheet '.$worksheet->getTitle();
						if (! empty ( $error )) {
							array_push ( $errors, $error );
						}
					}
					$cell = $worksheet->getCell('L' . $rowIndex);
					$item['start_time'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
					if($item['start_time'] == null || $item['start_time']== '') {
						$item['start_time'] = '00:00';
					}
					$cell = $worksheet->getCell('M' . $rowIndex);
					$item['end_time'] =   PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
					if($item['end_time'] == null || $item['end_time']== '') {
						$item['end_time'] = '23:59';
					}
					$cell = $worksheet->getCell('N' . $rowIndex);
					$item['packaging'] = $cell->getCalculatedValue();
					$cell = $worksheet->getCell('O' . $rowIndex);
					$item['color'] = $cell->getCalculatedValue();
					$cell = $worksheet->getCell('P' . $rowIndex);
					$item['is_dry'] = $cell->getCalculatedValue();
					$cell = $worksheet->getCell('Q' . $rowIndex);
					if(!empty($cell->getCalculatedValue()))
						$item['vat_tax'] =  $cell->getCalculatedValue();
					else
						$item['vat_tax'] =  0;
					$cell = $worksheet->getCell('R' . $rowIndex);
					if(!empty($cell->getCalculatedValue()))
						$item['service_tax'] =  $cell->getCalculatedValue();
					else
						$item['service_tax'] =  0;
					$cell = $worksheet->getCell('S' . $rowIndex);
					$item['sortorder'] =  $cell->getCalculatedValue();
					$batch [] = $item;
				}
			}
		}
		
		if (count($errors) > 0) {
			$map['message'] = 'Failed to upload menu.';
			$map['status'] = 0;
			$map['errors'] = $errors;
		} else {
			$this->load->library('zyk/MenuLib');
			$update = array();
			$add = array();
			$price_batch = array();
			/* update functionality*/
			$duplicates = array();
			foreach($batch as $key=>$item)
			{
				$c++;
				$encode = base64_encode($item['mcategory']);
				$encode1 = base64_encode($item['category']);
				if($item['mcatid'] == null) //new section
				{
					if(count($mcategories[$encode]['categories']) <= 0) unset($categories);
					$mcategories[$encode]['name'] = $item['mcategory'];
					$mcategories[$encode]['restid'] = $restid;
					if(empty($mcategories[$encode]['sortorder']) || $mcategories[$encode]['sortorder'] == null)
						$mcategories[$encode]['sortorder'] = $c;
					$categories[$encode.'_'.$encode1]['name'] = $item['category'];
					$categories[$encode.'_'.$encode1]['items'][] = array('itemid'=>$item['itemid'],'option_id'=>$item['option_id'],'name'=>$item['name'],'posItemID'=>$item['posItemID'],'price'=>$item['price'],'start_date'=>$item['start_date'],'size'=>$item['size'],'end_date'=>$item['end_date'],'description'=>$item['description'],'start_time'=>$item['start_time'],'end_time'=>$item['end_time'],'has_options'=>0,'packaging'=>$item['packaging'],'color'=>$item['color'],'is_dry'=>$item['is_dry'],'vat_tax'=>$item['vat_tax'],'service_tax'=>$item['service_tax'],'sortorder'=>$item['sortorder']);
					$mcategories[$encode]['categories'] = $categories;
				}
				else if($item['catid'] == null)
				{
					if(count($mcategories[$encode]['categories']) <= 0) unset($categories);
					$mcategories[$encode]['menu_mcat_id'] = $item['mcatid'];
					$mcategories[$encode]['name'] = $item['mcategory'];
					if($mcategories[$encode]['sortorder'] == null)
						$mcategories[$encode]['sortorder'] = $c;
					$categories[$encode.'_'.$encode1]['name'] = $item['category'];
					$categories[$encode.'_'.$encode1]['items'][] = array('itemid'=>$item['itemid'],'option_id'=>$item['option_id'],'name'=>$item['name'],'posItemID'=>$item['posItemID'],'price'=>$item['price'],'start_date'=>$item['start_date'],'size'=>$item['size'],'end_date'=>$item['end_date'],'description'=>$item['description'],'start_time'=>$item['start_time'],'end_time'=>$item['end_time'],'has_options'=>0,'packaging'=>$item['packaging'],'color'=>$item['color'],'is_dry'=>$item['is_dry'],'vat_tax'=>$item['vat_tax'],'service_tax'=>$item['service_tax'],'sortorder'=>$item['sortorder']);
					$mcategories[$encode]['categories'] = $categories;
					$i++;
				}
				else if($item['itemid'] == null)
				{
					$cost = array('price'=>$item['price'],'start_date'=>$item['start_date'],'size'=>$item['size'],'end_date'=>$item['end_date'],'description'=>$item['description'],'start_time'=>$item['start_time'],'end_time'=>$item['end_time'],'has_options'=>0,'packaging'=>$item['packaging'],'color'=>$item['color'],'is_dry'=>$item['is_dry']);
					$add [] = array('name'=>$item['name'],'restid'=>$restid,'menu_cat_id'=>$item['catid'],'description'=>$item['description'],'video_url'=>'','posItemID'=>$item['posItemID'],'menu_id'=>$menu_id,'price'=>$cost,'vat_tax'=>$item['vat_tax'],'service_tax'=>$item['service_tax'],'sortorder'=>$item['sortorder']);
				}
				else
				{
					if(empty($duplicates[$item['itemid']]))
					{
						$cost = array('id'=>$item['option_id'],'itemid'=>$item['itemid'],'price'=>$item['price'],'start_date'=>$item['start_date'],'size'=>$item['size'],'end_date'=>$item['end_date'],'description'=>$item['description'],'start_time'=>$item['start_time'],'end_time'=>$item['end_time'],'packaging'=>$item['packaging'],'color'=>$item['color'],'is_dry'=>$item['is_dry']);
						$update [] = array('id'=>$item['itemid'],'name'=>$item['name'],'restid'=>$restid,'menu_cat_id'=>$item['catid'],'description'=>$item['description'],'video_url'=>'','posItemID'=>$item['posItemID'],'price'=>$cost,'vat_tax'=>$item['vat_tax'],'service_tax'=>$item['service_tax'],'sortorder'=>$item['sortorder']);
						$duplicates[$item['itemid']] = $item['itemid'];
					}
					else
					{
						if($item['option_id'] == null)
						{
							$price_batch [] = array('itemid'=>$duplicates[$item['itemid']],'price'=>$item['price'],'start_date'=>$item['start_date'],'size'=>$item['size'],'end_date'=>$item['end_date'],'description'=>$item['description'],'start_time'=>$item['start_time'],'end_time'=>$item['end_time'],'packaging'=>$item['packaging'],'color'=>$item['color'],'is_dry'=>$item['is_dry']);
						}
						else
						{
							$cost = array('id'=>$item['option_id'],'itemid'=>$duplicates[$item['itemid']],'price'=>$item['price'],'start_date'=>$item['start_date'],'size'=>$item['size'],'end_date'=>$item['end_date'],'description'=>$item['description'],'start_time'=>$item['start_time'],'end_time'=>$item['end_time'],'packaging'=>$item['packaging'],'color'=>$item['color'],'is_dry'=>$item['is_dry']);
							$update [] = array('id'=>$duplicates[$item['itemid']],'name'=>$item['name'],'restid'=>$restid,'menu_cat_id'=>$item['catid'],'description'=>$item['description'],'video_url'=>'','posItemID'=>$item['posItemID'],'price'=>$cost,'vat_tax'=>$item['vat_tax'],'service_tax'=>$item['service_tax'],'sortorder'=>$item['sortorder']);
						}
					}
				}
			}
			if(count($price_batch) > 0)
			{
				$map = $this->menulib->addprice($price_batch);
				//$apicalls [] = array('url'=>'crm/menus/addprice.json','params'=>http_build_query(array('prices'=>json_encode($price_batch),'restid'=>$restid,'menu_id'=>$menu_id)));
			}
			if(count($mcategories) > 0)
			{
				$smap['restid'] = $restid;
				$smap['structure'] = $mcategories;
				$map = $this->menulib->addsectionitems($smap);
				//$apicalls [] = array('url'=>'crm/menus/addsectionitems.json','params'=>http_build_query(array('template'=>json_encode($smap))));
			}
			if(count($add) > 0)
			{
				$map = $this->menulib->additems($add);
				$map = $this->menulib->updateitems($update);
				//$apicalls [] = array('url'=>'crm/menus/additems.json','params'=>http_build_query(array('items'=>json_encode($add),'restid'=>$restid,'menu_id'=>$menu_id)));
				//$apicalls [] = array('url'=>'crm/menus/updateitems.json','params'=>http_build_query(array('items'=>json_encode($update),'restid'=>$restid,'menu_id'=>$menu_id)));
			}
			else
			{
				$map = $this->menulib->updateitems($update);
				//$apicalls [] =  array('url'=>'crm/menus/updateitems.json','params'=>http_build_query(array('items'=>json_encode($update),'restid'=>$restid,'menu_id'=>$menu_id)));
			}
		}
		echo json_encode($map);
	}
	
	public function publish_menu() {
		$data = array();
		$data['restid'] = $this->input->get('restid');
		$data['comment'] = $this->input->get('comment');
		$this->load->library('zyk/MenuLib');
		$this->menulib->publishmenu($data);
		$map['status'] = 1;
		$map['msg'] = 'Menu published successfully.';
		echo json_encode($map);
	}
	
	public function download( $restid ) {
		$this->load->library('MyExcel');
		$objPHPExcel = new PHPExcel();
		$batch = array();
		$filename = FCPATH.'assets/documents/menus/menu_export_'.$restid.'.xls';
		$data = array();
		try {
			$this->load->library('zyk/MenuLib');
			// ***************For Log Details****************************
			$log[0]['comment'] = '';
			$log[0]['page_name'] = 'Menu List';
			$log[0]['field_name'] = "Download menu";
			$log[0]['restid'] = $restid;
			$log[0]['old_value'] = $filename;
			$log[0]['new_value'] = '';
			$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
			$log[0]['updated_datetime']=date("Y-m-d H:i:s");
			$this->menulib->addMenuPublishLogs($log);
			//****************************************************************
			
			//$this->load->library('zyk/MenuLib');
			$menu = $this->menulib->completemenu($restid);
			
			foreach($menu as $key=>$row) {
				$objWorksheet = $objPHPExcel->createSheet();
				$objWorksheet->setTitle($row['name'].'#'.$row['id']);
				$categories = $row['categories'];
				$itemcnt = 1;
				foreach($categories as $key1=>$row1)
				{
					$items = $row1['items'];
					foreach($items as $item)
					{
						if(count($item) < 2)
						{
							$food = $item[array_keys($item)[0]];
							$objWorksheet->setCellValueByColumnAndRow(0,$itemcnt,$row1['id']);
							$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,$row1['name']);
							$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,$food['id']);
							$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,$food['option_id']);
							$objWorksheet->setCellValueByColumnAndRow(4,$itemcnt,$food['name']);
							$objWorksheet->setCellValueByColumnAndRow(5,$itemcnt,$food['price']);
							$objWorksheet->setCellValueByColumnAndRow(6,$itemcnt,$food['size']);
							$objWorksheet->setCellValueByColumnAndRow(7,$itemcnt,$food['description']);
							$objWorksheet->setCellValueByColumnAndRow(8,$itemcnt,$food['posItemID']);
							$objWorksheet->setCellValueByColumnAndRow(9,$itemcnt,$food['start_date']);
							$objWorksheet->setCellValueByColumnAndRow(10,$itemcnt,$food['end_date']);
							$objWorksheet->setCellValueByColumnAndRow(11,$itemcnt,$food['start_time']);
							$objWorksheet->setCellValueByColumnAndRow(12,$itemcnt,$food['end_time']);
							$objWorksheet->setCellValueByColumnAndRow(13,$itemcnt,$food['packaging']);
							$objWorksheet->setCellValueByColumnAndRow(14,$itemcnt,$food['color']);
							$objWorksheet->setCellValueByColumnAndRow(15,$itemcnt,$food['is_dry']);
							if(!empty($food['vat_tax']))
								$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,$food['vat_tax']);
							else 
								$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,0);
							if(!empty($food['service_tax']))
								$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,$food['service_tax']);
							else 
								$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,0);
							$objWorksheet->setCellValueByColumnAndRow(18,$itemcnt,$food['sortorder']);
							$itemcnt++;
						}
						else
						{
							foreach($item as $key2=>$food) {
								$objWorksheet->setCellValueByColumnAndRow(0,$itemcnt,$row1['id']);
								$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,$row1['name']);
								$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,$food['id']);
								$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,$food['option_id']);
								$objWorksheet->setCellValueByColumnAndRow(4,$itemcnt,$food['name']);
								$objWorksheet->setCellValueByColumnAndRow(5,$itemcnt,$food['price']);
								$objWorksheet->setCellValueByColumnAndRow(6,$itemcnt,$food['size']);
								$objWorksheet->setCellValueByColumnAndRow(7,$itemcnt,$food['description']);
								$objWorksheet->setCellValueByColumnAndRow(8,$itemcnt,$food['posItemID']);
								$objWorksheet->setCellValueByColumnAndRow(9,$itemcnt,$food['start_date']);
								$objWorksheet->setCellValueByColumnAndRow(10,$itemcnt,$food['end_date']);
								$objWorksheet->setCellValueByColumnAndRow(11,$itemcnt,$food['start_time']);
								$objWorksheet->setCellValueByColumnAndRow(12,$itemcnt,$food['end_time']);
								$objWorksheet->setCellValueByColumnAndRow(13,$itemcnt,$food['packaging']);
								$objWorksheet->setCellValueByColumnAndRow(14,$itemcnt,$food['color']);
								$objWorksheet->setCellValueByColumnAndRow(15,$itemcnt,$food['is_dry']);
								if(!empty($food['vat_tax']))
									$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,$food['vat_tax']);
								else 
									$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,0);
								if(!empty($food['service_tax']))
									$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,$food['service_tax']);
								else 
									$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,0);
								$objWorksheet->setCellValueByColumnAndRow(18,$itemcnt,$food['sortorder']);
								$itemcnt++;
							}
						}
					}
				}
			}
			$objPHPExcel->removeSheetByIndex(0);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save($filename);
			$objPHPExcel->disconnectWorksheets();
			$data = file_get_contents($filename); // Read the file's contents
			$this->load->helper('download');
			force_download("menu_export_".$restid.".xls", $data);
			unset($objPHPExcel);
		}catch(Exception $e) {
			$data['status'] = 0;
			$data['msg'] = 'Failed to download.';
			echo json_encode($data);
			unset($apicalls);
			unset($apioutput);
		}
		
	}
	
	public function editMenu($restid) {
		$this->load->library('zyk/MenuLib');
		//$this->load->model('search/search_model','search');
		//$reason = $this->search->getMainMenuReason();
		//$template = 'crm/menus/template.json?'.http_build_query($map);
		//$items ='crm/menus/items.json?'.http_build_query($map);
		//$name ='crm/restaurants/basicinfo.json?'.http_build_query($map);
		//$log='crm/restaurants/menulog.json?'.http_build_query($map);
		//$apicalls = array($template,$items,$name,$log);
		//$tk_config = parse_ini_file("/etc/php5/fpm/tastykhana.ini");
		//$cdnurl['catimageurl'] = $tk_config['cdn'];
		try {
			$rname = "Test";
			$template = $this->menulib->getMenuTemplate($restid);
			$items = $this->menulib->getMenuItems($restid);
			$group = $this->groupItems($template['mcategories'], $template['categories'],$items);
			$this->template->set('group',$group);
			$this->template->set('restid',$restid);
			$this->template->set('restname',$rname);
			$this->template->set('today',date('Y-m-d'));
			$this->template->set('tabs',count($template['mcategories']));
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('backend')
							->title ( 'Administrator | Restaurants' )
							->set_partial ( 'header', 'partials/header' )
							->set_partial ( 'leftnav', 'partials/sidebar' )
							->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('menus/UpdateItems');
		}catch(Exception $e) {
			echo "Invalid Menu";
		}
	}
	
	private function groupItems( $mcategories, $categories , $items)
	{
		$group = array();
		$cats = array();
		$item = array();
		$i = 0;
		foreach($mcategories as $key=>$row) {
			$group [$i] = $row;
			$c = 0;
			foreach($categories as $key1=>$row1)
			{
				if($row1['menu_mcat_id'] == $row['id'])
				{
					$cats[$c] = $row1;
					$item = array();
					foreach($items as $key2=>$row2)
					{
						if($row2['menu_cat_id'] == $row1['id'])
						{
							$item [] = $row2;
						}
					}
					if(!empty($item) && count($item) > 0)
						$cats[$c]['items'] = $item;
					if(empty($item) || count($item) <= 0) {
						unset($cats[$c]);
					}else {
						$c++;
					}
					unset($item);
				}
			}
			if(count($cats) > 0)
				$group [$i]['categories']  = $cats;
			if(count($cats) <=0) {
				unset($group [$i]);
			}else {
				$i++;
			}
			unset($cats);
		}
		return $group;
	}
	
	public function editMenuSortOrder() {
		$this->load->library('zyk/MenuLib');
		$catid = $this->input->post('catid',true);
		$sortorder = $this->input->post('sortorder',true);
		$menu_id = $this->input->post('restid',true);
		$cnt = count($catid);
		$obj = array();
		for($i=0;$i<$cnt;$i++){
			$this->menulib->editCategorySortorder($catid[$i],$sortorder[$i]);
		}
	}
	
}