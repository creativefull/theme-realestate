<?php
/* @var \MyHomeCore\Components\Contact_Form\Contact_Form $myhome_single_property_form */
global $myhome_single_property_form;

if ( ! isset( $myhome_single_property_form ) || ! $myhome_single_property_form instanceof \MyHomeCore\Components\Contact_Form\Contact_Form ) {
	return;
}
?>
<section>
    <div class="mh-widget-title">
        <h3 class="mh-widget-title__text"><?php echo esc_html( $myhome_single_property_form->get_label() ); ?></h3>
    </div>

	<?php $myhome_single_property_form->display(); ?>

</section>