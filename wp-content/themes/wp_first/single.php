<?php get_header(); ?>

  <div class="topic__intro mb-5">
    <div class="topic__img-holder" <?php if(has_post_thumbnail()) { echo "style='background-image:url(".get_the_post_thumbnail_url().")'"; } ?>></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
            <?php if ( have_rows( 'layout' ) ):
                while ( have_rows( 'layout' ) ) : the_row();
                get_template_part( 'layout/'. get_row_layout() );
              endwhile;
            endif; ?>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>