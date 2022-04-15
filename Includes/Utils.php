<?php
namespace PluginPlaceholder\Includes;

class Utils
{
    private static $instance = NULL;

    private function __construct() {

    }

    // Clone not allowed
    private function __clone() { }

    public static function getInstance() {
      if ( is_null(self::$instance) ) {
        self::$instance = new Utils();
      }
      return self::$instance;
    }
}
