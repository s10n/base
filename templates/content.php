<?php akaiv_before_post(); ?>

<?php akaiv_post_thumbnail(); ?>

<header class="entry-header">
  <h1 class="entry-title">
    <a href="<?php akaiv_the_url(); ?>" target="_blank" rel="bookmark"><?php akaiv_the_title(); ?></a>
  </h1>
</header>

<section class="entry-summary">
  <p><?php the_excerpt(); ?></p>
</section>

<section class="entry-meta">
  <?php akaiv_entry_meta( 'category', 'fa-folder-open' ); ?>
  <?php akaiv_entry_meta( 'tag', 'fa-tag' ); ?>
  <?php akaiv_entry_meta( 'date', 'fa-clock-o' ); ?>
  <?php akaiv_edit_post_link( 'left', 'fa-pencil' ); ?>
</section>

<?php akaiv_after_post(); ?>
