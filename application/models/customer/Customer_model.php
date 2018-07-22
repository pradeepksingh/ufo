<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Model API for adding new client. 
 *
 * <p>
 * We are using this model to add/update client through backend.
 * </p>
 * @package Client
 * @subpackage client-model
 * @author pankaj
 * @category CI_Model API
 */

class Customer_model extends  CI_Model{
	function __construct() {
		parent::__construct();
	}
	
	public function getAllCustomer()
	{
		$this->db->select('*');
		$this->db->from(TABLES::$USERS)->order_by('id','DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}	
	
	public function getCustomerById($id){
		$this->db->select('*');
		$this->db->from(TABLES::$USERS);
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function  updateCustomer($data){
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$USERS,$data);
		$result =array();
		if ($this->db->affected_rows() > 0)
		{
			$result['status'] = 1;
			$result['msg'] = 'Record updated successfully.';
				
		}
		else
		{
			$result['status'] = 0;
			$result['msg'] = 'Please try again.';
		}
		return $result;
	}
	
	public function getCustomerAddressById($userid){
		
		$this->db->select ( 'a.id as id, a.locality as address' );
		$this->db->from ( TABLES::$USERADDRESS.' AS a' );
		$this->db->where ( 'a.userid', $userid );
		$this->db->order_by('a.id','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addCustomerAddress($users,$newaddress){
		$message = array();
		$result = array();
		if($newaddress['userid'] > 0){
			//try{
			$result = $this->addNewCustomerAddress($newaddress);
			if($result['status'] == 1){
				return $this->getCustomerAddressById($newaddress['userid']);
			}
			/*}catch(Exception $e){
				$result['status'] = 0;
				$result['msg'] = 'Fail to add new customer.Try again.';
				return $result;
			}*/
		}else {
			//try{
				$data = array(
						'source' => $users['source'],
						'name' => $users['name'],
						'email' => $users['email'],
						'mobile' => $users['mobile'],
						'password' => $users['password'],
						'original' => $users['original'],
						'otp' => $users['otp'],
						'coupon_code' => $users['coupon_code'],
						'created_on' => $users['created_on'],
						'last_login' => $users['last_login']
					);
				$message = $this->addCustomer($data);
				if($message['id'] >0 && $message['status'] == 1){
					$data = array(
						'address_name' => $newaddress['address_name'],
						'userid' => $message['id'],
						'areaid' => $newaddress['areaid'],
						'address' => $newaddress['address'],
						'apt_no' => $newaddress['apt_no'],
						'locality' => $newaddress['locality'],
						'latitude' => $newaddress['latitude'],
						'longitude' => $newaddress['longitude'],
						'landmark' => $newaddress['landmark'],
						'pincode' => $newaddress['pincode'],
						'city' => $newaddress['city'],
						'state' => $newaddress['state'],
						'address_opt' => $newaddress['address_opt']
					);
					$result = $this->addNewCustomerAddress($data);
					if($result['status'] == 1){
						return $this->getCustomerAddressById($message['id']);
					}
				}
			/*}catch (Exception $e){
				$result['status'] = 0;
				$result['msg'] = 'Fail to save address and customer.Please Try again';
			}*/
		}
	}
	
	public function addNewCustomerAddress($data){
		$this->db->insert(TABLES::$USERADDRESS,$data);
		$message['id'] = $this->db->insert_id ();
		$message['status'] = 1;
		$message['msg'] = "Added successfully";
		return $message;
	}
	
	public function addNewCustomer($data){
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$USERS );
		$this->db->where ( 'email', $data['email'] );
		$this->db->or_where ( 'mobile', $data['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count($result) <= 0) {
			$this->db->insert(TABLES::$USERS,$data);
			$message['id'] = $this->db->insert_id ();
			$message['status'] = 1;
			$message['msg'] = "Added successfully";
			return $message;
		} else {
			$message['status'] = 0;
			$message['msg']= 'Email Id already exist.';
			return $message;
		}
	}
	
	public function getProductsByCategory($id){
		$ids = explode(",",$id);
		$this->db->select('product_id as value, name as name');
		$this->db->from ( TABLES::$PRODUCT );
		$this->db->where_in('product_type',$ids);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProductsByIds($id){
		$ids = explode(",",$id);
		$this->db->select('*');
		$this->db->from ( TABLES::$PRODUCT );
		$this->db->where_in('product_id',$ids);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function  addCustomerOrder($order,$addressid,$products,$qty,$unitprice,$hunitpricetotal){
		$message = array();
		$result = 0;
		if($order['userid']>0){
			$this->db->insert(TABLES::$ORDER,$order);
			$message['id'] = $this->db->insert_id ();
			$message['status'] = 1;
			$flag = false;
			if($message['id'] > 0){
				$ordercode['ordercode'] =strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($message['id'], 10, 36)) ;
				$this->db->where('orderid', $message['id']);
				$this->db->update(TABLES::$ORDER, $ordercode);
				$users = $this->getCustomerById($order['userid']);
				$useraddress = $this->getUserAddressById($addressid);
				foreach($users as $user){
					$name = $user['name'];
				}
				$ordercustomer = array(
							'orderid'=>$message['id'],
							'userid'=> $order['userid'],
							'name'=> $users[0]['name'],
							'email'=>$users[0]['email'],
							'mobile'=>$users[0]['mobile'],
							'areaid' => $useraddress[0]['areaid'],
							'locality' => $useraddress[0]['locality'],
							'latitude' => $useraddress[0]['latitude'],
							'longitude' => $useraddress[0]['longitude'],
							'address' => $useraddress[0]['address'],
							'landmark' => $useraddress[0]['landmark'],
							'source' => $users[0]['source']
						);	
				$this->db->insert(TABLES::$ORDER_CUSTOMER,$ordercustomer);
				$productcount = count($products);
				for($a =0;$a<$productcount;$a++){
					$product = $this->getProductsById($products[$a]);
					
					$orderitem = array(
						'orderid' => $message['id'],
						'itemid' =>$products[$a],
						'option_id' => $product[0]['product_type'],
						'quantity' => $qty[$a],
						'size' => 0,
						'price' => $unitprice[$a],
						'total_amount' => $hunitpricetotal[$a],
						'packaging_charge' => 0,
						'ufoid' => 0
					);
					$updateQty = $product[0]['quantity']-$qty[$a];
					if($updateQty > 0){
					$this->db->set('quantity', $updateQty);
					$this->db->where('product_id', $products[$a]);
					$this->db->update('product');
					$this->db->insert(TABLES::$ORDER_ITEM,$orderitem);
					$result = $this->db->insert_id();
					}else{
						$flag = true;
					}
				}
				if($result > 0){
					$message['status'] = 1;
					$message['msg'] = 'Order placed successfully';
				}else{
					$message['status'] = 0;
					$message['msg'] = "Fail to place order. Please try again";
				}
			}else{
				$message['status'] = 0;
				$message['msg'] = 'Fail to place order. Please try again';
			}
		}else{
			$message['id'] = 0;
			$message['status'] = 0;
			$message['msg'] = 'Fail to place order. Please try again';
		}
		return $message;
	}
	
	public function getUserAddressById($id){
		$this->db->select('*');
		$this->db->from(TABLES::$USER_ADDRESS);
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getProductsById($productid){
		$this->db->select('*');
		$this->db->from(TABLES::$PRODUCT);
		$this->db->where('product_id',$productid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrderList(){
		$this->db->select('a.orderid,a.ordercode,a.grand_total,b.name,b.mobile,b.email');
		$this->db->from(TABlES::$ORDER.' AS a');
		$this->db->join(TABlES::$USERS.' AS b','b.id=a.userid','left');
		$this->db->order_by("a.orderid","DESC");
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
				
	}
}