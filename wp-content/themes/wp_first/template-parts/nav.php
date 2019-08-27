<header <?php if ( is_home() || is_front_page() ) : ?>class="home-header"<?php endif; ?>>
    <div class="container no-container-md">
        <div class="row">
            <div class="<?php if ( is_home() || is_front_page() ) : ?>col-6<?php else: ?>col-10<?php endif; ?>">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                  <?php if ( is_home() || is_front_page() ) : ?>
                    <?php if(get_field('logo_white', 'options')) : ?><img src="<?php the_field('logo_white', 'options'); ?>" alt="Logo history.first"><?php endif; ?>
                  <?php else :?>
                    <?php if(get_field('logo_main', 'options')) : ?><img src="<?php the_field('logo_main', 'options'); ?>" alt="Logo history.first"><?php endif; ?>
                  <?php endif; ?>
                </a>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-end">
                <?php if ( !is_home() && !is_front_page() ) : ?>
                <nav class="navbar navbar-expand-lg d-lg-none">
                    <button class="navbar-toggler js-navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="animated-menu-icon js-animated-menu-icon"><span></span><span></span><span></span></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar">
                      <?php
                      if( have_rows('topics', 'options') ):
                        while ( have_rows('topics', 'options') ) : the_row(); ?>
                          <?php  $post = get_sub_field('topic');
                          setup_postdata( $post ); ?>
                            <ul class="list-unstyled mobile-menu-content" data-post="<?php echo $post->ID; ?>">
                                <li class="js-open-mobile-submenu <?php if($actualID === $post->ID) : ?>main-item active<?php endif; ?>"><a href="<?php the_permalink(); ?>"><span class="overlay__first"><?php the_title(); ?></span></a>
                                  <?php $args = array(
                                    'post_type'      => 'page',
                                    'posts_per_page' => -1,
                                    'post_parent'    => $post->ID,
                                    'order'          => 'ASC',
                                    'orderby'        => 'menu_order'
                                  );
                                  $parent = new WP_Query( $args );
                                  if ( $parent->have_posts() ) : ?>
                                      <ul class="list-unstyled mobile-submenu js-mobile-submenu">
                                        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                                            <li class="js-redirect <?php if($actualID === get_the_ID()) : ?>active<?php endif; ?>"><a href="<?php the_permalink(); ?>"><?php the_field("date"); ?></a></li>
                                        <?php endwhile; ?>
                                      </ul>
                                  <?php endif; ?>
                                  <?php wp_reset_postdata(); ?>
                                </li>
                            </ul>
                          <?php wp_reset_postdata();
                        endwhile; ?>
                      <?php endif; ?>
                        <?php
                        $uploadInfoPage = get_field('uploadpage', 'options');
                        $uploadPage = get_field('uploadpage-upload', 'options');
                        ?>
                        <ul class="list-unstyled mobile-menu-content" data-post="<?php echo $uploadPage; ?>">
                            <li class="js-open-mobile-submenu <?php if($actualID === $uploadInfoPage) : ?>active activeUpload<?php endif; ?>"><a href="<?php echo get_permalink($uploadInfoPage); ?>"><span class="overlay__first"><?php echo get_post($uploadInfoPage)->post_title; ?></span></a>
                              <?php if($uploadPage) : ?>
                                  <ul class="list-unstyled mobile-submenu js-mobile-submenu">
                                      <li class="js-redirect <?php if($actualID === $uploadPage) : ?>active<?php endif; ?>"><a href="<?php echo get_permalink($uploadPage); ?>"><?php echo get_post($uploadPage)->post_title; ?></a></li>
                                  </ul>
                              <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>

  <?php if ( !is_home() && !is_front_page() ) : ?>
    <?php get_template_part('template-parts/breadcrumbs'); ?>
  <?php endif; ?>

</header>
