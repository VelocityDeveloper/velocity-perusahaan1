<?php

/**
 * Single post partial template
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$categories_list = get_the_category_list(', ');
$tags_list       = get_the_tag_list('', ', ');
?>

<article <?php post_class('block-primary'); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header">
        <div class="entry-meta mb-2">
            <?php echo do_shortcode('[date-post]'); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <hr />

    <?php
    if (has_post_thumbnail()) {
        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'w-100'));
        echo get_the_post_thumbnail_caption() ? '<div class="fst-italic mb-1"><small>' . get_the_post_thumbnail_caption() . '</small></div>' : '';
    }
    ?>

    <div class="entry-content">

        <?php the_content(); ?>

        <?php
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                'after'  => '</div>',
            )
        );
        ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer single-post-footer">
        <?php if ($categories_list || $tags_list) : ?>
            <div class="single-post-meta mb-2">
                <?php if ($categories_list) : ?>
                    <span class="me-3">Posted in <?php echo wp_kses_post($categories_list); ?></span>
                <?php endif; ?>
                <?php if ($tags_list) : ?>
                    <span class="single-post-meta-row">Tagged <?php echo wp_kses_post($tags_list); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->