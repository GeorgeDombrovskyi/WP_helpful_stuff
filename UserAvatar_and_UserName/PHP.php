<?php

// ----------------------------------------------------------------------
// Put this in function.php at the THEME of WP
// Function for Define Logged User Name and his avatar

function print_to_console() {
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$message = $current_user->display_name;
		
		 $response_data = array(
			userName => $message,
			userAvatar => esc_url( get_avatar_url( $current_user->ID ) )
			     );
		wp_send_json($response_data);
// 		echo json_encode($response_data);
//     echo json_encode($response_data);
    wp_die(); // Always use wp_die() at the end of an AJAX callback.
	}
	else {
		$message = "";
		echo json_encode($message);
   		 wp_die(); // Always use wp_die() at the end of an AJAX callback.
	}
}

add_action('wp_ajax_print_to_console', 'print_to_console');
add_action('wp_ajax_nopriv_print_to_console', 'print_to_console');





// ----------------------------------------------------------------------


function save_name_and_last_name() {
    if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);

        global $wpdb;
        $table_name = $wpdb->prefix . 'tryi';

        $wpdb->insert($table_name, array(
            'first_name' => $first_name,
            'last_name' => $last_name,
        ));

        echo 'Data saved successfully!';
    } else {
        echo 'Missing data.';
    }

    wp_die();
}

add_action('wp_ajax_save_name_and_last_name', 'save_name_and_last_name');
add_action('wp_ajax_nopriv_save_name_and_last_name', 'save_name_and_last_name');


