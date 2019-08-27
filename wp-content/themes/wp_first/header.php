<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicons/safari-pinned-tab.svg" color="#AF3802">
  <meta name="theme-color" content="#AF3802">
  <!-- Favicons -->

  <title><?php wp_title(' | ', 1, 'left'); ?></title>

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php if ( is_home() || is_front_page() ) : ?>
  <?php get_template_part('template-parts/home-head'); ?>
<?php endif; ?>

<?php get_template_part('template-parts/nav'); ?>

<main>

  <?php if ( !is_home() && !is_front_page() ) : ?>
    <?php get_template_part('template-parts/sidebar'); ?>
  <?php endif; ?>
