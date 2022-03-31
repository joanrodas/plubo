<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       PLUBO
 * Plugin URI:        https://sirvelia.com/
 * Description:       Plugin Description.
 * Version:           1.0.0
 * Author:            Sirvelia
 * Author URI:        https://sirvelia.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       plugin-placeholder
 * Domain Path:       /languages
 */

// Direct access, abort.
if ( ! defined( 'WPINC' ) ) {
	die('YOU SHALL NOT PASS!');
}

define( 'PLUGIN_PLACEHOLDER_VERSION', '1.0.0' );
define( 'PLUGIN_PLACEHOLDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_PLACEHOLDER_URL', plugin_dir_url( __FILE__ ) );

register_activation_hook( __FILE__, function() {
  require_once PLUGIN_PLACEHOLDER_PATH . 'includes/class-activator.php';
  Plugin_Placeholder_Activator::activate();
} );

register_deactivation_hook( __FILE__, function() {
  require_once PLUGIN_PLACEHOLDER_PATH . 'includes/class-deactivator.php';
  Plugin_Placeholder_Deactivator::deactivate();
} );

//LOAD ALL PLUGIN FILES
require plugin_dir_path( __FILE__ ) . 'includes/class-loader.php';
$loader = new Plugin_Placeholder();
