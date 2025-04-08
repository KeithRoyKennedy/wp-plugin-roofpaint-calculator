jQuery(document).ready(function($) {
    $('#rpc-form').on('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        $('#rpc-result').html('<p class="rpc-loading">' + rpc_vars.calculating_text + '</p>');
        
        // Get form values
        var data = {
            'action': 'rpc_calculate_paint',
            'length': $('#rpc-length').val(),
            'width': $('#rpc-width').val(),
            'pitch': $('#rpc-pitch').val(),
            'coats': $('#rpc-coats').val(),
            'nonce': rpc_vars.nonce
        };
        
        // Make AJAX request
        $.post(rpc_vars.ajaxurl, data, function(response) {
            if (response.success) {
                $('#rpc-result').html(
                    '<p>' + rpc_vars.roof_area_label + ': ' + response.data.roof_area + ' ' + rpc_vars.sqm_label + '</p>' +
                    '<p>' + rpc_vars.paint_needed_label + ': ' + response.data.paint_needed + ' ' + rpc_vars.liters_label + '</p>'
                );
            } else {
                $('#rpc-result').html('<p class="rpc-error">' + response.data + '</p>');
            }
        }).fail(function() {
            $('#rpc-result').html('<p class="rpc-error">' + rpc_vars.connection_error + '</p>');
        });
    });
});