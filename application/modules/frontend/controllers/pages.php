<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
Class Pages extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	//career section
	public function software_engineer() {
	    $this->template->set ( 'page', 'company/software-engineer' );
	    $this->template->set ( 'description', 'Donate for a greater cause. Your donations will be used for various community services offered by The Doctor Foundation in helping the needy the get the basics. Start helping today. Connect with us for CSR activities.' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('company/software-engineer');
	}
	public function software_developer() {
	    $this->template->set ( 'page', 'company/software-developer' );
	    $this->template->set ( 'description', 'Donate for a greater cause. Your donations will be used for various community services offered by The Doctor Foundation in helping the needy the get the basics. Start helping today. Connect with us for CSR activities.' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('company/software-developer');
	}
	//career section ends
	//support section
	public function getting() {
	    $this->template->set ( 'page', 'company/getting-started' );
	    $this->template->set ( 'description', 'Donate for a greater cause. Your donations will be used for various community services offered by The Doctor Foundation in helping the needy the get the basics. Start helping today. Connect with us for CSR activities.' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('company/getting-started');
	}
	//support section ends
	
	//legal section
	public function privacypolicy() {
	    
	    $this->template->set ( 'page', 'legal/privacy-policy' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('legal/privacy-policy');
	}
	public function termsofuse() {
	    $this->template->set ( 'page', 'legal/terms-of-use' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('legal/terms-of-use');
	}
	public function salepolicy() {
	    $this->template->set ( 'page', 'legal/sales-policy' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('legal/sales-policy');
	}
	public function propertypolicy() {
	    $this->template->set ( 'page', 'legal/property-policy' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('legal/property-policy');
	}
	public function license() {
	    $this->template->set ( 'page', 'legal/agreements' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('legal/agreements');
	}
	public function terms() {
	    $this->template->set ( 'page', 'legal/termsandconditions' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('legal/termsandconditions');
	}
	//legal section
	//ask a question 
	public function askaquestion() {
	    $this->template->set ( 'page', 'company/ask-a-question' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('company/ask-a-question');
	}
	//ask a question 
	//smart-devices
	public function smartdevices() {
	    $this->template->set ( 'page', 'company/smart-devices' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('company/smart-devices');
	}
	//smart-devices
	//search section
	public function search() {
	    $this->template->set ( 'page', 'company/search' );
	    $this->template->set_theme('default_theme');
	    // $this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'phynart' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('company/search');
	 }
	//search section 

}
?>