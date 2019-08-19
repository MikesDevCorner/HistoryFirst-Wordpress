<?php get_header(); ?>

<div class="topic__intro mb-3 mb-md-5">
    <div class="topic__img-holder js-img-parallax">
      <?php if(has_post_thumbnail($post->post_parent)) : ?><img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0]; ?>" alt="<?php the_title(); ?>" /><?php endif; ?>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php the_title(); ?></h1>
          <p><?php the_field("teaser"); ?></p>
        </div>
      </div>
    </div>
</div>

<section>
    <div class="container mb-3 mb-md-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <?php the_content(); ?>
              <?php if ( have_rows( 'layout' ) ):
                while ( have_rows( 'layout' ) ) : the_row();
                  get_template_part( 'layout/'. get_row_layout() );
                endwhile;
              endif; ?>
            </div>
        </div>
    </div>

    <div class="container mb-3 mb-md-5">
        <div class="row text-center justify-content-center">
            <div class="col-md-6">
              <?php global $post;
              $backLink = get_permalink(get_page_by_title(get_the_category()[0]->name));
              if ( $backLink ) { ?>
                  <a href="<?php echo $backLink; ?>" class="btn d-block" role="button">
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

<?php get_footer(); ?>