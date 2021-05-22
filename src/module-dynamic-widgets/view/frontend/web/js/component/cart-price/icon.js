define([
		'jquery',
		'underscore',
		'ko',
		'Eloom_DynamicWidgets/js/component/cart-price/promotions',
		'domReady!'
	], function ($, _, ko, Promotions) {
		'use strict';

		return Promotions.extend({
			visible: ko.observable(false),
			isAjax: ko.observable(false),

			defaults: {
				template: 'Eloom_DynamicWidgets/widget/cart-price/icon'
			},

			initialize: function () {
				this._super();
			},

			toggle: function () {
				this.visible(!this.visible());
			},
		});
	}
);