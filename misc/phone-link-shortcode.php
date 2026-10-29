<?php
/**
 * [tel number="081234567890"] -> link tel: yang bisa diklik di HP.
 * [wa number="081234567890" text="Halo"] -> link wa.me
 */

add_shortcode('tel', function ($atts) {
    $a = shortcode_atts(['number' => '', 'label' => ''], $atts);
    $clean = preg_replace('/[^0-9+]/', '', $a['number']);
    return sprintf('<a href="tel:%s">%s</a>', esc_attr($clean), esc_html($a['label'] ?: $a['number']));
});

add_shortcode('wa', function ($atts) {
    $a = shortcode_atts(['number' => '', 'text' => '', 'label' => 'WhatsApp'], $atts);
    $clean = preg_replace('/[^0-9]/', '', $a['number']);
    if (strpos($clean, '0') === 0) {
        $clean = '62' . substr($clean, 1);
    }
    $url = 'https://wa.me/' . $clean . ($a['text'] ? '?text=' . rawurlencode($a['text']) : '');
    return sprintf('<a href="%s" target="_blank" rel="noopener">%s</a>', esc_url($url), esc_html($a['label']));
});
