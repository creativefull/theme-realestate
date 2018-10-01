<?php
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

		<?php if ( have_posts() ) : ?>

            <div class="mh-grid">

                <?php while ( have_posts() ) : the_post();

                    $myhome_archive_style = My_Home_Theme()->layout->get_archive_style();
                    if ( $myhome_archive_style == 'vertical' ) :  ?>
                        <div class="mh-grid__1of1">
                            <?php get_template_part( 'templates/post', 'vertical' ); ?>
                        </div>
                    <?php elseif ( $myhome_archive_style == 'vertical-2x' ) : ?>
                        <div class="mh-grid__1of2">
                            <?php get_template_part( 'templates/post', 'vertical' ); ?>
                        </div>
                    <?php elseif ( $myhome_archive_style == 'vertical-3x' ) : ?>
                        <div class="mh-grid__1of3">
                            <?php get_template_part( 'templates/post', 'vertical' ); ?>
                        </div>
                    <?php elseif ( $myhome_archive_style == 'vertical-4x' ) : ?>
                        <div class="mh-grid__1of4">
                            <?php get_template_part( 'templates/post', 'vertical' ); ?>
                        </div>
                    <?php endif;

                endwhile; ?>

            </div>

			<?php if ( paginate_links() ): ?>
				<div class="mh-pagination">
					<?php My_Home_Theme()->layout->pagination(); ?>
				</div>
			<?php endif; ?>

		<?php endif; ?>

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
