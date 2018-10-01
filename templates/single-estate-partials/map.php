<?php
/* @var \MyHomeCore\Estates\Elements\Map_Estate_Element $myhome_estate_element */
global $myhome_estate_element;

if ( $myhome_estate_element->has_map() ) :
	$myhome_estate_element->map();
endif;