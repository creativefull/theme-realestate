<?php

get_header();

if ( have_posts() ):
	/* @var \MyHomeCore\Estates\Estate_Writer $myhome_estate */
	global $myhome_estate;

	$myhome_estate = \MyHomeCore\Estates\Estate_Writer::get_instance();
	?>

	<article
		id="post-<?php echo esc_attr( get_the_ID() ); ?>"
		data-id="<?php echo esc_attr( get_the_ID() ); ?>"
		class="mh-post"
	>
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'templates/content-single', 'estate' );
		endwhile;
		?>
	</article>

<?php
endif;

get_footer();
