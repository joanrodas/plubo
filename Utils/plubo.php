<?php

if (!function_exists("pb_log")) {
    function pb_log($log)
    {
        $backtrace = debug_backtrace();
        $backtrace = $backtrace[1] ?? [];
        $class = $backtrace['class'] ?? '';
        $function = $backtrace['function'] ?? '';
        error_log("\nCLASS: " . $class . "\nFUNCTION:" . $function .  "\nLOG:" . print_r($log, true) . "\n");
    }
}

if (!function_exists("pb_asset")) {
    function pb_asset($asset_name)
    {
        $manifest = file_get_contents(PLUGIN_PLACEHOLDER_ASSETS . "manifest.json");
        $manifest = json_decode($manifest, true);
        if (!isset($manifest[$asset_name])) return $asset_name;
        return PLUGIN_PLACEHOLDER_ASSETS . $manifest[$asset_name];
    }
}
