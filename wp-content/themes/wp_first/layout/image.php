<div class="full-img my-4 js-fill-border">
  <?php $image = get_sub_field('bild');
  if( !empty($image) ): ?>

      <a href="<?php echo $image['url']; ?>" data-lightbox="<?php echo $image['id']; ?>" data-title="<?php echo wp_get_attachment_caption($image['id']); ?>">
      <figure class="js-fill-color">
          <img class="js-get-img-color" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
          <?php if(wp_get_attachment_caption($image['id'])) : ?>
          <figcaption>
              <?php echo wp_get_attachment_caption($image['id']); ?>
          </figcaption>
          <?php endif; ?>
      </figure>
      </a>

  <?php endif; ?>

  <?php if(get_sub_field("quelle")) : ?>
      <div class="source">
          Quelle: <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("quelle")) ?>
      </div>
  <?php endif; ?>
</div>
