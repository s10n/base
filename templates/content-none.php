<?php akaiv_before_post( false ); ?>

<?php akaiv_page_header( '찾을 수 없습니다.' ); ?>

<section class="page-content">
  <p><?php
    if ( is_404() ) :
      echo '검색을 해보시겠습니까?';
    elseif ( is_search() ) :
      echo '검색어와 일치하는 것이 없습니다. 다른 검색어로 다시 시도해보세요.';
    else :
      echo '검색을 해보시겠습니까?';
    endif; ?>
  </p>
  <?php get_search_form(); ?>
</section>

<?php akaiv_after_post(); ?>
