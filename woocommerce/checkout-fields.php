<?php
/**
 * WooCommerce: rapihin field checkout.
 * Buang yang ga kepake buat toko lokal (company, address 2, dll),
 * ganti label, dan nomor HP jadi wajib.
 */

add_filter('woocommerce_checkout_fields', function ($fields) {
    // Field yang mau dibuang
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);

    // Label & placeholder
    $fields['billing']['billing_phone']['label']       = 'No. WhatsApp';
    $fields['billing']['billing_phone']['placeholder'] = '08xxxxxxxxxx';
    $fields['billing']['billing_phone']['required']    = true;
    $fields['billing']['billing_phone']['priority']    = 25; // naik ke atas, abis nama

    $fields['order']['order_comments']['placeholder'] = 'Catatan buat kurir / penjual (opsional)';

    return $fields;
});

// Default negara Indonesia biar ga milih dulu
add_filter('default_checkout_billing_country', fn() => 'ID');
add_filter('default_checkout_shipping_country', fn() => 'ID');
