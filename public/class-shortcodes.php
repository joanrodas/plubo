<?php

class Plugin_Placeholder_Shortcodes {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

    add_action( 'init', array($this, 'add_shortcodes') );
	}

	public function add_shortcodes() {
    //add_shortcode( 'name', array($this, 'example_function') );
    return;
	}

	public function example_function($atts, $content = "") {

	}

}
