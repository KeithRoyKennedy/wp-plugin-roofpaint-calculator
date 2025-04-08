<?php
/**
 * Fired when the plugin is uninstalled.
 * 
 * @package RoofPaintCalculator
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('rpc_settings'); // If you have any options stored

// Clear any cached data that might be related to the plugin
wp_cache_flush();

// Remove any custom database tables (if you created any)
/*
global $wpdb;
$table_name = $wpdb->prefix . 'roof_paint_calculator_data';
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");
*/