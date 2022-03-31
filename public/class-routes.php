<?php

class Plugin_Placeholder_Routes {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

		add_action( 'init', array($this, 'add_rewrite_rules') );
		add_filter( 'query_vars', array($this, 'add_query_vars') );
		add_action( 'template_include', array($this, 'include_templates') );
	}

	public function add_rewrite_rules() {
		//add_rewrite_rule( 'example/([a-z0-9-]+)[/]?$', 'index.php?example=$matches[1]', 'top' );
		add_rewrite_rule(
			'^dashboard/?$',
			'index.php?s=test',
			'top'
		);
		return;
	}

	public function add_query_vars( $query_vars ) {
		// $query_vars[] = 'new_query_var';
		return $query_vars;
	}

	public function include_templates( $template ) {
		// if( get_query_var( 'example' ) ) $template = ;
		return $template;
	}

}
