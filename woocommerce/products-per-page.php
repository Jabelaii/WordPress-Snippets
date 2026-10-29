<?php
/**
 * WooCommerce: jumlah produk per halaman & kolom di shop.
 * Setting Customizer cuma kasih jumlah baris, bukan angka pasti.
 * 24 bisa dibagi 2, 3, 4 kolom jadi ga ada baris bolong di bawah.
 */

add_filter('loop_shop_per_page', fn() => 24, 20);
add_filter('loop_shop_columns', fn() => 4);

// Related products: 4 produk, 4 kolom
add_filter('woocommerce_output_related_products_args', function ($args) {
    $args['posts_per_page'] = 4;
    $args['columns']        = 4;
    return $args;
}, 20);
