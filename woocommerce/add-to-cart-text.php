<?php
/**
 * WooCommerce: ganti teks tombol Add to cart.
 */

add_filter('woocommerce_product_single_add_to_cart_text', fn() => 'Beli Sekarang');

add_filter('woocommerce_product_add_to_cart_text', function ($text, $product) {
    if ($product->is_type('variable')) {
        return 'Pilih Varian';
    }
    if (!$product->is_in_stock()) {
        return 'Stok Habis';
    }
    return 'Beli';
}, 10, 2);

add_filter('woocommerce_order_button_text', fn() => 'Bayar Sekarang');
