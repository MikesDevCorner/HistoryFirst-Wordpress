<aside class="menu d-none d-lg-block js-aside">
  <ul class="list-unstyled js-icon-list">
<?php
$actualID = $post->ID;

function isChildOrParent($page_id) {
  global $post;
  $is_child = false;
  $parents = get_post_ancestors($post);
  if ($parents) {
    foreach ($parents as $one_parent_id) {
      if ($one_parent_id == $page_id) {
        $is_child = true;
        break;
      }
    }
  }
  if (!$is_child) {
      if ($page_id === $post->ID) {
        $is_child = true;
      }
  }
  return $is_child;
};

if( have_rows('topics', 'options') ):
  while ( have_rows('topics', 'options') ) : the_row();

    global $post;
    $post2 = get_sub_field('topic');
    //setup_postdata( $post );

    $icon = get_field('icon', $post2->ID);

    if( !empty($icon) ): ?>
    <li <?php if(isChildOrParent($post2->ID)): ?>class="activeP"<?php endif; ?>>
      <a href="#" class="js-menu-item" data-post="<?php echo $post2->ID; ?>">
        <img class="js-inline-svg" src="<?php echo $icon['url']; ?>" alt="<?php $icon['alt']; ?>" />
      </a>
    </li>
    <?php endif;

    wp_reset_postdata();
  endwhile; ?>
<?php endif; ?>
    <li <?php if($post->ID === url_to_postid( get_field('upload', 'options') )): ?>class="activeP"<?php endif; ?>>
      <a href="#" class="js-menu-item" data-post="<?php echo url_to_postid( get_field('upload', 'options')); ?>" title="Datei hochladen">
        <img class="js-inline-svg" src="<?php echo get_template_directory_uri(); ?>/img/upload.svg" alt="Icon Upload" />
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
            <li <?php if($actualID === $post->ID) : ?>class="main-item active"<?php endif; ?>><a href="<?php the_permalink(); ?>"><span class="overlay__first"><?php the_title(); ?></span></a>
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
                <li <?php if($actualID === get_the_ID()) : ?>class="active"<?php endif; ?>><a href="<?php the_permalink(); ?>"><?php the_field("date"); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            </li>
        </ul>
    <?php wp_reset_postdata();
        endwhile; ?>
    <?php endif; ?>
    <ul class="list-unstyled js-sidebar-menu-content" data-post="<?php echo url_to_postid(get_field('upload', 'options')); ?>">
        <li><a href="<?php the_field('upload', 'options'); ?>"><span class="overlay__first">Datei<br>einreichen</span></a>
          <ul class="list-unstyled submenu js-submenu">
              <li><a href="<?php the_field('upload', 'options'); ?>">Persönliche Dateien uploaden</a></li>
          </ul>
        </li>
    </ul>
</div>