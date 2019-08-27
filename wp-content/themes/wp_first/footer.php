</main>
<?php if ( is_home() || is_front_page() ) : ?>
</div>
<?php endif; ?>

<footer class="footer js-footer <?php if ( is_home() || is_front_page() ) : ?>footer--home<?php else : ?>mt-5<?php endif; ?>">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-9 col-sm-7">
                <?php wp_nav_menu(array('menu' => 'footer', 'menu_class' => 'footer-menu list-unstyled')); ?>
                <div class="footer__address">
                  <?php if(get_field('footer-1', 'options')) : ?><div class="first-line"><?php the_field('footer-1', 'options'); ?></div><?php endif; ?>
                    &copy; <?php echo date("Y");?> <?php if(get_field('footer-2', 'options')) : ?><?php the_field('footer-2', 'options'); ?><?php endif; ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-5 mt-4 mt-md-0 text-center text-sm-right">
              <?php if(have_rows('logos', 'options')) : ?>
                  <?php while ( have_rows('logos', 'options') ) : the_row(); ?>
                    <div class="footer__logo">
                        <?php $link = get_sub_field("link"); ?>
                        <?php if($link) : $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link_target); ?>" rel="noopener">
                        <?php endif; ?>
                        <img src="<?php if(is_home() || is_front_page()) : echo get_sub_field("logos_light")['url'];  else : echo get_sub_field("logos")['url'];  endif; ?>" alt="<?php echo get_sub_field("logos")['alt']; ?>" />
                        <?php if($link) : ?></a><?php endif; ?>
                    </div>
                  <?php endwhile; ?>
              <?php endif; ?>

            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
