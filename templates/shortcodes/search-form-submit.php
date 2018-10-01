<?php
global $myhome_search_form_submit;
?>
<div>
	<search-form-submit
		id="myhome-search-form-submit"
		:config="<?php echo esc_attr( json_encode( $myhome_search_form_submit ) ); ?>"
	>
	</search-form-submit>
</div>