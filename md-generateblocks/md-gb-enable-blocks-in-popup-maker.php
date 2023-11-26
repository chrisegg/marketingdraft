<?php

// Enable GenerateBlocks in Popup Maker Plugin

/*
 * Original solution located in this thread 
 * https://generatepress.com/forums/topic/gpgbpopup-maker-issue/#post-2088153
 * 
 *** The code below was modified to support multiple post IDs.
 */
add_filter( 'generateblocks_do_content', function( $content ) {
    $post_ids = array( 3981, 3849 ); // Replace with your Popup Maker popup IDs

    foreach ( $post_ids as $post_id ) {
        if ( has_blocks( $post_id ) ) {
            $block_element = get_post( $post_id );

            // Where 'popup' is the custom post type for Popup Maker popups.
            if ( ! $block_element || 'popup' !== $block_element->post_type ) {
                continue; // Skip to the next post ID if not a valid popup
            }

            if ( 'publish' !== $block_element->post_status || ! empty( $block_element->post_password ) ) {
                continue; // Skip to the next post ID if not published or has a password
            }

            $content .= $block_element->post_content;
        }
    }

    return $content;
} );
