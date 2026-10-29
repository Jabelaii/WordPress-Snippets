<?php
/**
 * WP-Cron jalan tiap ada pengunjung, bikin request pertama lambat.
 * Ini matiin trigger-nya; jalankan dari cron server tiap 5 menit (crontab):
 *   [star]/5 * * * * curl -s https://domain.com/wp-cron.php?doing_wp_cron > /dev/null
 *   (ganti [star] dengan *, ga bisa ditulis di sini karena nutup komentar)
 * atau: wp cron event run --due-now
 *
 * (Sama kayak define('DISABLE_WP_CRON', true) di wp-config, pakai yang mana aja.)
 */

if (!defined('DISABLE_WP_CRON')) {
    define('DISABLE_WP_CRON', true);
}
