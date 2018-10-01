<?php
/* @var \MyHomeCore\Estates\Estate_Writer $myhome_estate */
global $myhome_estate;
?>

	<div class="mh-estate__section">
		<div class="mh-estate__list">
			<ul class="mh-estate__list__inner">
				<?php foreach ( $myhome_estate->get_attributes() as $myhome_attr ) : ?>

					<?php if ( ! $myhome_attr->has_values() || $myhome_attr->new_box() ) :
						continue;
					endif; ?>

					<li class="mh-estate__list__element">
						<strong>
							<?php if ( $myhome_estate->use_icons() && $myhome_attr->has_icon() ) : ?>
								<i class="<?php echo esc_attr( $myhome_attr->get_icon() ); ?>"></i>
							<?php else : ?>
								<?php echo esc_html( $myhome_attr->get_name() ); ?>:
							<?php endif; ?>
						</strong>
						<?php foreach ( $myhome_attr->get_values() as $myhome_attr_key => $myhome_attr_value ) : ?>

							<?php echo $myhome_attr_key ? ', ' : ''; ?>

							<?php if ( $myhome_attr->has_archive() ) : ?>

								<a href="<?php echo esc_url( $myhome_attr_value->get_link() ); ?>"
								   title="<?php echo esc_attr( $myhome_attr_value->get_name() ) ?>">
									<?php echo esc_html( $myhome_attr_value->get_name() ); ?>
									<i class="fa fa-external-link" aria-hidden="true"></i>
								</a>

							<?php else : ?>

								<?php echo esc_html( $myhome_attr_value->get_name() ); ?>

							<?php endif; ?>

						<?php endforeach;; ?>

					</li>

				<?php endforeach; ?>

				<?php if ( $myhome_estate->has_additional_features() ) : ?>
					<?php foreach ( $myhome_estate->get_additional_features() as $myhome_additional_feature ) : ?>
						<li class="mh-estate__list__element">
							<?php if ( ! empty( $myhome_additional_feature['name'] ) ) : ?>
								<strong>
									<?php echo esc_html( $myhome_additional_feature['name'] ); ?><?php if ( ! empty( $myhome_additional_feature['value'] ) ) : ?>:<?php endif; ?>
								</strong>
							<?php endif; ?>

							<?php if ( ! empty( $myhome_additional_feature['value'] ) ) : ?>
								<?php echo esc_html( $myhome_additional_feature['value'] ); ?>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>

<?php
foreach ( $myhome_estate->get_attributes() as $myhome_attr ) :
	if ( ! $myhome_attr->has_values() || ! $myhome_attr->new_box() ) :
		continue;
	endif;

	?>
	<div class="mh-estate__section">

		<h3 class="mh-estate__section__heading">
			<?php echo esc_html( $myhome_attr->get_name() ); ?>
		</h3>


		<div class="mh-estate__list">
			<ul class="mh-estate__list__inner">

				<?php foreach ( $myhome_attr->get_values() as $myhome_attr_key => $myhome_attr_value ) : ?>

					<li class="mh-estate__list__element mh-estate__list__element--dot">

						<?php if ( $myhome_attr->has_archive() ) : ?>

							<a href="<?php echo esc_url( $myhome_attr_value->get_link() ); ?>"
							   title="<?php echo esc_attr( $myhome_attr_value->get_name() ) ?>">
								<?php echo esc_html( $myhome_attr_value->get_name() ); ?>
							</a>

						<?php else : ?>

							<?php echo esc_html( $myhome_attr_value->get_name() ); ?>

						<?php endif; ?>


					</li>

				<?php endforeach;; ?>

			</ul>
		</div>
	</div>
<?php
endforeach;
