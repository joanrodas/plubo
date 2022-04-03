<?php

class PluginPlaceholderAdmin {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
    $this->load_dependencies();
	}

	private function load_dependencies() {
		require_once PLUGIN_PLACEHOLDER_PATH . 'admin/admin-menus.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'admin/ajax-actions.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'admin/post-actions.php';

    $admin_menus = new PluginPlaceholderAdminMenus( $this->get_plugin_name(), $this->get_plugin_version() );
    $ajax_actions = new PluginPlaceholderAjaxActions( $this->get_plugin_name(), $this->get_plugin_version() );
    $post_actions = new PluginPlaceholderPostActions( $this->get_plugin_name(), $this->get_plugin_version() );
	}

	private function get_plugin_name() {
		return $this->plugin_name;
	}

	private function get_plugin_version() {
		return $this->plugin_version;
	}

}
