<?php

class PluginPlaceholderEmails {

	protected $plugin_name;
	protected $plugin_version;

  public function __construct( $plugin_name, $plugin_version, $blade ) {
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->send_emails();
	}

	private function send_emails() {

	}

}