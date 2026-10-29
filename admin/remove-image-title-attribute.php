<?php
/**
 * Remove title attribute from attachment images.
 * Bawaan WP nyalin judul attachment ke attribute title, hasilnya tooltip
 * random tiap hover gambar. Ga ada gunanya buat SEO juga.
 */

add_filter('wp_get_attachment_image_attributes', function ($attr) {
    unset($attr['title']);
    return $attr;
});
