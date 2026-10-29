<?php
/**
 * Kirim email lewat SMTP tanpa plugin WP Mail SMTP.
 * Pake PHPMailer bawaan WP, jadi ga nambah apa-apa.
 *
 * Password jangan ditaruh di sini, taruh di wp-config:
 *   define('WPS_SMTP_PASS', 'xxxx');
 *
 * Kebanyakan hosting share: host mail.domain.com, port 465 ssl atau 587 tls.
 * Gmail butuh App Password, bukan password akun biasa.
 */

add_action('phpmailer_init', function ($mail) {
    if (!defined('WPS_SMTP_PASS')) {
        return;
    }

    $mail->isSMTP();
    $mail->Host       = 'mail.domain.com';
    $mail->Port       = 465;
    $mail->SMTPSecure = 'ssl'; // 'tls' kalau port 587
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@domain.com';
    $mail->Password   = WPS_SMTP_PASS;
    $mail->From       = 'noreply@domain.com';
    $mail->FromName   = get_bloginfo('name');
});

// Log kalau email gagal, cek di debug.log
add_action('wp_mail_failed', function ($error) {
    error_log('wp_mail gagal: ' . $error->get_error_message());
});
