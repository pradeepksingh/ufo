<?php
class Home extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$current_lang = $this->session->userdata('my_lang');
		if(!$current_lang) {
			$current_lang = 'english';
			$this->session->set_userdata('my_lang','english');
		}
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper('mylang');
		$this->lang->load($current_lang.'_home_page_lang', $current_lang);
		$app_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->template->set ( 'page', 'home' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'Phynart' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header-home' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('index');
		
	}
	
	public function products() {
		$this->template->set ( 'page', 'products' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'Phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('products');
		
	}
	public function features() {
		$this->template->set ( 'page', 'features' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'Phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('features');
		
	}
	public function installation() {
		$this->template->set ( 'page', 'installation' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'Phynart' )
		->set_partial ( 'header', 'partials/header' );
		//->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('installation');
		
	}
	public function story() {
		$this->template->set ( 'page', 'story' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('story');
		
	}
	public function support() {
		$this->template->set ( 'page', 'company/support' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/support');
		
	}
	public function account() {
		$this->template->set ( 'page', 'account/account' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('account/account');
	}
	
	public function careers() {
		$this->template->set ( 'page', 'company/careers' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		// $this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/careers');
	}
	public function press() {
		$this->template->set ( 'page', 'company/press' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/press');
	}
	public function contact() {
		$this->template->set ( 'page', 'company/contact' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		// $this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/contact-us');
	}
	public function become_a_partner() {
		$this->template->set ( 'page', 'company/become-a-partner' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		//  $this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/become-a-partner');
	}
	public function blog() {
		$this->template->set ( 'page', 'company/blog' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		// $this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/blog');
	}
	public function legal() {
		$this->template->set ( 'page', 'company/legal' );
		$this->template->set ( 'description', 'Phynart' );
		$this->template->set_theme('default_theme');
		// $this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'phynart' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('company/legal');
	}
	
}