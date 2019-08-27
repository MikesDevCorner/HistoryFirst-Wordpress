<?php if ( !is_home() && !is_front_page() || is_paged() ) : ?>
<?php
  $delimiterBefore = '<li>';
  $delimiterAfter = '</li>';
  $home = 'Startseite';
  $before = '<li class="current-page">';
  $after = '</li>'; ?>

<div class="breadcrumbs bg-brown">
    <div class="container no-container-md">
        <div class="row">
          <div class="col-md-12 col-12">
            <nav class="breadcrumbs-nav">
                <ol class="list-unstyled">
                  <?php global $post;
                  $homeLink = get_bloginfo('url');
                  echo $delimiterBefore . '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiterAfter;

                  if (is_category()) {
                    global $wp_query;
                    $cat_obj = $wp_query->get_queried_object();
                    $thisCat = $cat_obj->term_id;
                    $thisCat = get_category($thisCat);
                    $parentCat = get_category($thisCat->parent);
                    if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiterAfter . ' '));
                    echo $before . single_cat_title('', false) . $after;

                  } elseif (is_day()) {
                    echo $delimiterBefore . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiterAfter . ' ';
                    echo $delimiterBefore . '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiterAfter . ' ';
                    echo $before . get_the_time('d') . $after;

                  } elseif (is_month()) {
                    echo $delimiterBefore . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiterAfter . ' ';
                    echo $before . get_the_time('F') . $after;

                  } elseif (is_year()) {
                    echo $before . get_the_time('Y') . $after;

                  } elseif (is_single() && !is_attachment()) {
                    if (get_post_type() != 'post') {
                      $post_type = get_post_type_object(get_post_type());
                      $slug = $post_type->rewrite;
                      echo $delimiterBefore . '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiterAfter . ' ';
                      echo $before . get_the_title() . $after;
                    } else {
                      $cat = get_the_category();
                      $cat = $cat[0];

                      $parent = get_category($cat->category_parent);
                      if($parent) {
                        $catLinkParent = get_permalink( get_page_by_path($parent->slug) );
                        echo $delimiterBefore . '<a href="' . $catLinkParent . '">' . strip_tags ($parent->name) . '</a> ';
                      }

                      $catLink = get_permalink( get_page_by_path(get_category($cat->category_parent)->slug . "/" . $cat->slug) );
                      echo $delimiterBefore . '<a href="' . $catLink . '">' . strip_tags ($cat->name) . '</a> ';
                      //echo get_category_parents($cat, TRUE, ' ' . $delimiterAfter . ' ');
                      echo $delimiterBefore . get_the_title() . $after . $delimiterAfter;
                    }

                  } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                    $post_type = get_post_type_object(get_post_type());
                    echo $before . $post_type->labels->singular_name . $after;


                  } elseif (is_attachment()) {
                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiterAfter . ' ');
                    echo $delimiterBefore . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiterAfter . ' ';
                    echo $before . get_the_title() . $after;

                  } elseif (is_page() && !$post->post_parent) {
                    echo $before . get_the_title() . $after;

                  } elseif (is_page() && $post->post_parent) {
                    $parent_id = $post->post_parent;
                    $breadcrumbs = array();
                    while ($parent_id) {
                      $page = get_page($parent_id);
                      $breadcrumbs[] = $delimiterBefore . '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                      $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiterAfter . ' ';
                    echo $before . get_the_title() . $after;

                  } elseif (is_search()) {
                    echo $before . 'Ergebnisse für Ihre Suche nach "' . get_search_query() . '"' . $after;

                  } elseif (is_tag()) {
                    echo $before . 'Beiträge mit dem Schlagwort "' . single_tag_title('', false) . '"' . $after;

                  } elseif (is_404()) {
                    echo $before . 'Fehler 404' . $after;
                  }

                  if (get_query_var('paged')) {
                    if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
                    echo ': ' . __('Seite') . ' ' . get_query_var('paged');
                    if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
                  } ?>
                </ol>
            </nav>
          </div>
          <div class="col-md-1 col-3 speech d-none">
              <button class="js-speech-btn">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/play.svg" data-change="<?php echo get_template_directory_uri(); ?>/img/pause.svg" alt="Vorlesen lassen">
              </button>
          </div>
        </div>
    </div>
</div>
<?php endif; ?>