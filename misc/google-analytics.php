<?php
/**
 * Pasang GA4 / GTM tanpa plugin. Isi salah satu, admin yang login ga ditrack.
 */

define('WPS_GA4_ID', '');  // G-XXXXXXXXXX
define('WPS_GTM_ID', '');  // GTM-XXXXXXX

add_action('wp_head', function () {
    if (current_user_can('manage_options')) {
        return;
    }

    if (WPS_GTM_ID) {
        printf(
            "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','%s');</script>\n",
            esc_js(WPS_GTM_ID)
        );
    } elseif (WPS_GA4_ID) {
        printf(
            "<script async src=\"https://www.googletagmanager.com/gtag/js?id=%1\$s\"></script>\n<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','%1\$s');</script>\n",
            esc_js(WPS_GA4_ID)
        );
    }
}, 1);
