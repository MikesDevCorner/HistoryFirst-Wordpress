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
    <ul class="list-unstyled">
        <li><span class="overlay__first">Ernährung und Mangel</span>
        <ul class="list-unstyled submenu">
            <li><a href="#">1500 bis 1700</a></li>
            <li><a href="#">1910 bis 1920</a></li>
            <li><a href="#">1920 bis 1940</a></li>
            <li><a href="#">1940er</a></li>
            <li><a href="#">heute</a></li>
        </ul>
        </li>
    </ul>
</div>