<?php

class Plugin_Placeholder_Activator {

	public static function activate() {
		$plugin_version = defined( 'PLUGIN_PLACEHOLDER_VERSION' ) ? PLUGIN_PLACEHOLDER_VERSION : '1.0.0';
		$plugin_name = 'plugin-placeholder';

		require_once PLUGIN_PLACEHOLDER_PATH . 'public/class-public.php';
		$plugin_public = new Plugin_Placeholder_Public( $plugin_name, $plugin_version, true );
		flush_rewrite_rules();
	}

}
