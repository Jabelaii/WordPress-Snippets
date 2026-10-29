<?php
/**
 * Matiin XML-RPC (xmlrpc.php). Sering jadi target brute force,
 * dan hampir ga ada yang pake lagi kecuali Jetpack / app WP lama.
 */

add_filter('xmlrpc_enabled', '__return_false');

// Buang header X-Pingback
add_filter('wp_headers', function ($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

// Balas 403 kalau ada yang nembak xmlrpc.php langsung
add_action('init', function () {
    if (strpos($_SERVER['REQUEST_URI'] ?? '', 'xmlrpc.php') !== false) {
        status_header(403);
        exit;
    }
});
