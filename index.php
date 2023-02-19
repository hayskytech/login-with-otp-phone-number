<?php
/**
 * Plugin Name: HS Login with Phone Number & OTP
 * Plugin URI: https://haysky.com/
 * Description: Use this shortcode [login_otp_phone_number] to display form
 * Version: 1.0.0
 * Author: Haysky
 * Author URI: https://haysky.com/
 * License: GPLv2 or later
  */
// $wpdb->show_errors(); $wpdb->print_error();

add_shortcode('login_otp_phone_number',function(){
	ob_start();
	include 'login_form.php';
	return ob_get_clean();
});

include 'otp_handler.php';

add_action('admin_menu' , function(){
	add_submenu_page('options-general.php','OTP Firebase Settings','OTP Firebase Settings','manage_options', 'firebase_settings_admin', 'firebase_settings_dbi');
});

function firebase_settings_dbi(){ include 'firebase_settings.php'; }


$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin",function($links){
    $firebase_config_link = '<a href="'.admin_url().'options-general.php?page=firebase_settings_admin">Firebase Config</a>';
    array_unshift($links, $firebase_config_link);
    return $links;
});