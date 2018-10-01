jQuery(window).on('load', function () {
	var offsetTop = 24;

	if (jQuery('.mh-sticky-menu-placeholder').length) {
		offsetTop = jQuery('.mh-sticky-menu-placeholder').height() + 24;
	}

	if (jQuery(window).width() > 1023 && jQuery('.mh-layout__sidebar--sticky').length) {
		jQuery('.mh-layout__sidebar--sticky').stick_in_parent({
			offset_top: offsetTop
		});
	}
});