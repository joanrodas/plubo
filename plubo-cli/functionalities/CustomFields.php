<?php

namespace PluginPlaceholder\Functionality;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class CustomFields
{

	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

		add_action('after_setup_theme', [$this, 'load_cf']);
		add_action('carbon_fields_register_fields', [$this, 'register_fields']);
	}

	public function load_cf()
	{
		\Carbon_Fields\Carbon_Fields::boot();
	}

	public function register_fields()
	{
		return;
	}
}
