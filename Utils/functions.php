<?php

if (!function_exists("pb_script")) {
    function pb_script(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->addScript($name, $path, $condition, $dependencies, $localize);
    }
}

if (!function_exists("pb_style")) {
    function pb_style(string $name, string $path, callable $condition = null, array $dependencies = [])
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->addStyle($name, $path, $condition, $dependencies);
    }
}

if (!function_exists("pb_admin_script")) {
    function pb_admin_script(string $name, string $path, callable $condition = null, array $dependencies = [], $localize = false)
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->addAdminScript($name, $path, $condition, $dependencies, $localize);
    }
}

if (!function_exists("pb_admin_style")) {
    function pb_admin_style(string $name, string $path, callable $condition = null, array $dependencies = [])
    {
        PluginPlaceholder\Includes\AssetsLoader::getInstance()
        ->addAdminStyle($name, $path, $condition, $dependencies);
    }
}
