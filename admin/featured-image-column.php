<?php
/**
 * Kolom thumbnail di list post & page di admin.
 */

foreach (['post', 'page'] as $type) {
    add_filter("manage_{$type}_posts_columns", function ($columns) {
        return ['cb' => $columns['cb'], 'wps_thumb' => 'Gambar'] + $columns;
    });

    add_action("manage_{$type}_posts_custom_column", function ($column, $post_id) {
        if ($column === 'wps_thumb') {
            echo get_the_post_thumbnail($post_id, [50, 50]) ?: '—';
        }
    }, 10, 2);
}

add_action('admin_head', function () {
    echo '<style>.column-wps_thumb{width:60px}.column-wps_thumb img{border-radius:4px;object-fit:cover}</style>';
});
