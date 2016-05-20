<?php
/* 포스트 기능 제거 */
function akaiv_init() {
  remove_post_type_support( 'post', 'author' );
  remove_post_type_support( 'post', 'trackbacks' );
  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'author' );
  remove_post_type_support( 'page', 'trackbacks' );
  remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'akaiv_init' );

/* 메뉴 제거 */
function akaiv_remove_menus(){
  remove_menu_page( 'index.php' );         // Dashboard
  remove_menu_page( 'edit-comments.php' ); // Comments
}
add_action( 'admin_menu', 'akaiv_remove_menus' );

/* 대시보드 - '환영합니다' 제거 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/* 대시보드 - 메타 박스들 제거 */
function remove_dashboard_meta() {
  remove_meta_box( 'dashboard_right_now',   'dashboard', 'normal' ); // 사이트 현황
  remove_meta_box( 'dashboard_activity',    'dashboard', 'normal');  // 활동
  remove_meta_box( 'dashboard_primary',     'dashboard', 'normal' ); // 워드프레스 뉴스
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );   // 빠른 임시글
}
add_action( 'admin_init', 'remove_dashboard_meta' );
