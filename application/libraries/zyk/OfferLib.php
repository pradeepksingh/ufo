<?php
class OfferLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function saveOffer($data)
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$id = $this->CI->offer->saveOffer ($data);
		
		$log[0]['page_name'] = 'Add Offer';
		$log[0]['field_name'] = "Offer";
		$log[0]['offerid'] = $id;
		$log[0]['old_value'] = '';
		$log[0]['new_value'] = '';
		$log[0]['restid'] = $data['restid'];
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->CI->load->model ('offer/Offer_model', 'offer');
		$this->CI->offer->addOfferLog($log);
		
	}
	public function getOffer()
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$offer = $this->CI->offer->getOffer ();
		return $offer;
	}
	
	public function getRestaurantOffer($restid) {
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$offer = $this->CI->offer->getOfferByRestId ($restid);
		return $offer;
	}
	public function getOfferHome()
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$offer = $this->CI->offer->getOfferHome ();
		return $offer;
	}
	public function getOfferList()
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$offer = $this->CI->offer->getOfferList ();
		return $offer;
	}
	public function getOfferById($id)
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$offer = $this->CI->offer->getOfferById ($id);
		return $offer;
	}
	public function turnOnOffer($data)
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$offer = $this->CI->offer->turnOnOffer ($data['id']);
		$log[0]['page_name'] = 'Offer List';
		$log[0]['field_name'] = "status";
		$log[0]['restid'] = $data['restid'];
		$log[0]['offerid'] = $data['id'];
		$log[0]['old_value'] = '0';
		$log[0]['new_value'] = '1';
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->CI->load->model ('offer/Offer_model', 'offer');
		$this->CI->offer->addOfferLog($log);
		
	}
	public function turnOfOffer($data)
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$this->CI->offer->turnOfOffer ($data['id']);
		//*****************************************for log***************
		$log[0]['page_name'] = 'Offer List';
		$log[0]['field_name'] = "status";
		$log[0]['offerid'] = $data['id'];
		$log[0]['restid'] = $data['restid'];
		$log[0]['old_value'] = '1';
		$log[0]['new_value'] = '0';
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->CI->load->model ('offer/Offer_model', 'offer');
		$this->CI->offer->addOfferLog($log);
	}
	public function updateOffer($data)
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$olddata = $this->getOfferById($data['id']);
		$this->CI->offer->updateOffer ($data);
		$this->updateOfferLog($olddata[0],$data,'Update Offer');
	}
	public function deleteOffer($data)
	{
		$this->CI->load->model ( 'offer/Offer_model', 'offer' );
		$this->CI->offer->deleteOffer ($data['id']);
		$log[0]['page_name'] = 'Offer List';
		$log[0]['field_name'] = "Delete Offer";
		$log[0]['restid'] = $data['restid'];
		$log[0]['offerid'] = $data['id'];
		$log[0]['old_value'] = '';
		$log[0]['new_value'] = '';
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->CI->load->model ('offer/Offer_model', 'offer');
		$this->CI->offer->addOfferLog($log);
	}
	
	//**************************For Log*****************************
	
	public function updateOfferLog($olddata,$newdata,$page)
	{
		$i = 0;
		$j = 0;
		$log[] = array();
		foreach($newdata as $key2=>$value2)
		{
	
			foreach($olddata as $key1 => $value1)
			{
				if($key1==$key2)
				{
					if($value1!=$value2)
					{	$log[$j]['restid'] = $newdata['restid'];
						$log[$j]['page_name'] = $page;
						$log[$j]['field_name'] = $key1;
						$log[$j]['offerid'] = $newdata['id'];
						$log[$j]['old_value'] = $value1;
						$log[$j]['new_value'] = $value2;
						$log[$j]['updated_by'] = $_SESSION['adminsession']['id'];
						$log[$j]['updated_datetime']=date("Y-m-d H:i:s");
						$j++;
					}
					$i++;
				}
			}
	
		}
		
		$this->CI->load->model ('offer/Offer_model', 'offer');
		$this->CI->offer->addofferLog($log);
	
	}
	public function getOfferLogs()
	{
		$this->CI->load->model ('offer/Offer_model', 'offer');
		$log = $this->CI->offer->getOfferLogs();
		return $log;
	}
	
	
}