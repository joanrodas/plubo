<?php

class PluginPlaceholderAdminMenus {

	protected $plugin_name;
	protected $plugin_version;

	private $blade;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->blade = PluginPlaceholderBlade::getInstance();

		$this->add_menus();
	}

	private function add_menus() {

	}

}
