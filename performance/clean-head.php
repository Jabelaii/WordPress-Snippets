<?php
/**
 * Buang hal-hal yang ga perlu dari <head>: emoji script, RSD/WLW link,
 * shortlink, versi WP, oEmbed discovery, REST link, dns-prefetch s.w.org.
 * Ngurangin request + nutup info versi.
 */

// Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

// Link-link meta
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'feed_links_extra', 3);

// Versi WP di query string asset (?ver=6.x)
add_filter('style_loader_src', 'wps_strip_wp_ver', 15);
add_filter('script_loader_src', 'wps_strip_wp_ver', 15);
function wps_strip_wp_ver($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version')) !== false) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
