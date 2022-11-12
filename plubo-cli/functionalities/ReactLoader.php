<?php

namespace PluginPlaceholder\Functionality;

class ReactLoader
{

	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		require_once PLUGIN_PLACEHOLDER_PATH . 'React/apps.php';
		$this->load_react();
	}

	public function load_react()
	{

		add_action('wp_enqueue_scripts', function () {
			global $react_apps;
			foreach ($react_apps as $script_handle) {
				$script_path       = 'apps/' . $script_handle . '/build/index.js';
				$style_path       = 'apps/' . $script_handle . '/build/index.css';
				$script_asset_path = PLUGIN_PLACEHOLDER_PATH . 'React/apps/' . $script_handle . '/build/index.asset.php';
				$script_asset      = file_exists($script_asset_path)
					? require $script_asset_path
					: [
						'dependencies' => [],
						'version'      => $this->plugin_version,
					];
				$script_url = plugins_url($script_path, __FILE__);
				$style_url = plugins_url($style_path, __FILE__);

				wp_register_script($script_handle . '-script', $script_url, $script_asset['dependencies'], $script_asset['version']);
				wp_register_style($script_handle . '-style', $style_url, [], $script_asset['version']);

				wp_localize_script(
					$script_handle . '-script',
					'PLUGIN_PLACEHOLDER_ARGS',
					[
						'api' => esc_url_raw(rest_url('plugin_placeholder/v1'))
					]
				);
			}
		});

		add_action('init', function () {
			global $react_apps;
			foreach ($react_apps as $script_handle) {
				add_shortcode($script_handle, function ($atts, $content, $script_handle) {
					wp_enqueue_script($script_handle . '-script');
					wp_enqueue_style($script_handle . '-style');
					wp_set_script_translations($script_handle . '-script', 'plugin-placeholder', PLUGIN_PLACEHOLDER_PATH . 'languages');
					return "<div id='react-$script_handle'></div>";
				});
			}
		});
	}
}