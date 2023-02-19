<?php
function login_with_otp() {
	$phone = $_POST['phone'];
	$user = get_user_by('login', $phone);
	if ($user) {
		wp_clear_auth_cookie();
		wp_set_current_user($user->data->ID);
		wp_set_auth_cookie($user->data->ID, true);
		if (is_wp_error($user)) {
			wp_send_json_error($user->get_error_message());
		} else {
			wp_send_json_success($creds);
		}
	} else {
		wp_send_json_error('User not found');
	}
}
add_action('wp_ajax_login_with_otp', 'login_with_otp');
add_action('wp_ajax_nopriv_login_with_otp', 'login_with_otp');