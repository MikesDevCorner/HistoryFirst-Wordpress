<div class="homescreen js-homescreen" <?php if(has_post_thumbnail()) { echo "style='background:url(".get_the_post_thumbnail_url().") no-repeat;'"; } ?>>
    <div class="homescreen-slogan"> <!--data-tilt-->
        <div class="homescreen__circle js-progress-circle"></div>
        <span class="homescreen-slogan__inner">
            <span class="js-slogan-rest"><?php the_field("word1") ?><br><?php the_field("word2") ?></span><br>
            <?php $word3 = get_field("word3"); ?>
            <?php if( have_rows('word3') ): $i = 1; $words = ""; ?>
                <?php while(have_rows('word3') ) : the_row(); ?>
                    <?php if($i === 1) { $first = get_sub_field('word'); } ?>
                    <?php $words .= "data-word".$i."='".get_sub_field('word')."'"  ?>
                    <?php $i++; ?>
                <?php endwhile; ?>
                <span class="js-slogan" data-max="<?php echo $i-1; ?>" <?php echo $words; ?>><?php echo $first; ?></span>
            <?php endif; ?>
        </span>
    </div>