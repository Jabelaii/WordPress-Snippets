<?php
/**
 * Sembunyikan menu yang ga perlu dari role selain administrator.
 * Klien dengan role Editor ga perlu lihat Tools, Comments, dll.
 */

add_action('admin_menu', function () {
    if (current_user_can('manage_options')) {
        return;
    }

    remove_menu_page('tools.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('themes.php');
    remove_menu_page('plugins.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_submenu_page('index.php', 'update-core.php');
}, 999);
