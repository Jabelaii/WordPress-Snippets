<?php
/**
 * WooCommerce: notice "Belanja Rp X lagi buat gratis ongkir" di cart & checkout.
 * Ambil minimum dari setting Free Shipping method di zona pertama yang ketemu,
 * atau isi manual di WPS_FREE_SHIPPING_MIN.
 */

define('WPS_FREE_SHIPPING_MIN', 0); // 0 = ambil dari setting zona

function wps_free_shipping_min() {
    if (WPS_FREE_SHIPPING_MIN > 0) {
        return (float) WPS_FREE_SHIPPING_MIN;
    }

    foreach (WC_Shipping_Zones::get_zones() as $zone) {
        foreach ($zone['shipping_methods'] as $method) {
            if ($method->id === 'free_shipping' && !empty($method->min_amount)) {
                return (float) $method->min_amount;
            }
        }
    }

    return 0;
}

function wps_free_shipping_notice() {
    $min = wps_free_shipping_min();
    if ($min <= 0 || !WC()->cart) {
        return;
    }

    $subtotal = (float) WC()->cart->get_displayed_subtotal();
    $sisa     = $min - $subtotal;

    if ($sisa > 0) {
        wc_print_notice(sprintf('Belanja %s lagi buat dapet gratis ongkir.', wc_price($sisa)), 'notice');
    } else {
        wc_print_notice('Kamu dapet gratis ongkir!', 'success');
    }
}
add_action('woocommerce_before_cart', 'wps_free_shipping_notice');
add_action('woocommerce_before_checkout_form', 'wps_free_shipping_notice');
