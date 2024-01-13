<?php

namespace PluginPlaceholder\Includes;

class Loader
{
    public function __construct()
    {
        $this->loadDependencies();

        add_action('plugins_loaded', [$this, 'loadPluginTextdomain']);
    }

    private function loadDependencies()
    {
        //FUNCTIONALITY CLASSES
        foreach (glob(PLUGIN_PLACEHOLDER_PATH . 'Functionality/*.php') as $filename) {
            $class_name = '\\PluginPlaceholder\Functionality\\' . basename($filename, '.php');
            if (class_exists($class_name)) {
                try {
                    new $class_name(PLUGIN_PLACEHOLDER_NAME, PLUGIN_PLACEHOLDER_VERSION);
                } catch (\Throwable $e) {
                    pb_log($e);
                    continue;
                }
            }
        }

        //ADMIN FUNCTIONALITY
        if( is_admin() ) {
            foreach (glob(PLUGIN_PLACEHOLDER_PATH . 'Functionality/Admin/*.php') as $filename) {
                $class_name = '\\PluginPlaceholder\Functionality\Admin\\' . basename($filename, '.php');
                if (class_exists($class_name)) {
                    try {
                        new $class_name(PLUGIN_PLACEHOLDER_NAME, PLUGIN_PLACEHOLDER_VERSION);
                    } catch (\Throwable $e) {
                        pb_log($e);
                        continue;
                    }
                }
            }
        }
    }

    public function loadPluginTextdomain()
    {
        load_plugin_textdomain('plugin-placeholder', false, dirname(PLUGIN_PLACEHOLDER_BASENAME) . '/languages/');
    }
}
