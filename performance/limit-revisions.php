<?php
/**
 * Batasi revisi post jadi 5 dan autosave jadi 2 menit.
 * Tanpa ini tabel wp_posts isinya revisi semua di site yang udah lama jalan.
 * (WP_POST_REVISIONS di wp-config lebih dulu dibaca kalau ada.)
 */

add_filter('wp_revisions_to_keep', fn($num, $post) => 5, 10, 2);

add_action('admin_init', function () {
    wp_deregister_script('autosave');
    wp_register_script('autosave', includes_url('js/autosave.min.js'), ['heartbeat'], false, true);
    wp_localize_script('autosave', 'autosaveL10n', [
        'autosaveInterval' => 120,
        'blog_id'          => get_current_blog_id(),
    ]);
});
