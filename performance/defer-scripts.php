<?php
/**
 * Tambah `defer` ke semua script frontend kecuali jQuery dan yang di-skip.
 * Kalau ada inline script yang depend ke jQuery langsung, jQuery harus tetap blocking.
 */

add_filter('script_loader_tag', function ($tag, $handle) {
    if (is_admin()) {
        return $tag;
    }

    $skip = ['jquery', 'jquery-core', 'jquery-migrate'];
    if (in_array($handle, $skip, true) || strpos($tag, ' defer') !== false || strpos($tag, ' async') !== false) {
        return $tag;
    }

    return str_replace(' src=', ' defer src=', $tag);
}, 10, 2);
