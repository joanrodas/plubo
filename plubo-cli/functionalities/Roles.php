<?php

namespace PluginPlaceholder\Functionality;

class Roles
{

	protected $plugin_name;
	protected $plugin_version;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

		add_action('after_setup_theme', [$this, 'load_plubo_roles']);
		add_filter('plubo/roles', [$this, 'mod_roles']);
		
	}

	public function load_plubo_roles()
	{
		\PluboRoles\RolesProcessor::init();
	}

	public function mod_roles($roles)
	{
		return $roles;
	}
}
