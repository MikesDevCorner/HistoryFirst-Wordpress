<div class="full-img my-4">
  <?php $image = get_sub_field('bild');
  if( !empty($image) ): ?>

    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

  <?php endif; ?>

  <?php if(get_sub_field("quelle")) : ?>
      <div class="source">
          Quelle: <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("quelle")) ?>
      </div>
  <?php endif; ?>
</div>
