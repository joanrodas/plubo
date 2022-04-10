<?php
use PluboRoutes\Endpoint\GetEndpoint;
use PluboRoutes\Endpoint\PostEndpoint;
use PluboRoutes\Endpoint\PutEndpoint;
use PluboRoutes\Endpoint\DeleteEndpoint;

class PluginPlaceholderApiEndpoints {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		add_filter( 'plubo/routes', array($this, 'add_endpoints') );
	}

	public function add_endpoints($endpoints) {
		return $endpoints;
	}
}
