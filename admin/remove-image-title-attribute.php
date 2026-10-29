<?php
/**
 * Remove title attribute from attachment images.
 * Browser nampilin tooltip dari attribute ini, biasanya ganggu.
 */

add_filter('wp_get_attachment_image_attributes', function ($attr) {
    unset($attr['title']);
    return $attr;
});
