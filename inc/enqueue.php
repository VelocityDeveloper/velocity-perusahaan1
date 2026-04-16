<?php

/**
 * Enqueue child theme styles and scripts.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
if (!function_exists('justg_child_enqueue_parent_style')) {
    function justg_child_enqueue_parent_style()
    {
        $parenthandle = 'parent-style';
        $theme        = wp_get_theme();

        wp_enqueue_style(
            $parenthandle,
            get_template_directory_uri() . '/style.css',
            array(),
            $theme->parent()->get('Version')
        );

        $custom_css_path = get_stylesheet_directory() . '/css/custom.css';
        $custom_js_path  = get_stylesheet_directory() . '/js/custom.js';
        $style_css_path  = get_stylesheet_directory() . '/style.css';

        $custom_css_version = file_exists($custom_css_path) ? (string) filemtime($custom_css_path) : $theme->get('Version');
        $custom_js_version  = file_exists($custom_js_path) ? (string) filemtime($custom_js_path) : $theme->get('Version');
        $style_css_version  = file_exists($style_css_path) ? (string) filemtime($style_css_path) : $theme->get('Version');

        wp_enqueue_style('slick-style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), '1.8.1');
        wp_enqueue_style('slick-style-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', array('slick-style'), '1.8.1');
        wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3');
        wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/custom.css', array(), $custom_css_version);

        wp_enqueue_style(
            'child-style',
            get_stylesheet_uri(),
            array($parenthandle),
            $style_css_version
        );

        wp_enqueue_script('slick-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
        wp_enqueue_script('justg-custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery', 'slick-scripts'), $custom_js_version, true);

        wp_dequeue_style('justg-fontawesome-legacy');
        wp_deregister_style('justg-fontawesome-legacy');
    }
}
