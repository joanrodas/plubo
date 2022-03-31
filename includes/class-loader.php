<?php

class Plugin_Placeholder {

	protected $plugin_name;
	protected $plugin_version;

	public function __construct() {
		$this->plugin_version = defined( 'PLUGIN_PLACEHOLDER_VERSION' ) ? PLUGIN_PLACEHOLDER_VERSION : '1.0.0';
		$this->plugin_name = 'plugin-placeholder';
    $this->load_dependencies();
	}

	private function load_dependencies() {
		require_once PLUGIN_PLACEHOLDER_PATH . 'vendor/autoload.php';
		require_once PLUGIN_PLACEHOLDER_PATH . 'includes/class-i18n.php';
		require_once PLUGIN_PLACEHOLDER_PATH . 'admin/class-admin.php';
		require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-public.php';

    $plugin_admin = new Plugin_Placeholder_Admin( $this->get_plugin_name(), $this->get_plugin_version() );
    $plugin_public = new Plugin_Placeholder_Public( $this->get_plugin_name(), $this->get_plugin_version() );
    $plugin_i18n = new Plugin_Placeholder_i18n();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_plugin_version() {
		return $this->plugin_version;
	}

	public function load_on_activation() {
		$plugin_admin = new Plugin_Placeholder_Admin( $this->get_plugin_name(), $this->get_plugin_version() );
		$plugin_admin->load_on_activation();

    $plugin_public = new Plugin_Placeholder_Public( $this->get_plugin_name(), $this->get_plugin_version() );
		$plugin_public->load_on_activation();
	}

}
