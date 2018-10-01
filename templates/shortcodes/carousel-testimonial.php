<?php
/* @var array $myhome_testimonial_carousel */
global $myhome_testimonial_carousel;
/* @var WP_Post[] $myhome_testimonials */
global $myhome_testimonials;
global $post;

if ( count( $myhome_testimonials ) ) : ?>
	<div class="owl-carousel <?php echo esc_attr( $myhome_testimonial_carousel['class'] ); ?>">
		<?php foreach ( $myhome_testimonials as $post ) : setup_postdata( $post );
			$myhome_occupation = get_field( 'testimonial_occupation', $post->ID );
			?>
			<div class="item">
				<article class="mh-testimonial">
					<div class="mh-testimonial__inner">
						<blockquote class="mh-testimonial__text">
							<?php the_content(); ?>
						</blockquote>
						<div class="mh-testimonial__photo">
							<?php if ( has_post_thumbnail( $post->ID ) ) :
								\MyHomeCore\Common\Image::the_image(
									get_post_thumbnail_id( $post->ID ),
									'square',
									$post->post_title
								);
							endif; ?>
						</div>

						<?php if ( ! empty( $post->post_title ) || ! empty( $myhome_occupation ) ) : ?>
							<div class="mh-testimonial__author-info">
								<?php if ( ! empty( $post->post_title ) ) : ?>
									<h3 class="mh-testimonial__author">
										<?php echo esc_html( $post->post_title ); ?>
									</h3>
								<?php endif; ?>

								<?php if ( ! empty( $myhome_occupation ) ) : ?>
									<div class="mh-testimonial__occupation">
										<?php echo esc_html( $myhome_occupation ); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</article>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif;
wp_reset_postdata();