<?php
/**
 * Estimasi waktu baca: [reading_time] atau wps_reading_time() di template.
 * 200 kata/menit, bahasa Indonesia rata-rata segitu.
 */

function wps_reading_time($post = null) {
    $post = get_post($post);
    if (!$post) {
        return '';
    }

    $words   = str_word_count(wp_strip_all_tags($post->post_content));
    $minutes = max(1, (int) ceil($words / 200));

    return $minutes . ' menit baca';
}

add_shortcode('reading_time', fn() => wps_reading_time());
