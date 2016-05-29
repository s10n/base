<?php
/* 본문 폭 */
$content_width = 1140;

/* 테마 설정 */
function akaiv_setup_theme() {
  register_nav_menu( 'gnb', '주 메뉴' );
  // add_image_size( 'name-1x', $width, $height, $crop );
  // add_image_size( 'name-2x', $width, $height, $crop );
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
  // add_theme_support( 'post-formats', array( '...' ) );
  $get_pkg = file_get_contents(get_template_directory() . '/package.json');
  $pkg     = json_decode($get_pkg, true);
  add_editor_style( 'stylesheets/' . $pkg['name'] . '.css' );
  add_filter( 'use_default_gallery_style', '__return_false' );
  show_admin_bar( false );
  // load_theme_textdomain( 'project', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'akaiv_setup_theme' );
