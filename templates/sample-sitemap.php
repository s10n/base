<?php akaiv_page_header('사이트맵'); ?>

<section class="page-content sitemap">

  <div class="row">
    <div class="col-sm-4">
      <h1>모든 페이지</h1>
      <ul class="sitemap-pages">
        <?php wp_list_pages('title_li='); ?>
      </ul>
    </div>

    <div class="col-sm-4">
      <h1>모든 날짜</h1>
      <ul class="sitemap-archives">
        <?php wp_get_archives('show_post_count=true'); ?>
      </ul>
    </div>

    <div class="col-sm-4">
      <h1>모든 태그</h1>
      <div class="sitemap-tags"><?php
        $args = array (
          'orderby' => 'count',
          'order'   => 'DESC'
        );
        $tags = get_tags( $args );
        $html = '<span class="tag-links">';
        foreach ( $tags as $tag ) :
          $tag_link = get_tag_link( $tag->term_id );
          $html .= "<a href=\"{$tag_link}\" class=\"label label-default\">{$tag->name} {$tag->count}</a> ";
        endforeach;
        $html .= '</span>';
        echo $html; ?>
      </div>

      <h1>모든 저자</h1>
      <ul class="sitemap-authors">
        <?php wp_list_authors('optioncount=1'); ?>
      </ul>
    </div>
  </div>

  <hr>

  <h1>모든 카테고리와 모든 글</h1>
  <section class="sitemap-category"><?php
    $category = get_terms('category');
    foreach($category as $cat) :
      $cat_id = $cat->term_id;
      $args = array (
        'cat'                    => $cat_id,
        'category__in'           => $cat_id,
        'posts_per_page'         => -1,
        'order'                  => 'ASC'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() && $query->post_count > 1 ) : ?>
        <div class="panel panel-default">
          <div class="panel-heading strong">
            <a href="<?php echo get_category_link( $cat_id ); ?>"><?php echo get_cat_name($cat_id); ?></a>
          </div>
          <div class="panel-body"><?php
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <article <?php post_class(); ?>>
                <div class="entry-meta">
                  <span class="post-format">
                    <?php if ( has_post_format() ) : ?>
                      <a class="entry-format" href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>"></a>
                    <?php else : ?>
                      <span class="entry-format"></span>
                    <?php endif; // 글 형식 ?>
                  </span>
                </div>
                <?php if ( ! get_the_title() ) : ?>
                  <a href="<?php the_permalink(); ?>" class="entry-title no-title">(제목이 없는 글)</a>
                <?php else : ?>
                  <a href="<?php the_permalink(); ?>" class="entry-title "><?php the_title(); ?></a>
                <?php endif; ?>
              </article><?php
            endwhile; // End while : 글 ?>
          </div>
        </div><?php
      endif; // 글을 2개 이상 가진 카테고리
      wp_reset_postdata();
    endforeach; // 각 카테고리 ?>
  </section>

</section>
