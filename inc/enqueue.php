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
