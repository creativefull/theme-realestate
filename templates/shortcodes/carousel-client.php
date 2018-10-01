<?php
/* @var \WP_Query $myhome_clients */
global $myhome_clients;
/* @var array $myhome_client_carousel */
global $myhome_client_carousel;

if ( $myhome_clients->have_posts() ) : ?>
	<div class="owl-carousel mh-clients <?php echo esc_attr( $myhome_client_carousel['class'] ); ?>">
		<?php while ( $myhome_clients->have_posts() ) : $myhome_clients->the_post();
			$myhome_client_link = get_field( 'client_link' );
			?>
			<div class="item">
				<div class="mh-client">
					<?php if ( ! empty( $myhome_client_link ) ) : ?>
					<a href="<?php echo esc_url( $myhome_client_link ); ?>" title="<?php the_title_attribute(); ?>"
					   target="_blank">
						<?php endif;
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'full' );
						else :
							the_title();
						endif;
						if ( ! empty( $myhome_client_link ) ) : ?>
					</a>
				<?php endif; ?>
				</div>
			</div>
		<?php endwhile;
		wp_reset_postdata(); ?>
	</div>
<?php endif;
