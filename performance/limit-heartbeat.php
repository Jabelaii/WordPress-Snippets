<?php
/**
 * Heartbeat API: matiin di frontend & dashboard, di editor kasih interval 60s.
 * Default-nya ngirim request tiap 15 detik, bikin CPU hosting shared kepake
 * terus kalau ada beberapa tab wp-admin kebuka.
 */

add_action('init', function () {
    global $pagenow;

    if (!is_admin() || $pagenow === 'index.php') {
        wp_deregister_script('heartbeat');
    }
}, 1);

add_filter('heartbeat_settings', function ($settings) {
    $settings['interval'] = 60;
    return $settings;
});
