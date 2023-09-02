<!-- JS_part -->

<!-- Put to JS folder in THEME of WP -->

jQuery(document).ready(function($) {
    $('#name-form').on('submit', function(e) {
        e.preventDefault();
        
        const firstName = $('#first-name').val();
        const lastName = $('#last-name').val();

        $.ajax({
            url: ajaxSettings.ajax_url,
            type: 'POST',
            data: {
                action: 'save_name_and_last_name',
                first_name: firstName,
                last_name: lastName,
            },
            success: function(response) {
                console.log(response); // Output the response from the server
            },
            error: function(error) {
                console.error('Error:', error);
            }
      
                });

    });


    $.ajax({
        url: ajaxSettings.ajax_url,
        type: 'GET',
        data: {
            action: 'print_to_console',
        },
        success: function(response) {
            document.getElementById('forName').innerHTML='<img src="'+response.userAvatar+'" style="width:40px; height:40px; border-radius:50px"/>' + '     ' + response.userName.replaceAll(/\\/g, '') 
        
            // console.log('Response:', response); // Log the entire response object
            // console.log('Data 1:', response.userName); // Log the specific data value
            // console.log('Data 2:', response.userAvatar);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
});