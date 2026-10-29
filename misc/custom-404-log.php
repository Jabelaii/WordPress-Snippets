<?php
/**
 * Catat URL yang kena 404 ke option, lihat di Tools > 404 Log.
 * Buat nemuin link rusak abis migrasi. Max 200 entry terakhir.
 */

add_action('template_redirect', function () {
    if (!is_404()) {
        return;
    }

    $log = get_option('wps_404_log', []);
    $uri = esc_url_raw($_SERVER['REQUEST_URI'] ?? '');

    $log[$uri] = [
        'count' => ($log[$uri]['count'] ?? 0) + 1,
        'last'  => current_time('mysql'),
        'ref'   => esc_url_raw($_SERVER['HTTP_REFERER'] ?? ''),
    ];

    uasort($log, fn($a, $b) => strcmp($b['last'], $a['last']));
    update_option('wps_404_log', array_slice($log, 0, 200, true), false);
});

add_action('admin_menu', function () {
    add_management_page('404 Log', '404 Log', 'manage_options', 'wps-404-log', function () {
        if (isset($_POST['clear']) && check_admin_referer('wps_404_clear')) {
            delete_option('wps_404_log');
        }
        $log = get_option('wps_404_log', []);

        echo '<div class="wrap"><h1>404 Log</h1>';
        echo '<form method="post">' . wp_nonce_field('wps_404_clear', '_wpnonce', true, false) . '<button class="button" name="clear" value="1">Bersihkan</button></form>';
        echo '<table class="widefat striped"><thead><tr><th>URL</th><th>Hit</th><th>Terakhir</th><th>Referer</th></tr></thead><tbody>';
        foreach ($log as $uri => $row) {
            printf('<tr><td><code>%s</code></td><td>%d</td><td>%s</td><td>%s</td></tr>',
                esc_html($uri), $row['count'], esc_html($row['last']), esc_html($row['ref']));
        }
        echo '</tbody></table></div>';
    });
});
