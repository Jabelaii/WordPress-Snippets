<?php
/**
 * Maintenance mode sederhana tanpa plugin.
 * Yang login sebagai admin tetap bisa akses, pengunjung dapet 503.
 * Hapus / comment baris add_action buat matiin.
 */

add_action('template_redirect', function () {
    if (current_user_can('manage_options') || is_user_logged_in()) {
        return;
    }

    // Halaman login tetap bisa dibuka
    if (in_array($GLOBALS['pagenow'] ?? '', ['wp-login.php', 'wp-cron.php'], true)) {
        return;
    }

    status_header(503);
    header('Retry-After: 3600');
    nocache_headers();

    wp_die(
        '<h1>' . esc_html(get_bloginfo('name')) . '</h1><p>Lagi maintenance sebentar, coba lagi nanti ya.</p>',
        'Maintenance',
        ['response' => 503]
    );
});
