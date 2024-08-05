jQuery(document).ready(function($) {
    $.ajax({
        url: hs_ajax_object.ajax_url,
        method: 'POST',
        data: {
            action: 'hs_get_architecture_projects',
            security: hs_ajax_object.nonce,
        },
        success: function(response) {
            if (response.success) {
                console.log(response.data);
            }
        },
    });
});