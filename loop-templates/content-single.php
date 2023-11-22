<?php

/**
 * Single post partial template
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
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

    <footer class="entry-footer">

        <?php justg_entry_footer(); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->