<?php
/**
 * Label di list page buat halaman penting (kayak "Front Page" bawaan WP).
 * Berguna biar klien ga sengaja hapus halaman yang dipake di template.
 */

add_filter('display_post_states', function ($states, $post) {
    $special = [
        'kontak'    => 'Halaman Kontak',
        'kebijakan' => 'Privacy Policy',
    ];

    if (isset($special[$post->post_name])) {
        $states['wps_special'] = $special[$post->post_name];
    }

    return $states;
}, 10, 2);
