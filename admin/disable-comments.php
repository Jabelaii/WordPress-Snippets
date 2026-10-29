<?php
/**
 * Matiin komentar di seluruh site.
 *
 * Yang versi lama cuma remove_post_type_support, tapi komentar lama masih
 * muncul di frontend dan menu Comments masih ada di admin. Ini nutup semuanya.
 */

// Support komentar & trackback di semua post type
add_action('admin_init', function () {
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Tutup form komentar & sembunyikan komentar yang sudah ada
add_filter('comments_open', '__return_false', 20);
add_filter('pings_open', '__return_false', 20);
add_filter('comments_array', '__return_empty_array', 10);

// Buang menu Comments di sidebar admin dan admin bar
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

add_action('admin_bar_menu', function ($wp_admin_bar) {
    $wp_admin_bar->remove_node('comments');
}, 999);

// Redirect kalau ada yang buka halaman Comments langsung
add_action('admin_init', function () {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
});
