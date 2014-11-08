<?php
/* <body>: .singular.page-{slug} */
function akaiv_body_class( $classes ) {
  if ( is_singular() && ! is_front_page() ) :
    $classes[] = 'singular';
    if (!in_array(basename(get_permalink()), $classes)) :
      $classes[] = 'page-'.basename(get_permalink());
    endif;
  endif;
  return $classes;
}
add_filter( 'body_class', 'akaiv_body_class' );

/* <article>: .has-post-thumbnail */
function akaiv_post_class( $classes ) {
  if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) :
    $classes[] = 'has-post-thumbnail';
  endif;
  return $classes;
}
add_filter( 'post_class', 'akaiv_post_class' );
