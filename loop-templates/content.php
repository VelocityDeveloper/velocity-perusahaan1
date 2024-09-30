<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$hari    = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
$bulan     = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

<article <?php post_class('mb-5'); ?> id="post-<?php the_ID(); ?>">

    <?php if (has_post_thumbnail()) { ?>
        <div class="ratio" style="--bs-aspect-ratio: 60%;">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'w-100 mb-3')); ?>
            </a>
        </div>
    <?php } ?>

    <header class="entry-header">
        <?php if ('post' == get_post_type()) : ?>
            <div class="entry-meta colortheme pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                </svg>
                <?php echo $hari[date("w")] . ", " . date("j") . " " . $bulan[date("n")] . " " . date("Y"); ?>
            </div>
        <?php endif; ?>
        <h3 class="py-3 fs-4 m-0">
            <a class="text-dark" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h3>
    </header>



    <div class="entry-content">
        <?php $content = get_the_content();
        $trimmed_content = wp_trim_words($content, 30);
        echo $trimmed_content; ?>
    </div>

    <div class="pt-3">
        <a class="colortheme" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">READ MORE</a>
    </div>

</article>