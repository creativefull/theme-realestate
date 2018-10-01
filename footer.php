<?php $myhome_footer = new My_Home_Footer(); ?>

<footer
	class="mh-footer-top mh-background-cover <?php echo esc_attr( $myhome_footer->get_class() ); ?>"
	<?php if ( $myhome_footer->has_background_image() ) : ?>
		style="<?php echo esc_attr( $myhome_footer->get_style() ); ?> background-image: url(<?php echo esc_url( wp_get_attachment_image_url( $myhome_footer->get_background_image_id(), 'full' ) ); ?>);"
	<?php endif; ?>
>

	<?php if ( $myhome_footer->has_widget_area() ) : ?>

		<div class="mh-footer__inner">
			<div class="mh-layout">
				<div class="mh-footer__row">

					<?php if ( $myhome_footer->has_information() ) : ?>

						<div class="mh-footer__row__column widget <?php echo esc_attr( $myhome_footer->get_widget_class() ); ?>">

							<?php if ( $myhome_footer->has_logo() ) : ?>
								<div class="mh-footer__logo">
									<img
										src="<?php echo esc_url( $myhome_footer->get_logo() ); ?>"
										alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
									>
								</div>
							<?php endif; ?>

							<?php if ( $myhome_footer->has_text() ) : ?>
								<div class="mh-footer__text">
									<?php echo esc_html( $myhome_footer->get_text() ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $myhome_footer->has_address() ) : ?>
								<address class="mh-footer__contact">
									<i class="flaticon-pin"></i>
									<?php echo esc_html( $myhome_footer->get_address() ); ?>
								</address>
							<?php endif; ?>

							<?php if ( $myhome_footer->has_phone() ) : ?>
								<div class="mh-footer__contact">
									<a href="tel:<?php echo esc_attr( $myhome_footer->get_phone_href() ) ?>">
										<i class="flaticon-phone"></i>
										<?php echo esc_html( $myhome_footer->get_phone() ); ?>
									</a>
								</div>
							<?php endif; ?>

							<?php if ( $myhome_footer->has_email() ) : ?>
								<div class="mh-footer__contact">
									<a href="mailto:<?php echo esc_attr( $myhome_footer->get_email() ) ?>">
										<i class="flaticon-mail-2"></i>
										<?php echo esc_html( $myhome_footer->get_email() ); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>

					<?php endif; ?>

					<?php
					if ( is_active_sidebar( 'mh-sidebar-footer' ) ) :
						dynamic_sidebar( 'mh-sidebar-footer' );
					endif;
					?>

				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $myhome_footer->has_copyrights() ) : ?>

		<div class="mh-footer-bottom <?php echo esc_attr( $myhome_footer->get_bottom_class() ); ?>">
			<div class="mh-layout">
				<?php echo wp_kses_post( $myhome_footer->get_copyrights() ); ?>
			</div>
		</div>

	<?php endif; ?>

</footer>
<?php
if ( $myhome_footer->is_compare_enabled() ) :
	My_Home_Theme()->layout->compare();
endif;
wp_footer();
?>

</body>
</html>
