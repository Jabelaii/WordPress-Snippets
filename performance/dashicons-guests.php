<?php
/**
 * Dashicons (~45KB CSS) cuma kepake di admin bar. Buat yang belum login
 * ga perlu diload.
 */

add_action('wp_enqueue_scripts', function () {
    if (!is_user_logged_in()) {
        wp_dequeue_style('dashicons');
        wp_deregister_style('dashicons');
    }
}, 100);
