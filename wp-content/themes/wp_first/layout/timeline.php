<div class="frst-container" data-animation-name="slideInUp">
  <?php $post_object = get_field('parent');

  if( $post_object ):
    $args = array(
      'post_type'      => 'page',
      'posts_per_page' => -1,
      'post_parent'    => $post_object,
      'order'          => 'ASC',
      'orderby'        => 'menu_order'
    );
    $parent = new WP_Query( $args );
    if ( $parent->have_posts() ) : ?>
    <div class="frst-timeline frst-date-opposite frst-alternate frst-timeline-style-11">
        <?php $odd = false; ?>
        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
            <div class="frst-timeline-block js-redirect <?php if($odd) : ?>frst-odd-item<?php else : ?>frst-even-item<?php endif; ?>" data-animation="slideInUp">
                <div class="frst-timeline-block-hover"></div>
                <div class="frst-timeline-img"> <span></span> </div>
                <div class="frst-timeline-content">
                    <div class="frst-timeline-content-inner">
                        <span class="frst-date"><?php the_field("date"); ?></span>
                        <span class="title-section"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                        <p class="content-section"><?php the_field("teaser"); ?></p>
                    </div>
                </div>
            </div>
            <?php $odd = !$odd; ?>
        <?php endwhile; ?>
        <div class="frst-timeline-dashed-end"></div>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</div>