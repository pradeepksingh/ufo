<?php
class UserLogin_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function saveVerificationEmail($map) {
		$this->db->select ('*');
		$this->db->from ( TABLES::$TEMP_EMAIL );
		$this->db->where ( 'email', $map['email'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result) <= 0) {
			$this->db->insert ( TABLES::$TEMP_EMAIL, $map );
			return $map['emailcode'];
		} else {
			return $result[0]['emailcode'];
		}
	}
	
	public function saveVerificationMobile($map) {
		$this->db->select ('*');
		$this->db->from ( TABLES::$TEMP_MOBILE );
		$this->db->where ( 'mobile', $map['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result) <= 0) {
			$this->db->insert ( TABLES::$TEMP_MOBILE, $map );
			return $map['otp'];
		} else {
			return $result[0]['otp'];
		}
	}
	
	public function verifyEmail($map) {
		$this->db->where ( 'emailcode', $map ['emailcode'] );
		$this->db->update ( TABLES::$TEMP_EMAIL, $map );
	}
	
	public function verifyMobile($map) {
		$resp = array();
		$this->db->select ('*');
		$this->db->from ( TABLES::$TEMP_MOBILE );
		$this->db->where ( 'mobile', $map['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result) > 0) {
			if($result[0]['otp'] == $map['otp']) {
				$map['is_verified'] = 1;
				$this->db->where ( 'mobile', $map ['mobile'] );
				$this->db->update ( TABLES::$TEMP_MOBILE, $map );
				$resp['status'] = 1;
				$resp['msg'] = "Mobile Verified";
			} else {
				$resp['status'] = 0;
				$resp['msg'] = "Enter 6 Digit OTP sent to your mobile number +91 ".$map['mobile'];
			}
		} else {
			$resp['status'] = 0;
			$resp['msg'] = "Invalid OTP";
		}
		return $resp;
	}
	
	public function isEmailVerified($email) {
		$this->db->select ('*');
		$this->db->from ( TABLES::$TEMP_EMAIL );
		$this->db->where ( 'email', $email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result) > 0) {
			if($result[0]['is_verified'] == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
   	public function userExist($data)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$USER );
   		$this->db->where ( 'email', $data['email'] );
   		$this->db->or_where( 'mobile', $data['mobile'] );
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}
	public function userRegistration($data) {
    	$this->db->insert ( TABLES::$USER, $data );
		return $this->db->insert_id ();  
	}
	
	public function otpMatch($map) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'otp', $map['otp'] );
		$this->db->where ( 'id', $map['id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		if (empty ( $result )) {
			$result [0] ['status'] = "0";
		} else {
			$status = array ( "status" => "1"  );
			$this->db->where ( 'id', $map['id'] );
			$this->db->update ( TABLES::$USER, $status );
			$result [0] ['status'] = "1";
		}
		
		return $result;
	}
	
	public function login($params) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where("(email = '" . $params['username'] . "' OR mobile = '" . $params['username'] . "') ");			
		$this->db->where('password',$params['password']);
		$query = $this->db->get ();	
		$result = $query->result_array ();
		return ($result);
	}
	
	public function addAddress($data) {
		$this->db->insert ( TABLES::$USERADDRESS, $data );
		return $this->db->insert_id ();
	}
	
	public function getAddressById($userid) {
		$this->db->select ( 'a.*,b.name as areaname,c.name as city' );
		$this->db->from ( TABLES::$USERADDRESS.' AS a' );
		$this->db->join ( TABLES::$AREA.' AS b','a.areaid=b.id','left' );
		$this->db->join ( TABLES::$CITY.' AS c','c.id=b.cityid','left' );
		$this->db->where ( 'a.userid', $userid );
		$this->db->order_by('a.id','DESC');
		$this->db->order_by('a.is_primary','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateAddress($data) {
		$this->db->where ( 'id', $data ['id'] );
		$this->db->update ( TABLES::$USERADDRESS, $data );
	}
	
	public function getAddressByAddressId($id) {
			$this->db->select ( 'a.*' )->from ( TABLES::$USERADDRESS . ' AS a' )->where ( 'a.id', $id );
			//$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
			//$this->db->join ( TABLES::$CITY . ' AS c', 'b.cityid=c.id', 'inner' );
			$query = $this->db->get ();
			$result = $query->result_array ();
			//print_r($result);
			return $result;
	}
	
	public function getProfile($id) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProfileByEmail($email) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email', $email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateUserProfile ($data) {
		$this->db->where ( 'id', $data['id'] );
		$this->db->update ( TABLES::$USER, $data );
	}
	
	public function updateUserProfileByEmail ($data) {
		$this->db->where ( 'email', $data['email'] );
		$this->db->update ( TABLES::$USER, $data );
	}
	
	/*public function forgetPassword ($mobile,$client_id){
		
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'mobile',$mobile );
		$this->db->where ( 'client_id',$client_id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result)>0)
		{
			$data ['otp'] = mt_rand ( 100000, 999999 );
			$this->db->where ( 'id', $result[0]['id'] );
			$this->db->update ( TABLES::$USER, $data );
			$result [0]['otp'] = $data ['otp'];
		}
		return $result;
	} */
	
	public function forgetPassword ($email){
	
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email',$email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function getOrderDetailByUserId($id)
	{
		$this->db->select ( 'a.*,b.name' );
		$this->db->from ( TABLES::$ORDER.' AS a' );
		$this->db->join ( TABLES::$RESTAURANT.' AS b','a.restid=b.id','left' );
		$this->db->where ( 'userid',$id );
		$this->db->order_by('a.orderid','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function subscribe($email)
	{   
	    $data=array();
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$SUBSCRIBE );
		$this->db->where ( $email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count( $result ) > 0)
		{ 
			$data['message'] = "You have allready Subscribed to our newsletter . ";
		}
		else {
		$this->db->insert ( TABLES::$SUBSCRIBE, $email );
		$data['message'] = "Thank you for subscribing to our newsletter ! ";
		$data['email']=$email['email'];
		}
		return $data;
		
	}
	
	public function getCustomerDetails($address_id) {
		$this->db->select ( 'a.*,b.*' );
		$this->db->from ( TABLES::$USER.' AS a' );
		$this->db->join ( TABLES::$USER_ADDRESS.' AS b','a.id=b.userid','inner' );
		$this->db->where ( 'b.id',$address_id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProfileByEmailMobile($map) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( "(email = '".$map['email']."' OR mobile = '".$map['mobile']."')",'',false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
}