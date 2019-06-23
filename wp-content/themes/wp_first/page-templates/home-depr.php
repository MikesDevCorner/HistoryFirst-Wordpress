<?php /* Deprecated Home */ ?>

<?php get_header( 'home' ); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 js-redirect">
            <div class="home-topic">
                <?php if( have_rows('topic1') ):
                while( have_rows('topic1') ): the_row(); ?>
                    <!--<div class="home-topic__img jsX-home-topic--left" data-max="<?php echo count(get_sub_field('topic1_imgs')); ?>" <?php echo $imgs; ?>>
                        <?php if( have_rows('topic1_imgs') ): $i = 1; ?>
                        <?php while( have_rows('topic1_imgs') ): the_row(); ?>
                            <?php $image = get_sub_field('topic_img'); ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-index="<?php echo $i; ?>"/>
                            <?php $i++; ?>
                        <?php endwhile; endif; ?>
                    </div>-->
                    <div class="red-ribbon">
                      <div class="red-ribbon__content" data-max="<?php echo count(get_sub_field('topic1_imgs')); ?>" <?php echo $imgs; ?>>
                      <?php if( have_rows('topic1_imgs') ): $i = 1; ?>
                        <?php while( have_rows('topic1_imgs') ): the_row(); ?>
                          <?php $image = get_sub_field('topic_img'); ?>
                          <div class="red-ribbon__img">
                              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-index="<?php echo $i; ?>"/>
                          </div>
                          <?php $i++; ?>
                        <?php endwhile; endif; ?>
                      </div>
                    </div>

                    <h2 class="home-topic__title"><a href="<?php the_sub_field('topic1_link'); ?>"><?php the_sub_field('topic1_title'); ?></a></h2>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
        </div>
        <div class="col-4 offset-3 js-redirect">
            <div class="home-topic home-topic--right">
              <?php if( have_rows('topic2') ):
                while( have_rows('topic2') ): the_row(); ?>
                  <h2 class="home-topic__title"><a href="<?php the_sub_field('topic2_link'); ?>"><?php the_sub_field('topic2_title'); ?></a></h2>
                  <div class="home-topic__img js-home-topic--right" data-max="<?php echo count(get_sub_field('topic2_imgs')); ?>" <?php echo $imgs; ?>>
                    <?php if( have_rows('topic2_imgs') ): $i = 1; ?>
                      <?php while( have_rows('topic2_imgs') ): the_row(); ?>
                        <?php $image = get_sub_field('topic2_img'); ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-index="<?php echo $i; ?>"/>
                        <?php $i++; ?>
                      <?php endwhile; endif; ?>
                  </div>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer('home'); ?>
