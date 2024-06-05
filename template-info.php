<?php

/*
Plugin Name: Template Info in Admin Bar
Description: A plugin that allows administrators to see templates and 
Version: 1.0
Author: j26a90
Author URI: https://github.com/AbelardoR/template-info
License: GPL2
*/

/* Including the main PHP file of the plugin. */
include_once dirname( __FILE__ ) . '/srcw/main.php';

/**
 * The function `run_active_templateinfo_plugin` initializes a new instance of the
 * `TemplateInfoAdminBar` class.
 */
function run_active_templateinfo_plugin () {
	new TemplateInfoAdminBar();
}

// Init plugin
add_action( 'plugins_loaded', 'run_active_templateinfo_plugin' );
