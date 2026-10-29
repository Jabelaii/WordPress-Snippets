<?php
/**
 * WooCommerce: tampilin SKU di list produk & di cart.
 */

add_action('woocommerce_after_shop_loop_item_title', function () {
    global $product;
    if ($sku = $product->get_sku()) {
        echo '<span class="wps-sku">SKU: ' . esc_html($sku) . '</span>';
    }
}, 5);

add_filter('woocommerce_cart_item_name', function ($name, $cart_item) {
    $sku = $cart_item['data']->get_sku();
    return $sku ? $name . '<br><small>SKU: ' . esc_html($sku) . '</small>' : $name;
}, 10, 2);
