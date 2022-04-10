<?php

class PluginPlaceholderPublic {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
    $this->load_dependencies();
	}

	private function load_dependencies() {
		require_once PLUGIN_PLACEHOLDER_PATH . 'public/api-endpoints.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/custom-fields.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/custom-post-types.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/routes.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/shortcodes.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/taxonomies.php';

    $api_endpoints = new PluginPlaceholderApiEndpoints( $this->get_plugin_name(), $this->get_plugin_version() );
    $custom_fields = new PluginPlaceholderCustomFields( $this->get_plugin_name(), $this->get_plugin_version() );
    $custom_post_types = new PluginPlaceholderCustomPostTypes( $this->get_plugin_name(), $this->get_plugin_version() );
    $routes = new PluginPlaceholderRoutes( $this->get_plugin_name(), $this->get_plugin_version() );
    $shortcodes = new PluginPlaceholderShortcodes( $this->get_plugin_name(), $this->get_plugin_version() );
    $taxonomies = new PluginPlaceholderTaxonomies( $this->get_plugin_name(), $this->get_plugin_version() );
	}

	private function get_plugin_name() {
		return $this->plugin_name;
	}

	private function get_plugin_version() {
		return $this->plugin_version;
	}

}
