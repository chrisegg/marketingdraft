<?php

// Custom Login Screen
function wpb_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/uploads/2023/11/logo.png); //replace with your file path
        height:100px;
        width:300px;
        background-size: 300px 100px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

// Change URL and site name
function wpb_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'wpb_login_logo_url' );
  
function wpb_login_logo_url_title() {
    return 'YOUR SITE NAME HERE';
}
add_filter( 'login_headertitle', 'wpb_login_logo_url_title' );

//Disable language switcher on login
add_filter( 'login_display_language_dropdown', '__return_false' );

// Login page style sheet
//Replace style-login.css with the name of your custom CSS file
function md_custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
}

//This loads the function above on the login page
add_action( 'login_enqueue_scripts', 'md_custom_login_stylesheet' );
