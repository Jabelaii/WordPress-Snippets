<?php
/**
 * Shortcode [year] buat copyright di footer biar ga perlu diedit tiap tahun.
 * Tiap Januari ada aja klien yang nanya kenapa footer masih tahun lalu.
 * Pakai: &copy; [year] Nama Toko
 */

add_shortcode('year', fn() => date_i18n('Y'));

// Biar shortcode jalan juga di widget text
add_filter('widget_text', 'do_shortcode');
