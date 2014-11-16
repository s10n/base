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
        $term_description = term_description();
        if ( empty( $term_description ) ) :
          akaiv_page_title();
        else :
          akaiv_page_title();
          echo '<small class="taxonomy-description">'.$term_description.'</small>';
        endif;
      else :
        akaiv_page_title();
      endif; ?>
    </h1>
  </header><?php
}

/* 페이지 제목 */
function akaiv_page_title() {
  if ( is_404() ) :
    echo 'Not Found';

  elseif ( is_search() ) :
    printf( '검색 결과: %s', get_search_query() );

  elseif ( is_archive() ) :
        if ( is_tax( 'post_format', 'post-format-aside'   ) ) : echo '추가 정보';
    elseif ( is_tax( 'post_format', 'post-format-image'   ) ) : echo '이미지';
    elseif ( is_tax( 'post_format', 'post-format-video'   ) ) : echo '비디오';
    elseif ( is_tax( 'post_format', 'post-format-audio'   ) ) : echo '오디오';
    elseif ( is_tax( 'post_format', 'post-format-quote'   ) ) : echo '인용';
    elseif ( is_tax( 'post_format', 'post-format-link'    ) ) : echo '링크';
    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) : echo '갤러리';
    elseif ( is_tax( 'post_format', 'post-format-status'  ) ) : echo '상태';
    elseif ( is_tax( 'post_format', 'post-format-chat'    ) ) : echo '챗';
    elseif ( is_category() ) : single_cat_title();
    elseif ( is_tag()      ) : single_tag_title();
    elseif ( is_author()   ) : the_post(); echo get_the_author().'의 모든 글'; rewind_posts();
    elseif ( is_year()     ) : echo get_the_date( 'Y년' );
    elseif ( is_month()    ) : echo get_the_date( 'Y년 F' );
    elseif ( is_day()      ) : echo get_the_date();
    else                     : echo '보관함';
    endif;

  elseif ( is_singular() ) :
    echo get_the_title();

  else :
    echo get_bloginfo( 'name', 'display' );

  endif;
}

/* 페이지 주소 */
function akaiv_url() {
  if ( is_search() ) :
    $canonical = get_search_link();

  elseif ( is_archive() ) :
        if ( is_tax( 'post_format' ) ) : $canonical = get_term_link( get_query_var( 'post_format' ), 'post_format' );
    elseif ( is_category()           ) : $canonical = get_term_link( get_query_var( 'cat' ), 'category' );
    elseif ( is_tag()                ) : $canonical = get_term_link( get_query_var( 'tag' ), 'post_tag' );
    elseif ( is_author()             ) : $canonical = get_author_posts_url( get_query_var( 'author' ), get_query_var( 'author_name' ) );
    elseif ( is_year()               ) : $canonical = get_year_link(  get_query_var( 'year' ) );
    elseif ( is_month()              ) : $canonical = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
    elseif ( is_day()                ) : $canonical = get_day_link(   get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
    else                               : $canonical = '';
    endif;

  elseif ( is_singular() ) :
    $canonical = get_permalink();

  else :
    $canonical = home_url( '/' );

  endif;
  echo esc_url( $canonical );
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

/* 타이틀 */
function akaiv_title() {
  wp_title( '|', true, 'right');
}

/* 메타: 루프 바깥에서 */
function akaiv_meta($meta = null) {
  if ( ! $meta ) return;

  if ( $meta == 'title' ) :
    akaiv_title();

  elseif ( $meta == 'url' ) :
    akaiv_url();

  elseif ( $meta == 'description' ) :
    $excerpt = strip_tags(get_the_excerpt());
    if ( ! $excerpt ) :
      $queried_object = get_queried_object();
      $excerpt = akaiv_trim_excerpt( $queried_object->post_content );
    endif;
    echo $excerpt;

  elseif ( $meta == 'section' ) :
    echo get_the_category()[0]->cat_name;

  elseif ( $meta == 'tags' ) :
    $tags = get_the_tags();
    if ( ! $tags ) $tags = array();
    return $tags;

  elseif ( $meta == 'time' ) :
    echo esc_attr( get_the_date( 'c' ) );

  elseif ( $meta == 'author' ) :
    $queried_object = get_queried_object();
    $author_id = $queried_object->post_author;
    echo get_the_author_meta( 'display_name', $author_id );

  elseif ( $meta == 'image' ) :
    $fb_image = get_template_directory_uri().'/images/fb-image.jpg';
    if ( is_singular() ) :
      $thumbnail_src = akaiv_get_post_thumbnail_src();
      $image         = ( $thumbnail_src ) ? $thumbnail_src : $fb_image;
    else :
      $image = $fb_image;
    endif;
    echo $image;

  else :
    return;

  endif;
}

/* 요약 생성 */
function akaiv_trim_excerpt($text = '') {
  /** wp-includes/formatting.php에서 wp_trim_excerpt() 함수를 복제 */
  $text = strip_shortcodes( $text );
  $text = apply_filters( 'the_content', $text );
  $text = str_replace(']]>', ']]&gt;', $text);
  $excerpt_length = apply_filters( 'excerpt_length', 55 );
  $excerpt_more = apply_filters( 'excerpt_more', ' ' . '&hellip;' );
  $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  return $text;
}
