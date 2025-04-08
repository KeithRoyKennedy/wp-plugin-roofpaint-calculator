<?php
class Roof_Paint_Calculator_Ajax {
    public function __construct() {
        add_action('wp_ajax_rpc_calculate_paint', array($this, 'calculate_paint'));
        add_action('wp_ajax_nopriv_rpc_calculate_paint', array($this, 'calculate_paint'));
    }
    
    public function calculate_paint() {
        // Verify nonce
        check_ajax_referer('rpc_nonce', 'nonce');
        
        // Validate inputs
        if (empty($_POST['length']) || empty($_POST['width']) || empty($_POST['pitch']) || empty($_POST['coats'])) {
            wp_send_json_error(__('All fields are required.', 'roof-paint-calculator'));
        }
        
        $length = floatval($_POST['length']);
        $width = floatval($_POST['width']);
        $pitch = floatval($_POST['pitch']);
        $coats = intval($_POST['coats']);
        
        // Validate values
        if ($length <= 0 || $width <= 0) {
            wp_send_json_error(__('Length and width must be positive numbers.', 'roof-paint-calculator'));
        }
        
        if ($pitch < 0 || $pitch > 90) {
            wp_send_json_error(__('Pitch must be between 0 and 90 degrees.', 'roof-paint-calculator'));
        }
        
        if ($coats < 1 || $coats > 5) {
            wp_send_json_error(__('Number of coats must be between 1 and 5.', 'roof-paint-calculator'));
        }
        
        // Calculate roof area (accounting for pitch)
        $pitch_rad = deg2rad($pitch);
        $roof_area = ($length * $width) / cos($pitch_rad);
        
        // Use average 9 sqm per liter per coat
        $coverage_per_liter_per_coat = 9;
        $paint_needed = ($roof_area * $coats) / $coverage_per_liter_per_coat;
        
        wp_send_json_success(array(
            'roof_area' => round($roof_area, 2),
            'paint_needed' => round($paint_needed, 2),
            'message' => __('Calculation successful!', 'roof-paint-calculator')
        ));
    }
}