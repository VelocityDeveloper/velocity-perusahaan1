<?php

/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// [vd-breadcrumbs]
add_shortcode('vd-breadcrumbs', 'vd_breadcrumbs');
function vd_breadcrumbs()
{
    ob_start();
    echo justg_breadcrumb();
    return ob_get_clean();
}

//[excerpt count="150"]
add_shortcode('excerpt', 'vd_getexcerpt');
function vd_getexcerpt($atts)
{
    ob_start();
    global $post;
    $atribut = shortcode_atts(array(
        'count'    => '150', /// count character
    ), $atts);

    $count        = $atribut['count'];
    $excerpt    = get_the_content();
    $excerpt     = strip_tags($excerpt);
    $excerpt     = substr($excerpt, 0, $count);
    $excerpt     = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt     = '' . $excerpt . '...';

    echo $excerpt;

    return ob_get_clean();
}

// [vd-search]
add_shortcode('vd-search', 'vd_search');
function vd_search()
{
    ob_start(); ?>
    <div class="vsearch float-end">
        <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" style="max-width: 300px;">
            <label class="visually-hidden" for="s"><?php esc_html_e('Search', 'justg'); ?></label>
            <div class="input-group">
                <input class="field form-control rounded-0" id="s" name="s" type="text" placeholder="" value="<?php echo esc_attr(get_search_query()); ?>" required>
                <button type="submit" class="submit btn h-100 p-1 btn-sm rounded-0" aria-label="<?php esc_attr_e('Search', 'justg'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
<?php
    return ob_get_clean();
}

// [date-post]
add_shortcode('date-post', 'vd_datepost');
function vd_datepost()
{
    ob_start();
    global $post;
    $postID = $post->ID;
    $haripost = get_the_date('N', $postID);
    $tglpost = get_the_date('j', $postID);
    $blnpost = get_the_date('n', $postID);
    $tahunpost = get_the_date('Y', $postID);

    $hari = [0 => 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    echo '<div class="text-secondary">Diterbitkan ' . $hari[$haripost] . ',' . $tglpost . ' ' . $bulan[$blnpost] . ' ' . $tahunpost . '</div>';
    return ob_get_clean();
}
