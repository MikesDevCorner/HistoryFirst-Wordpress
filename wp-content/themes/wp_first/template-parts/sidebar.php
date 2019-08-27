<aside class="menu d-none d-lg-block js-aside">
  <ul class="list-unstyled js-icon-list">
<?php
global $post;
$actPost = get_post($post->ID);
$actualID = $post->ID;
$uploadInfoPage = get_field('uploadpage', 'options');
$uploadPage = get_field('uploadpage-upload', 'options');

function isChildOrParent($page_id) {
  $is_child = false;
  $parents = get_post_ancestors($actPost);
  $cat = get_the_category($actPost);
  $cat = $cat[0];
  if($cat) {
    array_push($parents, get_page_by_path(get_category($cat->category_parent)->slug . "/" . $cat->slug)->ID);
    $parent = get_category($cat->category_parent);
    if($parent) {
       array_push($parents, get_page_by_path($parent->slug)->ID);
    }
  }

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

function isChildOf($actualID, $compareID) {
  $cat = get_the_category($actualID)[0];
  return get_page_by_path(get_category($cat->category_parent)->slug . "/" . $cat->slug)->ID === $compareID;
}

if( have_rows('topics', 'options') ):
  while ( have_rows('topics', 'options') ) : the_row();

    global $post;
    $post2 = get_sub_field('topic');
    //setup_postdata( $post );

    $icon = get_field('icon', $post2->ID);

    if( !empty($icon) ): ?>
    <li <?php if(isChildOrParent($post2->ID)): ?>class="activeP"<?php endif; ?>>
      <a href="#" class="js-menu-item" data-post="<?php echo $post2->ID; ?>" title="<?php echo htmlentities($icon['alt']); ?>">
        <img class="js-inline-svg" src="<?php echo $icon['url']; ?>" alt="<?php echo htmlentities($icon['alt']); ?>" />
      </a>
    </li>
    <?php endif;

    wp_reset_postdata();
  endwhile; ?>
<?php endif; ?>
    <li <?php if($post->ID === $uploadInfoPage || $post->ID === $uploadPage): ?>class="activeP"<?php endif; ?>>
      <a href="#" class="js-menu-item" data-post="<?php echo $uploadPage; ?>" title="<?php echo get_post($uploadInfoPage)->post_title; ?>">
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
                <li <?php if($actualID === get_the_ID() || isChildOf($actualID, get_the_ID())) : ?>class="active"<?php endif; ?>><a href="<?php the_permalink(); ?>"><?php the_field("date"); ?></a></li>
              <?php endwhile; ?>
            </ul>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            </li>
        </ul>
    <?php wp_reset_postdata();
        endwhile; ?>
    <?php endif; ?>
    <ul class="list-unstyled js-sidebar-menu-content" data-post="<?php echo $uploadPage; ?>">
        <li <?php if($actualID === $uploadInfoPage) : ?>class="active activeUpload"<?php endif; ?>><a href="<?php echo get_permalink($uploadInfoPage); ?>"><span class="overlay__first"><?php echo get_post($uploadInfoPage)->post_title; ?></span></a>
          <?php if($uploadPage) : ?>
          <ul class="list-unstyled submenu js-submenu">
              <li <?php if($actualID === $uploadPage) : ?>class="active"<?php endif; ?>><a href="<?php echo get_permalink($uploadPage); ?>"><?php echo get_post($uploadPage)->post_title; ?></a></li>
          </ul>
          <?php endif; ?>
        </li>
    </ul>
</div>