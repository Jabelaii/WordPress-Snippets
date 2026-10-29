<?php
/**
 * Batasi upload: maksimal ukuran file dan tipe yang boleh.
 * Default WP ikut php.ini, sering kegedean buat klien yang upload foto 10MB.
 */

// Max 2MB buat gambar, selain itu ikut default
add_filter('wp_handle_upload_prefilter', function ($file) {
    $max_image = 2 * 1024 * 1024;

    if (strpos($file['type'], 'image/') === 0 && $file['size'] > $max_image) {
        $file['error'] = sprintf(
            'Ukuran gambar maksimal %s. Kompres dulu sebelum upload.',
            size_format($max_image)
        );
    }

    return $file;
});

// Tambah tipe file yang boleh diupload (default WP ga izinin svg & webp lama)
add_filter('upload_mimes', function ($mimes) {
    $mimes['webp'] = 'image/webp';
    // SVG cuma buat admin, bisa bawa script
    if (current_user_can('manage_options')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
});
