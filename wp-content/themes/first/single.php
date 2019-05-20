<?php get_header();

global $post;
$post_slug = $post->post_type;
get_template_part( 'template-parts/single/single', $post_slug );

get_footer(); ?>
