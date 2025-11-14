<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

require_once get_stylesheet_directory() . '/inc/customizer/customizer.php';
require_once get_stylesheet_directory() . '/inc/customizer/output-styles.php';

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
