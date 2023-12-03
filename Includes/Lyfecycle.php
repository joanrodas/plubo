<?php

namespace PluginPlaceholder\Includes;

class Lyfecycle
{
    public static function activate($network_wide)
    {
        do_action('PluginPlaceholder/setup', $network_wide);
    }

    public static function deactivate($network_wide)
    {
        do_action('PluginPlaceholder/deactivation', $network_wide);
    }

    public static function uninstall()
    {
        do_action('PluginPlaceholder/cleanup');
    }
}
