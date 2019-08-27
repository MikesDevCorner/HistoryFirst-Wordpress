<?php get_header(); ?>

<div class="topic__intro">
  <div class="topic__img-holder" <?php if(get_field('bg', 'options')) { echo "style='background-image:url(".get_field('bg', 'options').")'"; } ?>></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php the_field('title', 'options'); ?></h1>
        <div class="mt-4"><?php the_field('text', 'options'); ?></div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
