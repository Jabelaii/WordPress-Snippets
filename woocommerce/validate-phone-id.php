<?php
/**
 * WooCommerce: validasi nomor HP Indonesia di checkout.
 * Terima 08xx, 62xx, +62xx; disimpan dalam format 628xx biar gampang buat WA.
 */

function wps_normalize_phone($phone) {
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    if (strpos($phone, '+62') === 0) {
        $phone = '62' . substr($phone, 3);
    } elseif (strpos($phone, '0') === 0) {
        $phone = '62' . substr($phone, 1);
    }
    return $phone;
}

add_action('woocommerce_checkout_process', function () {
    $phone = wps_normalize_phone($_POST['billing_phone'] ?? '');

    if (!preg_match('/^628[0-9]{7,11}$/', $phone)) {
        wc_add_notice('Nomor HP tidak valid. Contoh: 081234567890', 'error');
    }
});

add_filter('woocommerce_checkout_posted_data', function ($data) {
    if (!empty($data['billing_phone'])) {
        $data['billing_phone'] = wps_normalize_phone($data['billing_phone']);
    }
    return $data;
});
