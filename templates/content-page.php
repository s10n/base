<?php akaiv_before_post(); ?>

<?php akaiv_page_header(); ?>
<?php akaiv_post_thumbnail(); ?>
<div class="page-content">
  <?php the_content(); ?>
</div>
<?php akaiv_edit_post_link( 'right' ); ?>

<?php akaiv_after_post(); ?>
