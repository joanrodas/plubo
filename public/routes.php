<?php
use PluboRoutes\PluboRoutesProcessor;
use PluboRoutes\Route;

class PluginPlaceholderRoutes {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		PluboRoutesProcessor::init();
		add_filter( 'plubo/routes', array($this, 'add_routes') );
	}

	public function add_routes( $routes ) {
		$routes[] = new Route('testing', 'testing/{year:number}/{city:word}', 'test');
		return $routes;
	}

}
