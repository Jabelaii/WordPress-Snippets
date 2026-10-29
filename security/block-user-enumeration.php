<?php
/**
 * Tutup REST API user enumeration (/wp-json/wp/v2/users) dan ?author=N
 * buat yang belum login. Dua-duanya dipake bot buat nebak username.
 */

// /wp-json/wp/v2/users
add_filter('rest_endpoints', function ($endpoints) {
    if (is_user_logged_in()) {
        return $endpoints;
    }
    unset($endpoints['/wp/v2/users']);
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    return $endpoints;
});

// ?author=1 -> redirect ke home
add_action('template_redirect', function () {
    if (is_author() && !is_user_logged_in()) {
        wp_safe_redirect(home_url(), 301);
        exit;
    }
});

// Pesan error login jangan kasih tahu username mana yang bener
add_filter('login_errors', function () {
    return 'Username atau password salah.';
});
