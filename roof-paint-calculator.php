<?php
/**
 * Plugin Name: Roof Paint Calculator
 * Plugin URI: https://github.com/mrkennedy/roof-paint-calculator
 * Description: A simple calculator to estimate the amount of paint needed for a roof.
 * Version: 1.0.0
 * Author: Keith Kennedy
 * Author URI: https://mrkennedy.co.za
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: roof-paint-calculator
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('RPC_VERSION', '1.0.0');
define('RPC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('RPC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('RPC_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Include the main plugin class
require_once RPC_PLUGIN_DIR . 'includes/class-roof-paint-calculator.php';

// Initialize the plugin
function run_roof_paint_calculator() {
    $plugin = new Roof_Paint_Calculator();
    $plugin->run();
}
run_roof_paint_calculator();