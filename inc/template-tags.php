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
    $title = sprintf( '보관함: %s', post_type_archive_title( '', false ) );
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
function akaiv_get_the_archive_description() {
  return term_description();
}

/* 페이지 주소 */
function akaiv_url() {
      if ( is_search()   ) : $canonical = get_search_link();
  elseif ( is_archive()  ) : $canonical = akaiv_get_archive_url();
  elseif ( is_singular() ) : $canonical = get_permalink();
  else : $canonical = home_url( '/' );
  endif;

  echo esc_url( $canonical );
}

/* 보관함 주소 */
function akaiv_get_archive_url() {
      if ( is_category() ) : $canonical = get_term_link( get_query_var( 'cat' ), 'category' );
  elseif ( is_tag()      ) : $canonical = get_term_link( get_query_var( 'tag' ), 'post_tag' );
  elseif ( is_author()   ) : $canonical = get_author_posts_url( get_query_var( 'author' ), get_query_var( 'author_name' ) );
  elseif ( is_year()     ) : $canonical = get_year_link(  get_query_var( 'year' ) );
  elseif ( is_month()    ) : $canonical = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
  elseif ( is_day()      ) : $canonical = get_day_link(   get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
  elseif ( is_tax( 'post_format' ) ) :
    $canonical = get_term_link( get_query_var( 'post_format' ), 'post_format' );
  else :
    $canonical = '';
  endif;

  return $canonical;
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

  elseif ( $meta == 'attachment_images' ) :
    $queried_object = get_queried_object();
    $args = array(
      'post_type'      => 'attachment',
      'posts_per_page' => -1,
      'post_parent'    => $queried_object->ID
    );
    $attachments = get_posts( $args );
    $attachment_images = array();
    if ( $attachments ) :
      foreach ( $attachments as $attachment ) :
        $attachment_images[] = akaiv_get_attachment_image_src( $attachment->ID, 'full' );
      endforeach;
    endif;
    return $attachment_images;

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
