<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_head', function () {
    $color = get_theme_mod('color_theme', '#ffb600');
    $bg = get_theme_mod('background_themewebsite', [
        'background-color' => 'rgba(255,255,255)',
        'background-image' => '',
        'background-repeat' => 'repeat',
        'background-position' => 'center center',
        'background-size' => 'cover',
        'background-attachment' => 'scroll',
    ]);
    if (!is_array($bg)) {
        $bg = [];
    }
    $bg_color = isset($bg['background-color']) ? $bg['background-color'] : 'rgba(255,255,255)';
    $bg_image = isset($bg['background-image']) ? $bg['background-image'] : '';
    $bg_repeat = isset($bg['background-repeat']) ? $bg['background-repeat'] : 'repeat';
    $bg_position = isset($bg['background-position']) ? $bg['background-position'] : 'center center';
    $bg_size = isset($bg['background-size']) ? $bg['background-size'] : 'cover';
    $bg_attachment = isset($bg['background-attachment']) ? $bg['background-attachment'] : 'scroll';
    echo '<style id="velocity-child-inline-styles">';
    echo ':root{--color-theme:' . esc_html($color) . ';--bs-primary:' . esc_html($color) . ';}';
    echo '.border-color-theme{--bs-border-color:' . esc_html($color) . ';}';
    echo '.bg-theme{background-color:' . esc_html($color) . ' !important;}';
    $rules = 'background-color:' . esc_html($bg_color) . ';';
    if (!empty($bg_image)) {
        $rules .= 'background-image:url(' . esc_url($bg_image) . ');';
        $rules .= 'background-repeat:' . esc_html($bg_repeat) . ';';
        $rules .= 'background-position:' . esc_html($bg_position) . ';';
        $rules .= 'background-size:' . esc_html($bg_size) . ';';
        $rules .= 'background-attachment:' . esc_html($bg_attachment) . ';';
    }
    echo 'body{' . $rules . '}';
    echo '</style>';
});