(function ($) {

	var maps = google.maps;

	var Map = function (el, options) {
		var body = $('body');
		var defaultZoom = 10;

		if (body.hasClass('prime-mobile-portrait') || body.hasClass('prime-mobile-landscape')) {
			defaultZoom = 9;
		}

		this.settings = $.extend({
			zoom: defaultZoom,
			center: {
				lat: 41.4878,
				long: -95.5771
			},
			mapTypeControl: true,
			mapTypeControlOptions: {
				style: maps.MapTypeControlStyle.DROPDOWN_MENU
			},
			zoomControl: true,
			zoomControlOptions: {
				style: maps.ZoomControlStyle.SMALL
			},
			mapTypeId: maps.MapTypeId.ROADMAP
		}, options);

		this.settings.center = Map.toLatLong(this.settings.center);
		
		var circleSettings = this.settings.circle;
		delete this.settings.circle;

		this._map = new maps.Map(el, this.settings);
		window.theMap = this._map;
		var context = this;

		if (circleSettings) {
			this.addCircle(circleSettings);
		}
	};

	Map.toLatLong = function (options) {
		return new maps.LatLng(options.lat, options.long);
	}

	Map.prototype.addCircle = function (options) {
		var settings = $.extend({
			center: this._map.center,
			fillColor: '#336699',
			fillOpacity: .2,
			strokeColor: '#336699',
			strokeOpacity: 0.4,
			strokeWeight: 2,
			radius: 0 // miles
		}, options, { map: this._map });

		settings.radius = settings.radius * 1609.344;

		if (!(settings.center instanceof maps.LatLng)) {
			settings.center = Map.toLatLong(settings.center);
		}

		new google.maps.Circle(settings);
	}

	$.fn.map = function (options) {
		return this.each(function () {
			var map = new Map(this, options);
			$(window).on('resize.googlemap', _.throttle(function () {
				maps.event.trigger(map, 'resize');
			}, 500));
		});
	};

	$(function () {
		maps.event.addDomListener(window, 'load', function () {
			$(document).trigger('appready');
		});
	});

})(jQuery);