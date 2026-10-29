<?php
/**
 * Halaman attachment (domain.com/nama-gambar/) itu thin content, Yoast selalu
 * nyuruh dimatiin. Ini redirect ke post induknya, kalau ga ada induk ke file-nya langsung.
 */

add_action('template_redirect', function () {
    if (!is_attachment()) {
        return;
    }

    global $post;
    $target = ($post->post_parent && get_post_status($post->post_parent) === 'publish')
        ? get_permalink($post->post_parent)
        : wp_get_attachment_url($post->ID);

    wp_redirect($target, 301);
    exit;
});
