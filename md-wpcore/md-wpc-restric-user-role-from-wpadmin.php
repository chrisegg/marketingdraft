<?php

// Restrict 'student' role from accessing the admin area
// Change user role on line 6

function restrict_student_access() {
    if (is_admin() && current_user_can('student') && !defined('DOING_AJAX')) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'restrict_student_access');
