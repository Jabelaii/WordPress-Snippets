<?php
/**
 * Matiin editor file theme/plugin di wp-admin (Appearance > Theme File Editor).
 * Sama kayak DISALLOW_FILE_EDIT di wp-config, tapi bisa dari snippet.
 * Kalau akun admin kebobol, ini yang biasanya dipake buat nanem backdoor.
 */

add_filter('file_mod_allowed', function ($allowed, $context) {
    if ($context === 'capabilities') {
        return false;
    }
    return $allowed;
}, 10, 2);

// Sembunyikan info versi PHP/WP dari Site Health buat non-admin
add_filter('site_status_tests', function ($tests) {
    if (!current_user_can('manage_options')) {
        return [];
    }
    return $tests;
});
