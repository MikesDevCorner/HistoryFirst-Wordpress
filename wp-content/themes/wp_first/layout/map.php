<div class="embed-responsive embed-responsive-16by9">
  <div class="map js-map embed-responsive-item"></div>

  <?php if(have_rows('orte')) : ?>
    <?php while ( have_rows('orte') ) : the_row(); ?>
      <div class="marker js-marker" data-lat="<?php the_sub_field('lat'); ?>" data-lng="<?php the_sub_field('lng'); ?>">
        <div class="infowindow">
          <?php the_sub_field("info"); ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>