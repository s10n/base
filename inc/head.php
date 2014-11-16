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
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon-180x180.png">
  <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#00004d">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-144x144.png">
  <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-70x70.png">
  <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-150x150.png">
  <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-310x310.png">
  <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicon/mstile-310x150.png">
  <meta name="application-name" content="<?php bloginfo( 'name' ); ?>">

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
    $queried_object = get_queried_object();
    if ( is_single() ) :
      $excerpt = strip_tags(get_the_excerpt());

      if ( ! $excerpt ) :
        $text = $queried_object->post_content;
        $text = strip_shortcodes( $text );
        $text = apply_filters( 'the_content', $text );
        $text = str_replace(']]>', ']]&gt;', $text);
        $excerpt_length = apply_filters( 'excerpt_length', 55 );
        $excerpt_more = apply_filters( 'excerpt_more', ' ' . '&hellip;' );
        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
        $excerpt = $text;
      endif;

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
    $author_id     = $queried_object->post_author;
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
