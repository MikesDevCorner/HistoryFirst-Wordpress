</main>
<?php if ( is_home() || is_front_page() ) : ?>
</div>
<?php endif; ?>

<footer class="footer js-footer <?php if ( is_home() || is_front_page() ) : ?>footer--home<?php else : ?>mt-5<?php endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php wp_nav_menu(array('menu' => 'footer', 'menu_class' => 'footer-menu list-unstyled')); ?>

                <div class="footer__address">
                  <?php if(get_field('footer-1', 'options')) : ?><div class="first-line"><?php the_field('footer-1', 'options'); ?></div><?php endif; ?>
                    &copy; <?php echo date("Y");?> <?php if(get_field('footer-2', 'options')) : ?><?php the_field('footer-2', 'options'); ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
