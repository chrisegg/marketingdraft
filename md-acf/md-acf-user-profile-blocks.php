<?php

// Create User Profile Blocks to display data captured by ACF plugin

function my_acf_block_init() {

    if (function_exists('acf_register_block_type')) {

        $blocks = [
            'user-full-name' => ['title' => __('User Full Name'), 'fields' => ['first_name', 'last_name']],
            'user-first-name' => ['title' => __('User First Name'), 'fields' => ['first_name']],
            'user-email' => ['title' => __('User Email'), 'field' => 'email_address'],
            'user-company' => ['title' => __('User Company'), 'field' => 'company_name'],
			'user-phone' => ['title' => __('User Phone'), 'field' => 'phone'],
            'user-position' => ['title' => __('User Position'), 'field' => 'position'],
            'user-website' => ['title' => __('User Website'), 'field' => 'website_url'],
            'user-subscription' => ['title' => __('User Subscription Date'), 'field' => 'subscription_date'],
            'user-referral' => ['title' => __('User Referral ID'), 'field' => 'referral_id'],
            'user-profile-image' => ['title' => __('User Profile Image'), 'field' => 'profile_image'],
        ];

        foreach ($blocks as $block_name => $block_data) {
            acf_register_block_type(array(
                'name'              => $block_name,
                'title'             => $block_data['title'],
                'description'       => __("A custom block to display a user's information."),
                'render_callback'   => 'my_user_fields_block_render_callback',
                'category'          => 'formatting',
                'icon'              => 'admin-users',
                'keywords'          => array('user', $block_name),
            ));
        }
    }
}

add_action('acf/init', 'my_acf_block_init');

function my_user_fields_block_render_callback($block, $content = '', $is_preview = false, $post_id = 0) {
    $user_id = get_current_user_id();
    $block_name = str_replace('acf/', '', $block['name']); 

    $output = '';

    switch ($block_name) {
        case 'user-full-name':
            $first_name = get_field('first_name', 'user_' . $user_id);
            $last_name = get_field('last_name', 'user_' . $user_id);
            $full_name = trim($first_name . ' ' . $last_name);
            $output = !empty($full_name) ? $full_name : get_the_author_meta('display_name', $user_id);
            break;
		 case 'user-first-name':
            $output = get_field('first_name', 'user_' . $user_id);	
            break;
        case 'user-email':
            $output = get_field('email_address', 'user_' . $user_id);
            break;
        case 'user-company':
            $output = get_field('company_name', 'user_' . $user_id);
            break;
        case 'user-phone':
            $output = get_field('phone', 'user_' . $user_id);
            break;
        case 'user-position':
            $output = get_field('position', 'user_' . $user_id);
            break;
        case 'user-website':
            $output = get_field('website_url', 'user_' . $user_id);
            break;
        case 'user-subscription':
            $output = get_field('subscription_date', 'user_' . $user_id);
            break;
        case 'user-referral':
            $output = get_field('referral_id', 'user_' . $user_id);
            break;
        case 'user-profile-image':
            $image_id = get_field('profile_image', 'user_' . $user_id);
            if ($image_id) {
                $size = 'full'; 
                $output = wp_get_attachment_image($image_id, $size);
            }
            break;
        default:
            $output = 'No user information available.';
            break;
    }

    if ($block_name === 'user-profile-image') {
        echo "<div class='{$block_name}-block'>{$output}</div>";
    } else {
        echo "<div class='{$block_name}-block'>" . esc_html($output) . "</div>";
    }
}
