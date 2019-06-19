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

<?php get_footer(); ?>