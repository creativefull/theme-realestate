<?php
/* @var array $myhome_slider_estate */
global $myhome_slider_estate;
/* @var \MyHomeCore\Estates\Estates $myhome_estates */
global $myhome_estates;

?>
	<div class="rev_slider_estate_placeholder">
		<div class="rev_slider_wrapper fullwidthbanner-container">
			<div id="<?php echo esc_attr( $myhome_slider_estate['estates_slider_style'] ); ?>"
				 class="rev_slider myhome-rev_slider"
				 data-version="5.3.0">
				<ul>
					<?php foreach ( $myhome_estates as $myhome_key => $myhome_estate ) :
						if ( $myhome_slider_estate['estates_slider_style'] == 'estate_slider_card' ) : ?>
							<li
								class="mh-property-slide"
								data-index="<?php echo esc_attr( $myhome_key ); ?>"
								data-link="<?php echo esc_url( $myhome_estate->get_link() ); ?>"
								data-transition="slidehorizontal"
								data-slotamount="default"
								data-hideafterloop="0"
								data-hideslideonmobile="off"
								data-easein="default"
								data-easeout="default"
								data-masterspeed="600"
								data-rotate="0"
								data-saveperformance="off"
								data-title="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
								data-description=""
								<?php if ( ! $myhome_key ) : ?>
									data-fstransition="fade" data-fsmasterspeed="300"
								<?php endif; ?>
							>
								<?php if ( $myhome_estate->has_image() ) : ?>
									<img
										src="<?php echo esc_url( wp_get_attachment_image_url( $myhome_estate->get_image_id(), 'full' ) ); ?>"
										alt="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
									>
								<?php endif; ?>
								<div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme mh-mask-dark"
									 data-x="['center','center','center','center','center']"
									 data-hoffset="['0','0','0','0','0']"
									 data-y="['middle','middle','middle','middle','middle']"
									 data-voffset="['0','0','0','0','0']"
									 data-width="full"
									 data-height="full"
									 data-whitespace="nowrap"
									 data-type="shape"
									 data-basealign="slide"
									 data-responsive_offset="on"
									 data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
									 data-textAlign="['inherit','inherit','inherit','inherit','inherit']"
									 data-paddingtop="[0,0,0,0,0]"
									 data-paddingright="[0,0,0,0,0]"
									 data-paddingbottom="[0,0,0,0,0]"
									 data-paddingleft="[0,0,0,0,0]"></div>
								<div class="tp-caption"
									<?php if ( ! empty( $myhome_slider_estate['content'] ) ) : ?>
										data-x="['left','left','left','center','center']"
										data-hoffset="['0','48','0','0','0']"
										data-y="['bottom','bottom','bottom','bottom','bottom']"
										data-voffset="['160','160','160','136','64']"
									<?php else: ?>
										data-x="['left','left','left','center','center']"
										data-hoffset="['0','0','0','0','0']"
										data-y="['bottom','bottom','bottom','bottom','bottom']"
										data-voffset="['276','276','226','36','36']"
									<?php endif; ?>
									 data-whitespace="normal"
									 data-type="text"
									 data-responsive_offset="off"
									 data-responsive="off"
									 data-frames='[{"delay":0,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
									 data-textAlign="['inherit','inherit','inherit','inherit']"
									 data-paddingtop="[0,0,0,0]"
									 data-paddingright="[0,0,0,0]"
									 data-paddingbottom="[0,0,0,0]"
									 data-paddingleft="[0,0,0,0]">
									<div class="mh-slider__card-default">
										<h3 class="mh-slider__card-default__heading">
											<?php echo esc_html( $myhome_estate->get_name() ); ?>
										</h3>
										<div class="position-relative">
											<?php if ( $myhome_estate->get_address() != '' ) : ?>
												<address class="mh-slider__card-default__address">
													<i class="flaticon-pin"></i>
													<span>
                                                            <?php echo esc_html( $myhome_estate->get_address() ); ?>
                                                        </span>
												</address>
											<?php endif; ?>

											<?php if ( $myhome_estate->has_price() ) : ?>
												<?php $myhome_prices = $myhome_estate->get_prices(); ?>

												<div class="mh-slider__card-default__price">

													<?php foreach ( $myhome_prices as $myhome_price ) : ?>
														<div <?php if ( $myhome_price->is_range() ) : ?>class="mh-price__range" <?php endif; ?>>
															<?php echo esc_html( $myhome_price->get_formatted() ); ?>
														</div>
													<?php endforeach; ?>

												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</li>
						<?php
						elseif ( $myhome_slider_estate['estates_slider_style'] == 'estate_slider_card_short' ) : ?>
							<li data-index="<?php echo esc_attr( $myhome_key ); ?>"
								data-link="<?php echo esc_url( $myhome_estate->get_link() ); ?>"
								data-transition="slidehorizontal"
								data-slotamount="default"
								data-hideafterloop="0"
								data-hideslideonmobile="off"
								data-easein="default"
								data-easeout="default"
								data-masterspeed="600"
								data-rotate="0"
								data-saveperformance="off"
								data-title="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
								data-description=""
								<?php if ( ! $myhome_key ) : ?>
									data-fstransition="fade" data-fsmasterspeed="300"
								<?php endif; ?>>
								<?php if ( $myhome_estate->has_image() ) : ?>
									<img
										src="<?php echo esc_url( wp_get_attachment_image_url( $myhome_estate->get_image_id(), 'full' ) ); ?>"
										alt="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
									>
								<?php endif; ?>
								<div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme mh-mask-dark"
									 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
									 data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
									 data-width="full"
									 data-height="full"
									 data-whitespace="nowrap"
									 data-type="shape"
									 data-basealign="slide"
									 data-responsive_offset="on"
									 data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
									 data-textAlign="['inherit','inherit','inherit','inherit']"
									 data-paddingtop="[0,0,0,0]"
									 data-paddingright="[0,0,0,0]"
									 data-paddingbottom="[0,0,0,0]"
									 data-paddingleft="[0,0,0,0]"></div>
								<div class="tp-caption"
									<?php if ( ! empty( $myhome_slider_estate['content'] ) ) : ?>
										data-x="['left','left','left','center','center']"
										data-hoffset="['0','0','0','0','0']"
										data-y="['bottom','bottom','bottom','bottom','bottom']"
										data-voffset="['276','276','226','136','64']"
									<?php else: ?>
										data-x="['left','left','left','center','center']"
										data-hoffset="['0','0','0','0','0']"
										data-y="['bottom','bottom','bottom','bottom','bottom']"
										data-voffset="['276','276','226','36','36']"
									<?php endif; ?>
									 data-whitespace="normal"
									 data-type="text"
									 data-responsive_offset="off"
									 data-responsive="off"
									 data-frames='[{"delay":0,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
									 data-textAlign="['inherit','inherit','inherit','inherit']"
									 data-paddingtop="[0,0,0,0]"
									 data-paddingright="[0,0,0,0]"
									 data-paddingbottom="[0,0,0,0]"
									 data-paddingleft="[0,0,0,0]">
									<div class="mh-slider__card-short">
										<h3 class="mh-slider__card-short__heading">
											<?php echo esc_html( $myhome_estate->get_name() ); ?>
										</h3>
										<?php if ( $myhome_estate->get_address() != '' ) : ?>
											<address class="mh-slider__card-short__address">
												<i class="flaticon-pin"></i>
												<span>
                                                        <?php echo esc_html( $myhome_estate->get_address() ); ?>
                                                    </span>
											</address>
										<?php endif; ?>
										<?php if ( $myhome_estate->has_price() ) : ?>
											<div class="mh-slider__card-short__price">
												<?php $myhome_price = $myhome_estate->get_price(); ?>
												<div <?php if ( $myhome_price->is_range() ) : ?>class="mh-price__range" <?php endif; ?>>
													<?php echo esc_html( $myhome_price->get_formatted() ); ?>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</li>
						<?php
						elseif ( $myhome_slider_estate['estates_slider_style'] == 'estate_slider_transparent' ) : ?>
							<li data-index="<?php echo esc_attr( $myhome_key ); ?>"
								data-link="<?php echo esc_url( $myhome_estate->get_link() ); ?>"
								data-transition="slidingoverlayhorizontal"
								data-slotamount="default"
								data-hideafterloop="0"
								data-hideslideonmobile="off"
								data-easein="Power3.easeInOut"
								data-easeout="default"
								data-masterspeed="900"
								data-rotate="0"
								data-saveperformance="off"
								data-title="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
								<?php if ( ! $myhome_key ) : ?>
									data-fstransition="fade" data-fsmasterspeed="300"
								<?php endif; ?>>
								<?php if ( $myhome_estate->has_image() ) : ?>
									<img
										src="<?php echo esc_url( wp_get_attachment_image_url( $myhome_estate->get_image_id(), 'full' ) ); ?>"
										alt="<?php echo esc_attr( $myhome_estate->get_name() ); ?>"
									>
								<?php endif; ?>
								<div class="tp-caption tp-shape tp-shapewrapper tp-resizeme mh-mask-strong-dark"
									 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
									 data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
									 data-width="full"
									 data-height="full"
									 data-whitespace="normal"
									 data-type="shape"
									 data-basealign="slide"
									 data-responsive_offset="on"
									 data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"0","to":"opacity:0;","ease":"Power3.easeInOut"}]'
									 data-textAlign="['inherit','inherit','inherit','inherit']"
									 data-paddingtop="[0,0,0,0]"
									 data-paddingright="[0,0,0,0]"
									 data-paddingbottom="[0,0,0,0]"
									 data-paddingleft="[0,0,0,0]"></div>
								<div class="tp-caption  "
									<?php if ( ! empty( $myhome_slider_estate['content'] ) ) : ?>
										data-x="['center','center','center','center','center']"
										data-hoffset="['0','0','0','0','0']"
										data-y="['center','center','center','center','bottom']"
										data-voffset="['0','0','0','0','64']"
									<?php else: ?>
										data-x="['center','center','center','center','center']"
										data-hoffset="['0','0','0','0','0']"
										data-y="['center','center','center','bottom','bottom']"
										data-voffset="['0','0','0','36','24']"
									<?php endif; ?>
									 data-width="none"
									 data-height="none"
									 data-whitespace="normal"
									 data-type="text"
									 data-responsive_offset="off"
									 data-responsive="off"
									 data-frames='[{"delay":0,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
									 data-textAlign="['inherit','inherit','inherit','inherit']"
									 data-paddingtop="[0,0,0,0]"
									 data-paddingright="[0,0,0,0]"
									 data-paddingbottom="[0,0,0,0]"
									 data-paddingleft="[0,0,0,0]">
									<div class="mh-slider__transparent">
										<h3 class="mh-slider__transparent__title">
											<?php echo esc_html( $myhome_estate->get_name() ); ?>
										</h3>

										<?php if ( $myhome_estate->get_address() != '' ) : ?>
											<address class="mh-slider__transparent__address">
												<i class="flaticon flaticon-pin"></i> <?php echo esc_html( $myhome_estate->get_address() ); ?>
											</address>
										<?php endif; ?>

										<?php if ( $myhome_estate->has_price() ) : ?>
											<div class="mh-slider__transparent__price">
												<?php $myhome_price = $myhome_estate->get_price(); ?>
												<div <?php if ( $myhome_price->is_range() ) : ?>class="mh-price__range" <?php endif; ?>>
													<?php echo esc_html( $myhome_price->get_formatted() ); ?>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</li>
						<?php
						endif;
					endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

<?php if ( ! empty( $myhome_slider_estate['content'] ) ) : ?>
	<div class="mh-slider__extra-content">
		<?php echo $myhome_slider_estate['content']; ?>
	</div>
<?php endif;
