<?php
/**
 * WooCommerce: link WhatsApp ke customer di halaman detail order admin,
 * pesan udah keisi nomor order & status. Tinggal klik, ga perlu copy nomor.
 */

add_action('woocommerce_admin_order_data_after_billing_address', function ($order) {
    $phone = preg_replace('/[^0-9]/', '', $order->get_billing_phone());
    if (!$phone) {
        return;
    }
    if (strpos($phone, '0') === 0) {
        $phone = '62' . substr($phone, 1);
    }

    $text = sprintf(
        "Halo %s, pesanan #%s kamu statusnya sekarang: %s.",
        $order->get_billing_first_name(),
        $order->get_order_number(),
        wc_get_order_status_name($order->get_status())
    );

    printf(
        '<p><a href="https://wa.me/%s?text=%s" target="_blank" class="button">Chat WhatsApp</a></p>',
        esc_attr($phone),
        rawurlencode($text)
    );
});
