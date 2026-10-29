<?php
/**
 * Shortcode jalan di widget text, excerpt, dan menu item label.
 */

add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
add_filter('wp_nav_menu_items', 'do_shortcode');
