<?php
/* <title> */
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

/* <head>: IE8 대응, 메타, 파비콘 */
function akaiv_add_opengraph_namespace( $input ) {
  return $input.' prefix="og: http://ogp.me/ns#"';
}
add_filter( 'language_attributes', 'akaiv_add_opengraph_namespace' );
function akaiv_head() {
  if (WP_ENV != 'development') :
    echo '<!--[if lt IE 9]>';
    echo '<script src="' . esc_url( get_template_directory_uri() ) . '/assets/html5shiv/dist/html5shiv.min.js"></script>';
    echo '<script src="' . esc_url( get_template_directory_uri() ) . '/assets/respond/dest/respond.min.js"></script>';
    echo '<![endif]-->';
  endif; ?>

  <!-- 검색엔진최적화 - http://simcheolhwan.com -->
  <?php if ( is_404() ) : ?>
    <meta name="robots" content="noindex,follow">
    <meta property="og:title" content="<?php akaiv_meta( 'title' ); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_search() ) : ?>
    <meta name="robots" content="noindex,follow">
    <link rel="canonical" href="<?php akaiv_meta( 'url' ); ?>">
    <meta property="og:title" content="<?php akaiv_meta( 'title' ); ?>">
    <meta property="og:url" content="<?php akaiv_meta( 'url' ); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_archive() ) : ?>
    <meta name="robots" content="noindex,follow">
    <meta name="description" content="<?php akaiv_meta( 'description' ); ?>">
    <link rel="canonical" href="<?php akaiv_meta( 'url' ); ?>">
    <meta property="og:title" content="<?php akaiv_meta( 'title' ); ?>">
    <meta property="og:url" content="<?php akaiv_meta( 'url' ); ?>">
    <meta property="og:type" content="object">
    <meta property="og:description" content="<?php akaiv_meta( 'description' ); ?>">

  <?php elseif ( is_singular() ) : ?>
    <meta property="og:title" content="<?php akaiv_meta( 'title' ); ?>">
    <meta property="og:url" content="<?php akaiv_meta( 'url' ); ?>">
    <meta property="og:type" content="article">
    <?php if ( is_single() ) : ?>
      <meta name="description" content="<?php akaiv_meta( 'description' ); ?>">
      <meta property="og:description" content="<?php akaiv_meta( 'description' ); ?>">
      <meta property="article:section" content="<?php akaiv_meta( 'section' ); ?>">
      <?php foreach ( akaiv_meta( 'tags' ) as $tag ) : ?>
        <meta property="article:tag" content="<?php echo $tag->name; ?>">
      <?php endforeach; ?>
    <?php endif; ?>
    <meta property="article:published_time" content="<?php akaiv_meta( 'time' ); ?>">
    <meta property="article:author" content="<?php akaiv_meta( 'author' ); ?>">

  <?php else : ?>
    <link rel="canonical" href="<?php akaiv_meta( 'url' ); ?>">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:type" content="website">

  <?php endif; ?>

  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:image" content="<?php akaiv_meta( 'image' ); ?>">
  <?php if ( is_singular() ) : ?>
    <?php foreach ( akaiv_meta( 'attachment_images' ) as $attachment_image ) : ?>
      <meta property="og:image" content="<?php echo $attachment_image; ?>">
    <?php endforeach; ?>
  <?php endif; ?>
  <meta property="og:locale" content="<?php bloginfo( 'language' ); ?>">
  <!-- / 검색엔진최적화 -->

  <!-- 파비콘 -->
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
  <!-- / 파비콘 --><?php
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
