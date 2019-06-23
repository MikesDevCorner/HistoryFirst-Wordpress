<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicons/safari-pinned-tab.svg" color="#acca57">
  <meta name="theme-color" content="#acca57">
  <!-- Favicons -->

  <title><?php wp_title(' | ', 1, 'left'); ?></title>

  <!-- Cookie Banner - Start
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>


  <script>
      let dsgvoSettings = {
          'CookieBaseColor' : '#000',
          'CookieContentColor' : '#ffffff',
          'Link' : '/datenschutz'
      };

      window.addEventListener("load", function(){
          window.cookieconsent.initialise({
              "palette": {
                  "popup": {
                      "background": dsgvoSettings.CookieBaseColor,
                      "text": dsgvoSettings.CookieContentColor,
                  },
                  "button": {
                      "background": dsgvoSettings.CookieContentColor,
                      "text": dsgvoSettings.CookieBaseColor,
                      "border": dsgvoSettings.CookieContentColor
                  }
              },
              "content": {
                  "message": "Diese Webseite verwendet Cookies, um Ihnen den bestmöglichen Service zu gewährleisten. Wenn Sie auf der Seite weitersurfen sind Sie mit der Verwendung von Cookies einverstanden: ",
                  "dismiss": "OK",
                  "link": "Datenschutzrichtlinien",
                  "href": dsgvoSettings.Link
              }
          })});

  </script>
  Cookie Banner - End -->

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php if ( is_home() || is_front_page() ) : ?>
  <?php get_template_part('template-parts/home-head'); ?>
<?php endif; ?>

<?php get_template_part('template-parts/nav'); ?>

<?php if ( !is_home() && !is_front_page() ) : ?>
<?php get_template_part('template-parts/sidebar'); ?>
<?php endif; ?>

<main>
