<?php
/* @var \MyHomeCore\Estates\Elements\Shortcode_Estate_Element $myhome_estate_element */
global $myhome_estate_element;

?>
<div class="mh-estate__section mh-estate__section--shortcode">

	<?php if ( $myhome_estate_element->has_label() ) : ?>
		<h3 class="mh-estate__section__heading"><?php echo esc_html( $myhome_estate_element->get_label() ); ?></h3>
	<?php endif; ?>

	<?php if ( $myhome_estate_element->has_shortcode() ) : ?>
		<?php echo do_shortcode( $myhome_estate_element->get_shortcode() ); ?>
	<?php endif; ?>

</div>
