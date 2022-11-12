<?php

namespace PluginPlaceholder\Functionality;

use PluginPlaceholder\Includes\BladeLoader;

class Shortcodes
{

	protected $plugin_name;
	protected $plugin_version;

	private $blade;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->blade = BladeLoader::getInstance();

		add_action('init', [$this, 'add_shortcodes']);
		add_filter('do_shortcode_tag', function ($output, $tag, $attr) {
			return "<span style='display: none;' class='plubo-shortcode' data-tag='$tag'></span>" . $output;
		}, 22, 3);
	}

	public function add_shortcodes()
	{
		//add_shortcode( 'test', [$this, 'example_function'] );
		return;
	}

	public function example_function($atts, $content = "")
	{
		//return $this->blade->template('test');
	}
}
