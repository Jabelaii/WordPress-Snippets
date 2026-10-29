<?php
/**
 * Bersihin dashboard wp-admin: buang widget bawaan + welcome panel.
 * Comment baris yang mau dipertahankan.
 */

add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress Events and News
});

remove_action('welcome_panel', 'wp_welcome_panel');
