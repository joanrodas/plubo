<?php

class Plugin_Placeholder_Api_Endpoints {

	protected $plugin_name;
	protected $plugin_version;

  //FORMAT: array(type, name, function)
  private $endpoints = array();

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->add_endpoints();
	}

	public function add_endpoints() {

	}

}
