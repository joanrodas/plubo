<?php
namespace PluginPlaceholder\General;

class Roles {
  	public function __construct()
	{
		add_filter('plubo/roles', array($this, 'update_roles'));
	}

	public function update_roles($roles)
	{
		// $roles[] = pb_role('test', 'Rol test')->extend('subscriber');
		$roles[] = pb_role('subscriber')->rename('Patata');
		return $roles;
	}
}
