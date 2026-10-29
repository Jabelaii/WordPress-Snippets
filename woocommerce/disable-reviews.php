<?php
/**
 * WooCommerce: matiin review produk total.
 */

add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}, 98);

add_filter('woocommerce_product_get_reviews_allowed', '__return_false');

add_action('init', function () {
    remove_post_type_support('product', 'comments');
});

// Buang rating bintang di loop
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
