<?php

// ---------
// MAIN
// ---------

// Load Main Files

add_action('wp_enqueue_scripts', function () {
  // Main Styles
  wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');

  // Main Scripts
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/libs/bootstrap-4.3.1.min.js', array('jquery'), '1.0.0');
  wp_enqueue_script('css-vars-polyfill', get_template_directory_uri() . '/js/libs/css-var-polyfill.js', array('jquery'), '1.0.0');
  wp_enqueue_script('main_script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
});

// Theme Setup
add_action('after_setup_theme', function () {

  // Add Theme Support: Menus
  add_theme_support('menus');
  // Add Theme Support: Thumbnails
  add_theme_support( 'post-thumbnails' );
  // Register Navigations
  register_nav_menus( array(
    'nav_main' => 'Haupt Navigation',
  ));
  // $role_object = get_role( 'editor' );
  // $role_object->add_cap( 'edit_theme_options' );
});

// ---------
// CLEARING
// ---------

// remove admin bar
add_action('show_admin_bar', function () {
  return false;
});

// hide menus
add_action('admin_menu', function () {
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'edit.php' );          	        //Posts
});

// backend logo
function logo_backend() {
  ?>
  <style type="text/css">
    body.login div#login h1 a {
      background-image: url(/wp-content/themes/wp_first/img/logo.png);
      width: 150px;
      background-size: 150px;
    }
  </style>
  <?php
}
add_action( 'login_enqueue_scripts', 'logo_backend' );