<?php

class Plugin_Placeholder_Public {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version, $activation=false ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
    $this->load_dependencies($activation);
	}

	private function load_dependencies($activation) {
		require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-api-endpoints.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-custom-fields.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-custom-post-types.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-routes.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-shortcodes.php';
    require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-taxonomies.php';

    $api_endpoints = new Plugin_Placeholder_Api_Endpoints( $this->get_plugin_name(), $this->get_plugin_version() );
    $custom_fields = new Plugin_Placeholder_Custom_Fields( $this->get_plugin_name(), $this->get_plugin_version() );
    $custom_post_types = new Plugin_Placeholder_Custom_Post_Types( $this->get_plugin_name(), $this->get_plugin_version() );
    $routes = new Plugin_Placeholder_Routes( $this->get_plugin_name(), $this->get_plugin_version() );
    $shortcodes = new Plugin_Placeholder_Shortcodes( $this->get_plugin_name(), $this->get_plugin_version() );
    $taxonomies = new Plugin_Placeholder_Taxonomies( $this->get_plugin_name(), $this->get_plugin_version() );

		if($activation) {
			$custom_post_types->register_post_types();
			$api_endpoints->add_endpoints();
			$routes->add_rewrite_rules();
		}
	}

	private function get_plugin_name() {
		return $this->plugin_name;
	}

	private function get_plugin_version() {
		return $this->plugin_version;
	}

}
