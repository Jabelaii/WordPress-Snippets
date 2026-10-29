<?php
/**
 * WooCommerce: produk habis ditaruh paling bawah di shop & kategori.
 */

add_filter('posts_clauses', function ($clauses, $query) {
    global $wpdb;

    if (is_admin() || !$query->is_main_query() || !function_exists('is_shop')) {
        return $clauses;
    }
    if (!(is_shop() || is_product_category() || is_product_tag())) {
        return $clauses;
    }

    $clauses['join']    .= " LEFT JOIN {$wpdb->wc_product_meta_lookup} wps_lookup ON {$wpdb->posts}.ID = wps_lookup.product_id ";
    $clauses['orderby']  = " wps_lookup.stock_status ASC, " . $clauses['orderby'];

    return $clauses;
}, 10, 2);
