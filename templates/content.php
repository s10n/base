<?php akaiv_before_page(); ?>

<?php if ( is_single() ) : /* 글 */ ?>

  <header class="entry-header">
    <h1 class="entry-title">
      <?php akaiv_the_title(); ?>
    </h1>
    <div class="entry-meta">
      <?php akaiv_post_meta( 'category' ); ?>
      <?php akaiv_post_meta( 'date' ); ?>
      <?php akaiv_post_meta( 'author' ); ?>
      <?php akaiv_edit_post_link(); ?>
    </div>
  </header>
  <?php akaiv_post_thumbnail(); ?>
  <div class="entry-content">
    <?php the_content(); ?>
  </div>
  <div class="entry-meta">
    <span class="tag-links"><?php the_tags('', ' ', ''); ?></span>
  </div>

<?php else : /* 목록 */ ?>

  <div class="row">
    <div class="col-xs-3 col-sm-2">
      <?php akaiv_post_thumbnail(); ?>
    </div><!-- column: 썸네일 -->
    <div class="col-xs-9 col-sm-10">
      <header class="entry-header">
        <h1 class="entry-title">
          <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php akaiv_the_title(); ?></a>
        </h1>
      </header>
      <div class="entry-summary">
        <?php the_excerpt(); ?>
      </div>
    </div><!-- column: 제목과 요약 -->
  </div><!-- .row -->

<?php endif; ?>

<?php akaiv_after_page(); ?>
