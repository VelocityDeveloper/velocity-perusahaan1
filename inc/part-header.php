<div class="container pt-0 py-md-4 px-0 px-md-2 header-container z-1">
    <div class="row text-center align-items-center py-0 m-0">
        <div class="col-md-4 text-md-start bg-sm-theme p-2 z-1">
            <?php $sitelogo = velocitytheme_option('custom_logo'); ?>
            <div class="position-relative">
                <?php if ($sitelogo) : ?>
                    <a href="<?php echo esc_url(get_home_url()); ?>">
                        <img src="<?php echo esc_url(wp_get_attachment_image_url($sitelogo, 'full')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" loading="lazy">
                    </a>
                <?php endif;  ?>
            </div>
        </div>
        <div class="col-md-8 text-md-end">
            <div class="row my-3 mb-md-0 mx-sm-0 mx-2">
                <?php if (velocitytheme_option('velocity_address')) : ?>
                    <div class="col-md">
                        <div class="h-contact"><?php echo velocitychild_get_bootstrap_icon_svg('house-fill', 'contact-icon colortheme'); ?>
                            <div class="text-dark mb-1">Address</div>
                            <div class="text-secondary mb-2"><small><?php echo esc_html(velocitytheme_option('velocity_address')); ?></small></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (velocitytheme_option('velocity_phone')) : ?>
                    <div class="col-md">
                        <div class="h-contact"><?php echo velocitychild_get_bootstrap_icon_svg('telephone-fill', 'contact-icon colortheme'); ?>
                            <div class="text-dark mb-1">Phone</div>
                            <div class="text-secondary mb-2"><small><a class="text-secondary" href="tel:<?php echo esc_attr(velocitytheme_option('velocity_phone')); ?>"><?php echo esc_html(velocitytheme_option('velocity_phone')); ?></a></small></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (velocitytheme_option('velocity_email')) : ?>
                    <div class="col-md">
                        <div class="h-contact"><?php echo velocitychild_get_bootstrap_icon_svg('envelope-fill', 'contact-icon colortheme'); ?>
                            <div class="text-dark mb-1">Email</div>
                            <div class="mb-2"><small><a class="text-secondary" href="mailto:<?php echo esc_attr(velocitytheme_option('velocity_email')); ?>"><?php echo esc_html(velocitytheme_option('velocity_email')); ?></a></small></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container z-1 px-0 px-md-2">
    <nav id="main-navi" class="navbar navbar-expand-md d-block navbar-light  bg-theme p-0" aria-labelledby="main-nav-label">

        <div class="menu-header text-start d-md-none position-relative" data-bs-theme="dark">

            <button class="navbar-toggler text-dark p-2 rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/> </svg>
            </button>

        </div>

        <div class="menu-styles bg-theme p-md-1">
            <div class="pb-0">

                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close btn-close-dark text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div><!-- .offcancas-header -->

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'offcanvas-body',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav navbar-light p-md-2 justify-content-md-start justify-content-start flex-md-wrap flex-grow-1',
                            'fallback_cb'     => '',
                            'menu_id'         => 'primary-menu',
                            'depth'           => 4,
                            'walker'          => new justg_WP_Bootstrap_Navwalker(),
                        )
                    ); ?>

                </div><!-- .offcanvas -->
            </div>

    </nav><!-- .site-navigation -->
</div>

<?php if (!is_front_page()) : ?>
    <header class="entry-header mb-5">
        <?php $pagebg = velocitytheme_option('velocity_page_image'); ?>
        <?php if ($pagebg) { ?>
            <div class="page-banner position-relative overflow-hidden">
                <div class="overelay position-absolute start-0 top-0 h-100 w-100" style="background-color: rgba(0,0,0,0.2);"></div>
                <div class="container">
                    <div class="row m-0 align-items-center">
                        <div class="col-md-6 text-md-start z-1">
                            <?php velocity_title(); ?>
                        </div>
                        <div class="col-md-6 text-md-end z-1"><?php echo do_shortcode('[vd-breadcrumbs]'); ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </header>

    <style>
        .page-banner {
            background-image: url(<?php echo esc_url($pagebg); ?>);
        }
    </style>
<?php endif; ?>
