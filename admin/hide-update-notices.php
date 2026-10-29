<?php
/**
 * Sembunyikan notifikasi update (core, plugin, theme) dari user non-admin.
 *
 * Buat site klien yang update-nya kita yang handle. Admin tetap lihat
 * semuanya, jadi ga ada update yang kelewat.
 *
 * Catatan: jangan remove_all_actions('admin_notices') - itu matiin notice
 * dari semua plugin (WooCommerce, SEO, dll), bukan cuma update nag.
 */

add_action('admin_init', function () {
    if (current_user_can('update_core')) {
        return;
    }

    remove_action('admin_notices', 'update_nag', 3);
    remove_action('admin_notices', 'maintenance_nag', 10);

    add_filter('pre_site_transient_update_core', '__return_null');
    add_filter('pre_site_transient_update_plugins', '__return_null');
    add_filter('pre_site_transient_update_themes', '__return_null');
});

// Icon update di admin bar
add_action('admin_bar_menu', function ($wp_admin_bar) {
    if (!current_user_can('update_core')) {
        $wp_admin_bar->remove_node('updates');
    }
}, 999);
