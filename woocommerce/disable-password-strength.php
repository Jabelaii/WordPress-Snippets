<?php
/**
 * Matiin password strength meter di register/checkout.
 * Hampir tiap project klien minta ini karena customer ga bisa daftar
 * gara-gara password "lemah". Script-nya juga lumayan gede (zxcvbn ~800KB).
 */

add_action('wp_print_scripts', function () {
    if (is_admin()) {
        return;
    }
    wp_dequeue_script('wc-password-strength-meter');
}, 100);

// 0 = terima semua, 1 = lemah, 2 = sedang, 3 = kuat
add_filter('woocommerce_min_password_strength', fn() => 0);
