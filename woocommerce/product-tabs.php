<?php
/**
 * WooCommerce: atur tab di halaman produk.
 * Buang "Additional information" & reviews, rename Description, tambah tab custom.
 */

add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['additional_information']);
    unset($tabs['reviews']);

    if (isset($tabs['description'])) {
        $tabs['description']['title'] = 'Detail Produk';
    }

    $tabs['pengiriman'] = [
        'title'    => 'Pengiriman',
        'priority' => 50,
        'callback' => function () {
            echo '<p>Pesanan diproses 1x24 jam hari kerja. Estimasi sampai 2-5 hari tergantung kurir.</p>';
        },
    ];

    return $tabs;
}, 98);
