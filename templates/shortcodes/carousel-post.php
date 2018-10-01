<?php
/* @var array $myhome_post_carousel */
global $myhome_post_carousel;
/* @var \WP_Query $myhome_posts */
global $myhome_posts;
global $post;

?>
	<div class="owl-carousel <?php echo esc_attr( $myhome_post_carousel['class'] ); ?>">
		<?php foreach ( $myhome_posts as $post ) : setup_postdata( $post ); ?>
			<article
				<?php post_class( 'mh-post-grid mh-post-grid--img-absolute ' . $myhome_post_carousel['posts_style'] ); ?>>
				<a href="<?php the_permalink(); ?>"
				   title="<?php the_title_attribute(); ?>"
				   class="mh-post-grid__thumbnail">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mh-thumbnail__inner ">
							<?php \MyHomeCore\Common\Image::the_image( get_post_thumbnail_id(), 'standard', get_the_title() ); ?>
						</div>
						<span class="mh-caption">
								<span class="mh-caption__inner"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
							</span>
					<?php endif; ?>
				</a>
				<div class="mh-post-grid__inner">
					<h3 class="mh-post-grid__heading">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php echo esc_html( get_the_title() ); ?>
						</a>
					</h3>
					<div class="mh-post-grid__excerpt">
						<?php echo esc_html( wp_trim_words( get_the_excerpt(), 35, '...' ) ); ?>
					</div>
					<div class="mh-post-grid__btn-wrapper">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"
						   class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary-ghost">
							<?php echo esc_html( $myhome_post_carousel['read_more_text'] ); ?>
						</a>
					</div>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
<?php
wp_reset_postdata();
