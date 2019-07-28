</main>
<?php if ( is_home() || is_front_page() ) : ?>
</div>
<?php endif; ?>

<footer class="footer js-footer <?php if ( is_home() || is_front_page() ) : ?>footer--home<?php else : ?>mt-5<?php endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php wp_nav_menu(array('menu' => 'footer', 'menu_class' => 'footer-menu list-unstyled')); ?>
            </div>
            <div class="col-md-6 order-md-1 mt-4 mt-md-0 text-center text-md-right order-2">
              <?php if(have_rows('logos', 'options')) : ?>
                  <?php while ( have_rows('logos', 'options') ) : the_row(); ?>
                    <div class="footer__logo">
                        <?php $link = get_sub_field("link"); ?>
                        <?php if($link) : $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link_target); ?>">
                        <?php endif; ?>
                        <img src="<?php echo get_sub_field("logos")['url']; ?>" alt="<?php echo get_sub_field("logos")['alt']; ?>" />
                        <?php if($link) : ?></a><?php endif; ?>
                    </div>
                  <?php endwhile; ?>
              <?php endif; ?>

            </div>
            <div class="col-md-12 order-md-2 order-1">
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
