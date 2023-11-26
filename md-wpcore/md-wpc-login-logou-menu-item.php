<?php

// Specify which menus to add a login/logout menu item

add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
    // Define an array of menu locations where you want to add the login/logout link
    $allowed_locations = array('primary', 'slideout');

    // Check if the current theme location is in the allowed locations array
    if (in_array($args->theme_location, $allowed_locations)) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();

        $items .= '<li>'. $loginoutlink .'</li>';
    }

    return $items;
}
