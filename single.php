<?php
get_header();
akaiv_before_main(); ?>

<?php
while ( have_posts() ) : the_post();
  get_template_part( 'templates/content' );
  akaiv_post_navigation();
endwhile;
?>

<?php
akaiv_after_main();
get_footer();
