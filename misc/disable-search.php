<?php
/**
 * Matiin fitur search total. Buat landing page / company profile yang
 * ga ada blog, biar ?s= ga bisa dipake buat nge-scan konten.
 */

add_action('parse_query', function ($query) {
    if (is_admin() || !$query->is_main_query() || !$query->is_search) {
        return;
    }
    $query->is_search = false;
    $query->query_vars['s'] = '';
    $query->set_404();
    status_header(404);
});

add_filter('get_search_form', '__return_empty_string');
add_action('widgets_init', fn() => unregister_widget('WP_Widget_Search'));
