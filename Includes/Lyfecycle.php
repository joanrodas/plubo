<?php
namespace PluginPlaceholder\Includes;

class Lyfecycle
{
	public static function activate()
	{
		do_action('PluginPlaceholder/setup');
	}
	
	public static function deactivate()
	{

	}
	
	public static function uninstall()
	{
		do_action('PluginPlaceholder/cleanup');
	}
}
