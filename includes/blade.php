<?php
use Jenssegers\Blade\Blade;

class PluginPlaceholderBlade
{
    private static $instance = NULL;
    private $blade;

    private function __construct() {
      $this->blade = new Blade(PLUGIN_PLACEHOLDER_PATH . 'resources/views', PLUGIN_PLACEHOLDER_PATH . 'resources/cache');
      add_action( 'init', function() {
        foreach ( glob(PLUGIN_PLACEHOLDER_PATH . 'resources/directives/*.php') as $filename ) {
          require_once $filename;
        }
      }, 1 );
    }

    // Clone not allowed
    private function __clone() { }

    public static function getInstance() {
      if ( is_null(self::$instance) ) {
        self::$instance = new PluginPlaceholderBlade();
      }
      return self::$instance;
    }

    public function make_directive(string $name, callable $handler) {
      $this->blade->directive($name, $handler);
    }

    public function template( $name, $args=array() ) {
      return $this->blade->render($name, $args);
    }

}
