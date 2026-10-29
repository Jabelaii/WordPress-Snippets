<?php
/**
 * WooCommerce: customer yang login dari wp-login.php dilempar ke My Account,
 * bukan ke dashboard wp-admin. Admin/shop manager tetap ke wp-admin.
 */

add_filter('login_redirect', function ($redirect, $request, $user) {
    if ($user instanceof WP_User && !user_can($user, 'edit_posts')) {
        return wc_get_page_permalink('myaccount');
    }
    return $redirect;
}, 10, 3);

// Sembunyikan admin bar buat customer
add_filter('show_admin_bar', function ($show) {
    return current_user_can('edit_posts') ? $show : false;
});
