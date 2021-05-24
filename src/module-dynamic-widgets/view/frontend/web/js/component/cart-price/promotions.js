define([
		'jquery',
		'mage/storage',
		'underscore',
		'ko',
		'uiComponent',
		'Eloom_Core/js/model/url-builder',
		'Eloom_Geolocation/js/storage',
		'Magento_Customer/js/customer-data'
	], function ($, storage, _, ko, Component, urlBuilder, addressStorage, customerData) {
		'use strict';

		if(!addressStorage.hasData()) {
			return;
		}
		let geoAddress = addressStorage.getAddressData();
		let promotions = ko.observableArray([]);
		let isComplete   = $.Deferred();
		let data$      	 = null;
		let cartData     = customerData.get('cart');

		let messageCount = ko.computed(() => {
			return promotions().length;
		});

		const isEmpty = ko.computed(() => {
			return promotions().length === 0;
		});

		return Component.extend({
			isEmpty: isEmpty,
			promotions: promotions,
			messageCount: messageCount,

			initialize: function () {
				this._super();
				let self = this;

				self.fetchNewData();

				cartData.subscribe(() => {
					self.fetchNewData();
				}, this);
			},

			fetchNewData: function() {
				promotions().length = 0;

				if(_.size(cartData().items)) {
					storage.post(
						urlBuilder.createUrl('/eloom/dw/address', {}),
						JSON.stringify({
							'country': geoAddress.country,
							'region': geoAddress.state.name,
							'regionId': geoAddress.state.id,
							'postcode': geoAddress.postalCode
						}),
						false).done((response) => {
						data$ = response;
						isComplete.resolve();
					}).always(() => {
						isComplete.reject();
					});

					$.when(isComplete).done(function () {
						try {
							if(data$) {
								let json = JSON.parse(data$);
								if(json && json.code == '200') {
									_.each(json.data, function (data, k) {
										if(!_.contains(promotions, data)) {
											promotions.push(data);
										}
									});
								}
							}
						} catch (e) {
							console.log(e);
						}
					}.bind(this)).fail(function () {
					}.bind(this)).always(function () {
					}.bind(this));
				}
			}
		});
	}
);