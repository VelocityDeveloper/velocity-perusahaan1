<footer class="site-footer text-center mt-5" id="colophon">
    <div class="velocity-footer">
        <div class="row footer-widget container text-start mx-auto px-2 pt-4">
            <?php for ($x = 1; $x <= 3; $x++) { ?>
                <?php if (is_active_sidebar('footer-widget-' . $x)) { ?>
                    <div class="col-md">
                        <?php dynamic_sidebar('footer-widget-' . $x); ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <div class=" site-info text-white">
        <small class="opacity-25">
            Copyright © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
        </small>
        <br>
        <small class="opacity-25">
            Design by <a class="" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->
</footer>