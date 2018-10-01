(function ($) {
	"use strict";

	jQuery(window).on('load', function () {

		if ($("#mh_rev_slider_single").revolution !== undefined) {
			var propertySlider = $("#mh_rev_slider_single");

			propertySlider.on('revolution.slide.onloaded', function () {
				if ($('a.mh-popup-group__element').length) {
					$('a.mh-popup-group__element').magnificPopup({
						type           : 'image',
						tLoading       : 'Loading image #%curr%...',
						mainClass      : 'mfp-no-margins mfp-with-zoom',
						fixedContentPos: false,
						gallery        : {
							enabled           : true,
							navigateByImgClick: true,
							preload           : [0, 1] // Will preload 0 - before current, and 1 after the current image
						},
						image          : {
							tError     : '<a href=" % url % ">The image #%curr%</a> could not be loaded.',
							verticalFit: true
						}
					});
				}
			});

			propertySlider.show().revolution({
				sliderType            : "standard",
				sliderLayout          : "fullwidth",
				dottedOverlay         : "none",
				delay                 : 2500,
				navigation            : {
					keyboardNavigation   : "on",
					keyboard_direction   : "horizontal",
					mouseScrollNavigation: "off",
					mouseScrollReverse   : "default",
					onHoverStop          : "on",
					touch                : {
						touchenabled       : "on",
						swipe_threshold    : 5,
						swipe_min_touches  : 1,
						swipe_direction    : "horizontal",
						drag_block_vertical: false
					},
					arrows               : {
						style            : "uranus",
						enable           : true,
						hide_onmobile    : true,
						hide_onleave     : false,
						hide_delay       : 200,
						hide_delay_mobile: 1200,
						tmp              : '',
						left             : {
							h_align : "left",
							v_align : "center",
							h_offset: 0,
							v_offset: 0
						},
						right            : {
							h_align : "right",
							v_align : "center",
							h_offset: 0,
							v_offset: 0
						}
					}
				},
				responsiveLevels      : [1240, 1200, 1024, 766],
				gridwidth             : [1140, 940, 738, 320],
				gridheight            : [600, 600, 500, 350],
				lazyType              : "none",
				shadow                : 0,
				spinner               : "off",
				stopLoop              : "off",
				stopAfterLoops        : -1,
				stopAtSlide           : -1,
				shuffle               : "off",
				autoHeight            : "off",
				disableProgressBar    : "on",
				hideThumbsOnMobile    : "off",
				hideSliderAtLimit     : 0,
				hideCaptionAtLimit    : 0,
				hideAllCaptionAtLilmit: 0,
				startWithSlide        : 0,
				debugMode             : false,
				fallbacks             : {
					simplifyAll           : "off",
					nextSlideOnWindowFocus: "off",
					disableFocusListener  : false,
				}
			});
		}

	});
})(jQuery);