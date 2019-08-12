<?php /* Template Name: Kapitel */ ?>

<?php get_header(); ?>

<div class="topic__intro mb-md-5 mb-3">
    <div class="topic__img-holder js-img-parallax" <?php if(has_post_thumbnail()) { echo "style='background-image:url(".get_the_post_thumbnail_url().")'"; } ?>></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="js-speech-text"><?php the_title(); ?><span class="sr-only" aria-hidden="true">.</span></h1>
          <div class="js-speech-text">
            <?php the_content(); ?>
          </div>
          <?php if(get_field("autor")): ?>
              <div itemprop="author" itemscope itemtype="https://schema.org/Person" class="topic__author">Text: <span itemprop="name"><?php the_field("autor"); ?></span></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
</div>

<section>
  <div class="text-center">
      <?php if(get_field("parent")) : ?>
        <?php get_template_part("layout/timeline"); ?>
      <?php endif; ?>
  </div>

  <div class="container mb-5">
    <?php if(have_rows("additional-links")) : ?>
      <div class="row mb-3 mb-md-4">
        <div class="col-md-12">
        <div class="topic__linkbox">
            <div class="topic__linkbox__links">
                <h2 class="h5">Weiterführende Links</h2>
              <?php while(have_rows('additional-links')) : the_row(); ?>
                  <p class="topic__linkbox__link">
                    <?php $link = get_sub_field('link');

                    if( $link ):
                      $link_url = $link['url'];
                      $link_title = $link['title'];
                      $link_target = $link['target'] ? $link['target'] : '_self';
                    endif;
                    ?>
                      <strong><?php echo esc_html($link_title); ?></strong>
                      <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                        <?php echo esc_url($link_url); ?>
                      </a>
                  </p>
              <?php endwhile; ?>
            </div>
        </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="row text-center justify-content-center">
      <div class="col-md-6">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-block" role="button">Zur Startseite</a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
