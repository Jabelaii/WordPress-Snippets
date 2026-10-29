<?php
/**
 * WooCommerce: tombol "Kosongkan Keranjang" di halaman cart.
 */

add_action('woocommerce_cart_actions', function () {
    printf(
        '<a href="%s" class="button" onclick="return confirm(\'Kosongkan keranjang?\')">Kosongkan Keranjang</a>',
        esc_url(add_query_arg('empty_cart', 'yes', wc_get_cart_url()))
    );
});

add_action('wp_loaded', function () {
    if (isset($_GET['empty_cart']) && $_GET['empty_cart'] === 'yes' && WC()->cart) {
        WC()->cart->empty_cart();
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
}, 20);
