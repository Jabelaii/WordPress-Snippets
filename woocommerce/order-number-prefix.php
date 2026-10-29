<?php
/**
 * WooCommerce: nomor order pakai prefix + padding, misal INV-000123.
 * Cuma tampilan, ID asli di database ga berubah.
 */

add_filter('woocommerce_order_number', function ($order_id, $order) {
    return 'INV-' . str_pad($order->get_id(), 6, '0', STR_PAD_LEFT);
}, 10, 2);
