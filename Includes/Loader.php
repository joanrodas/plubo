<?php
namespace PluginPlaceholder\Includes;

use PluginPlaceholder\Admin\AdminMenus;
use PluginPlaceholder\Admin\AjaxActions;
use PluginPlaceholder\Admin\PostActions;

use PluginPlaceholder\General\ApiEndpoints;
use PluginPlaceholder\General\CustomFields;
use PluginPlaceholder\General\CustomPostTypes;
use PluginPlaceholder\General\Routes;
use PluginPlaceholder\General\Shortcodes;
use PluginPlaceholder\General\Taxonomies;

use PluginPlaceholder\React\ReactLoader;

class Loader {

	protected $plugin_name;
	protected $plugin_version;

	public function __construct() {
		$this->plugin_version = defined( 'PLUGIN_PLACEHOLDER_VERSION' ) ? PLUGIN_PLACEHOLDER_VERSION : '1.0.0';
		$this->plugin_name = 'plugin-placeholder';
    $this->load_dependencies();
	}

	private function load_dependencies() {
		\PluboRoutes\PluboRoutesProcessor::init();

		$plugin_i18n = new Languages();

		$react = new ReactLoader( $this->plugin_name, $this->plugin_version );

		$admin_menus = new AdminMenus($this->plugin_name, $this->plugin_version);
    $ajax_actions = new AjaxActions($this->plugin_name, $this->plugin_version);
    $post_actions = new PostActions($this->plugin_name, $this->plugin_version);

		$api_endpoints = new ApiEndpoints($this->plugin_name, $this->plugin_version);
    $custom_fields = new CustomFields($this->plugin_name, $this->plugin_version);
    $custom_post_types = new CustomPostTypes($this->plugin_name, $this->plugin_version);
    $routes = new Routes($this->plugin_name, $this->plugin_version);
    $shortcodes = new Shortcodes($this->plugin_name, $this->plugin_version);
    $taxonomies = new Taxonomies($this->plugin_name, $this->plugin_version);

		add_filter( 'do_shortcode_tag', function($output, $tag, $attr) {
			return "<span style='display: none;' class='plubo-shortcode' data-tag='$tag'></span>" . $output;
		}, 22, 3);

		add_action('wp_enqueue_scripts', function () {
	    wp_enqueue_style('plugin-placeholder/app.css', PLUGIN_PLACEHOLDER_URL . 'dist/app.css', false, null);
	    wp_enqueue_script('plugin-placeholder/app.js', PLUGIN_PLACEHOLDER_URL . 'dist/app.js', [], null, true);

	    wp_localize_script( 'plugin-placeholder/app.js', 'plugin_placeholder_ajax', array(
	      'ajaxurl'   => admin_url( 'admin-ajax.php' ),
	      'nonce'     => wp_create_nonce( 'ajax-nonce' ),
	    ) );
		}, 100);
	}
}
