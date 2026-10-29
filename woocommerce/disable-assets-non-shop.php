<?php
/**
 * WooCommerce: matiin cart fragments (wc-ajax=get_refreshed_fragments)
 * di halaman yang bukan cart/checkout/produk. Request ini jalan tiap page
 * load dan sering jadi yang paling lambat di waterfall.
 *
 * Konsekuensi: counter cart di header ga update real-time di halaman
 * blog/landing. Kalau theme kamu butuh itu, jangan pake.
 */

add_action('wp_enqueue_scripts', function () {
    if (is_cart() || is_checkout() || is_product() || is_shop() || is_product_category()) {
        return;
    }
    wp_dequeue_script('wc-cart-fragments');
}, 20);

// Sekalian buang CSS/JS Woo di halaman non-toko
add_action('wp_enqueue_scripts', function () {
    if (!function_exists('is_woocommerce') || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        return;
    }

    wp_dequeue_style('woocommerce-general');
    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_script('woocommerce');
    wp_dequeue_script('wc-add-to-cart');
}, 99);
