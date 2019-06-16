<header>
    <div class="container no-container-md">
        <div class="row">
            <div class="col-10">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo histery.first">
                </a>
            </div>
            <div class="col-2 d-flex align-items-center">
                <nav class="navbar navbar-expand-lg d-lg-none">
                    <button class="navbar-toggler js-navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="animated-menu-icon js-animated-menu-icon"><span></span><span></span><span></span></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar">
                      <?php $home = get_field("homepage"); ?>
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
                      </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

  <?php get_template_part('template-parts/breadcrumbs'); ?>

</header>
