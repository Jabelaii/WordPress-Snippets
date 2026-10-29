<?php
/**
 * Field nomor resi di order admin, ikut masuk ke email "Completed" dan
 * halaman My Account > Order. Ga perlu plugin tracking yang berat.
 */

define('WPS_RESI_META', '_wps_resi');

// Field di sidebar order admin
add_action('woocommerce_admin_order_data_after_shipping_address', function ($order) {
    woocommerce_wp_text_input([
        'id'            => WPS_RESI_META,
        'label'         => 'No. Resi',
        'value'         => $order->get_meta(WPS_RESI_META),
        'wrapper_class' => 'form-field-wide',
    ]);
});

add_action('woocommerce_process_shop_order_meta', function ($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }
    $resi = sanitize_text_field(wp_unslash($_POST[WPS_RESI_META] ?? ''));
    $order->update_meta_data(WPS_RESI_META, $resi);
    $order->save();
});

// Tampil di email & my account
add_action('woocommerce_order_details_after_order_table', 'wps_show_resi');
add_action('woocommerce_email_after_order_table', 'wps_show_resi');

function wps_show_resi($order) {
    $resi = $order->get_meta(WPS_RESI_META);
    if ($resi) {
        echo '<p><strong>No. Resi:</strong> ' . esc_html($resi) . '</p>';
    }
}
