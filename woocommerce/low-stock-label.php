<?php
/**
 * "Sisa 3 lagi!" di halaman produk kalau stok tinggal dikit.
 * Batas ambil dari setting Woo (Inventory > Low stock threshold).
 */

add_filter('woocommerce_get_availability_text', function ($text, $product) {
    if (!$product->managing_stock() || !$product->is_in_stock()) {
        return $text;
    }

    $stock     = $product->get_stock_quantity();
    $threshold = (int) get_option('woocommerce_notify_low_stock_amount', 2);

    if ($stock > 0 && $stock <= $threshold) {
        return sprintf('Sisa %d lagi!', $stock);
    }

    return $text;
}, 10, 2);
