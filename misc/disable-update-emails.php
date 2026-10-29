<?php
/**
 * Matiin email notifikasi auto-update (core, plugin, theme) dan
 * email "Site Admin Email Change". Inbox klien jadi ga penuh.
 */

add_filter('auto_core_update_send_email', '__return_false');
add_filter('auto_plugin_update_send_email', '__return_false');
add_filter('auto_theme_update_send_email', '__return_false');
add_filter('send_site_admin_email_change_email', '__return_false');

// Email "password changed" ke admin tiap ada user reset password
add_filter('wp_password_change_notification_email', '__return_false');
remove_action('after_password_reset', 'wp_password_change_notification');
