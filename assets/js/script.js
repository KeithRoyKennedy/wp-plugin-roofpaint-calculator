jQuery(document).ready(function($) {
    $('#rpc-form').on('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        var data = {
            'action': 'rpc_calculate_paint',
            'length': $('#rpc-length').val(),
            'width': $('#rpc-width').val(),
            'pitch': $('#rpc-pitch').val(),
            'coats': $('#rpc-coats').val()
        };
        
        // Make AJAX request
        $.post(ajaxurl, data, function(response) {
            if (response.success) {
                $('#rpc-result').html('<p>Roof Area: ' + response.data.roof_area + ' sqm</p>' +
                                      '<p>Paint Needed: ' + response.data.paint_needed + ' liters</p>');
            } else {
                $('#rpc-result').html('<p class="error">Error calculating paint requirements.</p>');
            }
        }).fail(function() {
            $('#rpc-result').html('<p class="error">Error connecting to server.</p>');
        });
    });
});
