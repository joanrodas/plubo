<?php

class PluginPlaceholder {

	protected $plugin_name;
	protected $plugin_version;

	public function __construct() {
		$this->plugin_version = defined( 'PLUGIN_PLACEHOLDER_VERSION' ) ? PLUGIN_PLACEHOLDER_VERSION : '1.0.0';
		$this->plugin_name = 'plugin-placeholder';
    $this->load_dependencies();
	}

	private function load_dependencies() {
		require_once PLUGIN_PLACEHOLDER_PATH . 'vendor/autoload.php';
		require_once PLUGIN_PLACEHOLDER_PATH . 'includes/i18n.php';
		require_once PLUGIN_PLACEHOLDER_PATH . 'admin/admin.php';
		require_once PLUGIN_PLACEHOLDER_PATH . 'public/public.php';

		$plugin_i18n = new PluginPlaceholderi18n();
    $plugin_admin = new PluginPlaceholderAdmin( $this->get_plugin_name(), $this->get_plugin_version() );
    $plugin_public = new PluginPlaceholderPublic( $this->get_plugin_name(), $this->get_plugin_version() );
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_plugin_version() {
		return $this->plugin_version;
	}

}
