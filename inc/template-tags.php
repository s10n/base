<?php
/* 본문 영역 시작 */
function akaiv_before_content() {
  // get_sidebar(); ?>
  <div id="content" class="site-content" role="main"><?php
}

/* 본문 영역 끝 */
function akaiv_after_content() { ?>
  </div><!-- #content --><?php
}

/* 페이지 헤더 */
function akaiv_page_header($heading = null) { ?>
  <header class="page-header">
    <h1 class="page-title"><?php
      if ( $heading ) :
        echo $heading;
      elseif ( is_archive() ) :
        akaiv_page_title();
        akaiv_the_archive_description( '<small class="taxonomy-description">', '</small>' );
      else :
        akaiv_page_title();
      endif; ?>
    </h1>
  </header><?php
}

/* 페이지 제목 */
function akaiv_page_title() {
      if ( is_404()      ) : echo 'Not Found';
  elseif ( is_search()   ) : printf( '검색 결과: %s', get_search_query() );
  elseif ( is_archive()  ) : akaiv_the_archive_title();
  elseif ( is_singular() ) : the_title();
  else : bloginfo( 'name' );
  endif;
}

/* 보관함 제목 */
function akaiv_the_archive_title() {
  $title = akaiv_get_the_archive_title();
  if ( ! empty( $title ) ) :
    echo $title;
  endif;
}
function akaiv_get_the_archive_title() {
      if ( is_category() ) : $title = sprintf( single_cat_title( '', false ) );
  elseif ( is_tag()      ) : $title = sprintf( '태그: %s', single_tag_title( '', false ) );
  elseif ( is_author()   ) : $title = sprintf( get_the_author() . '의 모든 글' );
  elseif ( is_year()     ) : $title = sprintf( get_the_date( 'Y년' ) );
  elseif ( is_month()    ) : $title = sprintf( get_the_date( 'Y년 F' ) );
  elseif ( is_day()      ) : $title = sprintf( get_the_date( 'Y년 F j일') );
  elseif ( is_tax( 'post_format', 'post-format-aside'   ) ) : $title = '추가 정보';
  elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) : $title = '갤러리';
  elseif ( is_tax( 'post_format', 'post-format-image'   ) ) : $title = '이미지';
  elseif ( is_tax( 'post_format', 'post-format-video'   ) ) : $title = '비디오';
  elseif ( is_tax( 'post_format', 'post-format-quote'   ) ) : $title = '인용';
  elseif ( is_tax( 'post_format', 'post-format-link'    ) ) : $title = '링크';
  elseif ( is_tax( 'post_format', 'post-format-status'  ) ) : $title = '상태';
  elseif ( is_tax( 'post_format', 'post-format-audio'   ) ) : $title = '오디오';
  elseif ( is_tax( 'post_format', 'post-format-chat'    ) ) : $title = '챗';
  elseif ( is_post_type_archive() ) :
    $title = post_type_archive_title( '', false );
  elseif ( is_tax() ) :
    $tax = get_taxonomy( get_queried_object()->taxonomy );
    $title = sprintf( '%1$s: %2$s', $tax->labels->singular_name, single_term_title( '', false ) );
  else :
    $title = '보관함';
  endif;

  return $title;
}

/* 보관함 설명 */
function akaiv_the_archive_description( $before = '', $after = '' ) {
  $description = akaiv_get_the_archive_description();
  if ( ! empty( $description ) ) :
    echo $before . $description . $after;
  endif;
}
remove_filter( 'term_description', 'wpautop' );
function akaiv_get_the_archive_description() {
  if ( ! is_post_type_archive() ) :
    return term_description();
  else :
    return get_queried_object( 'post_type' )->description;
  endif;
}

/* 보관함: 페이지네이션 */
function akaiv_paginate_links() {
  global $wp_query;
  if ( $wp_query->max_num_pages > 1 ) :
    echo '<nav class="nav-pagination">';
    $big = 999999999;
    $args = array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'after_page_number' => '<span class="screen-reader-text">번째 페이지</span>',
      'prev_next' => False,
      'type' => 'array'
    );
    $paginate_links = paginate_links( $args );
    if( is_array( $paginate_links ) ) :
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      echo '<ul class="pagination pagination-sm">';
      foreach ( $paginate_links as $page ) :
        if ( strpos($page, 'current') ) : echo '<li class="active">'.$page.'</li>';
        else : echo '<li>'.$page.'</li>';
        endif;
      endforeach;
      echo '</ul>';
    endif;
    echo '</nav>';
  endif;
}
