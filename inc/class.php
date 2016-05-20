<?php
/* <body class="singular page-{slug}"> */
function akaiv_body_class( $classes ) {
  if ( is_singular() && ! is_home() && ! is_front_page() ) :
    $classes[] = 'singular';
    $slug = basename(get_permalink());
    if ( ! is_single() && ! in_array($slug, $classes) ) :
      $classes[] = 'page-' . $slug;
    endif;
  endif;
  return $classes;
}
add_filter( 'body_class', 'akaiv_body_class' );

/* <article class="has-post-thumbnail"> */
function akaiv_post_class( $classes ) {
  if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() )
    $classes[] = 'has-post-thumbnail';
  return $classes;
}
add_filter( 'post_class', 'akaiv_post_class' );

/* 검색폼: submit 버튼에 .screen-reader-text 추가 */
function akaiv_search_form_modify( $html ) {
  return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'akaiv_search_form_modify' );
