<?php
namespace PluginPlaceholder\Admin;

class PostActions {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->add_post_actions();
	}
    
    private function add_post_non_logged_in_action($action, $function) {
		add_action( "admin_post_nopriv_{$action}", array($this, $function) );
	}
    
    private function add_post_logged_in_action($action, $function) {
		add_action( "admin_post_{$action}", array($this, $function) );
	}

	private function add_post_action($action, $function) {
		$this->add_post_non_logged_in_action($action, $function);
		$this->add_post_logged_in_action($action, $function);
	}

	private function add_post_actions() {
		//$this->add_post_action($action, 'example_function');
	}

	public function example_function() {
		//POST ACTION CODE
	}

}
