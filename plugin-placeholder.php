<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       PluginPlaceholder
 * Plugin URI:        https://sirvelia.com/
 * Description:       A WordPress plugin made with PLUBO.
 * Version:           1.0.0
 * Author:            Joan Rodas - Sirvelia
 * Author URI:        https://sirvelia.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       plugin-placeholder
 * Domain Path:       /languages
 */

// Direct access, abort.
if (!defined('WPINC')) {
	die('YOU SHALL NOT PASS!');
}

define('PLUGIN_PLACEHOLDER_VERSION', '1.0.0');
define('PLUGIN_PLACEHOLDER_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_PLACEHOLDER_BASENAME', plugin_basename(__FILE__));
define('PLUGIN_PLACEHOLDER_URL', plugin_dir_url(__FILE__));

require_once PLUGIN_PLACEHOLDER_PATH . 'vendor/autoload.php';

register_activation_hook(__FILE__, function () {
	PluginPlaceholder\Includes\Activator::activate();
});

register_deactivation_hook(__FILE__, function () {
	PluginPlaceholder\Includes\Deactivator::deactivate();
});

//LOAD ALL PLUGIN FILES
$loader = new PluginPlaceholder\Includes\Loader();
