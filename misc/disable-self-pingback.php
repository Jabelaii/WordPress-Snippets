<?php
/**
 * WP ngirim pingback ke diri sendiri tiap kita link ke post sendiri.
 * Muncul di komentar sebagai "[...] baca juga [...]". Ganggu.
 */

add_action('pre_ping', function (&$links) {
    $home = home_url();
    foreach ($links as $i => $link) {
        if (strpos($link, $home) === 0) {
            unset($links[$i]);
        }
    }
});
