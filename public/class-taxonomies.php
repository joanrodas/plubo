<?php

class Plugin_Placeholder_Taxonomies {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

    add_action( 'init', array($this, 'register_taxonomies') );
	}

	public function register_taxonomies() {
    // register_taxonomy( 'tax_slug', 'post_type', $args );
	}

}
