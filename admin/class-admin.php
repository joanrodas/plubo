<?php

class Plugin_Placeholder_Admin {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
    $this->load_dependencies();
	}

	private function load_dependencies() {
		require_once PLUGIN_PLACEHOLDER_PATH . 'admin/class-admin-menus.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'admin/class-ajax-actions.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'admin/class-post-actions.php';

    $admin_menus = new Plugin_Placeholder_Admin_Menus( $this->get_plugin_name(), $this->get_plugin_version() );
    $ajax_actions = new Plugin_Placeholder_Ajax_Actions( $this->get_plugin_name(), $this->get_plugin_version() );
    $post_actions = new Plugin_Placeholder_Post_actions( $this->get_plugin_name(), $this->get_plugin_version() );
	}

	private function get_plugin_name() {
		return $this->plugin_name;
	}

	private function get_plugin_version() {
		return $this->plugin_version;
	}

}
