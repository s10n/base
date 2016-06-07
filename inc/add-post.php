<?php
/* 전달받은 폼을 새 포스트에 추가 */
if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) :
  if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'add-post_'.get_current_user_id() ) ) :
    die( 'Security check' );
  elseif ( add_post( $_POST['post'] ) ) :
    wp_redirect( home_url() );
    die();
  else :
    $error = true;
  endif;
endif;

/* 새 포스트 추가 함수 */
function add_post( $post ) {

  if ( empty( $post['title'] ) )
    return false;

  $args = array(
    // 'post_date'     => $post['date'],
    'post_title'    => $post['title'],
    'post_excerpt'  => $post['excerpt'],
    'post_category' => array( $post['category_id'] ),
    'tags_input'    => array( $post['tags_input'] ),
    'post_status'   => 'publish',
    'post_type'     => 'post',
  );

  $post_id = wp_insert_post( $args );
  if ( is_wp_error( $post_id ) )
    return false;

  update_post_meta( $post_id, 'wpcf-url', $post['url'] );
  return true;

}
