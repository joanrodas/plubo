<?php

namespace PluginPlaceholder\Functionality;

use PluboRoutes\Route\Route;
use PluboRoutes\Route\ActionRoute;
use PluboRoutes\Route\RedirectRoute;

class Routes
{

	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

		add_action('after_setup_theme', [$this, 'load_plubo_routes']);
		add_filter('plubo/routes', [$this, 'add_routes']);
		
	}

	public function load_plubo_routes($routes)
	{
		\PluboRoutes\RoutesProcessor::init();
	}

	public function add_routes($routes)
	{
		return $routes;
	}
}
