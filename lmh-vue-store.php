<?php
/**
 * Plugin Name:       LMH Vue Store 
 * Plugin URI:        https://lyminhhoang.com/plugin-lmh-vue-store
 * Description:       LMH Vue Store use VueJs
 * Version:           1.0.0
 * Author:            Mr.Hoang
 * Author URI:        https://lyinhhoang.com/
 * License:           GPL-2.0+
 * Text Domain:       lmh-vue-store
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

function run_plugin() {
	$plugin = new LMH_Vue_Store('lmh-vue-store', '1.0.0');
	$plugin->run();
}

function activate_lmh_vue_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-activator.php';
	Plugin_Activator::activate();
}

function deactivate_lmh_vue_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-deactivator.php';
	Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__ , 'activate_lmh_vue_store' );
register_deactivation_hook( __FILE__ , 'deactivate_lmh_vue_store' );

require plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

run_plugin();
