<?php get_header(); ?>

<div class="topic__intro mb-3 mb-md-5">
    <div class="topic__img-holder js-img-parallax">
      <?php if(has_post_thumbnail()) : ?>
          <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0]; ?>" alt="<?php the_title(); ?>" />
      <?php else : ?>
          <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0]; ?>" alt="<?php the_title(); ?>" />
      <?php endif; ?>
    </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
