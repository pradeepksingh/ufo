<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Invoicing extends MX_Controller {
	public $arrInvoiceEmail = array ();
	public $billingType = "";
	public $dtRange = "";
	public function __construct() {
		parent::__construct ();
		
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	public function getInvoiceRestaurants() {
		$this->load->library ( 'zyk/BillingLib' );
		$this->load->library ( 'zyk/InvoicingLib' );
		$this->load->library ( 'zyk/General' );
		$dataMap = array ();
		$dataMap ['date_generated'] = date ( 'Y-m-d' );
		$dataMap ['cityid'] = $this->input->post ( 'cityid', TRUE );
		$dataMap ['billingCycle'] = $this->input->post ( 'billing_cycle', TRUE );
		$invoiceRestaurants = "";
		$cities = $this->general->getCities ();
		$this->template->set ( 'cities', $cities );
		$this->template->set ( 'date_generated', date ( 'Y-m-d' ) );
		
		if ($dataMap ['cityid'] != "" && $dataMap ['date_generated'] != "") {
			$invoiceRestaurants = $this->invoicinglib->getInvoiceBillingRestaurants ( $dataMap );
			// print_r($invoiceRestaurants);
			$this->template->set ( 'invoiceRestaurants', $invoiceRestaurants );
			$this->template->set ( 'date_generated', date ( 'Y-m-d' ) );
			$this->template->set ( 'cityid', $dataMap ['cityid'] );
			$this->template->set ( 'billingCycle', $this->input->post ( 'billing_cycle', TRUE ) );
		}
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Invoicing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'invoicing/generateInvoice' );
	}
	
	
	
	public function generateInvoice() {
		$this->load->library ( 'zyk/BillingLib' );
		$this->load->library ( 'zyk/InvoicingLib' );
		$this->load->library ( 'zyk/General' );
		$this->load->library ( 'zyk/RestaurantLib' );
		$this->load->library ( 'm_pdf' );
		$dataMap ['date_generated'] = date ( 'Y-m-d' );
		$dataMap ['cityid'] = $this->input->post ( 'cityid', TRUE );
		$dataMap ['billingCycle'] = $this->input->post ( 'billing_cycle', TRUE );
		if ($dataMap ['cityid'] != "" && $dataMap ['date_generated'] != "") {
			$invoiceRestaurants = $this->invoicinglib->getInvoiceBillingRestaurants ( $dataMap );
		}
		
		$arrInvoices = array ();
		$fromDate = date ( 'Y-m-d' );
		$blnInvoiceSuccess = 0;
		$restids_invoice = "";
		$restids_gen_invoice = "";
		$restids_invoice_not_gen = "";
		$folderLink = "";
		$i = 1;
		$dirPath = FCPATH . "assets/invoices/";
		$rsclearEmail = $this->invoicinglib->clearInvoiceEmail ();
		foreach ( $invoiceRestaurants as $key => $value ) {
			$fromDate = strtotime ( $value ['last_invoice_date'] );
			$fromDate = date ( 'Y-m-d H:i:s', strtotime ( '+1 day', $fromDate ) );
			$toDate = $value ['next_invoice_date'];
			$restids_invoice .= $value ['id'] . ",";
			if (empty ( $fromDate ) || $fromDate = "0000-00-00 00:00:00") {
				if ($dataMap ['billingCycle'] == 1) {
					$arrDates = $this->invoicinglib->getWeeklyBillingDates ();
					$this->billingType = 'Weekly';
				} elseif ($dataMap ['billingCycle'] == 2) {
					$arrDates = $this->invoicinglib->getFortnightBillingDates ();
					$this->billingType = 'Fortnightly';
				} elseif ($dataMap ['billingCycle'] == 3) {
					$arrDates = $this->invoicinglib->getMonthlyBillingDates ();
					$this->billingType = 'Monthly';
				}
				$fromDate = $arrDates ['fromdate'];
				$toDate = $arrDates ['todate'];
				
			}
			
			$invoiceMap ['rest_id'] = $value ['id'];
			$invoiceMap ['from_date'] = $fromDate;
			$invoiceMap ['to_date'] = $toDate;
			$invoiceMap ['date_generated'] = date ( 'Y-m-d' );
			$invoiceMap ['bill_type'] = 0;
			// create a folder for invoices
			$dirFolder = "invoices_" . $this->billingType . "_" . date ( 'Y-m-d' );
			
			if (is_dir ( $dirPath . $dirFolder ) === false)
			mkdir ( $dirPath . $dirFolder );
			$invoiceFolderPath = $dirPath . $dirFolder . "/";
			$folderLink = $dirPath . $dirFolder . '.zip';
			
			$invoice = $this->invoicinglib->getInvoiceBetweenDateRange ( $invoiceMap );
			
			if (count ( $invoice ) <= 0) {
				
				$billingTax = $this->billinglib->getBillingTaxes ( $fromDate, $toDate );
				// print_r($billingTax);
				$restDetails = $this->restaurantlib->getRestaurantBasicDetails ( $value ['id'] );
				$restBilling = $this->restaurantlib->getRestaurantBillingConfig ( $value ['id'] );
				$restContacts = $this->restaurantlib->getRestaurantContacts ( $value ['id'] );
				
				$orderBill = $this->invoicinglib->calculateOrderInvoice ( $value ['id'], $billingTax, $fromDate, $toDate );
				$subscriptionBill = $this->invoicinglib->calculateSubscriptionInvoice ( $value ['id'], $billingTax, $fromDate, $toDate );
				// echo "<pre>";
				// print_r($orderBill);
				if (count ( $orderBill ) > 0) {
					$restids_gen_invoice .= $value ['id'] . ",";
					$blnInvoiceSuccess = 1;
					$invoiceCode = $this->invoicinglib->generateInvoiceCode ( $value ['id'] );
					$billingTotal = $orderBill ['TotalBillingAmount'];
					// $invoiceStatus = $this->invoicinglib->getCompanyInvoiceStatus($companyDetail, $billingTotal);
					$invoiceFileName = $this->invoicinglib->getInvoiceFileName ( $value ['id'], $value ['name'], $invoiceCode );
					$this->template->set ( 'restDetails', $restDetails );
					$this->template->set ( 'restBilling', $restBilling );
					$this->template->set ( 'restContacts', $restContacts );
					$this->template->set ( 'orderBill', $orderBill );
					$this->template->set ( 'finalTotal', $billingTotal );
					$this->template->set ( 'restBillingTax', $billingTax );
					
					$this->template->set ( 'orderRecs', $orderBill ['OrderData'] [0] ['orderData'] );
					$this->template->set ( 'invoiceRecs', $orderBill ['OrderData'] [0] ['invoiceData'] );
					$this->template->set ( 'otheritemsRecs', $subscriptionBill );
					
					// save invoice to db
					$taxvalue = 0;
					$invoiceFileName = str_replace ( ".html", "", $invoiceFileName );
					$invoiceFilePath = $invoiceFolderPath . $invoiceFileName . ".pdf";
					$invoiceData ['invoice_code'] = $invoiceCode;
					$invoiceData ['from_date'] = $fromDate;
					$invoiceData ['to_date'] = $toDate;
					$invoiceData ['is_single_billing'] = "0";
					$invoiceData ['date_generated'] = date ( 'Y-m-d' );
					$invoiceData ['rest_id'] = $value ['id'];
					$invoiceData ['invoice_status'] = "";
					$invoiceData ['is_debit'] = "0";
					$invoiceData ['invoice_filename'] = str_replace ( '\\', '/', 'invoices/' . $invoiceFileName . ".pdf" );
					$invoiceData ['billing_cycle_id'] = $dataMap ['billingCycle'];
					$invoiceData ['total_commission'] = $orderBill ['CommissionableTotal'];
					foreach ( $orderBill ['InvoiceTax'] as $tax ) {
						$taxvalue += $tax ['taxvalue'];
					}
					$invoiceData ['total_service_tax'] = $taxvalue;
					
					$invoiceData ['billing_total'] = $orderBill ['TotalBillingAmount'];
					$invoiceresponse = $this->invoicinglib->addInvoice ( $invoiceData );
					// print_r ( $invoiceresponse );
					$invoiceId = $invoiceresponse [0] ['id'];
					$invoiceGenDate = $invoiceresponse [0] ['date_generated'];
					// error_reporting(0);
					$arrInvoices [$value ['id']] = $invoiceFilePath;
					
					$this->template->set ( 'invoiceData', $invoiceData );
					$this->template->set ( 'page', '' );
					
					// echo $this->template->build ( 'invoicing/invoiceTemplate' );
					// exit;
					// / ob_start();
					$htmlbuffer = $this->template->build ( 'invoicing/invoiceTemplateNew' );
					// ob_get_clean();
					// $len = ob_get_length() ;
					// ob_end_clean();
					// ob_end_flush();
					$pdf = $this->m_pdf->load ();
					$pdf->WriteHTML ( $htmlbuffer );
					$pdf->Output ( $invoiceFilePath, "F" );
					$nextInvoiceDate = $this->invoicinglib->getCompanyNextInvoiceDate ( $value ['id'], $toDate );
					$commamounttot = 0;
					$finaltot = 0;
					$gatewaytot = 0;
					// update tables after invoice generated
					$invoiceMap = array ();
					$invoiceMap ['restid'] = $value ['id'];
					$invoiceMap ['from_date'] = $fromDate;
					$invoiceMap ['to_date'] = $toDate;
					$invoiceMap ['date_generated'] = date ( 'Y-m-d' );
					$invoiceMap ['invoiceid'] = $invoiceId;
					$this->invoicinglib->updateRestaurantInvoiceDates ( $value ['id'], $toDate, $nextInvoiceDate );
					$this->invoicinglib->updateRestaurantOrderBilling ( $invoiceMap );
					$this->invoicinglib->updateRestaurantOtherBilling ( $invoiceMap );
					foreach($subscriptionBill[0]['oitems'] as $bill){
						$this->invoicinglib->updateRestaurantSubscription($bill['item_id']);
					}
					
					$this->arrInvoiceEmail ['email'] = $restContacts [0] ['invoice_notify_email'];
					$this->arrInvoiceEmail ['file_link'] = str_replace ( '\\', '/', $invoiceFilePath );
					$this->arrInvoiceEmail ['messagetxt'] = "";
					$this->arrInvoiceEmail ['subject'] = " Invoice for billing cycle - " . $fromDate . " To " . $toDate;
					$this->arrInvoiceEmail ['rest'] = $value ['id'] . "-" . $value ['name'];
					$saveres = $this->invoicinglib->saveInvoiceEmail ( $this->arrInvoiceEmail );
				} else {
					$restids_invoice_not_gen .= $value ['id'] . ",";
				} // end if count of orders to be invoiced
			} else {
				$blnInvoiceSuccess = 3;
			}
		} // foreach
		
		$arrResponse = array ();
		
		if ($blnInvoiceSuccess == 1) {
			// make zip file
			exec ( 'zip -r ' . $dirPath . $dirFolder . ' ' . $dirPath . $dirFolder );
			
			// admin email
			$this->arrInvoiceEmail ['email'] = "avinashw@olotime.com";
			// $this->arrInvoiceEmail ['email'] = "shinee.dcosta@gmail.com";
			$folderLink = str_replace ( '\\', '/', $folderLink );
			$this->arrInvoiceEmail ['file_link'] = $folderLink;
			$this->arrInvoiceEmail ['rest'] = 'olotime Admin';
			$this->dtRange = " billing cycle - " . $fromDate . " To " . $toDate;
			$this->arrInvoiceEmail ['messagetxt'] = "";
			// $this->arrInvoiceEmail['messagetxt'] = "<br/> Restaurants to be invoiced = ".$restids_invoice;
			// $this->arrInvoiceEmail['messagetxt'] .= "<br/> Restaurants invoice generated = ".$restids_gen_invoice ;
			// $this->arrInvoiceEmail['messagetxt'] .="<br/> Restaurants invoice not generated = ".$restids_invoice_not_gen ;
			$this->arrInvoiceEmail ['subject'] = " Invoice for billing cycle - " . $fromDate . " To " . $toDate;
			
			$saveres = $this->invoicinglib->saveInvoiceEmail ( $this->arrInvoiceEmail );
		}
		$arrResponse ['status'] = $blnInvoiceSuccess;
		if ($blnInvoiceSuccess == 1) {
			$arrResponse ['message'] = "Invoices generated successfully. Please download invoices folder at :<b> " . $folderLink . "</b>";
			// $arrResponse['message'] .= "<br/> Restaurants invoice not generated = ".$restids_invoice_not_gen ;;
		} else if ($blnInvoiceSuccess == 0) {
			$arrResponse ['message'] = "Invoices not generated successfully";
		} else if ($blnInvoiceSuccess == 3)
			$arrResponse ['message'] = "Invoices have been already generated for billing cycle - " . $fromDate . " To " . $toDate;
		
		echo json_encode ( $arrResponse );
		exit ();
	} // generate invoice
	
	public function sendInvoiceEmail() {
		$this->load->library ( 'zyk/InvoicingLib' );
		$arrResponse = array ();
		$resp = "";
		
		$resp = $this->invoicinglib->sendInvoiceEmails ();
		if ($resp) {
			$arrResponse ['message'] = "Invoices emailed to Restaurants !. ";
			$arrResponse ['emailstatus'] = 1;
		} else {
			$arrResponse ['message'] = "There was a problem sending invoice email !. ";
			$arrResponse ['emailstatus'] = 0;
		}
		echo json_encode ( $arrResponse );
	}
	public function getCustomInvoiceRestaurants() {
		$this->load->library ( 'zyk/BillingLib' );
		$this->load->library ( 'zyk/InvoicingLib' );
		$this->load->library ( 'zyk/General' );
		
		$dataMap = array ();
		$dataMap ['fromDate'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'cycle_from_date', TRUE ) ) );
		$dataMap ['toDate'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'cycle_to_date', TRUE ) ) );
		$dataMap ['cityid'] = $this->input->post ( 'cityid', TRUE );
		$dataMap ['billingCycle'] = $this->input->post ( 'billing_cycle', TRUE );
		$dataMap ['restId'] = $this->input->post ( 'restid', TRUE );
		$invoiceRestaurants = "";
		$cities = $this->general->getCities ();
		$this->template->set ( 'cities', $cities );
		
		if ($dataMap ['cityid'] != "" && $dataMap ['fromDate'] != "" && $dataMap ['toDate'] != "") {
			$invoiceRestaurants = $this->invoicinglib->getCustomInvoiceBillingRestaurants ( $dataMap );
			// print_r($invoiceRestaurants);
			$this->template->set ( 'invoiceRestaurants', $invoiceRestaurants );
			$this->template->set ( 'to_date', $this->input->post ( 'cycle_to_date', TRUE ) );
			$this->template->set ( 'from_date', $this->input->post ( 'cycle_from_date', TRUE ) );
			$this->template->set ( 'restid', $this->input->post ( 'restid', TRUE ) );
			$this->template->set ( 'cityid', $dataMap ['cityid'] );
			$this->template->set ( 'billingCycle', $this->input->post ( 'billing_cycle', TRUE ) );
		}
		$this->template->set_layout ( 'backend' )->title ( 'Administrator | Invoicing' )->set_partial ( 'header', 'partials/header' )->set_partial ( 'leftnav', 'billing/menu' )->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ( 'invoicing/generateCustomInvoice' );
	}
	
	public function generateCustomInvoice() {
		$this->load->library ( 'zyk/BillingLib' );
		$this->load->library ( 'zyk/InvoicingLib' );
		$this->load->library ( 'zyk/General' );
		$this->load->library ( 'zyk/RestaurantLib' );
		$this->load->library ( 'm_pdf' );
		
		$dataMap ['toDate'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'cycle_to_date', TRUE ) ) );
		$dataMap ['fromDate'] = date ( 'Y-m-d', strtotime ( $this->input->post ( 'cycle_from_date', TRUE ) ) );
		$dataMap ['cityid'] = $this->input->post ( 'cityid', TRUE );
		$dataMap ['billingCycle'] = $this->input->post ( 'billing_cycle', TRUE );
		$dataMap ['restId'] = $this->input->post ( 'restid', TRUE );
		if ($dataMap ['cityid'] != "" && $dataMap ['fromDate'] != "" && $dataMap ['toDate'] != "") {
			$invoiceRestaurants = $this->invoicinglib->getCustomInvoiceBillingRestaurants ( $dataMap );
		}
		
		$arrInvoices = array ();
		
		$blnInvoiceSuccess = 0;
		$restids_invoice = "";
		$restids_gen_invoice = "";
		$restids_invoice_not_gen = "";
		$folderLink = "";
		$i = 1;
		$rsclearEmail = $this->invoicinglib->clearInvoiceEmail ();
		foreach ( $invoiceRestaurants as $key => $value ) {
			
			$fromDate = $dataMap ['fromDate'];
			$toDate = $dataMap ['toDate'];
			if ($dataMap ['billingCycle'] == 1) {
				$this->billingType = 'Weekly';
			} elseif ($dataMap ['billingCycle'] == 2) {
				$this->billingType = 'Fortnightly';
			} elseif ($dataMap ['billingCycle'] == 3) {
				$this->billingType = 'Monthly';
			}
			
			$invoiceMap ['restId'] = $value ['id'];
			$invoiceMap ['fromDate'] = $fromDate;
			$invoiceMap ['toDate'] = $toDate;
			$invoiceMap ['bill_type'] = 0;
			// create a folder for invoices
			$dirFolder = "custom_invoices_" . $this->billingType. "_" .date ( 'Y-m-d' );
			
			$dirPath = FCPATH . "assets/invoices/";
			if (is_dir ( $dirPath . $dirFolder ) === false)
			mkdir ( $dirPath . $dirFolder );
			$invoiceFolderPath = $dirPath . $dirFolder . "/";
			$folderLink = $dirPath . $dirFolder . '.zip';
			
			$invoice = $this->invoicinglib->deleteInvoiceBetweenDateRange ( $invoiceMap );
			
			// print_r($invoice);
			if (count ( $invoice ) <= 0) {
				
				$billingTax = $this->billinglib->getBillingTaxes ( $fromDate, $toDate );
				// print_r($billingTax);
				$restDetails = $this->restaurantlib->getRestaurantBasicDetails ( $value ['id'] );
				$restBilling = $this->restaurantlib->getRestaurantBillingConfig ( $value ['id'] );
				$restContacts = $this->restaurantlib->getRestaurantContacts ( $value ['id'] );
				$isRegenerate = 1;
				$orderBill = $this->invoicinglib->calculateOrderInvoice ( $value ['id'], $billingTax, $fromDate, $toDate, $isRegenerate );
				$subscriptionBill = $this->invoicinglib->calculateSubscriptionInvoice ( $value ['id'], $billingTax, $fromDate, $toDate,$isRegenerate );
				// print_r($subscriptionBill);
				if (count ( $orderBill ) > 0) {
					$restids_gen_invoice .= $value ['id'] . ",";
					$blnInvoiceSuccess = 1;
					$invoiceCode = $this->invoicinglib->generateInvoiceCode ( $value ['id'] );
					$billingTotal = $orderBill ['TotalBillingAmount'];
					// $invoiceStatus = $this->invoicinglib->getCompanyInvoiceStatus($companyDetail, $billingTotal);
					$invoiceFileName = $this->invoicinglib->getInvoiceFileName ( $value ['id'], $value ['name'], $invoiceCode );
					$this->template->set ( 'restDetails', $restDetails );
					$this->template->set ( 'restBilling', $restBilling );
					$this->template->set ( 'restContacts', $restContacts );
					$this->template->set ( 'orderBill', $orderBill );
					// $this->template->set ( 'subscriptionBill', $subscriptionBill );
					$this->template->set ( 'finalTotal', $billingTotal );
					$this->template->set ( 'restBillingTax', $billingTax );
					$this->template->set ( 'orderRecs', $orderBill ['OrderData'] [0] ['orderData'] );
					$this->template->set ( 'invoiceRecs', $orderBill ['OrderData'] [0] ['invoiceData'] );
					$this->template->set ( 'otheritemsRecs', $subscriptionBill );
					// save invoice to db
					$taxvalue = 0;
					$invoiceFileName = str_replace ( ".html", "", $invoiceFileName );
					$invoiceFilePath = $invoiceFolderPath . $invoiceFileName . ".pdf";
					$invoiceData ['invoice_code'] = $invoiceCode;
					$invoiceData ['from_date'] = $fromDate;
					$invoiceData ['to_date'] = $toDate;
					$invoiceData ['is_single_billing'] = "0";
					$invoiceData ['date_generated'] = date ( 'Y-m-d' );
					$invoiceData ['rest_id'] = $value ['id'];
					$invoiceData ['invoice_status'] = "";
					$invoiceData ['is_debit'] = "0";
					$invoiceData ['invoice_filename'] = str_replace ( '\\', '/', 'invoices/' . $invoiceFileName . ".pdf" );
					$invoiceData ['billing_cycle_id'] = $dataMap ['billingCycle'];
					$invoiceData ['total_commission'] = $orderBill ['CommissionableTotal'];
					foreach ( $orderBill ['InvoiceTax'] as $tax ) {
						$taxvalue += $tax ['taxvalue'];
					}
					$invoiceData ['total_service_tax'] = $taxvalue;
					
					$invoiceData ['billing_total'] = $orderBill ['TotalBillingAmount'];
					$invoiceRec = $this->invoicinglib->addInvoice ( $invoiceData );
					$invoiceId = $invoiceRec [0] ['id'];
					// error_reporting(0);
					$arrInvoices [$value ['id']] = $invoiceFilePath;
					
					$this->template->set ( 'invoiceData', $invoiceData );
					$this->template->set ( 'page', '' );
					// echo $this->template->build ( 'invoicing/invoiceTemplateNew' );
					// exit;
					
					// ob_start();
					$htmlbuffer = $this->template->build ( 'invoicing/invoiceTemplateNew' );
					// ob_get_clean();
					// $len = ob_get_length() ;
					// ob_end_clean();
					// ob_end_flush();
					$pdf = $this->m_pdf->load ();
					$pdf->WriteHTML ( $htmlbuffer );
					$pdf->Output ( $invoiceFilePath, "F" );
					$nextInvoiceDate = $this->invoicinglib->getCompanyNextInvoiceDate ( $value ['id'], $toDate );
					$commamounttot = 0;
					$finaltot = 0;
					$gatewaytot = 0; //
					                 // update tables after invoice generated
					$invoiceMap = array ();
					$invoiceMap ['restid'] = $value ['id'];
					$invoiceMap ['from_date'] = $fromDate;
					$invoiceMap ['to_date'] = $toDate;
					$invoiceMap ['date_generated'] = date ( 'Y-m-d' );
					$invoiceMap ['invoiceid'] = $invoiceId;
					$this->invoicinglib->updateRestaurantInvoiceDates ( $value ['id'], $toDate, $nextInvoiceDate );
					$this->invoicinglib->updateRestaurantOrderBilling ( $invoiceMap );
					$this->invoicinglib->updateRestaurantOtherBilling ( $invoiceMap );
					
					foreach($subscriptionBill[0]['oitems'] as $bill){						
						$this->invoicinglib->updateRestaurantSubscription($bill['item_id']);
					}
									
					$this->arrInvoiceEmail ['email'] = $restContacts [0] ['invoice_notify_email'];
					$this->arrInvoiceEmail ['file_link'] = str_replace ( '\\', '/', $invoiceFilePath );
					$this->arrInvoiceEmail ['messagetxt'] = "";
					$this->arrInvoiceEmail ['subject'] = " Invoice for billing cycle - " . $fromDate . " To " . $toDate;
					$this->arrInvoiceEmail ['rest'] = $value ['id'] . "-" . $value ['name'];
					$saveres = $this->invoicinglib->saveInvoiceEmail ( $this->arrInvoiceEmail );
				} else {
					$restids_invoice_not_gen .= $value ['id'] . ",";
				} // end if count of orders to be invoiced
			}  // end if count of invoice
			else {
				$blnInvoiceSuccess = 3;
			}
		} // foreach
		  
		// error_log("Rest to be invoiced= ". $restids_invoice);
		error_log ( "Invoices generated for= " . $restids_gen_invoice );
		// error_log("Invoices not generated for = ".$restids_invoice_not_gen);
		// echo json_encode($arrInvoices);
		$arrResponse = array ();
		
		if ($blnInvoiceSuccess == 1) {
			// make zip file
			exec ( 'zip -r ' . $dirPath . $dirFolder . ' ' . $dirPath . $dirFolder );
			
			$this->arrInvoiceEmail ['email'] = "avinashw@olotime.com"; // admin email
			                                                            // $this->arrInvoiceEmail ['email'] = "shinee.dcosta@gmail.com";
			$folderLink = str_replace ( '\\', '/', $folderLink );
			$this->arrInvoiceEmail ['file_link'] = $folderLink;
			$this->arrInvoiceEmail ['rest'] = 'olotime Admin';
			$this->dtRange = " billing cycle - " . $fromDate . " To " . $toDate;
			$this->arrInvoiceEmail ['messagetxt'] = "";
			// $this->arrInvoiceEmail['messagetxt'] = "<br/> Restaurants to be invoiced = ".$restids_invoice;
			// $this->arrInvoiceEmail['messagetxt'] .= "<br/> Restaurants invoice generated = ".$restids_gen_invoice ;
			// $this->arrInvoiceEmail['messagetxt'] .="<br/> Restaurants invoice not generated = ".$restids_invoice_not_gen ;
			$this->arrInvoiceEmail ['subject'] = " Invoice for billing cycle - " . $fromDate . " To " . $toDate;
			
			$saveres = $this->invoicinglib->saveInvoiceEmail ( $this->arrInvoiceEmail );
		}
		$arrResponse ['status'] = $blnInvoiceSuccess;
		if ($blnInvoiceSuccess == 1) {
			$arrResponse ['message'] = "Invoices generated successfully. Please download invoices folder at :<b> " . $folderLink . "</b>";
			// $arrResponse ['message'] .= "<br/> Restaurants invoice not generated = " . $restids_invoice_not_gen;
			;
		} else if ($blnInvoiceSuccess == 0) {
			$arrResponse ['message'] = "Invoices not generated successfully";
		} else if ($blnInvoiceSuccess == 3)
			$arrResponse ['message'] = "Invoices have been already generated for billing cycle - " . $fromDate . " To " . $toDate;
		
		echo json_encode ( $arrResponse );
		exit ();
	} // generate invoice
}// end class