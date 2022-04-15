<?php
namespace PluginPlaceholder\Admin;

use PluginPlaceholder\Includes\BladeLoader;

class AdminMenus {

	protected $plugin_name;
	protected $plugin_version;

	private $blade;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->blade = BladeLoader::getInstance();

		add_action( 'admin_menu', array($this, 'add_admin_menus') );
	}

	public function add_admin_menus() {

	}

}
