<?php
/**
 * Disable Gutenberg, balik ke classic editor tanpa plugin.
 * Sekalian buang CSS block library di frontend (~100KB yang ga kepake).
 */

add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_filter('use_widgets_block_editor', '__return_false');

add_action('after_setup_theme', function () {
    remove_theme_support('core-block-patterns');
});

add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}, 100);
