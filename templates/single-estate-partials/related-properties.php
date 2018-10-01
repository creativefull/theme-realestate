<?php
/* @var \MyHomeCore\Estates\Elements\Related_Properties_Estate_Element $myhome_estate_element */
global $myhome_estate_element;
/* @var \MyHomeCore\Estates\Estate_Writer $myhome_Estate */
global $myhome_estate;
$myhome_related_properties = $myhome_estate->get_related_properties();

if ( count( $myhome_related_properties ) ) :
	?>
	<section class="mh-estate__related">

		<?php if ( $myhome_estate_element->has_label() ) : ?>
			<h3 class="mh-estate__section__heading"><?php echo esc_html( $myhome_estate_element->get_label() ); ?></h3>
		<?php endif; ?>

		<div class="mh-grid">

			<?php foreach ( $myhome_related_properties as $myhome_related_estate ) : ?>

				<div class="mh-grid__1of2">
					<article
						class="mh-estate-vertical <?php echo esc_attr( $myhome_related_estate->get_attribute_classes() ); ?>"
					>
						<a href="<?php echo esc_url( $myhome_related_estate->get_link() ); ?>"
						   title="<?php echo esc_attr( $myhome_related_estate->get_name() ); ?>"
						   class="mh-thumbnail"
							<?php if ( \MyHomeCore\Estates\Estate::is_new_tab() ) : ?>
								target="_blank"
							<?php endif; ?>
						>
							<div class="mh-thumbnail__inner">
								<?php if ( $myhome_related_estate->has_image() ) :
									\MyHomeCore\Common\Image::the_image(
										$myhome_related_estate->get_image_id(),
										'standard',
										$myhome_related_estate->get_name()
									);
								endif; ?>
							</div>

                            <?php if ( $myhome_related_estate->is_featured() ) : ?>
                                <div class="mh-thumbnail__featured">
                                    <i class="fa fa-star"></i>
                                </div>
                            <?php endif; ?>

							<?php
							$myhome_related_estate_offer_types = $myhome_related_estate->get_offer_type();
							if ( ! empty( $myhome_related_estate_offer_types ) ) : ?>
								<div class="mh-caption">

									<?php foreach ( $myhome_related_estate->get_offer_type() as $offer_type ) : ?>
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

						</a>

						<div class="mh-estate-vertical__content">
							<h3 class="mh-estate-vertical__heading">
								<a href="<?php echo esc_url( $myhome_related_estate->get_link() ); ?>"
								   title="<?php echo esc_attr( $myhome_related_estate->get_name() ); ?>"
									<?php if ( \MyHomeCore\Estates\Estate::is_new_tab() ) : ?>
										target="_blank"
									<?php endif; ?>
								>
									<?php echo esc_html( $myhome_related_estate->get_name() ); ?>
								</a>
							</h3>

							<address class="mh-estate-vertical__subheading">
								<?php echo esc_html( $myhome_related_estate->get_address() ); ?>
							</address>

							<?php if ( $myhome_related_estate->has_price() ) : ?>
								<div class="mh-estate-vertical__primary">
									<?php foreach ( $myhome_related_estate->get_prices() as $myhome_related_estate_price ) : ?>
										<div <?php if ( $myhome_related_estate_price->is_range() ) : ?>class="mh-price__range" <?php endif; ?>>
											<?php echo esc_html( $myhome_related_estate_price->get_formatted() ); ?>
										</div>
									<?php endforeach;; ?>
								</div>
							<?php endif; ?>

						</div>
					</article>
				</div>

			<?php endforeach; ?>
		</div>
	</section>
<?php
endif;