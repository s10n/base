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
    else : $title = '$title $sep $site_description';
    endif;

  else :
    $title = '$title $sep $site_name';

  endif;
  return $title;
}
add_filter( 'wp_title', 'akaiv_wp_title', 10, 2 );

/* <head>: 메타, 오픈그래프, 파비콘 */
function akaiv_add_opengraph_namespace( $input ) {
  return $input.' prefix="og: http://ogp.me/ns#"';
}
add_filter( 'language_attributes', 'akaiv_add_opengraph_namespace' );

function akaiv_head() { ?>
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

  <meta property="og:locale" content="<?php bloginfo( 'language' ); ?>">
  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:image" content="<?php akaiv_meta( 'image' ); ?>">

  <?php if ( is_singular() ) : ?>
    <?php foreach ( akaiv_meta( 'attachment_images' ) as $attachment_image ) : ?>
      <meta property="og:image" content="<?php echo $attachment_image; ?>">
    <?php endforeach; ?>
  <?php endif; ?>

  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-android-chrome-36x36.png" sizes="36x36">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-android-chrome-48x48.png" sizes="48x48">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-android-chrome-72x72.png" sizes="72x72">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-android-chrome-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-android-chrome-144x144.png" sizes="144x144">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#545454">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-144x144.png">
  <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-70x70.png">
  <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-150x150.png">
  <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-310x310.png">
  <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-310x150.png">
  <meta name="application-name" content="<?php bloginfo( 'name' ); ?>">
  <meta name="theme-color" content="#545454"><?php
}
add_action('wp_head', 'akaiv_head');

/* <head>: 청소 */
remove_action( 'wp_head', 'rsd_link' );                                 // RSD
remove_action( 'wp_head', 'wlwmanifest_link' );                         // WLW (Windows Live Writer)
remove_action( 'wp_head', 'wp_shortlink_wp_head' );                     // Shortlink
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );        // Shortlink
remove_action( 'wp_head', 'feed_links', 2 );                            // Feed
remove_action( 'wp_head', 'feed_links_extra', 3 );                      // Feed
remove_action( 'wp_head', 'wp_generator' );                             // Generator
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );          // Emoji
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); // Emoji
remove_action( 'wp_print_styles', 'print_emoji_styles' );               // Emoji
remove_action( 'admin_print_styles', 'print_emoji_styles' );            // Emoji
