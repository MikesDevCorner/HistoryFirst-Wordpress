<header>
    <div class="container no-container-md">
        <div class="row">
            <div class="col-10">
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
                      <!--<?php $home = get_field("homepage"); ?>
                      <?php $pid = get_the_ID(); ?>
                      <ul class="navbar-nav ml-auto">
                          <li class="nav-item">
                              <a class="nav-link primary" href="<?php echo esc_url(home_url('/')); ?>" <?php if($pid === $home) : ?>data-scroll-nav="0"<?php endif; ?>>Home</a>
                          </li>

                        <?php while ( have_rows('menu', $home) ) : the_row(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($pid !== $home) : ?>primary<?php endif; ?>" href="<?php echo esc_url(home_url('/')); ?>?sec=<?php echo $col; ?>" <?php if($pid === $home) : ?>data-scroll-nav="<?php echo $col; ?>"<?php endif; ?>><?php the_sub_field('menu-item'); ?></a>
                            </li>
                          <?php $col++; endwhile; ?>
                      </ul> -->
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
                        <ul class="list-unstyled mobile-menu-content" data-post="<?php echo url_to_postid(get_field('upload', 'options')); ?>">
                            <li class="js-open-mobile-submenu no-sub-items"><a href="<?php the_field('upload', 'options'); ?>"><span class="overlay__first">Datei einreichen</span></a></li>
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
