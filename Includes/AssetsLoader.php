<?php

namespace PluginPlaceholder\Includes;

class AssetsLoader
{
	private static $instance = NULL;
	private $scripts;
	private $styles;
	private $admin_scripts;
	private $admin_styles;

	private function __construct()
	{
		$this->scripts = [];
		$this->styles = [];
		$this->admin_scripts = [];
		$this->admin_styles = [];

		add_action('wp_enqueue_scripts', [$this, 'load_assets'], 100);
		add_action('admin_enqueue_scripts', [$this, 'load_admin_assets'], 100);
	}

	// Clone not allowed
	private function __clone()
	{
	}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new AssetsLoader();
		}
		return self::$instance;
	}

	public function add_style(string $name, string $path, callable $condition = null, array $dependencies = [])
	{
		$this->styles[] = [
			'name' => $name,
			'path' => $path,
			'condition' => $condition,
			'dependencies' => $dependencies
		];
	}

	public function add_script(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
	{
		$this->scripts[] = [
			'name' => $name,
			'path' => $path,
			'condition' => $condition,
			'dependencies' => $dependencies,
			'localize' => $localize
		];
	}

	public function add_admin_style(string $name, string $path, callable $condition = null, array $dependencies = [])
	{
		$this->admin_styles[] = [
			'name' => $name,
			'path' => $path,
			'condition' => $condition,
			'dependencies' => $dependencies
		];
	}

	public function add_admin_script(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
	{
		$this->admin_scripts[] = [
			'name' => $name,
			'path' => $path,
			'condition' => $condition,
			'dependencies' => $dependencies,
			'localize' => $localize
		];
	}

	public function load_assets($handler)
	{
		foreach ($this->styles as $style) {
			if(is_null($style['condition']) || call_user_func($style['condition'], $handler)) wp_enqueue_style("plugin-placeholder/{$style['name']}", $style['path'], $style['dependencies'], PLUGIN_PLACEHOLDER_VERSION);
		}

		foreach ($this->scripts as $script) {
			if(is_null($script['condition']) || call_user_func($script['condition'], $handler)) {
				wp_enqueue_script("plugin-placeholder/{$script['name']}", $script['path'], $script['dependencies'], PLUGIN_PLACEHOLDER_VERSION);

				if($script['localize']) {
					wp_localize_script("plugin-placeholder/{$script['name']}", $script['localize']['name'], $script['localize']['args']);
				}
			}
		}
	}

	public function load_admin_assets($handler)
	{
		foreach ($this->admin_styles as $style) {
			if(is_null($style['condition']) || call_user_func($style['condition'], $handler)) wp_enqueue_style("plugin-placeholder/{$style['name']}", $style['path'], $style['dependencies'], PLUGIN_PLACEHOLDER_VERSION);
		}

		foreach ($this->admin_scripts as $script) {
			if(is_null($script['condition']) || call_user_func($script['condition'], $handler)) {
				wp_enqueue_script("plugin-placeholder/{$script['name']}", $script['path'], $script['dependencies'], PLUGIN_PLACEHOLDER_VERSION);

				if($script['localize']) {
					wp_localize_script("plugin-placeholder/{$script['name']}", $script['localize']['name'], $script['localize']['args']);
				}
			}
		}
	}

	
}
