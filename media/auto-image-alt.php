<?php
/**
 * Isi alt text otomatis dari nama file pas upload.
 * "sepatu-lari-merah-01.jpg" -> "Sepatu lari merah 01".
 * Klien ga pernah isi alt, mending ada daripada kosong.
 */

add_action('add_attachment', function ($post_id) {
    if (!wp_attachment_is_image($post_id)) {
        return;
    }
    if (get_post_meta($post_id, '_wp_attachment_image_alt', true)) {
        return;
    }

    $name = pathinfo(get_attached_file($post_id), PATHINFO_FILENAME);
    $alt  = ucfirst(trim(preg_replace('/[-_]+/', ' ', $name)));

    update_post_meta($post_id, '_wp_attachment_image_alt', $alt);
});
