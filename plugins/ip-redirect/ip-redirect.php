<?php
/*
Plugin Name: IP Address Redirect
Description: Redirects users if their IP address starts with 77.29.
Version: 1.0
Author: Muhammad Shoaib
*/

if (!defined('ABSPATH')) {
    exit;
}

function ip_address_redirect() {
    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Check if the IP address starts with 77.29
    if (strpos($user_ip, '77.29') === 0) {
        // Redirect to a different URL
        wp_redirect('http://localhost/wordpress/');
        exit;
    }
}

add_action('init', 'ip_address_redirect');
