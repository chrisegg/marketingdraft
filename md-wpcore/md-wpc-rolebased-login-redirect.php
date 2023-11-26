<?php

// Login redirect
function custom_login_redirect( $redirect_to, $request, $user ) {
    // Get the current user's role
    $user_role = $user->roles[0];
 
    // Set the URL to redirect users to based on their role
    if ( $user_role == 'student' ) {
        $redirect_to = '/my-account/';
    } elseif ( $user_role == 'administrator' ) {
        $redirect_to = '/wp-admin/';
    }
 
    return $redirect_to;
}
add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );
