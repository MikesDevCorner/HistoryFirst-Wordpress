<?php /* Template Name: Ereignis */ ?>

<?php get_header(); ?>

<div class="topic__intro">
    <div class="topic__img-holder js-img-parallax">
      <?php if(has_post_thumbnail($post->post_parent)) : ?><img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0]; ?>" alt="<?php the_title(); ?>" /><?php endif; ?>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="event__article__date"><?php the_field("date"); ?></div>
          <h1 class="js-speech-text"><?php the_title(); ?><span class="sr-only" aria-hidden="true">.</span></h1>
          <div class="js-speech-text">
            <?php the_content(); ?>
          </div>
          <?php if(get_field("autor")): ?>
              <div itemprop="author" itemscope itemtype="https://schema.org/Person" class="topic__author">Text: <span itemprop="name"><?php the_field("autor"); ?></span></div>
          <?php endif; ?>

          <?php if(have_rows("additional-links")) : ?>
              <div class="topic__linkbox">
                  <div class="topic__linkbox__links">
                      <h2 class="h5">Weiterführende Links</h2>
                    <?php while(have_rows('additional-links')) : the_row(); ?>
                        <p class="topic__linkbox__link">
                          <?php $link = get_sub_field('link');

                          if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                          endif;
                          ?>
                            <strong><?php echo esc_html($link_title); ?></strong>
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_url($link_url); ?>
                            </a>
                        </p>
                    <?php endwhile; ?>
                  </div>
              </div>
          <?php endif; ?>
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
            <article class="js-redirect">
                <div class="row mx-0">
                    <div class="event__article <?php if ( has_post_thumbnail() ) : ?>col-md-7<?php else : ?>col-md-12 event__article--no-thumbnail<?php endif; ?>">
                        <div class="event__article__text">
                            <h2><?php the_title(); ?></h2>
                            <?php the_field("teaser"); ?>
                        </div>
                        <div class="event__article__link">
                            <a href="<?php the_permalink(); ?>">Weiterlesen</a>
                        </div>
                    </div>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="event__img col-md-5 px-0">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
                    </div>
                    <?php endif; ?>
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
            <div class="col-md-6 mt-3 mt-md-0">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--light d-block" role="button">Zur Startseite</a>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php get_footer(); ?>
