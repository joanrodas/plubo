<?php

class Plugin_Placeholder_Custom_Post_Types {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

    add_action( 'init', array($this, 'register_post_types') );
	}

	public function register_post_types() {
		//register_post_type( $cpt['slug'], $cpt['args'] );
	}

}
