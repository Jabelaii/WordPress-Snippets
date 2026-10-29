<?php
/**
 * Login page: ganti logo WP dengan logo site (Customizer > Site Identity),
 * link-nya ke home, bukan wordpress.org.
 */

add_action('login_enqueue_scripts', function () {
    $logo_id = get_theme_mod('custom_logo');
    if (!$logo_id) {
        return;
    }

    $logo = wp_get_attachment_image_url($logo_id, 'medium');
    if (!$logo) {
        return;
    }

    printf(
        '<style>
            #login h1 a {
                background-image: url(%s);
                background-size: contain;
                width: 220px;
                height: 80px;
            }
        </style>',
        esc_url($logo)
    );
});

add_filter('login_headerurl', fn() => home_url());
add_filter('login_headertext', fn() => get_bloginfo('name'));
