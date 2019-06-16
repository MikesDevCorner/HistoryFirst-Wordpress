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
  <div class="text-center">
      <?php $shortcode = get_field("timeline"); ?>
      <?php echo do_shortcode($shortcode); ?>
    <?php //echo do_shortcode('[ft_timeline category=4 design="11" daysofweek="off" align="alternate" effect="" order="desc" date-format="" post-number=10 icon="no"]'); ?>
  </div>

  <div class="container mb-5">
    <div class="row text-center justify-content-center">
      <div class="col-md-6">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn" role="button">Zur Startseite</a>
      </div>
    </div>
  </div>

</section>

<?php get_footer(); ?>
