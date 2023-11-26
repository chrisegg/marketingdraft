<?php

// Add the Page ID column next to the page title in the page list in WordPress admin
function custom_add_page_id_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['page_id'] = 'Page ID';
        }
    }
    return $new_columns;
}

function custom_display_page_id_column($column_name, $post_id) {
    if ($column_name === 'page_id') {
        echo $post_id;
    }
}

add_filter('manage_pages_columns', 'custom_add_page_id_column');
add_action('manage_pages_custom_column', 'custom_display_page_id_column', 10, 2);
