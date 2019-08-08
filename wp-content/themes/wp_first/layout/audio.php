<div class="audioo my-4">
    <audio controls crossorigin controlsList="nodownload">
        <source src="<?php echo get_sub_field("datei")["url"]; ?>" type="audio/mpeg">
    </audio>
    <?php if(get_sub_field("quelle")) : ?>
    <div class="source">
        Quelle: <?php echo str_replace(array('<p>','</p>'),'',get_sub_field("quelle")) ?>
    </div>
    <?php endif; ?>
</div>