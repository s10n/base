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
function akaiv_head() { ?>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.png">

  <?php if ( is_singular() ) : ?>
  <meta property="og:title" content="<?php single_post_title(); ?>">
  <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
  <meta property="og:url" content="<?php the_permalink(); ?>">
  <meta property="og:type" content="article">
  <?php
    $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    if ($fb_image) :
      echo '<meta property="og:image" content="'.$fb_image[0].'">';
    endif;
  ?>

  <?php else : ?>
  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/fb-image.jpg">

  <?php endif;
}
add_action('wp_head', 'akaiv_head');
