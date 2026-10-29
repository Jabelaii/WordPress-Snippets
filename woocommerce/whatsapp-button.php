<?php
/**
 * WooCommerce: tombol "Tanya via WhatsApp" di halaman produk.
 * Ganti nomornya di WPS_WA_NUMBER (format internasional tanpa +).
 */

define('WPS_WA_NUMBER', '628123456789');

add_action('woocommerce_single_product_summary', function () {
    global $product;

    $text = sprintf(
        "Halo, saya mau tanya produk *%s*\n%s",
        $product->get_name(),
        get_permalink($product->get_id())
    );

    $url = 'https://wa.me/' . WPS_WA_NUMBER . '?text=' . rawurlencode($text);

    printf(
        '<a href="%s" class="button wps-wa-button" target="_blank" rel="noopener">Tanya via WhatsApp</a>',
        esc_url($url)
    );
}, 35); // 35 = abis add to cart (30)

add_action('wp_head', function () {
    if (!is_product()) {
        return;
    }
    echo '<style>.wps-wa-button{background:#25d366;color:#fff;margin-top:8px}.wps-wa-button:hover{background:#1da851;color:#fff}</style>';
});
