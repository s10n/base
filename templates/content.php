<?php akaiv_before_post(); ?>

<?php if ( is_single() ) : /* 글 */ ?>

  <header class="entry-header">
    <h1 class="entry-title">
      <?php akaiv_the_title(); ?>
    </h1>
    <section class="entry-meta">
      <?php akaiv_entry_meta( 'category', 'fa-folder-open' ); ?>
      <?php akaiv_entry_meta( 'date', 'fa-clock-o' ); ?>
      <?php akaiv_entry_meta( 'author', 'fa-user' ); ?>
      <?php akaiv_edit_post_link( 'left', 'fa-pencil' ); ?>
    </section>
  </header>

  <?php akaiv_post_thumbnail(); ?>

  <section class="entry-content">
    <?php the_content(); ?>
  </section>

  <?php if ( has_tag() ) : ?>
    <footer class="entry-meta">
      <?php akaiv_entry_meta('tag'); ?>
    </footer>
  <?php endif; ?>

<?php else : /* 목록 */ ?>

  <div class="row">
    <div class="col-xs-3 col-sm-2">
      <?php akaiv_post_thumbnail(); ?>
    </div>

    <div class="col-xs-9 col-sm-10">
      <header class="entry-header">
        <h1 class="entry-title">
          <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php akaiv_the_title(); ?></a>
        </h1>
      </header>
      <section class="entry-summary">
        <?php the_excerpt(); ?>
      </section>
    </div>
  </div>

<?php endif; ?>

<?php akaiv_after_post(); ?>
