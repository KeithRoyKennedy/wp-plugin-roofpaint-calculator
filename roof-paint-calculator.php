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
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue plugin styles and scripts
 */
function rpc_enqueue_assets() {
    wp_enqueue_style('rpc-styles', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_script('rpc-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_localize_script('rpc-script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'rpc_enqueue_assets');

/**
 * Display the roof paint calculator form
 */
function roof_paint_calculator_shortcode() {
    ob_start();
    ?>
    <div class="roof-paint-calculator">
        <h2>Roof Paint Calculator</h2>
        <form id="rpc-form">
            <div class="form-group">
                <label for="rpc-length">Roof Length (meters):</label>
                <input type="number" style="color: #000 !important" id="rpc-length" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="rpc-width">Roof Width (meters):</label>
                <input type="number" style="color: #000 !important" id="rpc-width" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="rpc-pitch">Roof Pitch (degrees):</label>
                <input type="number"  style="color: #000 !important" id="rpc-pitch" min="0" max="90" value="30" required>
            </div>
            
            <div class="form-group">
                <label for="rpc-coats">Number of Coats:</label>
                <input type="number" style="color: #000 !important" id="rpc-coats" min="1" max="5" value="2" required>
            </div>
            
           
            
            <button type="submit" class="rpc-submit">Calculate</button>
        </form>
        
        <div id="rpc-result" class="rpc-result"></div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('roof_paint_calculator', 'roof_paint_calculator_shortcode');

/**
 * Handle the AJAX calculation
 */
function rpc_calculate_paint() {
    $length = floatval($_POST['length']);
    $width = floatval($_POST['width']);
    $pitch = floatval($_POST['pitch']);
    $coats = intval($_POST['coats']);

    // Calculate roof area (accounting for pitch)
    $pitch_rad = deg2rad($pitch);
    $roof_area = ($length * $width) / cos($pitch_rad);

    // Use average 9 sqm per liter per coat
    $coverage_per_liter_per_coat = 9;
    $paint_needed = ($roof_area * $coats) / $coverage_per_liter_per_coat;

    wp_send_json_success([
        'roof_area' => round($roof_area, 2),
        'paint_needed' => round($paint_needed, 2)
    ]);
}

add_action('wp_ajax_rpc_calculate_paint', 'rpc_calculate_paint');
add_action('wp_ajax_nopriv_rpc_calculate_paint', 'rpc_calculate_paint');
