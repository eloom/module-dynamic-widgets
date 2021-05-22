define([
		'jquery',
		'underscore',
		'ko',
		'Eloom_DynamicWidgets/js/component/cart-price/promotions',
		'EloomOwlCarousel',
		'domReady!'
	], function ($, _, ko, Promotions, owlCarousel) {
		'use strict';

		const CONTAINER_ID = '#promotions .owl-carousel';

		return Promotions.extend({
			defaults: {
				template: 'Eloom_DynamicWidgets/widget/cart-price/carousel'
			},

			initialize: function () {
				this._super();
			},

			owlCarouselInitiator: function (element, data) {
				if (data.index === (data.total - 1)) {
					$(CONTAINER_ID).trigger('destroy.owl.carousel').owlCarousel({
						items: 1,
						autoplay: true,
						autoplayTimeout: (1000 * 3),
						autoplayHoverPause: true,
						loop: true,
						center: true,
						dots: false,
						margin: 0,
						smartSpeed: (500 * 2)
					})
				}
			}
		});
	}
);