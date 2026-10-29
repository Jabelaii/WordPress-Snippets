<?php
/**
 * Hasil search include custom post type & produk, exclude page.
 */

add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return;
    }
    $query->set('post_type', ['post', 'product', 'portfolio']);
});
