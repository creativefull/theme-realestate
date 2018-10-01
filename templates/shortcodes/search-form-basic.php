<?php
global $myhome_search_form_basic;
?>
<div style="height:500px; background: url(<?php echo esc_url( $myhome_search_form_basic['image'] ); ?>) no-repeat center center fixed;background-size: cover;">

	<?php if ( empty( $myhome_search_form_basic['heading'] ) ) : ?>
		<h2><?php echo esc_html( $myhome_search_form_basic['heading'] ); ?></h2>
	<?php endif; ?>

	<search-form-basic
		id="myhome-search-form-basic"
		config-key="<?php echo esc_attr( $myhome_search_form_basic['key'] ); ?>"
	></search-form-basic>

</div>
