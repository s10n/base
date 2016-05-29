<?php
/* 스타일시트 및 자바스크립트 */
if ( ! defined( 'WP_ENV' ) ) define( 'WP_ENV', 'production' );
function akaiv_scripts() {
  $get_pkg = file_get_contents(get_template_directory() . '/package.json');
  $pkg     = json_decode($get_pkg, true);
  if (WP_ENV === 'development') :
    $assets = array(
      'js'        => '/scripts/'     . $pkg['name'] . '.js',
      'css'       => '/stylesheets/' . $pkg['name'] . '.css',
    );
  else :
    $get_versionsMapJS  = file_get_contents(get_template_directory() . '/scripts/versionsMapJS.json');
    $get_versionsMapCSS = file_get_contents(get_template_directory() . '/stylesheets/versionsMapCSS.json');
    $version_js         = json_decode($get_versionsMapJS, true)[0]['version'];
    $version_css        = json_decode($get_versionsMapCSS, true)[0]['version'];
    $assets     = array(
      'js'        => '/scripts/'     . $pkg['name'] . '.min.' . $version_js  . '.js',
      'css'       => '/stylesheets/' . $pkg['name'] . '.min.' . $version_css . '.css',
    );
  endif;
  // if( is_archive() ) { wp_enqueue_script( 'jquery-masonry' ); }
  wp_enqueue_style(  'project-style',    get_template_directory_uri() . $assets['css'], $deps = null, $ver = null );
  wp_enqueue_script( 'project-script',   get_template_directory_uri() . $assets['js'], array( 'jquery' ), $ver = null, $in_footer = true );
}
add_action( 'wp_enqueue_scripts', 'akaiv_scripts' );
