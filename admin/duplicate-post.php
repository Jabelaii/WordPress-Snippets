<?php
/**
 * Duplicate post/page/produk dari list admin tanpa plugin.
 * Nambah link "Duplicate" di row actions, hasilnya jadi draft.
 * Meta (ACF, Woo, dll) dan taxonomy ikut dicopy.
 */

add_filter('post_row_actions', 'wps_duplicate_link', 10, 2);
add_filter('page_row_actions', 'wps_duplicate_link', 10, 2);

function wps_duplicate_link($actions, $post) {
    if (!current_user_can('edit_post', $post->ID)) {
        return $actions;
    }

    $url = wp_nonce_url(
        admin_url('admin-post.php?action=wps_duplicate&post=' . $post->ID),
        'wps_duplicate_' . $post->ID
    );

    $actions['wps_duplicate'] = '<a href="' . esc_url($url) . '">Duplicate</a>';
    return $actions;
}

add_action('admin_post_wps_duplicate', function () {
    $post_id = (int) ($_GET['post'] ?? 0);
    check_admin_referer('wps_duplicate_' . $post_id);

    $post = get_post($post_id);
    if (!$post || !current_user_can('edit_post', $post_id)) {
        wp_die('Ga bisa duplicate post ini.');
    }

    $new_id = wp_insert_post([
        'post_title'     => $post->post_title . ' (Copy)',
        'post_content'   => $post->post_content,
        'post_excerpt'   => $post->post_excerpt,
        'post_type'      => $post->post_type,
        'post_status'    => 'draft',
        'post_author'    => get_current_user_id(),
        'post_parent'    => $post->post_parent,
        'menu_order'     => $post->menu_order,
        'comment_status' => $post->comment_status,
    ]);

    if (is_wp_error($new_id)) {
        wp_die($new_id->get_error_message());
    }

    // Taxonomy
    foreach (get_object_taxonomies($post->post_type) as $tax) {
        $terms = wp_get_object_terms($post_id, $tax, ['fields' => 'ids']);
        wp_set_object_terms($new_id, $terms, $tax);
    }

    // Meta, skip yang internal
    foreach (get_post_meta($post_id) as $key => $values) {
        if (in_array($key, ['_edit_lock', '_edit_last', '_wp_old_slug'], true)) {
            continue;
        }
        foreach ($values as $value) {
            add_post_meta($new_id, $key, maybe_unserialize($value));
        }
    }

    wp_safe_redirect(admin_url('post.php?action=edit&post=' . $new_id));
    exit;
});
