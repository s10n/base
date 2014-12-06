<?php
/* 메타: 루프 바깥에서 */
function akaiv_meta($meta = null) {
  if ( ! $meta ) return;

  if ( $meta == 'title' ) :
    akaiv_title();

  elseif ( $meta == 'url' ) :
    akaiv_url();

  elseif ( $meta == 'description' ) :
    if ( is_archive() ) :
      akaiv_the_archive_description();
    elseif ( is_single() ) :
      $excerpt = strip_tags(get_the_excerpt());
      if ( ! $excerpt ) :
        $queried_object = get_queried_object();
        $excerpt = akaiv_trim_excerpt( $queried_object->post_content );
      endif;
      echo $excerpt;
    else:
      return;
    endif;

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
  elseif ( is_post_type_archive() ) :
    $canonical = get_post_type_archive_link( get_query_var( 'post_type' ) );
  else :
    $canonical = '';
  endif;

  return $canonical;
}
