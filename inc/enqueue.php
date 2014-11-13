<?php
/* 스타일시트 및 자바스크립트 */
if ( ! defined( 'WP_ENV' ) ) define( 'WP_ENV', 'production' );
function akaiv_scripts() {
  if (WP_ENV === 'development') :
    $assets = array(
      'css'       => '/css/style.css',
      'js'        => '/js/script.js',
      'modernizr' => '/assets/modernizr/modernizr.js'
    );
  else :
    $assets     = array(
      'css'       => '/css/style.min.css',
      'js'        => '/js/script.min.js',
      'modernizr' => '/js/modernizr.min.js'
    );
  endif;
  wp_enqueue_style(  'project-style',    get_template_directory_uri() . $assets['css']);
  // wp_enqueue_script( 'modernizr',        get_template_directory_uri() . $assets['modernizr'], array(), null, true);
  // if( is_archive() ) { wp_enqueue_script( 'jquery-masonry' ); }
  wp_enqueue_script( 'project-script',   get_template_directory_uri() . $assets['js'], array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'akaiv_scripts' );

/* <head>: 파비콘, 오픈그래프 메타 */
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

/* <title> */
function akaiv_wp_title( $title, $sep ) {
  if ( is_feed() )
    return $title;
  $title .= get_bloginfo( 'name', 'display' );
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";
  return $title;
}
add_filter( 'wp_title', 'akaiv_wp_title', 10, 2 );
