<?php
/* 타이틀 */
function akaiv_title() {
  wp_title( '|', true, 'right');
}

/* 레티나 이미지 */
function akaiv_retina_image( $filename, $ext = 'png', $alt ) {
  $src    = akaiv_get_image( $filename .    '.' . $ext );
  $srcset = akaiv_get_image( $filename . '@2x.' . $ext . ' 2x' );
  list( $src_width, $src_height ) = getimagesize( $src );
  $hwstring = image_hwstring( $src_width, $src_height );
  echo '<img src="'.$src.'" alt="'.$alt.'" '.$hwstring.'srcset="'.$srcset.'">';
}

/* 테마 디렉토리의 이미지파일 리턴 */
function akaiv_get_image( $image ) {
  return get_template_directory_uri() . '/images/' . $image;
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
