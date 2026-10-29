<?php
/**
 * WooCommerce: nomor order pakai prefix + padding, misal INV-000123.
 * Klien minta nomor order keliatan "rapi" di invoice. Cuma tampilan,
 * get_id() tetap angka asli jadi aman buat plugin lain.
 */

add_filter('woocommerce_order_number', function ($order_id, $order) {
    return 'INV-' . str_pad($order->get_id(), 6, '0', STR_PAD_LEFT);
}, 10, 2);
