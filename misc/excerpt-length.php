<?php
/**
 * Panjang excerpt & teks "read more".
 */

add_filter('excerpt_length', fn() => 25, 999);
add_filter('excerpt_more', fn() => '…');

// Fungsi helper buat template: wps_excerpt(20)
function wps_excerpt($words = 20, $post = null) {
    $post = get_post($post);
    $text = $post->post_excerpt ?: wp_strip_all_tags(strip_shortcodes($post->post_content));
    return wp_trim_words($text, $words, '…');
}
