<?php
class PluginPlaceholderReactLoader {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
    require_once 'apps.php';

    $this->load_react();
	}

	public function load_react() {

    add_action('wp_enqueue_scripts', function () {
      global $apps;
      foreach ($apps as $script_handle) {
        $script_path       = 'apps/'.$script_handle.'/build/index.js';
      	$script_asset_path = PLUGIN_PLACEHOLDER_PATH .$script_handle.'/build/index.asset.php';
      	$script_asset      = file_exists( $script_asset_path )
      		? require $script_asset_path
      		: array(
      			'dependencies' => array(),
      			'version'      => $this->plugin_version,
      		);
      	$script_url = plugins_url( $script_path, __FILE__ );

        wp_register_script( $script_handle, $script_url, $script_asset['dependencies'], $script_asset['version'] );
      }
    }, 110);

    add_action( 'init', function() {
      global $apps;
      foreach ($apps as $script_handle) {
        add_shortcode( $script_handle, function($atts, $content, $script_handle) {
          wp_enqueue_script( $script_handle );
          return "<div id='$script_handle'></div>";
        } );
      }
    } );

	}

}
