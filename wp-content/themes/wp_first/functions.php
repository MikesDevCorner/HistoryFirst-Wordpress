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
  wp_enqueue_script('progressbar', get_template_directory_uri() . '/js/libs/progressbar.js', array('jquery'), '1.0.0');
  wp_enqueue_script('parallax', get_template_directory_uri() . '/js/libs/parallax.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('leaflet', get_template_directory_uri() . '/js/libs/leaflet.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('first-timeline', get_template_directory_uri() . '/js/libs/frst-timeline.min.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('audio', get_template_directory_uri() . '/js/libs/audio.js', array('jquery'), '1.0.0', true);
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
    'nav_main' => 'Hauptmenu',
    'footer' => 'Footer Navigation',
  ));
  // $role_object = get_role( 'editor' );
  // $role_object->add_cap( 'edit_theme_options' );
});

// remove admin bar
add_action('show_admin_bar', function () {
  return false;
});

// hide menus
add_action('admin_menu', function () {
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'edit.php' );          	        //Posts
});

// backend logo
function logo_backend() {
  ?>
  <style type="text/css">
    body.login div#login h1 a {
      background-image: url(/wp-content/themes/wp_first/img/logo.png);
      width: 150px;
      background-size: 150px;
      padding-bottom: 10px;
    }
  </style>
  <?php
}
add_action( 'login_enqueue_scripts', 'logo_backend' );

// Allow SVG (if XML definition is missing)
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );

  return [
    'ext'             => $filetype['ext'],
    'type'            => $filetype['type'],
    'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

// ACF Optionen Seite
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'FIRST - allgemeine Einstellungen',
		'menu_title'	=> 'FIRST Optionen',
		'menu_slug'	    => 'options',
		'redirect'		=> false,
        'position'      => '30.1',
        'capability' => 'edit_posts',
        'icon_url'      => 'dashicons-admin-tools',
        'update_button'		=> 'Aktualisieren',
        'updated_message'	=> 'Theme aktualisiert',
	));

}

// Move Yoast to bottom
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/**
 * Dynamic Select List for Contact Form 7
 * @usage [select name taxonomy:{$taxonomy} ...]
 */
function dynamic_select_list( $tag ) {

  // Only run on select lists
  if( 'select*' !== $tag['type'] ) {
    return $tag;
  } else if ( empty( $tag['options'] ) ) {
    return $tag;
  }

  $term_args = array();

  // Loop thorugh options to look for our custom options
  foreach( $tag['options'] as $option ) {

    $matches = explode( ':', $option );
    if( ! empty( $matches ) ) {

      switch( $matches[0] ) {
        case 'taxonomy':
          $term_args['taxonomy'] = $matches[1];
          break;
        case 'parent':
          $term_args['parent'] = intval( $matches[1] );
          break;
      }
    }

  }

  // Ensure we have a term arguments to work with
  if( empty( $term_args ) ) {
    return $tag;
  }

  // Merge dynamic arguments with static arguments
  $term_args = array_merge( $term_args, array(
    'hide_empty' => false,
    'parent' => 0
  ) );

  $terms = get_terms( $term_args );

  // Add terms to values
  if( ! empty( $terms ) && ! is_wp_error( $term_args ) ) {

    foreach( $terms as $term ) {

      $tag['values'][] = $term->name;

    }

  }

  return $tag;

}
add_filter( 'wpcf7_form_tag', 'dynamic_select_list', 10 );



function custom_validation( $result, $tag ) {
  $tag = new WPCF7_Shortcode($tag);
  $result = (object)$result;

  $name = 'kommentar';

  if ( $name == $tag->name ) {
    $comment = isset( $_POST[$name] ) ? trim( wp_unslash( (string) $_POST[$name] ) ) : '';
    $file = isset( $_POST["upload"] );
    //$file = file_exists($_FILES['upload']['tmp_name']);

    if ( empty( $comment ) && empty( $file ) ) {
      $result->invalidate( $tag, "Bitte laden Sie entweder eine Datei hoch oder fügen Sie einen Kommentar hinzu." );
    }
  }

  return $result;
}
add_filter( 'wpcf7_validate_textarea', 'custom_validation', 1, 2 );