<?php
/**
 * WooCommerce: minimum belanja sebelum bisa checkout.
 */

define('WPS_MIN_ORDER', 50000);

add_action('woocommerce_check_cart_items', function () {
    if (!WC()->cart || WC()->cart->is_empty()) {
        return;
    }

    $subtotal = (float) WC()->cart->get_displayed_subtotal();

    if ($subtotal < WPS_MIN_ORDER) {
        wc_add_notice(sprintf(
            'Minimum belanja %s. Total kamu sekarang %s.',
            wc_price(WPS_MIN_ORDER),
            wc_price($subtotal)
        ), 'error');
    }
});
