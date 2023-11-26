<?php

// Add a new user role called 'student'
function add_student_role() {
    add_role(
        'student', // Role slug (lowercase, no spaces)
        'Student', // Display name
        array(
            'read' => true, // Users with this role can read content
            'level_0' => true, // Users with this role have no additional capabilities by default
        )
    );
}
add_action('init', 'add_student_role');
