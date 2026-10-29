<?php
/**
 * Warna admin bar beda per environment biar ga salah edit di production.
 * Set WP_ENVIRONMENT_TYPE di wp-config: 'local' | 'staging' | 'production'.
 */

add_action('admin_head', 'wps_env_color');
add_action('wp_head', 'wps_env_color');

function wps_env_color() {
    if (!is_admin_bar_showing()) {
        return;
    }

    $colors = [
        'local'   => '#2e7d32',
        'staging' => '#ef6c00',
    ];

    $env = wp_get_environment_type();
    if (!isset($colors[$env])) {
        return;
    }

    printf(
        '<style>#wpadminbar{background:%1$s !important}#wpadminbar #wp-admin-bar-site-name>.ab-item:before{content:"[%2$s] "}</style>',
        $colors[$env],
        strtoupper($env)
    );
}
