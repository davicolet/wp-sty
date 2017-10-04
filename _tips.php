<?php
/**
* Tips of commands
*/


// Inner loop
if(have_posts()):
	while(have_posts()):the_post();

	endwhile;
endif;

// Out loop
$a = new wp_query(array(
	'posts_per_page' => 1,
	'post_type' => 'post'
));
if($a->have_posts()):
	while($a->have_posts()): $a->the_post();

	endwhile;
endif;


// Including external files
get_template_part('content', get_post_format());

// Commands
get_the_author_meta('ID');
