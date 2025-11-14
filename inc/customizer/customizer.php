<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_panel('panel_perusahaan1', [
        'priority' => 10,
        'title' => esc_html__('Velocity Perusahaan1', 'justg'),
        'description' => esc_html__('', 'justg'),
    ]);

    $wp_customize->add_section('velocity_kontak', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Kontak Header', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_address', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_address', [
        'label' => esc_html__('Address', 'justg'),
        'section' => 'velocity_kontak',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_phone', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_phone', [
        'label' => esc_html__('Phone', 'justg'),
        'section' => 'velocity_kontak',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_email', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_email', [
        'label' => esc_html__('Email', 'justg'),
        'section' => 'velocity_kontak',
        'type' => 'text',
    ]);

    $wp_customize->add_section('velocity_banner', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Banner', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_banner1', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'velocity_banner1', [
        'label' => esc_html__('Home Banner Atas', 'justg'),
        'section' => 'velocity_banner',
        'settings' => 'velocity_banner1',
    ]));
    $wp_customize->add_setting('velocity_title_banner1', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_title_banner1', [
        'label' => esc_html__('Judul Banner Atas', 'justg'),
        'section' => 'velocity_banner',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_subtitle_banner1', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_subtitle_banner1', [
        'label' => esc_html__('Subtitle Banner Atas', 'justg'),
        'section' => 'velocity_banner',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_banner2', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'velocity_banner2', [
        'label' => esc_html__('Home Banner Bawah', 'justg'),
        'section' => 'velocity_banner',
        'settings' => 'velocity_banner2',
    ]));
    $wp_customize->add_setting('velocity_page_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'velocity_page_image', [
        'label' => esc_html__('Page Header Image', 'justg'),
        'section' => 'velocity_banner',
        'settings' => 'velocity_page_image',
    ]));

    $wp_customize->add_section('velocity_layanan_section', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Layanan', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_layanan_repeat', [
        'default' => [],
        'sanitize_callback' => function ($json) {
            if (is_string($json)) {
                $arr = json_decode($json, true);
            } else {
                $arr = $json;
            }
            if (!is_array($arr)) {
                $arr = [];
            }
            $out = [];
            $limit = 3;
            foreach ($arr as $item) {
                if (count($out) >= $limit) {
                    break;
                }
                $out[] = [
                    'velocity_layanan_image' => isset($item['velocity_layanan_image']) ? esc_url_raw($item['velocity_layanan_image']) : '',
                    'velocity_layanan' => isset($item['velocity_layanan']) ? sanitize_text_field($item['velocity_layanan']) : '',
                    'velocity_icon' => isset($item['velocity_icon']) ? sanitize_text_field($item['velocity_icon']) : '',
                    'velocity_text' => isset($item['velocity_text']) ? wp_kses_post($item['velocity_text']) : '',
                    'velocity_link' => isset($item['velocity_link']) ? esc_url_raw($item['velocity_link']) : '',
                ];
            }
            return $out;
        },
    ]);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'velocity_layanan_repeat', [
        'label' => esc_html__('Layanan', 'justg'),
        'section' => 'velocity_layanan_section',
        'settings' => 'velocity_layanan_repeat',
        'type' => 'hidden',
    ]));

    $wp_customize->add_section('velocity_sambutan_section', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Sambutan', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_judul_sambutan', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_judul_sambutan', [
        'label' => esc_html__('Judul Sambutan', 'justg'),
        'section' => 'velocity_sambutan_section',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_sambutan', [
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('velocity_sambutan', [
        'label' => esc_html__('Isi Sambutan', 'justg'),
        'section' => 'velocity_sambutan_section',
        'type' => 'textarea',
    ]);
    $wp_customize->add_setting('velocity_link_sambutan', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('velocity_link_sambutan', [
        'label' => esc_html__('Link Sambutan', 'justg'),
        'section' => 'velocity_sambutan_section',
        'type' => 'text',
    ]);

    $wp_customize->add_section('velocity_gallery_section', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Gallery', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_judul_gallery', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_judul_gallery', [
        'label' => esc_html__('Judul Gallery', 'justg'),
        'section' => 'velocity_gallery_section',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_gallery_repeat', [
        'default' => [],
        'sanitize_callback' => function ($json) {
            if (is_string($json)) {
                $arr = json_decode($json, true);
            } else {
                $arr = $json;
            }
            if (!is_array($arr)) {
                $arr = [];
            }
            $out = [];
            $limit = 10;
            foreach ($arr as $item) {
                if (count($out) >= $limit) {
                    break;
                }
                $out[] = [
                    'velocity_gallery_image' => isset($item['velocity_gallery_image']) ? esc_url_raw($item['velocity_gallery_image']) : '',
                ];
            }
            return $out;
        },
    ]);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'velocity_gallery_repeat', [
        'label' => esc_html__('Gambar Gallery', 'justg'),
        'section' => 'velocity_gallery_section',
        'settings' => 'velocity_gallery_repeat',
        'type' => 'hidden',
    ]));

    $wp_customize->add_section('velocity_news_section', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Home News', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_judul_news', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_judul_news', [
        'label' => esc_html__('Judul', 'justg'),
        'section' => 'velocity_news_section',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_news', [
        'default' => '',
        'sanitize_callback' => 'absint',
    ]);
    $choices = function_exists('velocity_categories') ? velocity_categories() : ['' => 'Show All'];
    $wp_customize->add_control('velocity_news', [
        'label' => esc_html__('Pilih Kategori:', 'justg'),
        'section' => 'velocity_news_section',
        'type' => 'select',
        'choices' => $choices,
    ]);

    $wp_customize->add_section('velocity_logo_section', [
        'panel' => 'panel_perusahaan1',
        'title' => __('Velocity Home Logo', 'justg'),
        'priority' => 10,
    ]);
    $wp_customize->add_setting('velocity_judul_logo', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('velocity_judul_logo', [
        'label' => esc_html__('Judul Logo', 'justg'),
        'section' => 'velocity_logo_section',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('velocity_logo_repeat', [
        'default' => [],
        'sanitize_callback' => function ($json) {
            if (is_string($json)) {
                $arr = json_decode($json, true);
            } else {
                $arr = $json;
            }
            if (!is_array($arr)) {
                $arr = [];
            }
            $out = [];
            $limit = 10;
            foreach ($arr as $item) {
                if (count($out) >= $limit) {
                    break;
                }
                $out[] = [
                    'velocity_logo_image' => isset($item['velocity_logo_image']) ? esc_url_raw($item['velocity_logo_image']) : '',
                ];
            }
            return $out;
        },
    ]);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'velocity_logo_repeat', [
        'label' => esc_html__('Gambar Logo', 'justg'),
        'section' => 'velocity_logo_section',
        'settings' => 'velocity_logo_repeat',
        'type' => 'hidden',
    ]));
});

add_action('customize_controls_enqueue_scripts', function () {
    wp_enqueue_script('velocity-customizer-controls', get_stylesheet_directory_uri() . '/assets/customizer/customizer-controls.js', ['jquery', 'customize-controls'], null, true);
});