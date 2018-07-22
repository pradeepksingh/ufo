<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * General API
 * @author pradeepsingh
 * @package General
 *
 */
class Api extends REST_Controller {
	
	public function areas_get()
	{
		$cityid = $this->get('cityid');
		$this->load->library('zyk/general');
		$areas = $this->general->getAreasByCityId($cityid);
		$this->response ( $areas,200 );
	}
	
	public function placetodack_get() {
		$items = array();
		$iteminfo  = array();
		$iteminfo['Item Name'] = "Paneer Butter Masala";
		$iteminfo['Item Rate'] = "100";
		$iteminfo['Quantity'] = "1";
		$iteminfo['Total'] = "100";
		$items["Item1"] = $iteminfo;
		$iteminfo['Item Name'] = "Veg Koliwada";
		$iteminfo['Item Rate'] = "50";
		$iteminfo['Quantity'] = "2";
		$iteminfo['Total'] = "100";
		$items["Item2"] = $iteminfo;
		$dack = array();
		$dack['task_def'] = 'PND';
		$dack['pickup_customer_name'] = "Test Restaurant";
		$dack['pickup_customer_contact'] = '18002660292';
		$dack['pickup_datetime'] = date('Y-m-d H-i-s');
		$dack['pickup_address'] = "Test address, Test area";
		$dack['pickup_nearby_address'] = "Aundh, Maharashtra, Pune, India";
		$dack['pickup_mapLat'] = "18.558007";
		$dack['pickup_mapLng'] = "73.80752009999992";
		$dack['pickup_customer_id'] = 20;
		$dack['delivery_customer_name'] = "Panky Ponky";
		$dack['delivery_customer_contact'] = "9021609385";
		$dack['delivery_datetime'] = date('Y-m-d H-i-s',strtotime('+45 minutes'));
		$dack['delivery_address'] = "f-107,aundh gaon, aundh";
		$dack['delivery_nearby_address'] = "Aundh Gaon, Pune, Maharashtra, India";
		$dack['delivery_mapLat'] = "18.5639463";
		$dack['delivery_mapLng'] = "73.81029269999999";
		$dack['delivery_customer_id'] = "302";
		$dack['invoice_number'] = "123";
		$dack['item_info'] = json_encode($items);
		$dack['order_amount'] = 200;
		$dack['ride_code'] = "1";
		$dack['rider_mobile'] = "9021609385";
		$dack['item_quantity'] = 1;
		$this->load->library('zyk/Dack');
		$result = $this->dack->moveToDack($dack);
		$response['params'] = $dack;
		$response["response"] = $result;
		echo json_encode($response);
	}
}
