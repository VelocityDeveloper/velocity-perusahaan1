<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_head', function () {
    $color = velocitytheme_option('primary_color', '#ffb600');

    echo '<style id="velocity-child-inline-styles">';
    echo ':root{--color-theme:' . esc_html($color) . ';--bs-primary:' . esc_html($color) . ';}';
    echo '.colortheme,.text-color-theme{color:' . esc_html($color) . ' !important;}';
    echo '.border-color-theme{--bs-border-color:' . esc_html($color) . ';}';
    echo '.bg-theme,.bg-colortheme{background-color:' . esc_html($color) . ' !important;}';
    echo '</style>';
});
