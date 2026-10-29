<?php
/**
 * Convert JPG/PNG jadi WebP saat upload, sekalian resize kalau kegedean.
 *
 * File asli dihapus, jadi di media library cuma ada .webp. Thumbnail
 * dibuat WP dari file webp (support sejak WP 5.8). Butuh GD dengan WebP.
 *
 * Setting bisa dioverride lewat filter:
 *   add_filter('wps_webp_quality', fn() => 85);
 *   add_filter('wps_webp_max_dimension', fn() => 2560);
 *   add_filter('wps_webp_keep_original', '__return_true');
 */

add_filter('wp_handle_upload', function ($upload) {
    if (empty($upload['file']) || !file_exists($upload['file'])) {
        return $upload;
    }

    if (!function_exists('imagewebp')) {
        return $upload;
    }

    $path = $upload['file'];
    $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    if (!in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
        return $upload;
    }

    $image = $ext === 'png' ? @imagecreatefrompng($path) : @imagecreatefromjpeg($path);
    if (!$image) {
        error_log("wps_webp: gagal baca {$path}");
        return $upload;
    }

    if ($ext === 'png') {
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
    }

    // Resize kalau sisi terpanjang lebih dari batas
    $max    = (int) apply_filters('wps_webp_max_dimension', 1920);
    $width  = imagesx($image);
    $height = imagesy($image);

    if ($max > 0 && max($width, $height) > $max) {
        $ratio      = $max / max($width, $height);
        $new_width  = (int) round($width * $ratio);
        $new_height = (int) round($height * $ratio);

        $resized = imagecreatetruecolor($new_width, $new_height);

        if ($ext === 'png') {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagefill($resized, 0, 0, imagecolorallocatealpha($resized, 0, 0, 0, 127));
        }

        imagecopyresampled($resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagedestroy($image);
        $image = $resized;
    }

    $webp_name = pathinfo($path, PATHINFO_FILENAME) . '.webp';
    $webp_path = dirname($path) . '/' . $webp_name;
    $quality   = (int) apply_filters('wps_webp_quality', 82);

    $saved = imagewebp($image, $webp_path, $quality);
    imagedestroy($image);

    if (!$saved || !file_exists($webp_path)) {
        error_log("wps_webp: gagal nulis {$webp_path}");
        return $upload;
    }

    if (!apply_filters('wps_webp_keep_original', false)) {
        @unlink($path);
    }

    $upload['file'] = $webp_path;
    $upload['url']  = dirname($upload['url']) . '/' . $webp_name;
    $upload['type'] = 'image/webp';

    return $upload;
});
