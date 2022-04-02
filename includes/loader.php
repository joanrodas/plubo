<?php
use Jenssegers\Blade\Blade;

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
		require_once PLUGIN_PLACEHOLDER_PATH . 'react/loader.php';

		$blade = new Blade(PLUGIN_PLACEHOLDER_PATH . 'resources/views', PLUGIN_PLACEHOLDER_PATH . 'resources/cache');

		$plugin_i18n = new PluginPlaceholderi18n();
    $plugin_admin = new PluginPlaceholderAdmin( $this->get_plugin_name(), $this->get_plugin_version(), $blade );
    $plugin_public = new PluginPlaceholderPublic( $this->get_plugin_name(), $this->get_plugin_version(), $blade );
		$react = new PluginPlaceholderReactLoader( $this->get_plugin_name(), $this->get_plugin_version() );

		add_filter( 'do_shortcode_tag', function($output, $tag, $attr) {
			return "<span style='display: none;' class='plubo-shortcode' data-tag='$tag'></span>" . $output;
		}, 22, 3);

		add_action('wp_enqueue_scripts', function () {
	    wp_enqueue_style('plugin-placeholder/main.css', PLUGIN_PLACEHOLDER_URL . 'dist/styles/main.css', false, null);
	    wp_enqueue_script('plugin-placeholder/main.js', PLUGIN_PLACEHOLDER_URL . 'dist/scripts/main.js', ['jquery'], null, true);

	    wp_localize_script( 'plugin-placeholder/main.js', 'plugin_placeholder_ajax', array(
	      'ajaxurl'   => admin_url( 'admin-ajax.php' ),
	      'nonce'     => wp_create_nonce( 'ajax-nonce' ),
	    ) );
		}, 100);
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_plugin_version() {
		return $this->plugin_version;
	}

}
