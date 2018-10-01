(function ($) {
	"use strict";

	if ($("#myhome_attributes_box").length > 0 && $("#acf-myhome_estate .inside.acf-fields").length > 0) {
		$("#acf-myhome_estate .acf-field-myhome-estate-tab-general").after($("#mh-admin-attributes").html());
		$("#myhome_attributes_box").remove();
	}

	$('.selectize').selectize({
		sortField: 'text',
		create   : function (input) {
			return {
				value: input,
				text : input
			}
		}
	});

	if ($('.mh-dismiss-yoast-notice').length) {
		var noticeInterval = setInterval(function () {
			if ($('.mh-dismiss-yoast-notice .notice-dismiss').length) {
				$('.mh-dismiss-yoast-notice .notice-dismiss').on('click', function () {
					$.post(ajaxurl, {
						action: 'myhome_yoast_dismiss_notice'
					}, function (response) {

					});
				});
				clearInterval(noticeInterval);
			}
		}, 500);
	}

	if ($(".redux-action_bar").length > 0) {
		$("#redux_save").after($("#myhome-clear-cache"));
		$("#myhome-clear-cache").show();
	}

	window.onload = function () {
		if ($('#acf-myhome_estate_location').length) {
			var disableAutoComplete = false;
			$('#acf-myhome_estate_location .title').after('<div><input type="checkbox" id="myhome-disable-autocomplete"> ' + window.MyHomeAdmin.disable_map_autocomplete + '</div>');
			$('#myhome-disable-autocomplete').bind('change', function () {
				disableAutoComplete = $(this).is(':checked');
			});

			acf.fields.google_map.sync = function () {

				// reference
				var self = this;


				// vars
				var position = this.map.marker.getPosition(),
					latlng = new google.maps.LatLng(position.lat(), position.lng());


				// add class
				this.$el.addClass('-loading');

				if (!disableAutoComplete) {
					// load
					this.geocoder.geocode({'latLng': latlng}, function (results, status) {

						// remove class
						self.$el.removeClass('-loading');


						// validate
						if (status != google.maps.GeocoderStatus.OK) {

							console.log('Geocoder failed due to: ' + status);
							return;

						} else if (!results[0]) {

							console.log('No results found');
							return;

						}


						// get location
						var location = results[0];


						// update title
						self.$search.val(location.formatted_address);


						// update input
						acf.val(self.$el.find('.input-address'), location.formatted_address);

					});
				}


				// return for chaining
				return this;

			}
		}
	}
})(jQuery);