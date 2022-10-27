<?php
namespace PluginPlaceholder\Vue;

class VueLoader {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
	    require_once 'apps.php';
	    $this->load_vue();
	}

	public function load_vue() {

	    add_action('wp_enqueue_scripts', function () {
	      global $vue_apps;
	      foreach ($vue_apps as $script_handle) {
	        $script_path       = 'apps/'.$script_handle.'/build/main.js';
			$style_path       = 'apps/'.$script_handle.'/build/styles.css';
			$script_url = plugins_url( $script_path, __FILE__ );
			$style_url = plugins_url( $style_path, __FILE__ );

			wp_register_script( $script_handle . '-script', $script_url, [], $this->plugin_version, true);
			wp_register_style( $script_handle . '-style', $style_url, [], $this->plugin_version );

			wp_localize_script( $script_handle . '-script', 'PLUGIN_PLACEHOLDER_VUE_ARGS',
				array(
					'api' => esc_url_raw( rest_url('plugin_placeholder/v1') )
				)
			);
	      }
	    });

	    add_action( 'init', function() {
	      global $vue_apps;
	      foreach ($vue_apps as $script_handle) {
	        add_shortcode( $script_handle, function($atts, $content, $script_handle) {
			  wp_enqueue_script( $script_handle . '-script' );
	  		  wp_enqueue_style( $script_handle . '-style' );
	          return "<div id='vue-$script_handle'></div>";
	        } );
	      }
	    } );

	}

}
