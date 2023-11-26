<?php

//Remove home link from logo
add_filter( 'generate_logo_output', 'tu_no_logo_link', 10, 3 );
function tu_no_logo_link( $output, $logo_url, $html_attr ) {
	printf(
		'<div class="site-logo">
			<img %1$s />
		</div>',
		$html_attr
	);
}

// Remove the link for mobile header
add_filter( 'generate_mobile_header_logo_output', function() {
    if ( ! function_exists( 'generate_menu_plus_get_defaults' ) ) {
        return $output;
    }

    $settings = wp_parse_args(
        get_option( 'generate_menu_plus_settings', array() ),
        generate_menu_plus_get_defaults()
    );

    return sprintf(
        '<div class="site-logo mobile-header-logo">
            <img src="%1$s" alt="%2$s" />
         </div>',
         esc_url( apply_filters( 'generate_mobile_header_logo', $settings['mobile_header_logo'] ) ),
         esc_attr( apply_filters( 'generate_logo_title', get_bloginfo( 'name', 'display' ) ) )
    );
} );
