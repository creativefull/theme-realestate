(function ($) {
	"use strict";

	jQuery(window).on('load', function () {


		var propertyGallery = $("#mh_rev_gallery_single");

		if (propertyGallery.revolution !== undefined) {
			propertyGallery.on('revolution.slide.onloaded', function () {
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

			propertyGallery.show().revolution({
				sliderType            : "standard",
				sliderLayout          : "auto",
				autoHeight            : 'off',
				dottedOverlay         : "none",
				delay                 : 5500,
				navigation            : {
					keyboardNavigation   : "off",
					keyboard_direction   : "horizontal",
					mouseScrollNavigation: "off",
					mouseScrollReverse   : "default",
					onHoverStop          : "on",
					arrows               : {
						style        : "gyges",
						enable       : true,
						hide_onmobile: false,
						hide_onleave : false,
						tmp          : '',
						left         : {
							h_align : "left",
							v_align : "center",
							h_offset: 0,
							v_offset: 0
						},
						right        : {
							h_align : "right",
							v_align : "center",
							h_offset: 0,
							v_offset: 0
						}
					},
					touch                : {
						touchenabled       : 'on',
						swipe_threshold    : 75,
						swipe_min_touches  : 1,
						swipe_direction    : 'horizontal',
						drag_block_vertical: true
					},
					thumbnails           : {
						style          : "zeus",
						enable         : true,
						width          : 199,
						height         : 140,
						min_width      : 120,
						visibleAmount  : 5,
						wrapper_padding: 0,
						wrapper_color  : "transparent",
						wrapper_opacity: "1",
						tmp            : '<span class="tp-thumb-image"></span>',
						hide_onmobile  : false,
						hide_under     : 0,
						hide_onleave   : false,
						direction      : "horizontal",
						span           : false,
						position       : "outer-bottom",
						space          : 8,
						h_align        : "left",
						v_align        : "bottom",
						h_offset       : -8,
						v_offset       : 0
					}
				},
				responsiveLevels      : [1240, 1024, 778, 480],
				visibilityLevels      : [1240, 1024, 778, 480],
				gridwidth             : [433, 566, 566, 566],
				gridheight            : [528, 500, 500, 500],
				lazyType              : "none",
				shadow                : 0,
				spinner               : "off",
				stopLoop              : "off",
				stopAfterLoops        : -1,
				stopAtSlide           : -1,
				shuffle               : "off",
				disableProgressBar    : "on",
				hideThumbsOnMobile    : "on",
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
