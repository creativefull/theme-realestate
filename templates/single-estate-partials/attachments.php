<?php
/* @var \MyHomeCore\Estates\Elements\Attachments_Estate_Element $myhome_estate_element */
global $myhome_estate_element;

if ( $myhome_estate_element->has_attachments() ) :
	?>
	<section class="mh-estate__section">

		<?php if ( $myhome_estate_element->has_label() ) : ?>
			<h3 class="mh-estate__section__heading"><?php echo esc_html( $myhome_estate_element->get_label() ); ?></h3>
		<?php endif; ?>

		<?php foreach ( $myhome_estate_element->get_attachments() as $myhome_attachment ) : ?>
			<div>
				<a
					href="<?php echo esc_url( $myhome_attachment->get_file() ); ?>"
					title="<?php echo esc_attr( $myhome_attachment->get_label() ); ?>"
					class="mh-attachment mh-attachment--<?php echo esc_attr( $myhome_attachment->get_type() ); ?>"
					target="_blank"
				>
					<img
						src="<?php echo esc_url( $myhome_attachment->get_icon() ); ?>"
						alt="<?php echo esc_attr( $myhome_attachment->get_label() ); ?>"
					>
				</a>
			</div>
		<?php endforeach; ?>
	</section>
	<?php
endif;