<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('velocitychild_get_bootstrap_icon_svg')) {
    /**
     * Render a small set of inline Bootstrap-style SVG icons.
     *
     * @param string $icon  Icon slug.
     * @param string $class Optional CSS classes.
     * @return string
     */
    function velocitychild_get_bootstrap_icon_svg($icon, $class = '')
    {
        $icons = array(
            'house-fill' => '<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 2 8h1v6.5a.5.5 0 0 0 .5.5H6V10.5A1.5 1.5 0 0 1 7.5 9h1A1.5 1.5 0 0 1 10 10.5V15h2.5a.5.5 0 0 0 .5-.5V8h1a.5.5 0 0 0 .354-.854z"/><path d="M13 2.5v2.793l-1-1V2.5a.5.5 0 0 1 .5-.5h.5a.5.5 0 0 1 .5.5"/>',
            'telephone-fill' => '<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z"/>',
            'envelope-fill' => '<path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414z"/><path d="M0 4.697v7.104l5.803-3.558z"/><path d="M6.761 8.83 0 12.97V13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-.03L9.239 8.83l-1.239.76z"/><path d="M16 11.801V4.697l-5.803 3.546z"/>',
            'calendar' => '<path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/> <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/> <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z"/>',
        );

        if (!isset($icons[$icon])) {
            return '';
        }

        $classes = trim('bi bi-' . sanitize_html_class($icon) . ' ' . $class);

        return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($classes) . '" viewBox="0 0 16 16" aria-hidden="true">' . $icons[$icon] . '</svg>';
    }
}

if (!function_exists('velocitychild_get_layanan_icon_html')) {
    /**
     * Render layanan icon markup using Bootstrap Icons font classes.
     *
     * @param string $icon Icon slug.
     * @return string
     */
    function velocitychild_get_layanan_icon_html($icon)
    {
        $icon = sanitize_html_class(str_replace('_', '-', (string) $icon));
        if ($icon === '') {
            $icon = 'briefcase-fill';
        }

        return '<i class="bi bi-' . esc_attr($icon) . '" aria-hidden="true"></i>';
    }
}
