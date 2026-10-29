<?php
/**
 * WooCommerce: harga & tombol beli cuma buat yang login (B2B / reseller).
 */

add_action('init', function () {
    if (is_user_logged_in()) {
        return;
    }

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

    add_action('woocommerce_single_product_summary', function () {
        printf('<p><a href="%s">Login</a> untuk lihat harga.</p>', esc_url(wp_login_url(get_permalink())));
    }, 10);
});
