<?php
/**
 * Tambah class di <body>: slug halaman, nama browser, login/guest.
 * Buat CSS per halaman tanpa bikin template baru.
 */

add_filter('body_class', function ($classes) {
    global $post;

    if (is_singular() && $post) {
        $classes[] = 'page-' . $post->post_name;
    }

    $classes[] = is_user_logged_in() ? 'logged-in-user' : 'guest';

    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if (stripos($ua, 'Safari') !== false && stripos($ua, 'Chrome') === false) {
        $classes[] = 'safari';
    }

    return $classes;
});
