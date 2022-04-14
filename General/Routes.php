<?php
namespace PluginPlaceholder\General;

use PluboRoutes\Route\Route;
use PluboRoutes\Route\ActionRoute;
use PluboRoutes\Route\RedirectRoute;

class Routes {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		add_filter( 'plubo/routes', array($this, 'add_routes') );
	}

	public function add_routes( $routes ) {
		return $routes;
	}

}
