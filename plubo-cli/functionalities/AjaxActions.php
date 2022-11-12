<?php

namespace PluginPlaceholder\Functionality;

class AjaxActions
{

	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->add_ajax_actions();
	}

	private function add_ajax_non_logged_in_action($action, $function)
	{
		add_action("wp_ajax_nopriv_{$action}", [$this, $function]);
	}

	private function add_ajax_logged_in_action($action, $function)
	{
		add_action("wp_ajax_{$action}", [$this, $function]);
	}

	private function add_ajax_general_action($action, $function)
	{
		$this->add_ajax_non_logged_in_action($action, $function);
		$this->add_ajax_logged_in_action($action, $function);
	}

	private function add_ajax_actions()
	{
		//$this->add_ajax_logged_in_action('my_action', 'example_function');
	}

	public function example_function()
	{
		//AJAX ACTION CODE
	}
}
