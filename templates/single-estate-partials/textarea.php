<?php
/* @var \MyHomeCore\Estates\Estate_Writer $myhome_estate */
global $myhome_estate;
/* @var \MyHomeCore\Estates\Elements\Text_Area_Estate_Element $myhome_estate_element */
global $myhome_estate_element;

if ( $myhome_estate_element->has_text() ) :
	?>
	<div class="mh-estate__section">

		<?php if ( $myhome_estate_element->has_label() ) : ?>
			<h3 class="mh-estate__section__heading"><?php echo esc_html( $myhome_estate_element->get_label() ); ?></h3>
		<?php endif; ?>

		<?php $myhome_estate_element->text(); ?>

	</div>
	<?php
endif;