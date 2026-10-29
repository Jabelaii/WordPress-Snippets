<?php
/**
 * WooCommerce: badge "Sale!" diganti jadi persen diskon, misal "-25%".
 * Buat variable product ambil diskon terbesar dari variasinya.
 */

add_filter('woocommerce_sale_flash', function ($html, $post, $product) {
    $percent = 0;

    if ($product->is_type('variable')) {
        foreach ($product->get_available_variations() as $v) {
            $reg  = (float) $v['display_regular_price'];
            $sale = (float) $v['display_price'];
            if ($reg > 0 && $sale < $reg) {
                $percent = max($percent, round(($reg - $sale) / $reg * 100));
            }
        }
    } else {
        $reg  = (float) $product->get_regular_price();
        $sale = (float) $product->get_sale_price();
        if ($reg > 0 && $sale < $reg) {
            $percent = round(($reg - $sale) / $reg * 100);
        }
    }

    if ($percent <= 0) {
        return $html;
    }

    return '<span class="onsale">-' . $percent . '%</span>';
}, 10, 3);
