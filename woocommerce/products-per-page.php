<?php
/**
 * WooCommerce: jumlah produk per halaman & kolom di shop.
 */

add_filter('loop_shop_per_page', fn() => 24, 20);
add_filter('loop_shop_columns', fn() => 4);

// Related products: 4 produk, 4 kolom
add_filter('woocommerce_output_related_products_args', function ($args) {
    $args['posts_per_page'] = 4;
    $args['columns']        = 4;
    return $args;
}, 20);
