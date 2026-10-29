<?php
/**
 * WooCommerce: redirect ke checkout langsung setelah add to cart,
 * skip halaman cart. Cocok buat toko yang produknya dikit / jual satuan.
 */

add_filter('woocommerce_add_to_cart_redirect', function ($url) {
    return wc_get_checkout_url();
});

// Matiin "View cart" notice karena udah langsung ke checkout
add_filter('wc_add_to_cart_message_html', '__return_empty_string');

// Kalau AJAX add to cart aktif, paksa reload supaya redirect jalan
add_filter('woocommerce_product_add_to_cart_url', function ($url, $product) {
    if ($product->is_type('simple')) {
        return $product->add_to_cart_url();
    }
    return $url;
}, 10, 2);
