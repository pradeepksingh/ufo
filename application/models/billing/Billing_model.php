<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class billing_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function addEffectiveServiceTax($params) {
		$result = $this->getServiceTaxByDate ( $params['name'], $params['from_dt'] );
		$data =array();
		if (count ( $result ) > 0) {
				
			if (($result [0] ['to_dt'] == null ||$result [0] ['to_dt'] = "000-00-00" ) && $params ['from_dt'] > $result [0] ['from_dt']) {
				$newdate = date ( 'Y-m-d', strtotime ( '-1 day', strtotime ( $params ['from_dt'] ) ) );
				$newparams = array ();
				$newparams ['to_dt'] = $newdate;				
				$this->db->where ( 'id', $result [0]['id'] );
				$this->db->where ( 'name', $result [0]['name'] );
				$this->db->update ( TABLES::$EFFECTIVE_SERVICE_TAX, $newparams );
				$this->db->insert ( TABLES::$EFFECTIVE_SERVICE_TAX, $params );
				error_log($this->db->last_query());
				$data ['status'] = 1;
				$data ['msg'] = 'Tax Updated successfully.';
			} else {
				$data ['status'] = 0;
				$data ['msg'] = 'Invalid effective date.';
			}
		} else {
			$this->db->insert ( TABLES::$EFFECTIVE_SERVICE_TAX, $params );
			$id = $this->db->insert_id ();
			$data ['id'] = $id;
			$data ['status'] = 1;
			$data ['msg'] = "Service Tax added successfully";
			error_log($this->db->last_query());
		}
		return $data;
	}
	
	public function getServiceTaxByDate( $taxname, $date) {
		$curr_date = $date;
		$this->db->select ( '*' )->from ( TABLES::$EFFECTIVE_SERVICE_TAX );
		$this->db->where ( "name ='".$taxname."'", '', FALSE );
		$this->db->where ( "('". $curr_date . "' BETWEEN from_dt AND to_dt", '', FALSE );
		$this->db->or_where ( " (to_dt IS NULL OR to_dt = '0000-00-00'))", '', FALSE );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getServiceTaxList($id = "") {
		$this->db->select ( '*' )->from ( TABLES::$EFFECTIVE_SERVICE_TAX );
		if ($id > 0)
			$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	function updateEffServiceTax($params) {
		$this->db->where ( 'id', $params ['id'] );
		$this->db->update ( TABLES::$EFFECTIVE_SERVICE_TAX, $params );
		
		$data ['status'] = 1;
		$data ['message'] = "Service Tax updated successfully";
		return $data;
	}
	
	public function addRestCommission($params) {
		$result = $this->getRestaurantCommissionByDate ( $params['restid'], $params['from_date'] );
		$data =array();
		if (count ( $result ) > 0) {
			
			if (($result [0] ['to_date'] == null ||$result [0] ['to_date'] = "000-00-00" ) && $params ['from_date'] > $result [0] ['from_date']) {
				$newdate = date ( 'Y-m-d', strtotime ( '-1 day', strtotime ( $params ['from_date'] ) ) );
				$newparams = array ();
				$newparams ['to_date'] = $newdate;
				$this->db->where ( 'restid', $params ['restid'] );
				$this->db->where ( 'id', $result [0]['id'] );
				$this->db->update ( TABLES::$RESTAURANT_COMMISSION, $newparams );
				$this->db->insert ( TABLES::$RESTAURANT_COMMISSION, $params );
				error_log($this->db->last_query());
				$data ['status'] = 1;
				$data ['msg'] = 'Restaurant Commission Updated successfully.';
			} else {
				$data ['status'] = 0;
				$data ['msg'] = 'Invalid effective date.';
			}
		} else {
			$this->db->insert ( TABLES::$RESTAURANT_COMMISSION, $params );
			$id = $this->db->insert_id ();
			$data ['id'] = $id;
			$data ['status'] = 1;
			$data ['msg'] = 'Restaurant Commission added successfully.';
			error_log($this->db->last_query());
		}
		return $data;
		//**************************************
	}
	
	public function getRestaurantCommissionByDate($restid, $date) {
		$curr_date = $date;
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_COMMISSION .' as rc');
		$this->db->where ( "restid=" . $restid ." AND '" . $curr_date . "' BETWEEN from_date AND to_date", '', FALSE );
		$this->db->where ( 'effective_date <= ', "'" . $curr_date . "'", false );
		$this->db->where ( "(( to_date >= '$curr_date' )OR (rc.to_date ='0000-00-00' OR rc.to_date IS NULL ))");
		$this->db->where ( ' rc.restid = ', $restid, false );
	
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCommissionList($id = "") {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_COMMISSION );
		if ($id > 0)
			$this->db->where ( 'restid', $id );
			// echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	function getRestCommission($id = "") {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_COMMISSION );
		if ($id > 0)
			$this->db->where ( 'id', $id );
	  	//echo "<br><br/>".$this->db->_compile_select();
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		return $result;
	}
	function addRestBillingItem($map) {
		$this->db->insert ( TABLES::$RESTAURANT_BILLING_ITEM, $map );
		$id = $this->db->insert_id ();
		$data ['id'] = $id;
		$data ['status'] = 1;
		$data ['message'] = "Restaurant Billing Item added successfully";
		return $data;
	}
	function getRestBillingItemList($id = "") {
		$params = array (
				'restid' => $id 
		);
		$this->db->select ( "a.id,restid,b.name as billing_head,c.name as billing_sub_head,
							amount,a.description,orderId,item_type,date_format(billing_date,'%Y-%m-%d') as billing_date, a.status,   
                              is_service_tax_applicable, adjustment, is_separate_invoice, date_format(billing_date,'%d-%m-%Y') as billing_date2,
                              billing_frequency, a.created_on,a.created_by,a.modified_on,a.modified_by" )
		->from ( TABLES::$RESTAURANT_BILLING_ITEM . ' AS a' )
		->join ( TABLES::$BILLING_HEAD_CATEGORY . ' AS b', 'b.id = a.head_cat_id', 'left' )
		->join ( TABLES::$BILLING_HEAD_SUB_CATEGORY . ' AS c', 'c.id = a.head_sub_cat_id', 'left' )
		->where ( $params );
		// echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	function getRestBillingItem($id = "") {
		$this->db->select ( 'a.id,restid,a.head_cat_id,a.head_sub_cat_id,
							amount,a.description,orderId,item_type,date_format(billing_date,"%Y-%m-%d")billing_date,
							date_format(billing_date,"%d-%m-%Y")billing_date2, status,   
                              is_service_tax_applicable,  adjustment, is_separate_invoice,  
                              billing_frequency, a.created_on,a.created_by,a.modified_on,a.modified_by' )
		->from ( TABLES::$RESTAURANT_BILLING_ITEM. ' AS a' );
		if ($id > 0)
			$this->db->where ( 'id', $id );
		//echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	function updateRestBillingItem($params) {
		$this->db->where ( 'id', $params ['id'] );
		$this->db->update ( TABLES::$RESTAURANT_BILLING_ITEM, $params );
		$data ['status'] = 1;
		$data ['message'] = "Billing item updated successfully";
		return $data;
	}
	function updateRestCommission($params) {
		
		$this->db->where ( 'id', $params ['id'] );
		$this->db->update ( TABLES::$RESTAURANT_COMMISSION, $params );
		//echo $this->db->last_query();
		$data ['status'] = 1;
		$data ['message'] = "Commission details updated successfully";
		return $data;
	}
	function addBillingHeadCategory($map) {
		$this->db->insert ( TABLES::$BILLING_HEAD_CATEGORY, $map );
		$id = $this->db->insert_id ();
		$data ['id'] = $id;
		$data ['status'] = 1;
		$data ['message'] = "Billing Head Category added successfully";
		return $data;
	}
	function getBillingHeadCategoryList($id = "") {
		$this->db->select ( '*' )->from ( TABLES::$BILLING_HEAD_CATEGORY );
		if ($id > 0)
			$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	function updateBillingHeadCategory($params) {
		$this->db->where ( 'id', $params ['id'] );
		$this->db->update ( TABLES::$BILLING_HEAD_CATEGORY, $params );
		// echo $this->db->last_query();
		$data ['status'] = 1;
		$data ['message'] = "Billing Head Category updated successfully";
		return $data;
	}
	function addBillingSubHeadCategory($map) {
		$this->db->insert ( TABLES::$BILLING_HEAD_SUB_CATEGORY, $map );
		$id = $this->db->insert_id ();
		$data ['id'] = $id;
		$data ['status'] = 1;
		$data ['message'] = "Billing Head Sub Category added successfully";
		return $data;
	}
	function getBillingSubHeadCategoryList($id = "") {
		$this->db->select ( 'b.id as catid,a.id ,a.head_cat_id,b.name as catname,a.name as subcatname,a.description ' )->from ( TABLES::$BILLING_HEAD_SUB_CATEGORY . ' as a' )->join ( TABLES::$BILLING_HEAD_CATEGORY . ' AS b', 'b.id = a.head_cat_id', 'inner' );
		
		if ($id > 0)
			$this->db->where ( 'a.id', $id );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	function updateBillingSubHeadCategory($params) {
		$this->db->where ( 'id', $params ['id'] );
		$this->db->update ( TABLES::$BILLING_HEAD_SUB_CATEGORY, $params );
		// echo $this->db->last_query();
		$data ['status'] = 1;
		$data ['message'] = "Billing Head Sub Category updated successfully";
		return $data;
	}
	function getBillingSubCategoryByCategoryId($catid) {
		$this->db->select ( '*' )->from ( TABLES::$BILLING_HEAD_SUB_CATEGORY . ' as a' );
		if ($catid > 0)
			$this->db->where ( 'a.head_cat_id', $catid );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	function getEffectiveServiceTax($from_date, $to_date = "") {
		$this->db->select ( '*' )->from ( TABLES::$EFFECTIVE_SERVICE_TAX );
		if ($from_date != "")
			$this->db->where ( 'effective_dt >=', $from_date );
			/*
		 * if ($to_date != "")
		 * $this->db->where ( 'to_dt >=', $to_date );
		 */
			// echo $this->db->_compile_select();
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		return $result;
	}
	function getEffectiveCommissionByRestaurant($restid, $from_date, $to_date = "") {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_COMMISSION );
		if ($restid > 0)
			$this->db->where ( 'restid', $restid );
		if ($from_date != "")
			$this->db->where ( 'effective_date >=', $from_date );
		if ($to_date != "")
			$this->db->where ( 'to_dt >=', $to_date );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	function getRestaurantGatewayCharge($restid, $from_date, $to_date) {
		$this->db->select ( 'r.id,r.name, r.packaging_charge,rbf.value as gateway_charge,							
							rbf.billing_field, rbf.from_date, rbf.to_date ' )->from ( TABLES::$RESTAURANT . ' as r' )->join ( TABLES::$RESTAURANT_BILLING_FIELDS . ' AS rbf', 'r.id = rbf.restid', 'inner' );
		$this->db->where ( 'rbf.billing_field', 'gateway_effective_date', true );
		$this->db->where ( ' rbf.from_date <= ', "'" . $from_date . "'", false );
	    $this->db->where ( "(( rbf.to_date >= '$to_date' )OR (rbf.to_date ='0000-00-00' OR rbf.to_date IS NULL ))");
		
		$this->db->where ( ' rbf.restid = ', $restid, false );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	function getRestaurantCommission($restid, $from_date, $to_date) {
		$this->db->select ( '`r`.`id` as restid, `r`.`name`, `r`.`packaging_charge`,rc.from_date, rc.to_date,
							rc.commission_plan,rc.count_amount,rc.lower_limit,
							rc.upper_limit ,rc.comm_type,rc.comm_amt,rbc.delivery_type,rc.comm_amt_zyk ' )
							->from ( TABLES::$RESTAURANT . ' as r' )
		->join ( TABLES::$RESTAURANT_COMMISSION . ' AS rc', 'r.id = rc.restid', 'inner' )
		->join ( TABLES::$RESTAURANT_BILLING_CONFIG . ' AS rbc', 'r.id = rbc.restid', 'inner' );
		$this->db->where ( 'rc.effective_date <= ', "'" . $from_date . "'", false );
		$this->db->where ( "(( rc.to_date >= '$from_date' )OR (rc.to_date ='0000-00-00' OR rc.to_date IS NULL ))");
		$this->db->where ( ' rc.restid = ', $restid, false );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	
	function getOrdersToBeInvoicedByRestaurant($restid, $from_date, $to_date = "") {
		$from_date = date_create($from_date);
		$from_date = date_format($from_date,'Y-m-d');
		
		$this->db->select ( ' orderid , ordercode, restid, userid,areaid,
                        sub_total,zyk_discount,rest_discount,order_tax,delivery_charge,
                        packaging_charge,total_amount,is_takeaway,is_online_paid,payment_status,
                        delivery_date, delivery_time,coupon_code,
                        date_format(created_date,"%Y-%m-%d") as created_date , status, cse_id ' )->from ( TABLES::$ORDER . ' as a' );
		 $this->db->where ( 'a.status', '1');
		 if($to_date <> '0000-00-00 00:00:00')
				 $this->db->where ( " date_format(created_date,'%Y-%m-%d') BETWEEN '" . $from_date . "' AND '" . $to_date . "'");
		 else				 		
		 		$this->db->where (" date_format(created_date,'%Y-%m-%d') >= '".$from_date."'", "", false );
		if ($restid > 0)
			$this->db->where ( 'restid', $restid );
		
	//	error_log($this->db->_compile_select());
		 //echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result;
	}
	
	
	function getTotalOrdersAmtByRestaurant($restid, $from_date, $to_date = "") {
		$this->db->select ( 'COUNT( orderid) as ordercnt , SUM(total_amount) as orderamt' )->from ( TABLES::$ORDER . ' as a' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( " created_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'", "", false );
		if ($restid > 0)
			$this->db->where ( 'a.restid', $restid );
			// echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result;
	}
	
	function getOrderCommissionByDate($commPlan, $orderCntAmt, $restid, $from_date) {
		$this->db->select ( '`r`.`id`, `r`.`name`, `r`.`packaging_charge`,rc.from_date, rc.to_date,
							rc.commission_plan,rc.count_amount,rc.lower_limit,
							rc.upper_limit ,rc.comm_type,rc.comm_amt ,rc.comm_amt_zyk' )
		->from ( TABLES::$RESTAURANT . ' as r' )->join ( TABLES::$RESTAURANT_COMMISSION . ' AS rc', 'r.id = rc.restid', 'inner' );
		$this->db->where ( 'rc.effective_date <= ', "'" . $from_date . "'", false );
		$this->db->where ( "(( rc.to_date >= '$from_date' )OR (rc.to_date ='0000-00-00' OR rc.to_date IS NULL ))");
		$this->db->where ( ' rc.restid = ', $restid, false );
		if ($commPlan == 0) { // regular
		} else if ($commPlan == 1 || $commPlan == 2) { // range
			$this->db->where ( $orderCntAmt . " BETWEEN rc.lower_limit AND rc.upper_limit" );
		}
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	function getBillingTaxes($from_date, $to_date = "") {
		$this->db->select ( '*' )->from ( TABLES::$EFFECTIVE_SERVICE_TAX );
		if($from_date != "")
			$this->db->where ( 'effective_dt <=', $from_date );
		//echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	function getRestaurantBillingCycle($restId, $invoiceDate) {
		//echo "Invoice Date=".$invoiceDate;
		/*if($invoiceDate <> "0000-00-00 00:00:00" ){
			$invoiceDate = $invoiceDate->format('Y-m-d');
		
		}*/
		//echo "Invoice DateBilling model = ".$invoiceDate;
		$this->db->select ( 'r.id,r.name, rbf.value as cycleType,
							(SELECT CASE rbf.value
                             WHEN  "1" THEN "Weekly"
                             WHEN  "2" THEN "Fortnightly"
                             WHEN  "3" THEN "Monthly"
                             ELSE "Not specified"
                            END) as billing_cycle,rbc.last_invoice_date, rbc.next_invoice_date,
						rbf.billing_field, rbf.from_date, rbf.to_date ' )
		->from ( TABLES::$RESTAURANT . ' as r' )
		->join ( TABLES::$RESTAURANT_BILLING_CONFIG . ' AS rbc', 'r.id = rbc.restid', 'inner' )
		->join ( TABLES::$RESTAURANT_BILLING_FIELDS . ' AS rbf', 'r.id = rbf.restid', 'inner' );
		if($invoiceDate <> "0000-00-00 00:00:00" ){
			$this->db->where ( "('" . $invoiceDate ."'>= rbf.from_date )", "", false );
		}
		$this->db->where ( 'rbf.billing_field', 'cycle_effective_date', true );
		$this->db->where ( 'r.id', $restId, true );
// 		/echo $this->db->_compile_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) > 0) {
			return $result [0];
		} else {
			return null;
		}
	}
	
	public function updateRestaurantInvoiceDates($restId, $lastInvoiceDate, $nextInvoiceDate){
		$params =array();
		$params['last_invoice_date'] = $lastInvoiceDate;
		if(!empty($params['next_invoice_date']))
			$params['next_invoice_date'] = $nextInvoiceDate->format('Y-m-d');
		$params['restid'] = $restId;
		
		$this->db->where('restid',$params['restid']);
		$flag = $this->db->update(TABLES::$RESTAURANT_BILLING_CONFIG,$params);
		if ($flag) {
			$map['status'] = 1;
			$map['msg'] = 'Updated successfully.';
		} else {
			$map['status'] = 1;
			$map['msg'] = 'Updated successfully.';
		}
		return $map;
	}
		
	public function getRestaurantBillingConfig($restid){
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_BILLING_CONFIG );
		if ($restid != "")
			$this->db->where ( 'restid =', $restid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result;
	}
		
	public function getMaxFromDateByRestComm($restid) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_COMMISSION . ' AS rc WHERE restid ='.$restid. ' AND from_date = (SELECT max(from_date) FROM tbl_restaurant_commission rc WHERE restid ='.$restid.')' );
		
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRestBillingInvoices($restid){
		$this->db->select ( '*' )->from ( TABLES::$BILLING_INVOICES . ' AS bi WHERE restid ='.$restid );
		
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
} 