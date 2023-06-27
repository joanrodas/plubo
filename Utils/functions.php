<?php

if (!function_exists("pb_script")) {
    function pb_script(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->add_script($name, $path, $condition, $dependencies, $localize);
    }
}

if (!function_exists("pb_style")) {
    function pb_style(string $name, string $path, callable $condition = null, array $dependencies = [])
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->add_style($name, $path, $condition, $dependencies);
    }
}

if (!function_exists("pb_admin_script")) {
    function pb_admin_script(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->add_admin_script($name, $path, $condition, $dependencies, $localize);
    }
}

if (!function_exists("pb_admin_style")) {
    function pb_admin_style(string $name, string $path, callable $condition = null, array $dependencies = [])
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->add_admin_style($name, $path, $condition, $dependencies);
    }
}
