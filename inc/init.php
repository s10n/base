<?php
/* 테마 설정 */
function akaiv_setup_theme() {
  register_nav_menu( 'gnb', '주 메뉴' );
  // add_image_size( $name-1x, $width, $height, $crop );
  // add_image_size( $name-2x, $width, $height, $crop );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
  // add_theme_support( 'post-formats', array( '...' ) );
  add_editor_style( 'css/style.css' );
  add_filter( 'use_default_gallery_style', '__return_false' );
  show_admin_bar( false );
  // load_theme_textdomain( 'project', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'akaiv_setup_theme' );

/* 관리자: 포스트에서 일부 기능 제거 */
function akaiv_init() {
  remove_post_type_support( 'post', 'author' );
  remove_post_type_support( 'post', 'trackbacks' );
  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'author' );
  remove_post_type_support( 'page', 'trackbacks' );
  remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'akaiv_init' );

/* 관리자: 일부 메뉴 제거 */
function akaiv_remove_menus(){
  remove_menu_page( 'index.php' );         // Dashboard
  remove_menu_page( 'edit-comments.php' ); // Comments
}
add_action( 'admin_menu', 'akaiv_remove_menus' );

/* 관리자: 대시보드 - '환영합니다' 제거 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/* 관리자: 대시보드 - 메타 박스들 제거 */
function remove_dashboard_meta() {
  remove_meta_box( 'dashboard_right_now',   'dashboard', 'normal' ); // 사이트 현황
  remove_meta_box( 'dashboard_activity',    'dashboard', 'normal');  // 활동
  remove_meta_box( 'dashboard_primary',     'dashboard', 'normal' ); // 워드프레스 뉴스
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );   // 빠른 임시글
}
add_action( 'admin_init', 'remove_dashboard_meta' );
