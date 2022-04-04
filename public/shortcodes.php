<?php

class PluginPlaceholderShortcodes {

	protected $plugin_name;
	protected $plugin_version;

	private $blade;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->blade = PluginPlaceholderBlade::getInstance();

    add_action( 'init', array($this, 'add_shortcodes') );
	}

	public function add_shortcodes() {
    add_shortcode( 'test', array($this, 'example_function') );
    return;
	}

	public function example_function($atts, $content = "") {
		return $this->blade->template('test');
	}

}
