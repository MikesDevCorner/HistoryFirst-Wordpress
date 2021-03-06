<?php /* Template Name: Kontakt/Formular */ ?>

<?php get_header(); ?>

<div class="topic__intro">
    <div class="topic__img-holder" <?php if(has_post_thumbnail()) { echo "style='background-image:url(".get_the_post_thumbnail_url().")'"; } ?>></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
</div>

<?php $shortcode = get_field("contact-form-7"); ?>
<?php if($shortcode) : ?>
<section>
  <div class="text-center">
    <?php echo do_shortcode($shortcode); ?>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
