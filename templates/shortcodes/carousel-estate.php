<?php
/* @var \MyHomeCore\Estates\Estates $myhome_estates */
global $myhome_estates;
/* @var array $myhome_estate_carousel */
global $myhome_estate_carousel;

?>
<div class="mh-carousel owl-carousel owl-properties <?php echo esc_attr( $myhome_estate_carousel['class'] ); ?>">
	<?php foreach ( $myhome_estates as $myhome_estate ) : ?>
		<div class="item">
			<article
				class="mh-estate-vertical <?php echo esc_attr( $myhome_estate->get_attribute_classes() . ' ' . $myhome_estate_carousel['estate_style'] ); ?>"
			>
				<a href="<?php echo esc_url( $myhome_estate->get_link() ); ?>"
				   title="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
				   class="mh-thumbnail"
					<?php if ( \MyHomeCore\Estates\Estate::is_new_tab() ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<div class="mh-thumbnail__inner">
						<?php if ( $myhome_estate->has_image() ) :
							\MyHomeCore\Common\Image::the_image(
								$myhome_estate->get_image_id(),
								'standard',
								$myhome_estate->get_name()
							);
						endif; ?>
					</div>

					<?php if ( $myhome_estate->is_featured() ) : ?>
						<div class="mh-thumbnail__featured">
							<i class="fa fa-star"></i>
						</div>
					<?php endif; ?>

					<?php
					$myhome_estate_offer_types = $myhome_estate->get_offer_type();
					if ( ! empty( $myhome_estate_offer_types ) ) : ?>
						<div class="mh-caption">

							<?php foreach ( $myhome_estate->get_offer_type() as $offer_type ) : ?>
								<?php if ( $offer_type->get_option( 'has_label' ) ) : ?>
									<div
										class="mh-caption__inner"
										style="background-color: <?php echo esc_attr( $offer_type->get_option( 'bg_color' ) ); ?>; color: <?php echo esc_attr( $offer_type->get_option( 'color' ) ); ?>"
									>
										<?php echo esc_html( $offer_type->get_name() ); ?>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>

						</div>
					<?php endif; ?>

					<div class="mh-estate-vertical__text">
						<div class="mh-estate-vertical__text__inner">
							<?php echo esc_html( $myhome_estate->get_excerpt() ); ?>
						</div>
					</div>
				</a>

				<div class="mh-estate-vertical__content">
					<h3 class="mh-estate-vertical__heading">
						<a href="<?php echo esc_url( $myhome_estate->get_link() ); ?>"
						   title="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
							<?php if ( \MyHomeCore\Estates\Estate::is_new_tab() ) : ?>
								target="_blank"
							<?php endif; ?>
						>
							<?php echo esc_html( $myhome_estate->get_name() ); ?>
						</a>
					</h3>

					<address class="mh-estate-vertical__subheading">
						<?php echo esc_html( $myhome_estate->get_address() ); ?>
					</address>

					<div class="mh-estate-vertical__primary">
						<?php if ( $myhome_estate->has_price() ) : ?>
							<?php foreach ( $myhome_estate->get_prices() as $myhome_price ) : ?>
								<div <?php if ( $myhome_price->is_range() ) : ?>class="mh-price__range" <?php endif; ?>>
									<?php echo esc_html( $myhome_price->get_formatted() ); ?>
								</div>
							<?php endforeach;; ?>
						<?php else : ?>
							<div class="mh-price__contact">
								<?php echo esc_html( $myhome_estate->get_contact_for_price_text() ); ?>
							</div>
						<?php endif; ?>
					</div>

					<div>
						<div class="mh-estate__list">
							<?php foreach ( $myhome_estate->get_attributes() as $myhome_attribute ) :
								if ( ! $myhome_attribute->show_on_card() ) {
									continue;
								}

								$myhome_attribute_values = $myhome_attribute->get_values();
								if ( ! count( $myhome_attribute_values ) ) {
									continue;
								}
								?>

								<span class="mh-estate-vertical__more-info">
                                    <strong>
										<?php if ( $myhome_attribute->has_icon() ) : ?>
											<i class="<?php echo esc_attr( $myhome_attribute->get_icon() ); ?>"></i>
										<?php else : ?>
											<?php echo esc_html( $myhome_attribute->get_name() ); ?>:
										<?php endif; ?>
									</strong>

									<?php
									foreach ( $myhome_attribute_values as $key => $value ) :
										echo esc_html( ( $key ? ', ' : '' ) . $value->get_name() );
									endforeach;
									?>

                                </span>

							<?php endforeach; ?>
						</div>
					</div>

					<div class="mh-estate-vertical__bottom">
						<div class="mh-estate-vertical__bottom__inner">

							<?php if ( $myhome_estate_carousel['show_date'] ) : ?>
								<div class="mh-estate-vertical__date">
									<?php echo esc_html( $myhome_estate->get_days_ago() ); ?>
								</div>
							<?php endif; ?>

							<div class="mh-estate-vertical__buttons-wrapper">
								<div class="mh-estate-vertical__buttons">

									<?php if ( My_Home_Theme()->layout->is_compare_enabled() ) : ?>
										<div class="mh-estate-vertical__buttons__single">
											<compare-button
												class="myhome-compare-button"
												:estate="<?php echo esc_attr( json_encode( $myhome_estate->get_data() ) ); ?>"
											></compare-button>
										</div>
									<?php endif; ?>

									<div class="mh-estate-vertical__buttons__single">
										<a href="<?php echo esc_url( $myhome_estate->get_link() ); ?>"
										   title="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
										   class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary-ghost"
											<?php if ( \MyHomeCore\Estates\Estate::is_new_tab() ) : ?>
												target="_blank"
											<?php endif; ?>
										>
											<?php esc_html_e( 'Details', 'myhome' ); ?>
											<span class="mdl-button__icon-right">
                                                <i class="fa fa-angle-right"></i>
                                            </span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
	<?php endforeach; ?>
</div>
