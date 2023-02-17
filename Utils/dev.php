<?php
if( !function_exists("pb_log") ) {
    function pb_log($log) {
        $backtrace = debug_backtrace();
        $backtrace = $backtrace[1] ?? [];
        $class = $backtrace['class'] ?? '';
        $function = $backtrace['function'] ?? '';
        error_log( "\nCLASS: " . $class . "\nFUNCTION:" . $function .  "\nLOG:" . print_r($log, true) . "\n" );
    }
}