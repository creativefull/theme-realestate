<?php
/* @var \MyHomeCore\Estates\Estate_Writer */
global $myhome_estate;
?>

<aside class="mh-layout__sidebar-right <?php if ( $myhome_estate->is_sidebar_sticky() ) : ?>mh-layout__sidebar--sticky<?php endif; ?>">

	<?php if ( $myhome_estate->is_gallery_type() && ( $myhome_estate->has_price() || $myhome_estate->has_map() || $myhome_estate->agent->has_phone() ) ) : ?>
		<div class="mh-display-desktop">
			<div class="position-relative">
				<div class="mh-estate__details">

					<?php if ( $myhome_estate->has_price() ) : ?>
						<div class="mh-estate__details__price">
							<div>
								<?php foreach ( $myhome_estate->get_prices() as $myhome_price ) : ?>
									<div class="mh-estate__details__price__single"><?php echo $myhome_price->get_formatted(); ?></div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $myhome_estate->agent->has_phone() ) : ?>
						<div class="mh-estate__details__phone">
							<a href="tel:<?php echo esc_attr( $myhome_estate->agent->get_phone_href() ); ?>">
								<i class="flaticon-phone"></i> <?php echo esc_html( $myhome_estate->agent->get_phone() ); ?>
							</a>
						</div>
					<?php endif; ?>

                    <?php if ( $myhome_estate->has_map() ) : ?>
                        <div class="mh-estate__details__map">
                            <a href="#map" class="smooth">
                                <i class="flaticon-pin"></i> <?php esc_html_e( 'See Map', 'myhome' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

					<?php if ( $myhome_estate->has_sidebar_elements() ) : ?>
						<?php foreach ( $myhome_estate->get_sidebar_elements() as $myhome_sidebar_element ) : ?>
							<div class="mh-estate__cta">

                                <?php if ( $myhome_sidebar_element->has_link() ) : ?>
                                <a
                                        href="<?php echo esc_url( $myhome_sidebar_element->get_link() ); ?>"
                                        title="<?php echo esc_attr( $myhome_sidebar_element->get_text() ); ?>"
                                        target="_blank"
                                >
                                    <?php endif; ?>

								<?php if ( $myhome_sidebar_element->has_image() ) : ?>
									<img src="<?php echo esc_url( $myhome_sidebar_element->get_image() ); ?>);">
								<?php endif; ?>

                                    <div class="mh-estate__cta__text">
									    <?php echo esc_html( $myhome_sidebar_element->get_text() ); ?>
                                    </div>

									<?php if ( $myhome_sidebar_element->has_link() ) : ?>
								</a>
							<?php endif; ?>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	if ( $myhome_estate->has_contact_form() ) :
		$myhome_estate->contact_form();
	endif;

	if ( $myhome_estate->has_user_profile() ) :
		$myhome_estate->user_profile();
	endif;

	dynamic_sidebar( 'mh-property-sidebar' );
	?>
</aside>