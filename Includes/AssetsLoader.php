<?php

namespace PluginPlaceholder\Includes;

class AssetsLoader
{
    private static $instance = null;
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

        add_action('wp_enqueue_scripts', [$this, 'loadAssets'], 100);
        add_action('admin_enqueue_scripts', [$this, 'loadAdminAssets'], 100);
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

    public function addStyle(string $name, string $path, callable $condition = null, array $dependencies = [])
    {
        $this->styles[] = [
            'name' => $name,
            'path' => $path,
            'condition' => $condition,
            'dependencies' => $dependencies
        ];
    }

    public function addScript(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
    {
        $this->scripts[] = [
            'name' => $name,
            'path' => $path,
            'condition' => $condition,
            'dependencies' => $dependencies,
            'localize' => $localize
        ];
    }

    public function addAdminStyle(string $name, string $path, callable $condition = null, array $dependencies = [])
    {
        $this->admin_styles[] = [
            'name' => $name,
            'path' => $path,
            'condition' => $condition,
            'dependencies' => $dependencies
        ];
    }

    public function addAdminScript(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
    {
        $this->admin_scripts[] = [
            'name' => $name,
            'path' => $path,
            'condition' => $condition,
            'dependencies' => $dependencies,
            'localize' => $localize
        ];
    }

    public function loadAssets($handler)
    {
        foreach ($this->styles as $style) {
            if (is_null($style['condition']) || call_user_func($style['condition'], $handler)) {
                wp_register_style("plugin-placeholder/{$style['name']}", $style['path'], $style['dependencies'], PLUGIN_PLACEHOLDER_VERSION);
            }
        }

        foreach ($this->scripts as $script) {
            if (is_null($script['condition']) || call_user_func($script['condition'], $handler)) {
                wp_register_script("plugin-placeholder/{$script['name']}", $script['path'], $script['dependencies'], PLUGIN_PLACEHOLDER_VERSION);

                if ($script['localize']) {
                    wp_localize_script("plugin-placeholder/{$script['name']}", $script['localize']['name'], $script['localize']['args']);
                }
            }
        }
    }

    public function loadAdminAssets($handler)
    {
        foreach ($this->admin_styles as $style) {
            if (is_null($style['condition']) || call_user_func($style['condition'], $handler)) {
                wp_register_style("plugin-placeholder/{$style['name']}", $style['path'], $style['dependencies'], PLUGIN_PLACEHOLDER_VERSION);
            }
        }

        foreach ($this->admin_scripts as $script) {
            if (is_null($script['condition']) || call_user_func($script['condition'], $handler)) {
                wp_register_script("plugin-placeholder/{$script['name']}", $script['path'], $script['dependencies'], PLUGIN_PLACEHOLDER_VERSION);

                if ($script['localize']) {
                    wp_localize_script("plugin-placeholder/{$script['name']}", $script['localize']['name'], $script['localize']['args']);
                }
            }
        }
    }
}
