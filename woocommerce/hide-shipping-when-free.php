<?php
/**
 * WooCommerce: kalau gratis ongkir udah kena, sembunyikan metode lain
 * biar customer ga salah pilih flat rate.
 */

add_filter('woocommerce_package_rates', function ($rates) {
    $free = [];
    foreach ($rates as $id => $rate) {
        if ($rate->method_id === 'free_shipping') {
            $free[$id] = $rate;
        }
    }
    return $free ?: $rates;
}, 100);
