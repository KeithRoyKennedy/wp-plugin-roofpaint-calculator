<?php
class Roof_Paint_Calculator {
    public function __construct() {
        // Load dependencies
        require_once RPC_PLUGIN_DIR . 'includes/class-roof-paint-calculator-ajax.php';
        
        // Instantiate AJAX handler
        new Roof_Paint_Calculator_Ajax();
        
        // Register hooks
        $this->define_hooks();
    }
    
    public function run() {
        // Load plugin textdomain
        $this->load_textdomain();
    }
    
    private function define_hooks() {
        // Frontend hooks
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_shortcode('roof_paint_calculator', array($this, 'display_calculator'));
    }
    
    public function enqueue_assets() {
        wp_enqueue_style(
            'rpc-styles',
            RPC_PLUGIN_URL . 'assets/css/style.css',
            array(),
            RPC_VERSION
        );
        
        wp_enqueue_script(
            'rpc-script',
            RPC_PLUGIN_URL . 'assets/js/script.js',
            array('jquery'),
            RPC_VERSION,
            true
        );
        
        wp_localize_script(
            'rpc-script',
            'rpc_vars',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('rpc_nonce'),
                'calculating_text' => esc_html__('Calculating...', 'roof-paint-calculator'),
                'roof_area_label' => esc_html__('Roof Area', 'roof-paint-calculator'),
                'sqm_label' => esc_html__('sqm', 'roof-paint-calculator'),
                'paint_needed_label' => esc_html__('Paint Needed', 'roof-paint-calculator'),
                'liters_label' => esc_html__('liters', 'roof-paint-calculator'),
                'connection_error' => esc_html__('Error connecting to server.', 'roof-paint-calculator')
            )
        );
    }
    
    public function display_calculator() {
        ob_start();
        include RPC_PLUGIN_DIR . 'templates/calculator-form.php';
        return ob_get_clean();
    }
    
    public function load_textdomain() {
        load_plugin_textdomain(
            'roof-paint-calculator',
            false,
            dirname(RPC_PLUGIN_BASENAME) . '/languages'
        );
    }
}