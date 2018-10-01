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
        <?php if ( My_Home_Theme()->layout->get_archive_style() == 'vertical-2x' || My_Home_Theme()->layout->get_archive_style() == 'vertical-3x' || My_Home_Theme()->layout->get_archive_style() == 'vertical-4x') : ?>
        <div class="mh-grid mh-post-grid--img-absolute">
            <?php else: ?>
            <div class="mh-grid">
                <?php endif; ?>
                <?php if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        if ( My_Home_Theme()->layout->get_archive_style() == 'vertical' ) :  ?>
                            <div class="mh-grid__1of1">
                                <?php get_template_part( 'templates/post', 'vertical' ); ?>
                            </div>
                        <?php elseif ( My_Home_Theme()->layout->get_archive_style() == 'vertical-2x' ) : ?>
                            <div class="mh-grid__1of2">
                                <?php get_template_part( 'templates/post', 'vertical' ); ?>
                            </div>
                        <?php elseif ( My_Home_Theme()->layout->get_archive_style() == 'vertical-3x' ) : ?>
                            <div class="mh-grid__1of3">
                                <?php get_template_part( 'templates/post', 'vertical' ); ?>
                            </div>
                        <?php elseif ( My_Home_Theme()->layout->get_archive_style() == 'vertical-4x' ) : ?>
                            <div class="mh-grid__1of4">
                                <?php get_template_part( 'templates/post', 'vertical' ); ?>
                            </div>
                        <?php
                        endif;
                    endwhile;

                    if ( paginate_links() ) : ?>
                        <div class="mh-pagination">
                            <?php My_Home_Theme()->layout->pagination(); ?>
                        </div>
                    <?php endif;
                else: ?>
                    <h2>
                        <?php esc_html_e( 'No results', 'myhome' ); ?>
                    </h2>
                <?php endif; ?>
            </div>
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

<?php
get_footer();
