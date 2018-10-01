var $ = jQuery.noConflict();

(function ($) {
	jQuery(window).on('load', function () {
		if ($('html').attr('dir') === 'rtl') {
			function vc_rtl_fix() {
				var $elements = $('[data-vc-full-width="true"]')
				$.each($elements, function () {
					var $el = $(this)
					$el.css('right', $el.css('left')).css('left', '')
				})
			}

			$(document).on('vc-full-width-row', function () {
				vc_rtl_fix()
			});

			vc_rtl_fix()
		}
		// post card height
		var offset = 0;
		var min = 0;
		var height = 0;
		var cards = $('.mh-post-grid__inner').not('.owl-carousel .mh-post-grid__inner');
		cards.each(function (i, card) {
			var currentOffset = $(card).offset().top;
			if (currentOffset !== offset && i > 0) {
				for (min; min < i; min++) {
					$(cards[min]).css('height', height + 'px')
				}
				min = i;
				height = 0;
				offset = currentOffset;
			} else if (i === 0) {
				offset = currentOffset;
			}

			var cardHeight = $(card).height();
			if (cardHeight > height) {
				height = cardHeight
			}
			if (i + 1 === cards.length) {
				for (min; min <= i; min++) {
					$(cards[min]).css('height', height + 'px')
				}
			}
		});

		// post card height
		var offset = 0;
		var min = 0;
		var height = 0;
		var cards = $('.mh-estate-vertical__content');
		cards.each(function (i, card) {
			var currentOffset = $(card).offset().top;
			if (currentOffset !== offset && i > 0) {
				for (min; min < i; min++) {
					$(cards[min]).css('height', height + 'px')
				}
				min = i;
				height = 0;
				offset = currentOffset;
			} else if (i === 0) {
				offset = currentOffset;
			}

			var cardHeight = $(card).height();
			if (cardHeight > height) {
				height = cardHeight
			}
			if (i + 1 === cards.length) {
				for (min; min <= i; min++) {
					$(cards[min]).css('height', height + 'px')
				}
			}
		});

		if ($('#comment_post_ID').length && $('.mh-post').length) {
			$('#comment_post_ID').val($('.mh-post').data('id'))
		}

		$('.mh-navbar li a[href^="#"]').on('click', function (e) {
			e.preventDefault()
		});

		var mhMobileMenu = true;

		$('.mh-navbar__toggle').click(function () {
			if (mhMobileMenu) {
				$('.mh-navbar__menu').show();
				$('.mh-navbar__search').show();
				mhMobileMenu = false;
			} else {
				$('.mh-navbar__menu').hide();
				$('.mh-navbar__search').hide();
				mhMobileMenu = true;
			}
		});

		var $smoothScrollOffset = 90;
		$('body').scrollspy({
			offset: $smoothScrollOffset + 30
		});

		$('a.smooth').on('click', function (e) {
			if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
				e.preventDefault()
				var target = $(this.hash)
				if (this.hash) {
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']')
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top - $smoothScrollOffset
						}, 1000)
						return false
					} else {
						window.location.href = this.hash
					}
				} else {
					$('html,body').animate({
						scrollTop: 0
					})
				}
			}
		});

		$('.mh-navbar__menu li.page_item_has_children > a').on('click', function (e) {
			e.preventDefault()
		});

		$('.mh-navbar li').hover(function () {
			$(this).find('ul:first').fadeIn('fast')
		}, function () {
			$(this).find('ul').hide()
		});

		var accordion = $('.mh-accordion');
		if (accordion.length) {
			accordion.accordion({
				animate    : 300,
				autoHeight : false,
				heightStyle: 'content',
				collapsible: true,
				active     : accordion.hasClass('first-active') ? 0 : false
			})
		}

		// Select Picker
		if ($('.selectpicker').length) {
			$('.selectpicker').selectpicker({
				style     : '',
				dropupAuto: false
			})
		}

		// Magnific Popup
		if ($('.mh-popup').length) {
			$('.mh-popup').magnificPopup({
				type               : 'image',
				closeOnContentClick: true,
				closeBtnInside     : false,
				fixedContentPos    : true,
				mainClass          : 'mfp-no-margins mfp-with-zoom',
				image              : {
					tError     : '<a href=" % url % ">The image #%curr%</a> could not be loaded.',
					verticalFit: true
				}
			})
		}

		if ($('.mh-widget-facebook').length) {
			$('.mh-widget-facebook iframe').each(function () {
				var parentWidth = $(this).parent().width()
				$(this).attr('src', $(this).data('src') + '&width=' + parentWidth)
				$(this).attr('width', parentWidth)
			})
		}

		if ($('#mh-menu-currency_switcher').length) {
			$('#mh-menu-currency_switcher').change(function () {
				setCookie('myhome_currency', $('#mh-menu-currency_switcher').val(), 1);
				window.location.reload();
			});
		}

		if ($('#estate_slider_card').revolution !== undefined) {
			$('#estate_slider_card').show().revolution({
				sliderType            : 'standard',
				sliderLayout          : 'fullwidth',
				dottedOverlay         : 'none',
				delay                 : 2500,
				navigation            : {
					keyboardNavigation   : 'on',
					keyboard_direction   : 'horizontal',
					mouseScrollNavigation: 'off',
					mouseScrollReverse   : 'default',
					onHoverStop          : 'on',
					touch                : {
						touchenabled       : 'on',
						swipe_threshold    : 5,
						swipe_min_touches  : 1,
						swipe_direction    : 'horizontal',
						drag_block_vertical: false
					},
					arrows               : {
						style            : 'uranus',
						enable           : true,
						hide_onmobile    : true,
						hide_onleave     : false,
						hide_delay       : 200,
						hide_delay_mobile: 1200,
						tmp              : '',
						left             : {
							h_align : 'left',
							v_align : 'center',
							h_offset: 0,
							v_offset: 0
						},
						right            : {
							h_align : 'right',
							v_align : 'center',
							h_offset: 0,
							v_offset: 0
						}
					}
				},
				responsiveLevels      : [1440, 1320, 1100, 900, 768],
				gridwidth             : [1140, 940, 738, 520, 320],
				gridheight            : [600, 600, 500, 450, 450],
				lazyType              : 'none',
				shadow                : 0,
				spinner               : 'off',
				stopLoop              : 'off',
				stopAfterLoops        : -1,
				stopAtSlide           : -1,
				shuffle               : 'off',
				autoHeight            : 'off',
				disableProgressBar    : 'on',
				hideThumbsOnMobile    : 'off',
				hideSliderAtLimit     : 0,
				hideCaptionAtLimit    : 0,
				hideAllCaptionAtLilmit: 0,
				startWithSlide        : 0,
				debugMode             : false,
				fallbacks             : {
					simplifyAll           : 'off',
					nextSlideOnWindowFocus: 'off',
					disableFocusListener  : false,
				}
			})
		}

		if ($('#estate_slider_card_short').revolution !== undefined) {
			$('#estate_slider_card_short').show().revolution({
				sliderType            : 'standard',
				sliderLayout          : 'fullwidth',
				dottedOverlay         : 'none',
				delay                 : 2500,
				navigation            : {
					keyboardNavigation   : 'on',
					keyboard_direction   : 'horizontal',
					mouseScrollNavigation: 'off',
					mouseScrollReverse   : 'default',
					onHoverStop          : 'on',
					touch                : {
						touchenabled       : 'on',
						swipe_threshold    : 5,
						swipe_min_touches  : 1,
						swipe_direction    : 'horizontal',
						drag_block_vertical: false
					},
					arrows               : {
						style            : 'uranus',
						enable           : true,
						hide_onmobile    : true,
						hide_onleave     : false,
						hide_delay       : 200,
						hide_delay_mobile: 1200,
						tmp              : '',
						left             : {
							h_align : 'left',
							v_align : 'center',
							h_offset: 0,
							v_offset: 0
						},
						right            : {
							h_align : 'right',
							v_align : 'center',
							h_offset: 0,
							v_offset: 0
						}
					}
				},
				responsiveLevels      : [1440, 1320, 1100, 900, 768],
				gridwidth             : [1140, 940, 738, 520, 320],
				gridheight            : [600, 600, 500, 450, 450],
				lazyType              : 'none',
				shadow                : 0,
				spinner               : 'off',
				stopLoop              : 'off',
				stopAfterLoops        : -1,
				stopAtSlide           : -1,
				shuffle               : 'off',
				autoHeight            : 'off',
				disableProgressBar    : 'on',
				hideThumbsOnMobile    : 'off',
				hideSliderAtLimit     : 0,
				hideCaptionAtLimit    : 0,
				hideAllCaptionAtLilmit: 0,
				startWithSlide        : 0,
				debugMode             : false,
				fallbacks             : {
					simplifyAll           : 'off',
					nextSlideOnWindowFocus: 'off',
					disableFocusListener  : false,
				}
			})
		}

		if ($('#estate_slider_transparent').revolution !== undefined) {
			$('#estate_slider_transparent').show().revolution({
				sliderType            : 'standard',
				sliderLayout          : 'fullwidth',
				dottedOverlay         : 'none',
				delay                 : 4000,
				navigation            : {
					keyboardNavigation   : 'on',
					keyboard_direction   : 'horizontal',
					mouseScrollNavigation: 'off',
					mouseScrollReverse   : 'default',
					onHoverStop          : 'on',
					touch                : {
						touchenabled       : 'on',
						swipe_threshold    : 5,
						swipe_min_touches  : 1,
						swipe_direction    : 'horizontal',
						drag_block_vertical: false
					},
					arrows               : {
						style            : 'uranus',
						enable           : true,
						hide_onmobile    : true,
						hide_onleave     : false,
						hide_delay       : 200,
						hide_delay_mobile: 1200,
						tmp              : '',
						left             : {
							h_align : 'left',
							v_align : 'center',
							h_offset: 0,
							v_offset: 0
						},
						right            : {
							h_align : 'right',
							v_align : 'center',
							h_offset: 0,
							v_offset: 0
						}
					}
				},
				responsiveLevels      : [1440, 1320, 1100, 900, 768],
				gridwidth             : [1140, 940, 738, 520, 320],
				gridheight            : [600, 600, 500, 450, 450],
				lazyType              : 'none',
				shadow                : 0,
				spinner               : 'off',
				stopLoop              : 'off',
				stopAfterLoops        : -1,
				stopAtSlide           : -1,
				shuffle               : 'off',
				autoHeight            : 'off',
				disableProgressBar    : 'on',
				hideThumbsOnMobile    : 'off',
				hideSliderAtLimit     : 0,
				hideCaptionAtLimit    : 0,
				hideAllCaptionAtLilmit: 0,
				startWithSlide        : 0,
				debugMode             : false,
				fallbacks             : {
					simplifyAll           : 'off',
					nextSlideOnWindowFocus: 'off',
					disableFocusListener  : false,
				}
			})
		}

		if ($(".mh-fixed-menu").length > 0) {
			var topHeight = $(".mh-top-header").innerHeight() + $(".mh-top-header-big").innerHeight();

			if (!$(".mh-header--transparent").length) {
				$(".mh-sticky-menu-placeholder").css("min-height", $("#mega_main_menu.mh-primary > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text").height() + 'px');
			}

			var menu = $('.mh-fixed-menu');
			var logo = $('.logo_link img');

			window.onscroll = function () {
				var windowOffsetTop = $(window).scrollTop();

				if (windowOffsetTop > topHeight && !menu.hasClass('mh-fixed-menu--active')) {
					menu.addClass('mh-fixed-menu--active');
					if ($('.mh-fixed-menu--transparent-light').length > 0) {
						logo.attr('src', logo.data('logo-switch'));
					}
				} else if (windowOffsetTop <= topHeight) {
					menu.removeClass('mh-fixed-menu--active');
					if ($('.mh-fixed-menu--transparent-light').length > 0) {
						logo.attr('src', logo.data('logo'));
					}
				}
			};
		}

		var breadcrumbsSelect = $('.mh-breadcrumbs-selectize');
		if ($(breadcrumbsSelect).length) {
			$(breadcrumbsSelect).selectize();
		}

		breadcrumbsSelect.on('change', function () {
			var value = $(this).val();
			if (value.indexOf('http') !== -1) {
				window.location.href = $(this).val();
			}
		});

	});
})(jQuery);

jQuery(window).on('load', function () {
	if (jQuery('.compose-mode').length) {
		setInterval(function () {
			if ($('.myhome-rev_slider').length > $('.myhome-rev_slider-vc').length) {
				$('.myhome-rev_slider:not(.myhome-rev_slider-vc)').each(function () {
					$(this).addClass('myhome-rev_slider-vc');
					$(this).show().revolution();
				})
			}
		}, 1500)
	}

	var sliders = jQuery('.rev_slider:not(.myhome-rev_slider)');

	jQuery.each(sliders, function (index, slider) {
		if (!jQuery(slider).hasClass('revslider-initialised')) {
			jQuery(slider).revstart();
		}
	});
});

function setCookie(cname, cvalue, exdays) {
	const d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	const expires = 'expires=' + d.toUTCString();
	document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/'
}