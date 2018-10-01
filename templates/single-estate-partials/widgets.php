<?php
/* @var \MyHomeCore\Estates\Elements\Widgets_Estate_Element $myhome_estate_element */
global $myhome_estate_element;

?>
<div class="mh-estate__section">

	<?php if ( $myhome_estate_element->has_label() ) : ?>
        <h3 class="mh-estate__section__heading"><?php echo esc_html( $myhome_estate_element->get_label() ); ?></h3>
	<?php endif; ?>

    <div class="mh-grid">
		<?php dynamic_sidebar( $myhome_estate_element->get_slug() ); ?>
    </div>

</div>