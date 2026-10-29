<?php
/**
 * Ganti teks footer di wp-admin ("Thank you for creating with WordPress").
 */

add_filter('admin_footer_text', function () {
    return sprintf(
        'Site by <a href="%s" target="_blank" rel="noopener">%s</a>',
        esc_url('https://example.com'),
        esc_html('Your Agency')
    );
});

// Hilangkan nomor versi WP di kanan bawah
add_filter('update_footer', '__return_empty_string', 11);
