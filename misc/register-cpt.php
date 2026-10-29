<?php
/**
 * Template register custom post type + taxonomy. Ganti 'portfolio' & label.
 * Jangan lupa Settings > Permalinks > Save sekali abis nambah CPT.
 */

add_action('init', function () {
    register_post_type('portfolio', [
        'label'        => 'Portfolio',
        'labels'       => [
            'singular_name' => 'Portfolio',
            'add_new_item'  => 'Tambah Portfolio',
            'edit_item'     => 'Edit Portfolio',
        ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'menu_position' => 20,
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite'      => ['slug' => 'portfolio'],
        'show_in_rest' => true, // false kalau mau classic editor
    ]);

    register_taxonomy('portfolio_category', 'portfolio', [
        'label'        => 'Kategori',
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'portfolio-category'],
    ]);
});
