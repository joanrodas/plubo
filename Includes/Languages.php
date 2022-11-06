<?php

namespace PluginPlaceholder\Includes;

class Languages
{

	public function __construct()
	{
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
	}

	public function load_plugin_textdomain()
	{
		load_plugin_textdomain('plugin-placeholder', false, PLUGIN_PLACEHOLDER_BASENAME . '/languages/');
	}
}