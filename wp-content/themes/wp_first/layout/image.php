<div class="full-img my-4">
  <?php $image = get_sub_field('bild');
  if( !empty($image) ): ?>

    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

  <?php endif; ?>
</div>
