<aside class="menu d-none d-lg-block">
  <ul class="list-unstyled">
<?php

if( have_rows('topics', 'options') ):
  while ( have_rows('topics', 'options') ) : the_row();

    $post = get_sub_field('topic');
    setup_postdata( $post );

    $icon = get_field('icon');

    if( !empty($icon) ): ?>
    <li>
      <a href="#" class="js-menu-item" data-post="<?php echo $post->ID; ?>">
        <img src="<?php echo $icon['url']; ?>" alt="<?php $icon['alt']; ?>" />
      </a>
    </li>
    <?php endif;

    wp_reset_postdata();
  endwhile; ?>
<?php endif; ?>
    <li>
      <a href="<?php the_field('upload', 'options'); ?>" title="Datei hochladen">
        <img src="<?php echo get_template_directory_uri(); ?>/img/upload.svg" alt="Icon Upload" />
      </a>
    </li>
  </ul>
</aside>

<div class="overlay js-sidebar-menu">
    <?php
    if( have_rows('topics', 'options') ):
      while ( have_rows('topics', 'options') ) : the_row(); ?>
      <?php  $post = get_sub_field('topic');
        setup_postdata( $post ); ?>
        <ul class="list-unstyled js-sidebar-menu-content" data-post="<?php echo $post->ID; ?>">
            <li><span class="overlay__first"><?php the_title(); ?></span>
            <?php $args = array(
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'post_parent'    => $post->ID,
            'order'          => 'ASC',
            'orderby'        => 'menu_order'
            );
            $parent = new WP_Query( $args );
            if ( $parent->have_posts() ) : ?>
            <ul class="list-unstyled submenu js-submenu">
              <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_field("date"); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            </li>
        </ul>
    <?php wp_reset_postdata();
        endwhile; ?>
    <?php endif; ?>
</div>