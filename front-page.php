<?php
get_header();
akaiv_before_main();

get_template_part( 'templates/content', 'front' );

akaiv_after_main();
get_footer();
