<?php
require_once 'inc/add-post.php';
get_header();
akaiv_before_main();

/* 관리자: 새 항목 추가 폼 */
if ( current_user_can( 'publish_posts' ) ) :
  require_once 'templates/form-add-post.php';
endif;

/* 첫 화면 내용 */
get_template_part( 'templates/content', 'front' );

/* 최근 글 목록 */
if ( have_posts() ) :
  akaiv_page_header();
  while ( have_posts() ) : the_post();
    get_template_part( 'templates/content' );
  endwhile;
  akaiv_paginate_links();
else :
  get_template_part( 'templates/content', 'none' );
endif;

akaiv_after_main();
get_footer();
