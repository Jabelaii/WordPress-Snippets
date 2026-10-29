<?php
/**
 * WooCommerce: field tambahan di produk (tab General) yang tampil di frontend.
 * Contoh: estimasi pengiriman / catatan singkat. Ganti key & label sesuai kebutuhan.
 */

define('WPS_PRODUCT_FIELD', '_wps_estimasi_kirim');

// Input di admin
add_action('woocommerce_product_options_general_product_data', function () {
    woocommerce_wp_text_input([
        'id'          => WPS_PRODUCT_FIELD,
        'label'       => 'Estimasi Kirim',
        'placeholder' => 'misal: 2-3 hari',
        'desc_tip'    => true,
        'description' => 'Tampil di bawah harga di halaman produk.',
    ]);
});

// Simpan
add_action('woocommerce_process_product_meta', function ($post_id) {
    $value = isset($_POST[WPS_PRODUCT_FIELD]) ? sanitize_text_field(wp_unslash($_POST[WPS_PRODUCT_FIELD])) : '';
    update_post_meta($post_id, WPS_PRODUCT_FIELD, $value);
});

// Tampil di frontend
add_action('woocommerce_single_product_summary', function () {
    global $product;
    $value = get_post_meta($product->get_id(), WPS_PRODUCT_FIELD, true);
    if ($value) {
        echo '<p class="wps-estimasi">Estimasi kirim: ' . esc_html($value) . '</p>';
    }
}, 11);
