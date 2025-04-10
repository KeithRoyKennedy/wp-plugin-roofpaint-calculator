<div class="roof-paint-calculator">
    <h2><?php esc_html_e('Roof Paint Calculator', 'roof-paint-calculator'); ?></h2>
    <form id="rpc-form">
        <div class="form-group">
            <label for="rpc-length"><?php esc_html_e('Roof Length (meters):', 'roof-paint-calculator'); ?></label>
            <input type="number" id="rpc-length" step="0.01" min="0" required>
        </div>
        
        <div class="form-group">
            <label for="rpc-width"><?php esc_html_e('Roof Width (meters):', 'roof-paint-calculator'); ?></label>
            <input type="number" id="rpc-width" step="0.01" min="0" required>
        </div>
        
        <div class="form-group">
            <label for="rpc-pitch"><?php esc_html_e('Roof Pitch (degrees):', 'roof-paint-calculator'); ?></label>
            <input type="number" id="rpc-pitch" min="0" max="90" value="30" required>
        </div>
        
        <div class="form-group">
            <label for="rpc-coats"><?php esc_html_e('Number of Coats:', 'roof-paint-calculator'); ?></label>
            <input type="number" id="rpc-coats" min="1" max="5" value="2" required>
        </div>
        
        <button type="submit" class="rpc-submit"><?php esc_html_e('Calculate', 'roof-paint-calculator'); ?></button>
    </form>
    
    <div id="rpc-result" class="rpc-result"></div>
    <div id="copywright"><a href="http://www.mrkennedy.co.za" title="Built By MrKennedy" target="_blank"><img src="https://mrkennedy.co.za/images/mrkennedy.jpeg" class="rpc-copy-logo"></div>

</div>