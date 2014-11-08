<?php
get_header();
akaiv_before_content(); ?>

<?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      get_template_part( 'templates/content' );
      akaiv_post_nav();
    endwhile;
  endif;
?>

<?php
akaiv_after_content();
get_footer();
