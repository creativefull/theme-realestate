<?php
/*
 * Single
 */
get_header();
get_template_part( 'templates/top-title' );
?>
	<div class="mh-layout mh-top-title-offset">

		<?php if ( My_Home_Theme()->layout->get_sidebar_position() == 'left' ) : ?>

			<aside class="mh-layout__sidebar-left">
				<?php if ( My_Home_Theme()->layout->blog_custom_sidebar() ) : ?>
					<?php get_template_part( 'templates/sidebar', 'blog' ); ?>
				<?php else : ?>
					<?php get_template_part( 'templates/sidebar' ); ?>
				<?php endif; ?>
			</aside>

		<?php endif; ?>

		<div <?php My_Home_Theme()->layout->main_class(); ?>>

			<?php
			if ( have_posts() ):
				while ( have_posts() ) : the_post();
					get_template_part( 'templates/content', 'single' );

					wp_link_pages( array(
						'before'         => '<div class="mh-pagination mh-pagination--single-post">',
						'after'          => '</div>',
						'separator'      => '<span> </span>',
						'end_size'       => 1,
						'mid_size'       => 1,
						'link_before'    => '',
						'link_after'     => '',
						'next_or_number' => 'number',
						'pagelink'       => '%',
						'echo'           => 1
					) );

				endwhile;
			endif;

			if ( My_Home_Theme()->layout->show_tags() ) :
				My_Home_Theme()->layout->tags();
			endif;

			if ( My_Home_Theme()->layout->show_nav() ):
				get_template_part( 'templates/nav', 'single' );
			endif;

			if ( My_Home_Theme()->layout->show_author() ) :
				get_template_part( 'templates/author' );
			endif;

			if ( My_Home_Theme()->layout->show_related() ) :
				get_template_part( 'templates/related', 'posts' );
			endif;

			if ( My_Home_Theme()->layout->show_comments() ) :
				comments_template();
			endif;
			?>
		</div>

		<?php if ( My_Home_Theme()->layout->get_sidebar_position() == 'right' ) : ?>
			<aside class="mh-layout__sidebar-right">
				<?php if ( My_Home_Theme()->layout->blog_custom_sidebar() ) : ?>
					<?php get_template_part( 'templates/sidebar', 'blog' ); ?>
				<?php else : ?>
					<?php get_template_part( 'templates/sidebar' ); ?>
				<?php endif; ?>
			</aside>
		<?php endif; ?>

	</div>

<?php get_footer();
