<div class="embed-responsive embed-responsive-16by9">
  <div class="map js-map embed-responsive-item" <?php if(get_sub_field("show-lines")) : ?>data-lines="true"<?php endif; ?>>
  <?php if(have_rows('orte')) : ?>
    <?php while ( have_rows('orte') ) : the_row(); ?>
      <div class="marker js-marker" data-color="<?php the_sub_field('color'); ?>" data-lat="<?php the_sub_field('lat'); ?>" data-lng="<?php the_sub_field('lng'); ?>">
        <div class="infowindow js-info">
          <?php the_sub_field("info"); ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
  </div>
</div>
<?php if(have_rows('legend')) : ?>
    <ul class="map-legend">
      <?php while ( have_rows('legend') ) : the_row(); ?>
          <li class="map-legend__item">
              <img src='/wp-content/themes/wp_first/img/marker-<?php the_sub_field('color'); ?>.svg'>
            <?php the_sub_field("info"); ?>
          </li>
      <?php endwhile; ?>
    </ul>
<?php endif; ?>
<div class="source">
  <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("quelle")) ?>
</div>