<?php

class Plugin_Placeholder_i18n {

  public function __construct() {
    add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
	}

	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'plugin-placeholder', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
	}

}
