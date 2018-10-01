<?php
get_header();
get_template_part( 'templates/top-title' );

if ( My_Home_Theme()->layout->has_breadcrumbs() ) :
	get_template_part( 'templates/breadcrumbs' );
endif;

?>
	<div class="mh-layout mh-top-title-offset">
		<?php
		$myhome_listing = new \MyHomeCore\Components\Listing\Archive_Listing();
		$myhome_listing->display();
		?>
	</div>
<?php

get_footer();