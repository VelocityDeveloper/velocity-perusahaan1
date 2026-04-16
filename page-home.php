<?php

/**
 * Template Name: Home Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package justg
 */

get_header();
$container         = velocitytheme_option('justg_container_type', 'container');
if (velocitytheme_option('velocity_banner1')) { ?>
    <div class="position-relative overflow-hidden">
        <div class="overelay position-absolute start-0 top-00 h-100 w-100" style="background-color: rgba(0,0,0,0.4);"></div>
        <img class="w-100" src="<?php echo esc_url(velocitytheme_option('velocity_banner1')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <div class="d-flex align-items-start position-absolute top-30 start-10 w-100 h-100">
            <div class="col-12 lh-sm">
                <div class="velocity-banner-title fw-bold h1 text-white text-uppercase"><?php echo esc_html(velocitytheme_option('velocity_title_banner1')); ?></div>
                <div class="velocity-banner-subtitle mt-1 h5 text-white"><?php echo esc_html(velocitytheme_option('velocity_subtitle_banner1')); ?></div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="wrapper mt-3 mt-md-0" id="page-wrapper">
    <div class="<?php echo esc_attr($container); ?>" id="content">
        <!-- Layanan section -->
        <div class="row text-center mb-5 frame-layanan mx-0 px-0">
            <?php $layanans = velocitytheme_option('velocity_layanan_repeat');
            if (!is_array($layanans)) {
                $layanans = array();
            }
            foreach ($layanans as $layanan) : ?>
                <div class="col-sm-4 p-0 mx-auto">
                    <div class="card-layanan position-relative text-center">
                        <div class="img-layanan ratio" style="--bs-aspect-ratio: 67%;">
                            <img src="<?php echo esc_url($layanan['velocity_layanan_image']); ?>" alt="<?php echo esc_attr($layanan['velocity_layanan']); ?>" />
                        </div>

                        <div class="icon-layanan">
                            <?php echo velocitychild_get_layanan_icon_html(isset($layanan['velocity_icon']) ? $layanan['velocity_icon'] : 'briefcase-fill'); ?>
                        </div>

                        <div class="p-3">
                            <h5 class="title-layanan">
                                <strong class="text-dark"><?php echo esc_html($layanan['velocity_layanan']); ?></strong>
                            </h5>
                            <div class="separator-layanan bg-colortheme"></div>
                            <div class="text-layanan">
                                <?php echo wp_kses_post($layanan['velocity_text']); ?>
                            </div>
                        </div>
                        <a class="link-layanan" href="<?php echo esc_url($layanan['velocity_link']); ?>" aria-label="<?php echo esc_attr($layanan['velocity_layanan']); ?>"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sambutan section -->
        <div class="my-5 text-center">
            <?php if (!empty(velocitytheme_option('velocity_judul_sambutan'))) { ?>
                <div class="text-center mt-5 mb-3">
                    <h2 class="text-dark text-uppercase"><?php echo esc_html(velocitytheme_option('velocity_judul_sambutan')); ?></h2>
                    <div class="separator-hitam my-1"></div>
                </div>
            <?php } ?>
            <?php echo wp_kses_post(velocitytheme_option('velocity_sambutan')); ?>
            <div class="mt-3"><a class="d-inline-block py-2 px-4 text-white bg-theme" href="<?php echo esc_url(velocitytheme_option('velocity_link_sambutan')); ?>">READ MORE</a></div>
        </div>
    </div><!-- #content -->

    <!-- Gallery home -->
    <div class="d-inline-block bg-dark py-5 my-5 text-center w-100">
        <?php if (!empty(velocitytheme_option('velocity_judul_gallery'))) { ?>
            <div class="container mb-4">
                <h1 class="text-start text-white text-uppercase"><?php echo esc_html(velocitytheme_option('velocity_judul_gallery')); ?></h1>
            </div>
        <?php }
        $galleries = velocitytheme_option('velocity_gallery_repeat');
        if (!is_array($galleries)) {
            $galleries = array();
        }
        if (!empty($galleries)) { ?>
            <div class="home-gallery pb-4">
                <?php foreach ($galleries as $gallery) {
                    if (!empty($gallery)) {
                        $url = $gallery['velocity_gallery_image'];
                        echo '<div class="p-2 ratio ratio-4x3"><img class="w-100 h-100 object-fit-cover" src="' . esc_url($url) . '" alt="' . esc_attr(velocitytheme_option('velocity_judul_gallery')) . '" /></div>';
                    }
                } ?>
            </div>
        <?php } ?>
    </div>

    <!-- Artikel section -->
    <?php $args = array(
        'posts_per_page' => 3,
        'showposts' => 3,
        'post_type' => 'post',
        'cat' => velocitytheme_option('velocity_news'),
    );
    $wp_query = new WP_Query($args);
    if ($wp_query->have_posts()) : ?>
        <div class="container">
            <?php if (!empty(velocitytheme_option('velocity_judul_news'))) { ?>
                <div class="text-center">
                    <h2 class="text-dark text-uppercase title-news"><?php echo esc_html(velocitytheme_option('velocity_judul_news')); ?></h2>
                    <div class="separator-hitam my-1"></div>
                </div>
            <?php } ?>
            <div class="text-start row mb-5">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                    $content = get_the_content();
                    $trimmed_content = wp_trim_words($content, 15);
                    ?>
                    <div class="col-sm-4">
                        <div class="card w-100 text-start rounded-0 border-0 bg-transparent">
                            <?php
                            echo velocitychild_get_post_thumbnail_html(
                                get_the_ID(),
                                array(
                                    'ratio_style' => '--bs-aspect-ratio: 70%;',
                                    'wrapper_class' => 'image-news',
                                    'img_class' => 'card-img-top rounded-0 w-100 h-100 object-fit-cover',
                                )
                            );
                            ?>
                            <div class="py-3">
                                <h4 class="card-title mb-3" style="line-height: 1.4;"><a class="text-dark" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                <div class="separator-hitam"></div>
                                <p class="card-text text-secondary"><?php echo $trimmed_content; ?></p>
                                <div class="mt-3 h-5"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">READ MORE</a></div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div><!-- #content -->

<!-- Klien section -->
<?php if (velocitytheme_option('velocity_banner2')) { ?>
    <div class="text-center my-5"><img class="w-100" src="<?php echo esc_url(velocitytheme_option('velocity_banner2')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></div>
<?php } ?>

<!-- Gallery home -->
<div class="d-inline-block text-center w-100">

    <div class="container mb-4 text-center">
        <?php if (!empty(velocitytheme_option('velocity_judul_logo'))) { ?>
            <h1 class="text-uppercase"><?php echo esc_html(velocitytheme_option('velocity_judul_logo')); ?></h1>
            <div class="separator-hitam my-1"></div>
        <?php }
        $logos = velocitytheme_option('velocity_logo_repeat');
        if (!is_array($logos)) {
            $logos = array();
        }
        if (!empty($logos)) { ?>
            <div class="home-gallery pb-4">
                <?php foreach ($logos as $logo) {
                    if (!empty($logo)) {
                        echo '<div class="p-2"><img class="w-100" src="' . esc_url($logo['velocity_logo_image']) . '" alt="' . esc_attr(velocitytheme_option('velocity_judul_logo')) . '" /></div>';
                    }
                } ?>
            </div>
        <?php } ?>
    </div>
</div>

</div><!-- #page-wrapper -->

<?php
get_footer();
