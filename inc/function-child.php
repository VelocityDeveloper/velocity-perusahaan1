<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function velocity_categories()
{
    $args = array(
        'orderby' => 'name',
        'hide_empty' => false,
    );
    $cats = array(
        '' => 'Show All'
    );
    $categories = get_categories($args);
    foreach ($categories as $category) {
        $cats[$category->term_id] = $category->name;
    }
    return $cats;
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{

    // Load justg_child_enqueue_parent_style after theme setup
    add_action('wp_enqueue_scripts', 'justg_child_enqueue_parent_style', 20);

    if (class_exists('Kirki')) :

        Kirki::add_panel('panel_velocity', [
            'priority'    => 10,
            'title'       => esc_html__('Velocity Theme', 'justg'),
            'description' => esc_html__('', 'justg'),
        ]);

        // section title_tagline
        Kirki::add_section('title_tagline', [
            'panel'    => 'panel_velocity',
            'title'    => __('Site Identity', 'justg'),
            'priority' => 10,
        ]);

        ///Section Color
        Kirki::add_section('section_colorvelocity', [
            'panel'    => 'panel_velocity',
            'title'    => __('Color & Background', 'justg'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'color',
            'settings'    => 'color_theme',
            'label'       => __('Theme Color', 'justg'),
            'description' => esc_html__('', 'justg'),
            'section'     => 'section_colorvelocity',
            'default'     => '#ffb600',
            'transport'   => 'auto',
            'output'      => [
                [
                    'element'   => ':root',
                    'property'  => '--color-theme',
                ],
                [
                    'element'   => ':root',
                    'property'  => '--bs-primary',
                ],
                [
                    'element'   => '.border-color-theme',
                    'property'  => '--bs-border-color',
                ],
                [
                    'element'   => '.bg-theme',
                    'property'  => 'background-color',
                    'suffix'    => ' !important',
                ],
            ],
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'background',
            'settings'    => 'background_themewebsite',
            'label'       => __('Website Background', 'justg'),
            'description' => esc_html__('', 'justg'),
            'section'     => 'section_colorvelocity',
            'default'     => [
                'background-color'      => 'rgba(255,255,255)',
                'background-image'      => '',
                'background-repeat'     => 'repeat',
                'background-position'   => 'center center',
                'background-size'       => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport'   => 'auto',
            'output'      => [
                [
                    'element'   => ':root[data-bs-theme=light] body',
                ],
                [
                    'element'   => 'body',
                ],
            ],
        ]);

        Kirki::add_panel('panel_perusahaan1', [
            'priority'    => 10,
            'title'       => esc_html__('Velocity Perusahaan1', 'justg'),
            'description' => esc_html__('', 'justg'),
        ]);

        // section velocity_kontak
        Kirki::add_section('velocity_kontak', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Kontak Header', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_address',
                'label'    => esc_html__('Address', 'justg'),
                'section'  => 'velocity_kontak',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_phone',
                'label'    => esc_html__('Phone', 'justg'),
                'section'  => 'velocity_kontak',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_email',
                'label'    => esc_html__('Email', 'justg'),
                'section'  => 'velocity_kontak',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );

        // section velocity_banner
        Kirki::add_section('velocity_banner', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Banner', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Image(
            [
                'settings'    => 'velocity_banner1',
                'label'       => esc_html__('Home Banner Atas', 'justg'),
                'description' => esc_html__('Ukuran 1366 x 590 pixel.', 'justg'),
                'section'     => 'velocity_banner',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_title_banner1',
                'label'    => esc_html__('Judul Banner Atas', 'justg'),
                'section'  => 'velocity_banner',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_subtitle_banner1',
                'label'    => esc_html__('Subtitle Banner Atas', 'justg'),
                'section'  => 'velocity_banner',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );

        new \Kirki\Field\Image(
            [
                'settings'    => 'velocity_banner2',
                'label'       => esc_html__('Home Banner Bawah', 'justg'),
                'description' => esc_html__('Ukuran 1366 x 500 pixel.', 'justg'),
                'section'     => 'velocity_banner',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'velocity_page_image',
                'label'       => esc_html__('Page Header Image', 'justg'),
                'description' => esc_html__('Ukuran 1366 x 250 pixel.', 'justg'),
                'section'     => 'velocity_banner',
                'default'     => '',
            ]
        );

        // section velocity_layanan_section
        Kirki::add_section('velocity_layanan_section', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Layanan', 'justg'),
            'priority' => 10,
        ]);

        // Layanan Repeater
        new \Kirki\Field\Repeater(
            [
                'settings' => 'velocity_layanan_repeat',
                'label'    => esc_html__('Layanan', 'justg'),
                'section'  => 'velocity_layanan_section',
                'priority' => 10,
                'choices' => [
                    'limit' => 3
                ],
                'row_label'    => [
                    'type'  => 'field',
                    'value' => esc_html__('Layanan', 'justg'),
                    // 'field' => 'link_text',
                ],
                'button_label' => esc_html__('"Add Layanan" ', 'justg'),
                'fields'   => [
                    'velocity_layanan_image'   => [
                        'type'        => 'image',
                        'label'       => esc_html__('Gambar', 'justg'),
                        'description' => esc_html__('Ukuran 410 x 270 pixel.', 'justg'),
                        'default'     => '',
                    ],
                    'velocity_layanan'   => [
                        'type'        => 'text',
                        'label'    => esc_html__('Judul Layanan', 'justg'),
                        'description' => esc_html__('', 'justg'),
                        'default'  => esc_html__('', 'justg'),
                    ],
                    'velocity_icon'   => [
                        'type'        => 'text',
                        'label'    => esc_html__('Icon Layanan(Font Awesome v5)', 'justg'),
                        'description' => esc_html__('Isi nama iconnya saja, list icon: https://fontawesome.com/v5/search?o=r&m=free', 'justg'),
                        'default'  => esc_html__('', 'justg'),
                    ],
                    'velocity_text'   => [
                        'type'        => 'textarea',
                        'label'    => esc_html__('Deskripsi Layanan', 'justg'),
                        'description' => esc_html__('', 'justg'),
                        'default'  => esc_html__('', 'justg'),
                    ],
                    'velocity_link'   => [
                        'type'        => 'text',
                        'label'    => esc_html__('Link Layanan', 'justg'),
                        'description' => esc_html__('', 'justg'),
                        'default'  => esc_html__('', 'justg'),
                    ],
                ],
            ]
        );

        // section velocity_sambutan_section
        Kirki::add_section('velocity_sambutan_section', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Sambutan', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_judul_sambutan',
                'label'    => esc_html__('Judul Sambutan', 'justg'),
                'section'  => 'velocity_sambutan_section',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Editor(
            [
                'settings'    => 'velocity_sambutan',
                'label'       => esc_html__('Isi Sambutan', 'justg'),
                'section'     => 'velocity_sambutan_section',
                'default'     => esc_html__('', 'justg'),
            ]
        );
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_link_sambutan',
                'label'    => esc_html__('Link Sambutan', 'justg'),
                'section'  => 'velocity_sambutan_section',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );

        // section velocity_gallery_section
        Kirki::add_section('velocity_gallery_section', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Gallery', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_judul_gallery',
                'label'    => esc_html__('Judul Gallery', 'justg'),
                'section'  => 'velocity_gallery_section',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Repeater(
            [
                'settings' => 'velocity_gallery_repeat',
                'label'    => esc_html__('Gambar Gallery', 'justg'),
                'section'  => 'velocity_gallery_section',
                'priority' => 10,
                'choices' => [
                    'limit' => 10
                ],
                'row_label'    => [
                    'type'  => 'field',
                    'value' => esc_html__('Gambar', 'justg'),
                    // 'field' => 'link_text',
                ],
                'button_label' => esc_html__('"Add Gambar" ', 'justg'),
                'fields'   => [
                    'velocity_gallery_image'   => [
                        'type'        => 'image',
                        'label'       => esc_html__('Gambar', 'justg'),
                        'description' => esc_html__('Ukuran 400 x 300 pixel.', 'justg'),
                        'default'     => '',
                    ],
                ],
            ]
        );

        // section velocity_news_section
        Kirki::add_section('velocity_news_section', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Home News', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_judul_news',
                'label'    => esc_html__('Judul', 'justg'),
                'section'  => 'velocity_news_section',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Select(
            [
                'settings'    => 'velocity_news',
                'label'       => esc_html__('Pilih Kategori:', 'justg'),
                'section'     => 'velocity_news_section',
                'default'     => '',
                'placeholder' => esc_html__('Pilih Kategori', 'justg'),
                'choices'   => velocity_categories(),
            ]
        );

        // section velocity_logo_section
        Kirki::add_section('velocity_logo_section', [
            'panel'    => 'panel_perusahaan1',
            'title'    => __('Velocity Home Logo', 'justg'),
            'priority' => 10,
        ]);
        new \Kirki\Field\Text(
            [
                'settings' => 'velocity_judul_logo',
                'label'    => esc_html__('Judul Logo', 'justg'),
                'section'  => 'velocity_logo_section',
                'default'  => esc_html__('', 'justg'),
                'priority' => 10,
            ]
        );
        new \Kirki\Field\Repeater(
            [
                'settings' => 'velocity_logo_repeat',
                'label'    => esc_html__('Gambar Logo', 'justg'),
                'section'  => 'velocity_logo_section',
                'priority' => 10,
                'choices' => [
                    'limit' => 10
                ],
                'row_label'    => [
                    'type'  => 'field',
                    'value' => esc_html__('Logo', 'justg'),
                    // 'field' => 'link_text',
                ],
                'button_label' => esc_html__('"Add Logo" ', 'justg'),
                'fields'   => [
                    'velocity_logo_image'   => [
                        'type'        => 'image',
                        'label'       => esc_html__('Logo', 'justg'),
                        'description' => esc_html__('', 'justg'),
                        'default'     => '',
                    ],
                ],
            ]
        );

        // remove panel in customizer 
        Kirki::remove_panel('global_panel');
        Kirki::remove_panel('panel_header');
        Kirki::remove_panel('panel_footer');
        Kirki::remove_panel('panel_antispam');
    // Kirki::remove_control('custom_logo');

    endif;

    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('widgets-block-editor');
}

if (!function_exists('justg_header_open')) {
    function justg_header_open()
    {
        echo '<header id="wrapper-header">';
        echo '<div id="wrapper-navbar" class="wrapper-fluid wrapper-navbar position-relative" itemscope itemtype="http://schema.org/WebSite">';
    }
}
if (!function_exists('justg_header_close')) {
    function justg_header_close()
    {
        echo '</div>';
        echo '</header>';
    }
}


///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}

add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
    do_action('justg_the_footer_content');
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

// excerpt more
add_filter('excerpt_more', 'velocity_custom_excerpt_more');
if (!function_exists('velocity_custom_excerpt_more')) {
    function velocity_custom_excerpt_more($more)
    {
        return '...';
    }
}

// excerpt length
add_filter('excerpt_length', 'velocity_excerpt_length');
function velocity_excerpt_length($length)
{
    return 20;
}

function velocity_title()
{
    if (is_single() || is_page()) {
        return the_title('<h1 class="velocity-postheader velocity-judul text-white">', '</h1>');
    } elseif (is_archive()) {
        return the_archive_title('<h1 class="velocity-postheader velocity-judul text-white">', '</h1>');
        return category_description();
    } elseif (is_tag()) {
        return '<h1 class="velocity-postheader velocity-judul text-white">' . single_tag_title('', false) . '</h1>';
    } elseif (is_day()) {
        return '<h1 class="velocity-postheader velocity-judul text-white">' . sprintf(__('Daily Archives: <span>%s</span>', THEME_NS), get_the_date()) . '</h1>';
    } elseif (is_month()) {
        return '<h1 class="velocity-postheader velocity-judul text-white">' . sprintf(__('Monthly Archives: <span>%s</span>', THEME_NS), get_the_date('F Y')) . '</h1>';
    } elseif (is_year()) {
        return '<h1 class="velocity-postheader velocity-judul text-white">' . sprintf(__('Yearly Archives: <span>%s</span>', THEME_NS), get_the_date('Y')) . '</h1>';
    } elseif (is_tax()) {
        $object = get_queried_object();
        return '<h1 class="velocity-postheader velocity-judul text-white">' . $object->name . '</h1>';
    } elseif (is_post_type_archive()) {
        $object = get_queried_object();
        return '<h1 class="velocity-postheader velocity-judul text-white">' . $object->label . '</h1>';
    } elseif (is_author()) {
        //the_post();
        return '<h1 class="velocity-postheader velocity-judul text-white">' . get_the_author() . '</h1>';
        //rewind_posts();
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
        return '<h1 class="velocity-postheader velocity-judul text-white">Blog Archives</h1>';
    } elseif (is_search()) {
        return '<h1 class="velocity-postheader velocity-judul text-white">Search Results for: "' . get_search_query() . '"</h1>';
    }
}
