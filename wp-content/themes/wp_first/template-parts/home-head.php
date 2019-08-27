<div class="homescreen js-homescreen" <?php if(has_post_thumbnail()) { echo "style='background:url(".get_the_post_thumbnail_url().") no-repeat;'"; } ?>>
    <div class="homescreen-slogan">
        <div class="homescreen__circle js-progress-circle"></div>
        <span class="homescreen-slogan__inner js-parallax">
            <?php if( have_rows('words') ): $i = 1; $words = ""; ?>
                <?php while(have_rows('words') ) : the_row(); ?>
                    <?php if($i === 1) { $first = get_sub_field('word'); } ?>
                    <?php $words .= " data-word".$i."='".get_sub_field('word')."'"  ?>
                    <?php $i++; ?>
                <?php endwhile; ?>
                <span class="js-slogan" data-max="<?php echo $i-1; ?>" <?php echo $words; ?>>&nbsp;</span>
            <?php endif; ?>
            <div class="d-md-none homescreen-touchinfo js-show-touchinfo">
                <div class="homescreen-touchinfo__transform">
                    <img src="/wp-content/themes/wp_first/img/mouse.svg" aria-hidden="true" />
                </div>
                Wähle deine Geschichte.
            </div>
        </span>
    </div>
<div class="homescreen-loading js-home-loading"></div>