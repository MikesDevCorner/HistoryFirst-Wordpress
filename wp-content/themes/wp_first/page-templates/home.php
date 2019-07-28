<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<div class="container">
    <div class="row row--header justify-content-center">
        <div class="col-md-4 col-5 js-redirect">
            <div class="home-topic">
                <?php if( have_rows('topic1') ):
                while( have_rows('topic1') ): the_row(); ?>
                    <div class="red-ribbon js-ribbon" data-max="<?php echo count(get_sub_field('topic1_imgs')); ?>">
                      <div class="red-ribbon__content">
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
        <div class="col-md-4 col-5 offset-md-3 offset-1 js-redirect">
            <div class="home-topic home-topic--right">
              <?php if( have_rows('topic2') ):
                while( have_rows('topic2') ): the_row(); ?>
                  <h2 class="home-topic__title"><a href="<?php the_sub_field('topic2_link'); ?>"><?php the_sub_field('topic2_title'); ?></a></h2>
                    <div class="red-ribbon red-ribbon--right js-ribbon" data-max="<?php echo count(get_sub_field('topic2_imgs')); ?>">
                        <div class="red-ribbon__content">
                          <?php if( have_rows('topic2_imgs') ): $i = 1; ?>
                            <?php while( have_rows('topic2_imgs') ): the_row(); ?>
                              <?php $image = get_sub_field('topic2_img'); ?>
                                  <div class="red-ribbon__img">
                                      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-index="<?php echo $i; ?>"/>
                                  </div>
                              <?php $i++; ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
