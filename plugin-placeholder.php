<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       PluginPlaceholder
 * Plugin URI:        https://sirvelia.com/
 * Description:       A WordPress plugin made with PLUBO.
 * Version:           1.0.0
 * Author:            Sirvelia
 * Author URI:        https://sirvelia.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       plugin-placeholder
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die('YOU SHALL NOT PASS!');
}

// PLUGIN CONSTANTS
define('PLUGIN_PLACEHOLDER_VERSION', '1.0.0');
define('PLUGIN_PLACEHOLDER_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_PLACEHOLDER_BASENAME', plugin_basename(__FILE__));
define('PLUGIN_PLACEHOLDER_URL', plugin_dir_url(__FILE__));

// AUTOLOAD
if (file_exists(PLUGIN_PLACEHOLDER_PATH . 'vendor/autoload.php')) {
    require_once PLUGIN_PLACEHOLDER_PATH . 'vendor/autoload.php';
}

// LYFECYCLE
register_activation_hook(__FILE__, [PluginPlaceholder\Includes\Lyfecycle::class, 'activate']);
register_deactivation_hook(__FILE__, [PluginPlaceholder\Includes\Lyfecycle::class, 'deactivate']);
register_uninstall_hook(__FILE__, [PluginPlaceholder\Includes\Lyfecycle::class, 'uninstall']);

// LOAD ALL FILES
$loader = new PluginPlaceholder\Includes\Loader();
