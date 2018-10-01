<?php
/* @var $myhome_breadcrumbs \MyHomeCore\Common\Breadcrumbs\Breadcrumbs */
global $myhome_breadcrumbs;

if ( is_singular( 'estate' ) ) :
	global $myhome_estate;
endif;

if ( $myhome_breadcrumbs->has_elements() ) :
	?>
	<div
		class="mh-breadcrumbs-wrapper <?php if ( isset( $myhome_estate ) ) : echo esc_attr( $myhome_estate->get_breadcrumbs_class() ); endif; ?>"
		itemtype="http://schema.org/BreadcrumbList"
		itemscope
	>
		<div class="mh-layout">
			<div class="mh-breadcrumbs">

				<?php if ( isset( $myhome_estate ) && $myhome_estate->has_back_to_results_button() ) : ?>
					<div class="mh-breadcrumbs__item-wrapper">
						<a class="mh-breadcrumbs__back" href="<?php echo esc_url( $myhome_estate->get_back_to_results_url() ); ?>">
							<i class="fa fa-angle-left"></i> <?php esc_html_e( 'Return to Search', 'myhome' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<?php
				$myhome_breadcrumb_elements       = $myhome_breadcrumbs->get_elements();
				$myhome_count_breadcrumb_elements = count( $myhome_breadcrumb_elements );
				?>
				<?php foreach ( $myhome_breadcrumb_elements as $myhome_breadcrumb_key => $myhome_breadcrumb ) : ?>
					<div class="mh-breadcrumbs__item-wrapper">
						<div
							class="mh-breadcrumbs__item"
							<?php if ( ! ( $myhome_count_breadcrumb_elements <= $myhome_breadcrumb_key + 1 && $myhome_breadcrumb->has_elements() && ! is_singular( 'estate' ) ) ) : ?>
								itemprop="itemListElement"
								itemtype="http://schema.org/ListItem"
								itemscope
							<?php endif; ?>
						>
							<?php if ( $myhome_count_breadcrumb_elements <= $myhome_breadcrumb_key + 1 && $myhome_breadcrumb->has_elements() && ! is_singular( 'estate' ) ) : ?>

								<select
									id="mh-breadcrumb__<?php echo esc_attr( $myhome_breadcrumb_key ); ?>-select"
									class="mh-breadcrumbs-selectize"
								>
									<?php foreach ( $myhome_breadcrumb->get_values() as $myhome_breadcrumb_value ) : ?>
										<option
											value="<?php echo esc_attr( $myhome_breadcrumb_value->get_link() ); ?>"
											<?php if ( $myhome_breadcrumb->get_slug() == $myhome_breadcrumb_value->get_slug() ) : ?>
												selected="selected"
											<?php endif; ?>
										>
											<?php echo esc_html( $myhome_breadcrumb_value->get_name() ); ?>
											<?php if ( $myhome_breadcrumbs->show_count() ) : ?>
												(<?php echo esc_html( $myhome_breadcrumb_value->get_count() ) ?>)
											<?php endif; ?>
										</option>
									<?php endforeach; ?>
								</select>
							<?php else : ?>
								<a
									id="mh-breadcrumb__<?php echo esc_attr( $myhome_breadcrumb_key ); ?>-link"
									href="<?php echo esc_url( $myhome_breadcrumb->get_link() ); ?>"
									title="<?php echo esc_attr( $myhome_breadcrumb->get_name() ); ?>"
									itemprop="item"
								>
									<span itemprop="name">
										<?php echo esc_html( $myhome_breadcrumb->get_name() ); ?>
									</span>
									<meta itemprop="position" content="<?php echo esc_attr( $myhome_breadcrumb_key + 1 ); ?>">

                                    <?php if ( $myhome_breadcrumbs->show_count() ) : ?>
                                        (<?php echo esc_html( $myhome_breadcrumb->get_count() ); ?>)
                                    <?php endif; ?>

                                </a>

							<?php endif; ?>
						</div>

						<?php if ( $myhome_breadcrumb_key <= \MyHomeCore\Common\Breadcrumbs\Breadcrumbs::breadcrumbs_number() || is_singular( 'estate' ) ) : ?>
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>

				<?php if ( $myhome_breadcrumbs->has_child() ) : ?>
					<div class="mh-breadcrumbs__item-wrapper">
						<div class="mh-breadcrumbs__item">
							<select
								id="mh-breadcrumb__child-select"
								class="mh-breadcrumbs-selectize"
							>
								<option
									selected="selected"
									value="placeholder"
								>
									<?php echo esc_html( $myhome_breadcrumbs->get_child_attribute()->get_name() ); ?>
								</option>
								<?php foreach ( $myhome_breadcrumbs->get_child_attribute_breadcrumb()->get_values() as $myhome_breadcrumb_value ) : ?>
									<option
										value="<?php echo esc_attr( $myhome_breadcrumb_value->get_link() ); ?>"
									>
										<?php echo esc_html( $myhome_breadcrumb_value->get_name() ); ?> (<?php echo esc_html( $myhome_breadcrumb_value->get_count() ); ?>)
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( is_singular( 'estate' ) ) : ?>
					<div class="mh-breadcrumbs__item-wrapper">
						<div class="mh-breadcrumbs__item">
							<?php echo esc_html( $myhome_estate->get_name() ); ?>
						</div>
					</div>
				<?php endif; ?>

			</div>

			<div class="mh-top-essb">
				<?php \MyHomeCore\My_Home_Core()->essb->display( \MyHomeCore\Integrations\ESSB\ESSB_Init::PROPERTY ); ?>
			</div>
		</div>
	</div>
<?php endif;
