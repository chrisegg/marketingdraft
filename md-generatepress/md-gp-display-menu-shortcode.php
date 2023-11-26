<?php

// Specify which menu to display using a shortcode in the GeneratePress theme

add_shortcode('lesson_menu',function(){
ob_start();
    // Start your PHP below
	wp_nav_menu(
			array(
				'container' => 'div',
				'container_class' => 'lesson-nav', //replace with your menu class/slug
				'container_id' => 'lesson-menu-shortcode', // replace with your desired shortcode name
				'menu_class' => '',
				'fallback_cb' => 'generate_menu_fallback',
				'items_wrap' => '<ul id="%1$s" class="%2$s ' . join( ' ', generate_get_element_classes( 'menu' ) ) . '">%3$s</ul>',
					)
				);
	// End your PHP above
return ob_get_clean();
});
