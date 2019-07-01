(function($) {
    'use strict';

    var woocommerce = {};
    edgt.modules.woocommerce = woocommerce;

    woocommerce.edgtOnDocumentReady = edgtOnDocumentReady;
    woocommerce.edgtOnWindowLoad = edgtOnWindowLoad;
    woocommerce.edgtOnWindowResize = edgtOnWindowResize;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgtInitQuantityButtons();
		edgtInitButtonLoading();
        edgtInitSelect2();
	    edgtInitSingleProductLightbox();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtOnWindowLoad() {
        edgtInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtOnWindowResize() {
        edgtInitProductListMasonryShortcode();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function edgtInitQuantityButtons() {
		$(document).on('click', '.edgt-quantity-minus, .edgt-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.edgt-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('edgt-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

	/*
	 ** Init Add to cart button loading
	 */
	function edgtInitButtonLoading() {

		$(".add_to_cart_button").click(function(){
			$(this).text(edgtGlobalVars.vars.edgtAddingToCart);
		});

	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function edgtInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.edgt-woocommerce-page .edgt-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function edgtInitSingleProductLightbox() {
		var item = $('.edgt-woo-single-page .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof edgt.modules.common.edgtPrettyPhoto === "function") {
				edgt.modules.common.edgtPrettyPhoto();
			}
		}
	}
	
	/*
	 ** Init Product List Masonry Shortcode Layout
	 */
	function edgtInitProductListMasonryShortcode() {
		var container = $('.edgt-pl-holder.edgt-masonry-layout .edgt-pl-outer');
		
		if (container.length) {
			container.each(function () {
				var thisContainer = $(this);
				
				thisContainer.waitForImages(function () {
					thisContainer.isotope({
						itemSelector: '.edgt-pli',
						resizable: false,
						masonry: {
							columnWidth: '.edgt-pl-sizer',
							gutter: '.edgt-pl-gutter'
						}
					});
					
					setTimeout(function () {
						if (typeof edgt.modules.common.edgtInitParallax === "function") {
							edgt.modules.common.edgtInitParallax();
						}
					}, 1000);
					
					thisContainer.isotope('layout').css('opacity', 1);
				});
			});
		}
	}

})(jQuery);