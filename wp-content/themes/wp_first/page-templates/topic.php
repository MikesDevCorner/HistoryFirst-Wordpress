<?php /* Template Name: Kapitel/Topic */ ?>

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

<section>
  <!--TODO Zeitleiste -->
  <div class="text-center"><?php echo do_shortcode("[timeline-express]"); ?></div>

  <div class="container mb-5">
    <div class="row text-center">
      <div class="col-md-12">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn" role="button">Zur Startseite</a>
      </div>
    </div>
  </div>

</section>

<?php get_footer(); ?>
