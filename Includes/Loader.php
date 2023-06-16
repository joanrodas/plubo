<?php
namespace PluginPlaceholder\Includes;

class Loader
{
	protected $plugin_name;
	protected $plugin_version;

	public function __construct()
	{
		$this->plugin_version = defined('PLUGIN_PLACEHOLDER_VERSION') ? PLUGIN_PLACEHOLDER_VERSION : '1.0.0';
		$this->plugin_name = 'plugin-placeholder';
		$this->load_dependencies();

		add_action('plugins_loaded', [$this, 'load_plugin_textdomain']);
	}

	private function load_dependencies()
	{
		foreach (glob(PLUGIN_PLACEHOLDER_PATH . 'Functionality/*.php') as $filename) {
			$class_name = '\\PluginPlaceholder\Functionality\\'. basename($filename, '.php');
			if (class_exists($class_name)) {
				try {
					new $class_name($this->plugin_name, $this->plugin_version);
				}
				catch (\Throwable $e) {
					pb_log($e);
					continue;
				}
			}
		}
	}

	public function load_plugin_textdomain()
	{
		load_plugin_textdomain('plugin-placeholder', false, dirname(PLUGIN_PLACEHOLDER_BASENAME) . '/languages/');
	}
}
