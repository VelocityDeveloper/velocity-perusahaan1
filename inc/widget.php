<?php
//register widget
add_action('widgets_init', 'justg_widgets_init', 20);
if (!function_exists('justg_widgets_init')) {
    function justg_widgets_init()
    {
        register_sidebar(
            array(
                'name'          => __('Main Sidebar', 'justg'),
                'id'            => 'main-sidebar',
                'description'   => __('Main sidebar widget area', 'justg'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div></aside>',
                'before_title'  => '<h3 class="widget-title fw-bold"><span>',
                'after_title'   => '</span></h3><div class="mt-4 mb-2">',
                'show_in_rest'   => false,
            )
        );

        // Register footer widget area
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 1', 'justg'),
                'id'            => 'footer-widget-1',
                'description'   => __('', 'justg'),
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 2', 'justg'),
                'id'            => 'footer-widget-2',
                'description'   => __('', 'justg'),
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 3', 'justg'),
                'id'            => 'footer-widget-3',
                'description'   => __('', 'justg'),
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
    }
}

if (!function_exists('justg_right_sidebar_check')) {
    function justg_right_sidebar_check()
    {
        if (is_singular('fl-builder-template')) {
            return;
        }
        if (!is_active_sidebar('main-sidebar')) {
            return;
        }
        echo '<div class="widget-area right-sidebar pt-3 pt-md-0 ps-md-3 col-md-4 order-3" id="right-sidebar" role="complementary">';
        do_action('justg_before_main_sidebar');
        dynamic_sidebar('main-sidebar');
        do_action('justg_after_main_sidebar');
        echo '</div>';
    }
}

function velocity_allpage()
{
    if (is_singular('post') && !current_user_can('administrator')) {
        global $post;
        $postID         = $post->ID;
        $count_key      = 'hit';
        $count          = get_post_meta($postID, $count_key, true);


        if ($count == '') {
            $count      = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
add_action('wp', 'velocity_allpage');

/*******  Widget Velocity Recent Posts  *******/

add_action('init', 'velocity_recent_post_register');
function velocity_recent_post_register()
{
    $prefix = 'vrp-widget'; // $id prefix
    $name = __('Velocity Recent Posts', 'velocity-theme');
    $widget_ops = array('classname' => 'vrp-widget', 'description' => __('Latest Post by Velocity Developer', 'velocity-theme'));
    $control_ops = array('width' => 200, 'height' => 200, 'id_base' => $prefix);

    $options = get_option('velocity_recent_post_widget');
    if (isset($options[0])) unset($options[0]);

    if (!empty($options)) {
        foreach (array_keys($options) as $widget_number) {
            wp_register_sidebar_widget($prefix . '-' . $widget_number, $name, 'velocity_recent_post_widget', $widget_ops, array('number' => $widget_number));
            wp_register_widget_control($prefix . '-' . $widget_number, $name, 'velocity_recent_post_widget_control', $control_ops, array('number' => $widget_number));
        }
    } else {
        $options = array();
        $widget_number = 1;
        wp_register_sidebar_widget($prefix . '-' . $widget_number, $name, 'velocity_recent_post_widget', $widget_ops, array('number' => $widget_number));
        wp_register_widget_control($prefix . '-' . $widget_number, $name, 'velocity_recent_post_widget_control', $control_ops, array('number' => $widget_number));
    }
}


function velocity_recent_post_widget($args, $vars = array())
{
    extract($args);
    // get widget saved options
    $widget_number = (int)str_replace('vrp-widget-', '', @$widget_id);
    $options = get_option('velocity_recent_post_widget');
    if (!empty($options[$widget_number])) {
        $vars = $options[$widget_number];
    }
    // widget open tags
    echo $before_widget;

    // print title from admin 
    if (!empty($vars['title'])) {
        echo $before_title . $vars['title'] . $after_title;
    }

    // print content and widget end tags
    global $post;
    $jumlah_post = $vars['jumlah_post'];
    $kategori_post = $vars['kategori'];
    $all_cat = $kategori_post == "semua";
    $tampil_thumbnail = $vars['tampil_thumbnail'];
    $urut_berdasarkan = $vars['urut_berdasarkan'];
    $urutkan = $vars['urutkan'];
    $lebar_thumb = $vars['lebar_thumb'];
    $tinggi_thumb = $vars['tinggi_thumb'];
    $tampil_waktu = $vars['tampil_waktu'];
    $tampil_excerpt = $vars['tampil_excerpt'];
    $jumlah_excerpt = $vars['jumlah_excerpt'];
    if ($urut_berdasarkan == "view") {
        $vtr_query = new WP_Query(
            array(
                'post_type' => array('post'),
                'post_status' => array('publish'),
                'showposts' => $jumlah_post,
                'orderby' => 'meta_value',
                'meta_key' => 'hit',
                'order' => $urutkan,
                'cat' => $kategori_post,
            )
        );
    } else {
        $vtr_query = new WP_Query(
            array(
                'post_type' => array('post'),
                'showposts' => $jumlah_post,
                'order' => $urutkan,
                'cat' => $kategori_post,
            )
        );
    }
    echo "<div class='vrp-content'>";
    if ($vtr_query->have_posts()) :  while ($vtr_query->have_posts()) : $vtr_query->the_post();
            $post_id = get_the_ID();
            $comments_count = wp_count_comments($post_id); ?>
            <div class="row m-0 vrp-post-list border-bottom py-2">
                <div class="col-4 p-1">
                    <?php if ($tampil_thumbnail == "ya") {
                        echo do_shortcode('[resize-thumbnail width="200" height="200" linked="true" class="w-100"]');
                    } ?>
                </div>

                <div class="col-8 p-1">
                    <div class="vrp-title"><a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                    <?php if ($tampil_waktu == "ya") { ?>
                        <small class="text-muted"><i class="far fa-clock"></i> <?php echo get_the_date('j F Y', $post_id); ?></small>
                    <?php } ?>

                    <?php
                    if ($tampil_excerpt == "ya") {
                        $content = get_the_content();
                        $trimmed_content = wp_trim_words($content, $jumlah_excerpt);
                        echo '<div class="vrp-excerpt">' . $trimmed_content . '</div>';
                    } ?>
                </div>
            </div>
    <?php endwhile;
    endif;
    echo "</div>";
    if (!$all_cat) {
        echo '<div class="vrp-more"><a href="' . get_category_link($kategori_post) . '">View All</a></div>';
    }
    wp_reset_query();
    echo $after_widget;
}


function velocity_recent_post_widget_control($args)
{

    $prefix = 'vrp-widget'; // $id prefix

    $options = get_option('velocity_recent_post_widget');
    if (empty($options)) $options = array();
    if (isset($options[0])) unset($options[0]);

    // update options array
    if (!empty($_POST[$prefix]) && is_array($_POST)) {
        foreach ($_POST[$prefix] as $widget_number => $values) {
            if (empty($values) && isset($options[$widget_number])) // user clicked cancel
                continue;

            if (!isset($options[$widget_number]) && $args['number'] == -1) {
                $args['number'] = $widget_number;
                $options['last_number'] = $widget_number;
            }
            $options[$widget_number] = $values;
        }

        // update number
        if ($args['number'] == -1 && !empty($options['last_number'])) {
            $args['number'] = $options['last_number'];
        }

        // clear unused options and update options in DB. return actual options array
        $options = bf_smart_multiwidget_update($prefix, $options, $_POST[$prefix], $_POST['sidebar'], 'velocity_recent_post_widget');
    }

    // $number - is dynamic number for multi widget, gived by WP
    // by default $number = -1 (if no widgets activated). In this case we should use %i% for inputs
    //   to allow WP generate number automatically
    $number = ($args['number'] == -1) ? '%i%' : $args['number'];

    // now we can output control
    $opts = @$options[$number];

    $title = @$opts['title'];
    $kategori = @$opts['kategori'];
    $jumlah_post = @$opts['jumlah_post'];
    $tampil_thumbnail = @$opts['tampil_thumbnail'];
    $urut_berdasarkan = @$opts['urut_berdasarkan'];
    $urutkan = @$opts['urutkan'];
    $lebar_thumb = @$opts['lebar_thumb'];
    $tinggi_thumb = @$opts['tinggi_thumb'];
    $tampil_waktu = @$opts['tampil_waktu'];
    $tampil_excerpt = @$opts['tampil_excerpt'];
    $jumlah_excerpt = @$opts['jumlah_excerpt'];
    ?><br />
    Judul
    <input type="text" name="<?php echo $prefix; ?>[<?php echo $number; ?>][title]" value="<?php if ($title) {
                                                                                                echo $title;
                                                                                            } else {
                                                                                                echo "Recent Posts";
                                                                                            } ?>" /><br /><br />

    Kategori
    <select name="<?php echo $prefix; ?>[<?php echo $number; ?>][kategori]">
        <option value="semua" <?php selected($kategori, ""); ?>>Semua Kategori</option>
        <?php $post_categories = get_categories(array(
            'orderby' => 'name',
        ));
        foreach ($post_categories as $post_cat) {
            $category_id = $post_cat->term_id; ?>
            <option value="<?php echo $category_id; ?>" <?php selected($kategori, $category_id); ?>><?php echo $post_cat->name; ?></option>
        <?php } ?>
    </select>
    <br /><br />

    Jumlah Pos
    <input type="number" name="<?php echo $prefix; ?>[<?php echo $number; ?>][jumlah_post]" value="<?php if ($jumlah_post) {
                                                                                                        echo $jumlah_post;
                                                                                                    } else {
                                                                                                        echo "3";
                                                                                                    } ?>" /><br /><br />

    Tampilkan Thumbnail
    <select name="<?php echo $prefix; ?>[<?php echo $number; ?>][tampil_thumbnail]">
        <option value="ya" <?php selected($tampil_thumbnail, "ya"); ?>>Ya</option>
        <option value="tidak" <?php selected($tampil_thumbnail, "tidak"); ?>>Tidak</option>
    </select>
    <br /><br />

    Lebar Thumbnail
    <input type="number" name="<?php echo $prefix; ?>[<?php echo $number; ?>][lebar_thumb]" value="<?php if ($lebar_thumb) {
                                                                                                        echo $lebar_thumb;
                                                                                                    } else {
                                                                                                        echo "100";
                                                                                                    } ?>" /><br /><br />

    Tinggi Thumbnail
    <input type="number" name="<?php echo $prefix; ?>[<?php echo $number; ?>][tinggi_thumb]" value="<?php if ($tinggi_thumb) {
                                                                                                        echo $tinggi_thumb;
                                                                                                    } else {
                                                                                                        echo "100";
                                                                                                    } ?>" /><br /><br />

    Tampilkan Waktu
    <select name="<?php echo $prefix; ?>[<?php echo $number; ?>][tampil_waktu]">
        <option value="ya" <?php selected($tampil_waktu, "ya"); ?>>Ya</option>
        <option value="tidak" <?php selected($tampil_waktu, "tidak"); ?>>Tidak</option>
    </select>
    <br /><br />

    Tampilkan Excerpt
    <select name="<?php echo $prefix; ?>[<?php echo $number; ?>][tampil_excerpt]">
        <option value="ya" <?php selected($tampil_excerpt, "ya"); ?>>Ya</option>
        <option value="tidak" <?php selected($tampil_excerpt, "tidak"); ?>>Tidak</option>
    </select>
    <br /><br />

    Jumlah Kata Excerpt
    <input type="number" name="<?php echo $prefix; ?>[<?php echo $number; ?>][jumlah_excerpt]" value="<?php if ($jumlah_excerpt) {
                                                                                                            echo $jumlah_excerpt;
                                                                                                        } else {
                                                                                                            echo "10";
                                                                                                        } ?>" /><br /><br />

    Urutkan Berdasarkan
    <select name="<?php echo $prefix; ?>[<?php echo $number; ?>][urut_berdasarkan]">
        <option value="date" <?php selected($urut_berdasarkan, "date"); ?>>Tanggal</option>
        <option value="view" <?php selected($urut_berdasarkan, "view"); ?>>Populer</option>
    </select>
    <br /><br />

    Urutkan
    <select name="<?php echo $prefix; ?>[<?php echo $number; ?>][urutkan]">
        <option value="DESC" <?php selected($urutkan, "DESC"); ?>>DESC</option>
        <option value="ASC" <?php selected($urutkan, "ASC"); ?>>ASC</option>
    </select>
    <br /><br />
<?php }




// helper function can be defined in another plugin
if (!function_exists('bf_smart_multiwidget_update')) {
    function bf_smart_multiwidget_update($id_prefix, $options, $post, $sidebar, $option_name = '')
    {
        global $wp_registered_widgets;
        static $updated = false;

        // get active sidebar
        $sidebars_widgets = wp_get_sidebars_widgets();
        if (isset($sidebars_widgets[$sidebar]))
            $this_sidebar = &$sidebars_widgets[$sidebar];
        else
            $this_sidebar = array();

        // search unused options
        foreach ($this_sidebar as $_widget_id) {
            if (preg_match('/' . $id_prefix . '-([0-9]+)/i', $_widget_id, $match)) {
                $widget_number = $match[1];

                // $_POST['widget-id'] contain current widgets set for current sidebar
                // $this_sidebar is not updated yet, so we can determine which was deleted
                if (!in_array($match[0], $_POST['widget-id'])) {
                    unset($options[$widget_number]);
                }
            }
        }

        // update database
        if (!empty($option_name)) {
            update_option($option_name, $options);
            $updated = true;
        }

        // return updated array
        return $options;
    }
}

/******* Akhir Widget Velocity Recent Posts  *******/
