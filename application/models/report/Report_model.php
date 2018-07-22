<?php
class Report_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function getAllUser()
    {	
		$this->db->select ('a.id,a.name,a.mobile,a.email,a.created_on,b.address,b.locality,c.name as areaname,d.name as zonename',false)
				 ->from(TABLES::$USER.' AS a')
		    	 ->join(TABLES::$USERADDRESS.' AS b','a.id = b.userid','left')
		    	 ->join(TABLES::$AREA.' AS c','b.areaid = c.id','left')
				 ->join(TABLES::$ZONE.' AS d','c.zone_id = d.id','left');
		$this->db->order_by('a.id','ASC');
		$this->db->group_by('a.id');
		$query = $this->db->get ();
		$result = $query->result_array ();
      	return $result;
   	}
   	
   	public function searchUser($data)
   	{
   		$this->db->select ('a.id,a.name,a.mobile,a.email,a.created_on,b.address,b.locality,c.name as areaname,d.name as zonename',false)
   				 ->from(TABLES::$USER.' AS a')
   				 ->join(TABLES::$USERADDRESS.' AS b','a.id = b.userid','left')
   				 ->join(TABLES::$AREA.' AS c','b.areaid = c.id','left')
   				 ->join(TABLES::$ZONE.' AS d','c.zone_id = d.id','left');
   		if(!empty($data['from_date']) && !empty($data['to_date'])) {
   			$this->db->where("a.created_on BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
   			
   		}
   		if(!empty($data['mobile']))
   		{
   			$this->db->where('a.mobile',$data['mobile']);
   		}
   		if(!empty($data['email']))
   		{
   			$this->db->where('a.email',$data['email']);
   		}
   		
   		$this->db->where('a.status',$data['user']);
   		$this->db->order_by('a.id','DESC');
   		$this->db->group_by('a.id');
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
   	public function OrdervsArea()
   	{
   		$this->db->select('a.orderid,a.ordercode,a.status,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
				'f.name cityname,g.name as rest_area,h.first_name as cse_name,i.name as zonename', FALSE)
				->from(TABLES::$ORDER.' AS a')
				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->join(TABLES::$ZONE.' AS i','e.zone_id = i.id','left');
		$this->db->order_by('a.delivery_date','desc');
		$this->db->order_by('a.delivery_time','desc');
		$this->db->group_by('a.areaid');
   		$query = $this->db->get();
   		$result = $query->result_array();
   		return $result;
   	}
   	
   	public function searchOrdervsArea($data)
   	{
   		$this->db->select('a.orderid,a.ordercode,a.status,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
   				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
   				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
   				'f.name cityname,g.name as rest_area,h.first_name as cse_name,i.name as zonename', FALSE)
   				->from(TABLES::$ORDER.' AS a')
   				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
   				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
   				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
   				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
   				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
   				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
   				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
   				->join(TABLES::$ZONE.' AS i','e.zone_id = i.id','left');
   		
   		if(!empty($data['from_date']) && !empty($data['to_date'])) {
   			$this->db->where("a.delivery_date BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
   		}
   		if(!empty($data['cityid']))
   		{
   			$this->db->where('f.id',$data['cityid']);
   		}
   		if(!empty($data['zone_id']))
   		{
   			$this->db->where('e.zone_id',$data['zone_id']);
   		}
   		if(!empty($data['areaid']))
   		{
   			$this->db->where('e.id',$data['areaid']);
   		}
   		$this->db->order_by('a.delivery_date','desc');
   		$this->db->order_by('a.delivery_time','desc');
   		$query = $this->db->get();
   		$result = $query->result_array();
   		return $result;
   	}
   	
   	public function searchPaidvsCOD($data)
   	{
   		$this->db->select('a.orderid,a.ordercode,a.status,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
   				'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,b.name,b.email,b.mobile,'.
   				'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
   				'f.name cityname,g.name as rest_area,h.first_name as cse_name,i.name as zonename', FALSE)
   				->from(TABLES::$ORDER.' AS a')
   				->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
   				->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
   				->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
   				->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
   				->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
   				->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
   				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
   				->join(TABLES::$ZONE.' AS i','e.zone_id = i.id','left');
   		if(!empty($data['from_date']) && !empty($data['to_date'])) {
   			$this->db->where("a.delivery_date BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
   		}
   		if(!empty($data['cityid']))
   		{
   			$this->db->where('f.id',$data['cityid']);
   		}
   		if(!empty($data['zone_id']))
   		{
   			$this->db->where('e.zone_id',$data['zone_id']);
   		}
   		if($data['mode'] != "")
   		{
   			$this->db->where('a.is_online_paid',$data['mode']);
   		}
   						
   		$query = $this->db->get();
   		$result = $query->result_array();
   		return $result;
   	}
   	
   	public function searchSuccessfullvsFail ($data)
   	{

    	$this->db->select('a.orderid,a.ordercode,a.status,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
   			'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.payment_status,b.name,b.email,b.mobile,'.
   			'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
   			'f.name cityname,g.name as rest_area,h.first_name as cse_name,i.name as zonename', FALSE)
   			->from(TABLES::$ORDER.' AS a')
   			->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
   			->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
   			->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
   			->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
   			->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
   			->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
   			->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
    		->join(TABLES::$ZONE.' AS i','e.zone_id = i.id','left');
   	
   			if(!empty($data['from_date']) && !empty($data['to_date'])) {
   				$this->db->where("a.delivery_date BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
   			}
   			if(!empty($data['cityid']))
   			{
   				$this->db->where('f.id',$data['cityid']);
   			}
   			if(!empty($data['zone_id']))
   			{
   				$this->db->where('e.zone_id',$data['zone_id']);
   			}
   			if(!empty($data['status']))
   			{
   			$this->db->where('a.payment_status',$data['status']);
   			}
   			$this->db->where('a.is_online_paid',1);
   			$query = $this->db->get();
   			$result = $query->result_array();
   			return $result;
   	}
   	
	public function searchDeliveryvsTakeaway ($data)
   	{
    	$this->db->select('a.orderid,a.ordercode,a.status,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
   			'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.payment_status,b.name,b.email,b.mobile,'.
   			'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,'.
   			'f.name cityname,g.name as rest_area,h.first_name as cse_name,i.name as zonename', FALSE)
   			->from(TABLES::$ORDER.' AS a')
   			->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
   			->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
   			->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
   			->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
   			->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
   			->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
   			->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
    		->join(TABLES::$ZONE.' AS i','e.zone_id = i.id','left');
   	
   			if(!empty($data['from_date']) && !empty($data['to_date'])) {
   				$this->db->where("a.delivery_date BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
   			}
   			if(!empty($data['cityid']))
   			{
   				$this->db->where('f.id',$data['cityid']);
   			}
   			if(!empty($data['zone_id']))
   			{
   				$this->db->where('e.zone_id',$data['zone_id']);
   			}
   			if($data['status']!=""){
   			$this->db->where('a.is_takeaway',$data['status']);
   			}
   			$query = $this->db->get();
   			$result = $query->result_array();
   			return $result;
   	}
   	public function searchRestaurantsvsOrders ($data)
   	{
   	$this->db->select('a.orderid,a.ordercode,a.status,a.rest_discount,a.zyk_discount,a.delivery_charge,a.total_amount,'.
   			'a.is_takeaway,a.is_online_paid,a.delivery_date,a.delivery_time,a.payment_status,b.name,b.email,b.mobile,'.
   			'b.locality,b.address,c.name as restname,d.order_placing_mode,e.name as cust_area,z.name as zonename'.
   			'f.name cityname,g.name as rest_area,h.first_name as cse_name', FALSE)
   			->from(TABLES::$ORDER.' AS a')
   			->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid','inner')
   			->join(TABLES::$RESTAURANT.' AS c','a.restid=c.id','inner')
   			->join(TABLES::$RESTAURANT_PROPERTY.' AS d','a.restid=d.restid','inner')
   			->join(TABLES::$AREA.' AS e','a.areaid = e.id','left')
   			->join(TABLES::$CITY.' AS f','e.cityid = f.id','inner')
   			->join(TABLES::$AREA.' AS g','c.areaid = g.id','inner')
   			->join(TABLES::$zone.' AS z','e.zone_id = z.id','left')
   			->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left');
   
   			if(!empty($data['from_date']) && !empty($data['to_date'])) {
   				$this->db->where("a.delivery_date BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
   			}
   			if(!empty($data['restid'])) {
   			$this->db->where('a.restid',$data['restid']);
   			}
   			$this->db->order_by('a.delivery_date','DESC');
   			
   			$query = $this->db->get();
   			$result = $query->result_array();
   			return $result;
   	}
	
	public function getRestDeliveryOrders($params) {
		$this->db->select('a.*,b.name as restname,c.name as restarea,z.name as zonename', FALSE)
				->from(TABLES::$CLIENT_ORDER.' AS a')
				->join(TABLES::$RESTAURANT.' AS b','a.restid=b.id','inner')
				->join(TABLES::$AREA.' AS c','b.areaid = c.id','left')
				->join(TABLES::$ZONE.' AS z','c.zone_id = z.id','left');
		if(!empty($params['from_date']) && !empty($params['to_date'])) {
			$this->db->where("DATE(a.created_date) BETWEEN '".$params['from_date']."' AND '".$params['to_date']."'",'',false);
		}
		if(isset($params['is_online_paid']) && $params['is_online_paid'] != '')
		$this->db->where('a.is_online_paid',$params['is_online_paid']);
		if(isset($params['status']))
		$this->db->where('a.status',$params['status']);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
   	public function bannerReport()
   	{
		   	$this->db->select('a.name as area ,z.name as zonename,b.restid as restid,r.name as name,count(b.restid) as click,sum(b.is_converted) as converted',FALSE)->from(TABLES::$AD_TRACKING.' AS b')
		   			 ->join(TABLES::$RESTAURANT.' AS r','b.restid=r.id','inner')
		   			 ->join(TABLES::$AREA.' AS a','a.id=r.areaid','inner')
		   			 ->join(TABLES::$ZONE.' AS z','a.zone_id=z.id','left')
		   			 ->group_by('b.restid');
		   	$query = $this->db->get();
		   	$result = $query->result_array();
		   	return $result;
   	}
   	
   	public function searchBannerReport($data)
   	{
		   	$this->db->select('b.restid as restid,r.name as name,count(b.restid) as click,sum(b.is_converted) as converted',FALSE)->from(TABLES::$AD_TRACKING.' AS b')
				   	 ->join(TABLES::$RESTAURANT.' AS r','b.restid=r.id','inner')
				   	 ->where("b.created_time BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false)
				   	 ->group_by('b.restid');
		   	$query = $this->db->get();
		   	$result = $query->result_array();
		   	return $result;
   	}
   	public function subscribeReport()
   	{
   		$this->db->select('*')->from(TABLES::$SUBSCRIBE);
   		$query = $this->db->get();
   		$result = $query->result_array();
   		return $result;
   	}
   	
}
