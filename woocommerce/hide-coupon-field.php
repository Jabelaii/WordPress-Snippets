<?php
/**
 * WooCommerce: sembunyikan form kupon di cart & checkout.
 * Riset nunjukin field kupon bikin orang keluar cari kode diskon.
 * Kupon masih bisa dipakai lewat URL: /checkout/?coupon=KODE
 */

add_filter('woocommerce_coupons_enabled', function ($enabled) {
    if (is_cart() || is_checkout()) {
        return false;
    }
    return $enabled;
});

// Apply kupon dari URL
add_action('wp_loaded', function () {
    if (!empty($_GET['coupon']) && function_exists('WC') && WC()->cart) {
        $code = sanitize_text_field(wp_unslash($_GET['coupon']));
        if (!WC()->cart->has_discount($code)) {
            WC()->cart->apply_coupon($code);
        }
    }
}, 30);
