<?php
/* @var \MyHomeCore\Estates\Estate_Writer $myhome_estate */
global $myhome_estate;
global $myhome_estate_element;

if ( $myhome_estate->has_plans() ) :
	?>
	<div class="mh-estate__section">

		<?php if ( $myhome_estate_element->has_label() ) : ?>
			<h3 class="mh-estate__section__heading"><?php echo esc_html( $myhome_estate_element->get_label() ); ?></h3>
		<?php endif; ?>

		<?php
		$myhome_accordion_first_active = My_Home_Theme()->settings->get( 'estate_plans-first_active' );
		?>
		<div class="mh-accordion <?php if ( ! empty( $myhome_accordion_first_active ) ) { ?>first-active<?php } ?>">
			<?php foreach ( $myhome_estate->get_plans() as $myhome_plan ) : ?>

				<h3>
					<i class="fa fa-minus"></i> <i class="fa fa-plus"></i>
					<?php echo esc_html( $myhome_plan->get_label() ); ?>
				</h3>
				<div>
					<a class="mh-estate__plan-thumbnail-wrapper mh-popup"
					   href="<?php echo esc_url( $myhome_plan->get_image() ); ?>"
					   title="<?php echo esc_attr( $myhome_plan->get_label() ); ?>">
						<img src="<?php echo esc_url( $myhome_plan->get_image() ); ?>"
							 alt="<?php echo esc_attr( $myhome_plan->get_label() ); ?>">
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php
endif;