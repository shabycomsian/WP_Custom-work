<?php
/**
 * Plugin Name: Random Coffee API Integration
 * Description: A simple plugin to integrate with the Random Coffee API and provide a function to get a random coffee link.
 * Version: 1.0
 * Author: Muhammad Shoaib
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Function to get a random coffee link using the Random Coffee API.
 *
 * @return string
 */
function hs_give_me_coffee() {
    $api_url = 'https://coffee.alexflipnote.dev/random.json'; // URL of the Random Coffee API

    // Make a GET request to the API
    $response = wp_remote_get( $api_url );

    // Check for errors
    if ( is_wp_error( $response ) ) {
        return 'Error retrieving coffee image.';
    }

    // Get the body of the response
    $body = wp_remote_retrieve_body( $response );

    // Decode the JSON response
    $data = json_decode( $body, true );

    // Check if the image link exists
    if ( isset( $data['file'] ) ) {
        return $data['file']; // Return the coffee image link
    } else {
        return 'No coffee image found.';
    }
}

/**
 * Shortcode to display a random coffee image.
 *
 * @return string
 */
function hs_coffee_shortcode() {
    return '<img src="' . hs_give_me_coffee() . '" alt="Random Coffee">';
}
add_shortcode( 'random_coffee', 'hs_coffee_shortcode' );

?>
