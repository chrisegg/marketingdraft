<?php

// Create Shortcode to Display Current Year
// Used in footer copyright
add_shortcode( 'get_year', 'md_current_year' );
function md_current_year() {
    ob_start();
    echo date('Y');
    return ob_get_clean();
}
