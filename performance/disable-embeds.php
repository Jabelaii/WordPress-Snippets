<?php
/**
 * Matiin oEmbed (wp-embed.min.js) & jQuery Migrate.
 * Embed YouTube/Twitter via paste URL tetap jalan, yang dimatiin cuma
 * fitur "embed post WP lain" yang jarang kepake.
 */

add_action('init', function () {
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    add_filter('embed_oembed_discover', '__return_false');
}, 9999);

add_action('wp_default_scripts', function ($scripts) {
    if (is_admin() || empty($scripts->registered['jquery'])) {
        return;
    }
    $scripts->registered['jquery']->deps = array_diff(
        $scripts->registered['jquery']->deps,
        ['jquery-migrate']
    );
});
