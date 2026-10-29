<?php
/**
 * Customer/subscriber ga bisa buka wp-admin, dilempar ke home.
 * AJAX tetap jalan.
 */

add_action('admin_init', function () {
    if (wp_doing_ajax() || current_user_can('edit_posts')) {
        return;
    }
    wp_safe_redirect(home_url());
    exit;
});
