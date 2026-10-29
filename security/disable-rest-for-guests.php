<?php
/**
 * REST API cuma buat yang login. Hati-hati: Contact Form 7, Woo Blocks,
 * dan plugin lain yang nembak /wp-json dari frontend bakal rusak.
 * Whitelist namespace yang masih boleh di $allowed.
 */

add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result) || is_user_logged_in()) {
        return $result;
    }

    $allowed = ['contact-form-7/', 'wc/store/', 'oembed/'];
    $route   = $GLOBALS['wp']->query_vars['rest_route'] ?? '';

    foreach ($allowed as $ns) {
        if (strpos($route, '/' . $ns) === 0) {
            return $result;
        }
    }

    return new WP_Error('rest_disabled', 'REST API hanya untuk user login.', ['status' => 401]);
});
