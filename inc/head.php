<?php
/* <title> */
function akaiv_title() {
  wp_title( '|', true, 'right');
}
function akaiv_wp_title( $title, $sep ) {
  if ( is_feed() )
    return $title;

  $title            = akaiv_page_title();
  $site_name        = get_bloginfo( 'name', 'display' );
  $site_description = get_bloginfo( 'description', 'display' );

  if ( is_home() || is_front_page() ) :
    if ( ! $site_description ) : return;
    else : $title = "$title $sep $site_description";
    endif;

  else :
    $title = "$title $sep $site_name";

  endif;
  return $title;
}
add_filter( 'wp_title', 'akaiv_wp_title', 10, 2 );

/* <head>: 파비콘, 메타 */
function akaiv_add_opengraph_namespace( $input ) {
  return $input.' prefix="og: http://ogp.me/ns#"';
}
add_filter( 'language_attributes', 'akaiv_add_opengraph_namespace' );
function akaiv_head() { ?>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.png">

  <!-- 검색엔진최적화 - http://simcheolhwan.com -->
  <?php $fb_image = get_template_directory_uri().'/images/fb-image.jpg'; ?>

  <?php if ( is_404() ) : ?>
    <meta name="robots" content="noindex,follow">
    <meta property="og:title" content="<?php akaiv_title(); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_search() ) : ?>
    <meta name="robots" content="noindex,follow">
    <link rel="canonical" href="<?php akaiv_url(); ?>">
    <meta property="og:title" content="<?php akaiv_title(); ?>">
    <meta property="og:url" content="<?php akaiv_url(); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_archive() ) : ?>
    <link rel="canonical" href="<?php akaiv_url(); ?>">
    <meta property="og:title" content="<?php akaiv_title(); ?>">
    <meta property="og:url" content="<?php akaiv_url(); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_singular() ) : ?>
    <meta property="og:title" content="<?php akaiv_title(); ?>">
    <meta property="og:url" content="<?php akaiv_url(); ?>">
    <meta property="og:type" content="article"><?php
    if ( is_single() ) :
      $excerpt = strip_tags(get_the_excerpt());
      $section = get_the_category()[0]->cat_name;
      $tags    = get_the_tags();
      if ( $excerpt ) : ?>
        <meta name="description" content="<?php echo $excerpt; ?>">
        <meta property="og:description" content="<?php echo $excerpt; ?>"><?php
      endif; ?>
      <meta property="article:section" content="<?php echo $section; ?>">
      <?php foreach ($tags as $tag) : ?>
        <meta property="article:tag" content="<?php echo $tag->name; ?>">
      <?php endforeach;
    endif;
    $author_id     = get_queried_object()->post_author;
    $author        = get_the_author_meta( 'display_name', $author_id );
    $time          = esc_attr( get_the_date( 'c' ) );
    $thumbnail_src = akaiv_get_post_thumbnail_src();
    $image         = ( $thumbnail_src ) ? $thumbnail_src : $fb_image; ?>
    <meta property="article:published_time" content="<?php echo $time; ?>">
    <meta property="article:author" content="<?php echo $author; ?>">

  <?php else : ?>
    <link rel="canonical" href="<?php akaiv_url(); ?>">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:type" content="website">

  <?php endif; ?>

  <?php if ( ! is_singular() ) $image = $fb_image; ?>
  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:image" content="<?php echo $image; ?>">
  <meta property="og:locale" content="<?php echo bloginfo( 'language' ); ?>">
  <!-- / 검색엔진최적화 --><?php
}
add_action('wp_head', 'akaiv_head');

/* <head>: 청소 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_generator' );
