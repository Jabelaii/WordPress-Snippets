<?php
/**
 * Tampilin "Diperbarui: 12 Jan 2026" kalau post pernah diedit setelah publish.
 * Pakai wps_last_updated() di template, atau shortcode [last_updated].
 * Google suka ini buat artikel evergreen.
 */

function wps_last_updated($post = null) {
    $post = get_post($post);
    if (!$post) {
        return '';
    }

    // Kalau selisih < 1 hari anggap belum diupdate
    if (strtotime($post->post_modified) - strtotime($post->post_date) < DAY_IN_SECONDS) {
        return '';
    }

    return sprintf(
        '<span class="wps-updated">Diperbarui: <time datetime="%s">%s</time></span>',
        esc_attr(get_the_modified_date('c', $post)),
        esc_html(get_the_modified_date('j M Y', $post))
    );
}

add_shortcode('last_updated', fn() => wps_last_updated());
