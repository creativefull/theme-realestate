<?php

if ( post_password_required() ) {
	return;
}

if ( comments_open() ) :
	?>
	<section id="comments" class="mh-comments">
	<?php if ( have_comments() ) : ?>
	<header>
		<h3 class="mh-post-single__section__heading">
			<?php
			echo esc_html( sprintf(
				_nx( 'One Comment', '%1$s comments', get_comments_number(), 'comments title', 'myhome' ),
				number_format_i18n( get_comments_number() )
			) );
			?>
		</h3>
	</header>

	<?php
	if ( My_Home_Theme()->comments->show_nav() ) :
		My_Home_Theme()->comments->nav();
	endif;

	My_Home_Theme()->comments->display();

	if ( My_Home_Theme()->comments->show_nav() ) :
		My_Home_Theme()->comments->nav();
	endif;

	if ( ! comments_open() ) :
		My_Home_Theme()->comments->closed();
	endif;
endif;
	My_Home_Theme()->comments->form();

	?>
	</section><?php
endif;