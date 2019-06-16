<?php /* Template Name: Subkapitel/Ereignis */ ?>

<?php get_header(); ?>

<div class="topic__intro mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
</div>

<?php $term = get_field('category');

if( $term ): ?>

<section class="container event">
  <?php $postsOfCat = new WP_Query(array(
    'post_type'         => 'post',
    'cat'               => $term,
    'posts_per_page'    => -1,
  )); ?>
    <?php if( $postsOfCat->have_posts() ) : ?>
        <?php while( $postsOfCat->have_posts() ) : $postsOfCat->the_post(); ?>
            <article>
                <div class="row mx-0">
                    <div class="event__article col-md-7">
                        <div class="event__article__text">
                            <h2><?php the_title(); ?></h2>
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="event__article__link">
                            <a href="<?php the_permalink(); ?>">Weiterlesen</a>
                        </div>
                    </div>
                    <div class="event__img col-md-5 px-0">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; wp_reset_query(); ?>

    <div class="mb-5">
        <div class="row text-center justify-content-center">
            <div class="col-md-6">
              <?php global $post;
              if ( $post->post_parent ) { ?>
                  <a href="<?php echo get_permalink( $post->post_parent ); ?>" class="btn d-block" role="button">
                      Zurück
                  </a>
              <?php } ?>
                </div>
            <div class="col-md-6">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--light d-block" role="button">Zur Startseite</a>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php get_footer(); ?>
