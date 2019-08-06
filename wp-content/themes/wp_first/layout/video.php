<div class="video my-4 embed-responsive embed-responsive-16by9">
  <video width="100%" class="embed-responsive-item" controls>
    <source src="<?php echo get_sub_field("video")["url"]; ?>" type="video/mp4">
    Dein Browser unterstützt die Video-Wiedergabe nicht.
  </video>

  <?php if(get_sub_field("quelle")) : ?>
      <div class="source">
          Quelle: <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("quelle")) ?>
      </div>
  <?php endif; ?>
</div>