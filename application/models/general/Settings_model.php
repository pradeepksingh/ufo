<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 * General Settings Model
 *
 * <p>
 * We are using this model to add, update, delete and get general setting like city,area etc.
 * </p>
 *
 * @package General
 * @author Pradeep Singh
 * @copyright Copyright &copy; 2015
 * @category CI_Model API
 *          
 */
class Settings_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function addCity($city) {
		$data = array ();
		$errors = array ();
		$params = array (
				'name' => $city ['name'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CITY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CITY, $city );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['city'] = "City name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 *
	 * update city name
	 * 
	 * @param
	 *        	city object
	 * @access public
	 * @return array
	 */
	public function updateCity($city) {
		$data = array ();
		$errors = array ();
		$params = array (
				'name' => $city ['name'],
				'id !=' => $city ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CITY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $city ['id'] );
			$this->db->update ( TABLES::$CITY, $city );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$errors ['city'] = "City name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * change the status of city from 1 to 0
	 * 
	 * @access public
	 * @param $id of
	 *        	city
	 *        	
	 */
	public function turnOffCity($id) {
		$city ['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$CITY, $city );
	}
	
	/**
	 *
	 * change the status of city from 0 to 1.
	 * 
	 * @access public
	 * @param
	 *        	id of city
	 */
	public function turnOnCity($id) {
		$city ['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$CITY, $city );
	}
	
	/**
	 *
	 * get city name,fence and status of city by id
	 * 
	 * @param
	 *        	city id
	 * @access public
	 * @return result_set
	 */
	public function getCityById($id) {
		$this->db->select ( 'id,name,status' )->from ( TABLES::$CITY )->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * get all the cities.
	 * 
	 * @param
	 *        	no param
	 * @access public
	 * @return array_list
	 */
	public function getAllCities() {
		$this->db->select ( 'id,name,status' )->from ( TABLES::$CITY )->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function checkLocalitiesbyPincode($pincode) {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->order_by ( 'name', 'asc' );
		$this->db->where ( 'pincode', $pincode );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addLocality($locality) {
		$params = array (
				'name' => $locality ['name'],
				'cityid=' => $locality ['cityid'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$AREA )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$AREA, $locality );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['locality'] = "Locality name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * update locality name, longitude, latitude and zone
	 * 
	 * @param
	 *        	locality object
	 * @access public
	 * @throws Exception
	 */
	public function updateLocality($locality) {
		$data = array ();
		$params = array (
				'name' => $locality ['name'],
				'cityid' => $locality ['cityid'],
				'id !=' => $locality ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$AREA )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $locality ['id'] );
			$this->db->update ( TABLES::$AREA, $locality );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully";
			return $data;
		} else {
			$errors ['locality'] = "Locality name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * change the status of locality from 1 to 0
	 * 
	 * @access public
	 * @param $id of
	 *        	locality
	 *        	
	 */
	public function turnOffLocality($id) {
		$locality ['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$AREA, $locality );
	}
	
	/**
	 *
	 * change the status of locality from 0 to 1
	 * 
	 * @access public
	 * @param $id of locality
	 *        	
	 */
	public function turnOnLocality($id) {
		$locality ['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$AREA, $locality );
	}
	
	/**
	 *
	 * get locality name, latitude, longitude and zone_id of zone by id
	 * 
	 * @param locality id
	 * @access public
	 * @return result_set
	 */
	public function getLocalityById($id) {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * get all the localities.
	 * 
	 * @param no param
	 * @access public
	 * @return array_list
	 */
	public function getAllLocalities() {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAreasByCityId($cityid) {
		$this->db->select ( 'a.*,b.name as zone_name' )
			 ->from ( TABLES::$AREA.' AS a' )
			 ->join ( TABLES::$ZONE.' AS b','a.zone_id=b.id','left')
			 ->order_by ( 'a.name', 'asc' );
		$this->db->where ( 'a.cityid', $cityid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/*public function getAllCuisines() {
		$this->db->select ( '*' )->from ( TABLES::$CUISINE )->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}*/
	
	public function getCuisineById($id) {
		$this->db->select ( '*' )->from ( TABLES::$CUISINE )->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addCuisine($cuisine) {
		$params = array (
				'name' => $cuisine ['name'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CUISINE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CUISINE, $cuisine );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['locality'] = "Cuisine name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function updateCuisine($cuisine) {
		$data = array ();
		$params = array (
				'name' => $cuisine ['name'],
				'id !=' => $cuisine ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CUISINE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cuisine ['id'] );
			$this->db->update ( TABLES::$CUISINE, $cuisine );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully";
			return $data;
		} else {
			$errors ['locality'] = "Cuisine name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function deleteCuisine($id) {
		$this->db->where ( 'id', $id );
		$this->db->delete ( TABLES::$CUISINE );
	}
	
	public function getRestaurantsByVendor($vendorid) {
		$this->db->select ( 'restid' )->from ( TABLES::$VENDOR )->where ( 'id', $vendorid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRestByAreaId($areaid) {
		$this->db->select ( 'a.*,b.name as areaname' )
				 ->from ( TABLES::$RESTAURANT.' AS a' )
				 ->from ( TABLES::$AREA.' AS b','a.areaid=b.id','inner' )
				 ->order_by ( 'a.name', 'asc' );
		$this->db->where ( 'b.id', $areaid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addReason($reason) {
		$params = array (
				'name' => $reason ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$CANCEL_REASON )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CANCEL_REASON, $reason );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['locality'] = "Reason already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function updateReason($reason) {
		$data = array ();
		$params = array (
				'name' => $reason ['name'],
				'id !=' => $reason ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$CANCEL_REASON )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $reason ['id'] );
			$this->db->update ( TABLES::$CANCEL_REASON, $reason );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully";
			return $data;
		} else {
			$errors ['locality'] = "Reason already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function deleteReason($id) {
		$map['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$CANCEL_REASON , $map);
	}
	
	public function getActiveReasons(){
		$this->db->select ('*')->from ( TABLES::$CANCEL_REASON )->where ('status',1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getReasonById($id){
		$this->db->select ('*')->from ( TABLES::$CANCEL_REASON )->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	//shinee 26May
	public function getCuisinesByArea($arealist) {
		$this->db->select ( 'distinct (c.id),c.name' )
		->from ( TABLES::$RESTAURANT . ' AS r' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES. ' AS rc', 'rc.restid = r.id', 'inner' );
		$this->db->join ( TABLES::$CUISINE. ' AS c', 'c.id = rc.cuisine_id', 'inner' );
		$this->db->where ( 'r.areaid IN ('.$arealist.')' );
		$this->db->group_by ( 'c.name' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	//.......................Added By Rohit Singh................................
	
	public function getZoneByCityId($cityid)
	{
		$this->db->select ('*')->from ( TABLES::$ZONE )->where ('city_id',$cityid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getAreaByZoneId ($zoneid)
	{
		$this->db->select ('*')->from ( TABLES::$AREA )->where ('zone_id',$zoneid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}
	public function getRestaurantByZoneId($zoneid)
	{
		$this->db->select ('r.*,a.name as areaname')->from ( TABLES::$RESTAURANT.' AS r' );
		$this->db->join(TABLES::$AREA.' AS a','a.id = r.areaid','inner');
		$this->db->join(TABLES::$ZONE.' AS z','a.zone_id = z.id','inner');
		$this->db->where('z.id ='.$zoneid);
		$this->db->where('r.status = 1');
		$this->db->order_by('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		//print_r($result);
		return $result;
	}
	
	public function saveContactUs($params) {
		return $this->db->insert ( TABLES::$CONTACT_US, $params );
	}
	
	public function addFeedback($params) {
		return $this->db->insert ( TABLES::$FEEDBACK, $params );
	}
	
	public function getAreasByZoneId($zone_id) {
		$this->db->select ( '*' )
				 ->from ( TABLES::$AREA)
				 ->order_by ( 'name', 'asc' );
		$this->db->where ( 'zone_id', $zone_id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function saveRating($params) {
		$this->db->select ('count(id) as ratings,sum(rating) as total_rating')
				 ->from ( TABLES::$RESTAURANT_RATING);
		$this->db->where('restid',$params['restid']);
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result) > 0) {
			$total_rating = $result[0]['total_rating'];
			$ratings = $result[0]['ratings'];
		} else {
			$total_rating = 0;
			$ratings = 0;
		}
		$rating = round(($total_rating+$params['rating'])/($ratings+1),1);
		$this->db->insert ( TABLES::$RESTAURANT_RATING, $params );
		$this->db->where('id',$params['restid']);
		$this->db->update(TABLES::$RESTAURANT,array('rating'=>$rating));
	}
	
	public function saveReview($params) {
		$this->db->insert ( TABLES::$RESTAURANT_REVIEW, $params );
	}
	
	public function getRestaurantsReviews($restid) {
		$this->db->select ('a.*,b.name,b.avatar,c.rating')
				 ->from ( TABLES::$RESTAURANT_REVIEW.' AS a')
				 ->join(TABLES::$USER.' AS b','a.userid=b.id','inner')
				 ->join(TABLES::$RESTAURANT_RATING.' AS c','a.userid=c.userid','left');
		$this->db->where('a.restid',$restid);
		$this->db->where('c.restid',$restid);
		$this->db->group_by('a.id');		 
		$this->db->order_by('a.review_on','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	//................ Added by Tushar Ticket model..........................
	
	public function addTicket($params) {
		$this->db->insert ( TABLES::$TICKET, $params );
		return $this->db->insert_id();
	}
	
	public function updateTicket($params) {
		$this->db->where('ticketid',$params['ticketid']);
		return $this->db->update(TABLES::$TICKET,$params);
	}
	
	public function getAllTickets() {
		$this->db->select ( '*' )->from ( TABLES::$TICKET )
				 ->order_by('status','ASC')
				 ->order_by('priority','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllActiveTickets() {
		$this->db->select ( "a.*,b.name,b.mobile,concat(c.first_name,' ',c.last_name) as assigned_to_name,concat(d.first_name,' ',d.last_name) as created_by_name" );
		$this->db->from ( TABLES::$TICKET.' AS a' );
		$this->db->join ( TABLES::$USER.' AS b','a.userid=b.id','inner' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS c','a.assigned_to=c.id','left' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS d','a.created_by=d.id','left' );
		$this->db->order_by('a.created_date','DESC');
		$this->db->order_by('a.priority','DESC');
		$this->db->order_by('a.status','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getTicketById($ticketid) {
		$this->db->select ( "a.*,b.name,b.mobile,concat(c.first_name,' ',c.last_name) as assigned_to_name,concat(d.first_name,' ',d.last_name) as created_by_name" );
		$this->db->from ( TABLES::$TICKET.' AS a' );
		$this->db->join ( TABLES::$USER.' AS b','a.userid=b.id','inner' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS c','a.assigned_to=c.id','left' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS d','a.created_by=d.id','left' );
		$this->db->where('a.ticketid',$ticketid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}