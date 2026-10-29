<?php
/**
 * Status order custom "Dikirim" (wc-shipped). Default Woo cuma Processing -> Completed,
 * padahal klien pengen tahu mana yang udah dikirim tapi belum sampai.
 * Muncul di dropdown status, bulk action, dan laporan.
 */

add_action('init', function () {
    register_post_status('wc-shipped', [
        'label'                     => 'Dikirim',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop('Dikirim <span class="count">(%s)</span>', 'Dikirim <span class="count">(%s)</span>'),
    ]);
});

add_filter('wc_order_statuses', function ($statuses) {
    $new = [];
    foreach ($statuses as $key => $label) {
        $new[$key] = $label;
        if ($key === 'wc-processing') {
            $new['wc-shipped'] = 'Dikirim';
        }
    }
    return $new;
});

add_filter('bulk_actions-edit-shop_order', function ($actions) {
    $actions['mark_shipped'] = 'Ubah status ke Dikirim';
    return $actions;
});
add_filter('bulk_actions-woocommerce_page_wc-orders', function ($actions) { // HPOS
    $actions['mark_shipped'] = 'Ubah status ke Dikirim';
    return $actions;
});

// Anggap "shipped" sebagai paid, biar laporan penjualan ngitung
add_filter('woocommerce_order_is_paid_statuses', function ($statuses) {
    $statuses[] = 'shipped';
    return $statuses;
});
