<?php
/**
 * Plugin Name: Kanye Quotes API
 * Description: A plugin to display five Kanye West quotes on a WordPress page using the Kanye Rest API.
 * Version: 1.0
 * Author: Muhammad Shoaib
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Function to get a Kanye quote using the Kanye Rest API.
 *
 * @return string
 */
function get_kanye_quote() {
    $api_url = 'https://api.kanye.rest/';

    // Make a GET request to the API
    $response = wp_remote_get( $api_url );

    // Check for errors
    if ( is_wp_error( $response ) ) {
        return 'Error retrieving quote.';
    }

    // Get the body of the response
    $body = wp_remote_retrieve_body( $response );

    // Decode the JSON response
    $data = json_decode( $body, true );

    // Check if the quote exists
    if ( isset( $data['quote'] ) ) {
        return $data['quote']; 
    } else {
        return 'No quote found.';
    }
}

/**
 * Shortcode to display five Kanye quotes.
 *
 * @return string
 */
function display_kanye_quotes() {
    $quotes = '<div class="kanye-quotes">';
    for ( $i = 0; $i < 5; $i++ ) {
        $quote = get_kanye_quote();
        $quotes .= '<li>' . esc_html( $quote ) . '</li>';
    }
    $quotes .= '</div>';

    return $quotes;
}
add_shortcode( 'kanye_quotes', 'display_kanye_quotes' );
?>
