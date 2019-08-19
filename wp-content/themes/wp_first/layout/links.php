<div class="mb-3 mb-md-4">
    <div class="topic__linkbox">
      <div class="topic__linkbox__links">
        <h2 class="h5">Weiterführende Links</h2>
        <?php while(have_rows('additional-links')) : the_row(); ?>
          <p class="topic__linkbox__link">
            <?php $link = get_sub_field('link');

            if( $link ):
              $link_url = $link['url'];
              $link_title = $link['title'];
              $link_target = $link['target'] ? $link['target'] : '_self';
            endif;
            ?>
            <strong><?php echo esc_html($link_title); ?></strong>
            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
              <?php echo esc_url($link_url); ?>
            </a>
          </p>
        <?php endwhile; ?>
      </div>
    </div>
</div>