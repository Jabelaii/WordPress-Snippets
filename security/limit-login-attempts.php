<?php
/**
 * Limit login attempts tanpa plugin. 5x salah dari IP yang sama = blok 15 menit.
 * Pakai transient, jadi ga nambah tabel. Buat site di balik Cloudflare/proxy,
 * IP diambil dari header CF-Connecting-IP / X-Forwarded-For.
 */

define('WPS_LOGIN_MAX', 5);
define('WPS_LOGIN_LOCK', 15 * MINUTE_IN_SECONDS);

function wps_client_ip() {
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $key) {
        if (!empty($_SERVER[$key])) {
            return trim(explode(',', $_SERVER[$key])[0]);
        }
    }
    return '0.0.0.0';
}

function wps_login_key() {
    return 'wps_login_' . md5(wps_client_ip());
}

add_filter('authenticate', function ($user, $username) {
    if (empty($username)) {
        return $user;
    }
    $attempts = (int) get_transient(wps_login_key());
    if ($attempts >= WPS_LOGIN_MAX) {
        return new WP_Error('wps_locked', 'Terlalu banyak percobaan login. Coba lagi 15 menit.');
    }
    return $user;
}, 30, 2);

add_action('wp_login_failed', function () {
    $key      = wps_login_key();
    $attempts = (int) get_transient($key) + 1;
    set_transient($key, $attempts, WPS_LOGIN_LOCK);
});

add_action('wp_login', function () {
    delete_transient(wps_login_key());
});
