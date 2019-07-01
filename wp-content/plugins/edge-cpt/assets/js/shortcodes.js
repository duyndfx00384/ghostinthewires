(function($) {
    'use strict';
	
	var accordions = {};
	edgt.modules.accordions = accordions;
	
	accordions.edgtInitAccordions = edgtInitAccordions;
	
	
	accordions.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function edgtInitAccordions(){
		var accordion = $('.edgt-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('edgt-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('edgt-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.edgt-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	edgt.modules.animationHolder = animationHolder;
	
	animationHolder.edgtInitAnimationHolder = edgtInitAnimationHolder;
	
	
	animationHolder.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgtInitAnimationHolder(){
		var elements = $('.edgt-grow-in, .edgt-fade-in-down, .edgt-element-from-fade, .edgt-element-from-left, .edgt-element-from-right, .edgt-element-from-top, .edgt-element-from-bottom, .edgt-flip-in, .edgt-x-rotate, .edgt-z-rotate, .edgt-y-translate, .edgt-fade-in, .edgt-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	edgt.modules.button = button;
	
	button.edgtButton = edgtButton;
	
	
	button.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var edgtButton = function() {
		//all buttons on the page
		var buttons = $('.edgt-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';

    var cardsGallery = {};
    edgt.modules.cardsGallery = cardsGallery;

    cardsGallery.edgtInitCardsGallery = edgtInitCardsGallery;

    cardsGallery.edgtOnDocumentReady = edgtOnDocumentReady;
    cardsGallery.edgtOnWindowLoad = edgtOnWindowLoad;
    cardsGallery.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).scroll(edgtOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtLazyImages();
    }

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitCardsGallery();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
        edgtLazyImages();
    }

    /**
     * Cards Gallery shortcode
     */
    function edgtInitCardsGallery() {
        if ($('.edgt-cards-gallery-holder').length) {
            $('.edgt-cards-gallery-holder').each(function () {
                var gallery = $(this);
                var cards = gallery.find('.card');
                cards.each(function () {
                    var card = $(this);
                    card.click(function () {
                        if (!cards.last().is(card)) {
                            card.addClass('out animating').siblings().addClass('animating-siblings');
                            card.detach();
                            card.insertAfter(cards.last());
                            setTimeout(function () {
                                card.removeClass('out');
                            }, 200);
                            setTimeout(function () {
                                card.removeClass('animating').siblings().removeClass('animating-siblings');
                            }, 1200);
                            cards = gallery.find('.card');
                            return false;
                        }
                    });
                });

                if (gallery.hasClass('edgt-appear-effect-yes') && !edgt.htmlEl.hasClass('touch')) {
                    gallery.appear(function () {
                        gallery.addClass('edgt-appeared');
                        gallery.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
                            $(this).addClass('edgt-animation-done');
                        });
                    }, {accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
                }
            });
        }
    }

    /**
     * Loads images that are set to be 'lazy'
     */
    function edgtLazyImages() {
        $.fn.preloader = function (action, callback) {
            if (!!action && action == 'destroy') {
                this.find('.edgt-preloader').remove();
            } else {
                var block = $('<div class="edgt-preloader"></div>');
                block.appendTo(this);
                if (typeof callback == 'function')
                    callback();
            }
            return this;
        };

        $('img[data-image][data-lazy="true"]:not(.lazyLoading)').each(function (i, object) {
            object = $(object);

            if (object.attr('data-ratio')) {
                object.height(object.width() * object.data('ratio'));

            }

            var rect = object[0].getBoundingClientRect(),
                vh = (edgt.windowHeight || document.documentElement.clientHeight),
                vw = (edgt.windowWidth || document.documentElement.clientWidth),
                oh = object.outerHeight(),
                ow = object.outerWidth();


            if (
                ( rect.top != 0 || rect.right != 0 || rect.bottom != 0 || rect.left != 0 ) &&
                ( rect.top >= 0 || rect.top + oh >= 0 ) &&
                ( rect.bottom >= 0 && rect.bottom - oh - vh <= 0 ) &&
                ( rect.left >= 0 || rect.left + ow >= 0 ) &&
                ( rect.right >= 0 && rect.right - ow - vw <= 0 )
            ) {

                var p = object.parent();
                if (!!p) {
                    p.preloader('init');
                }
                object.addClass('lazyLoading');

                var imageObj = new Image();

                $(imageObj).on('load', function () {

                    p.preloader('destroy');
                    object
                        .removeAttr('data-image')
                        .removeData('image')
                        .removeAttr('data-lazy')
                        .removeData('lazy')
                        .removeClass('lazyLoading');

                    object.attr('src', $(this).attr('src'));
                    object.height('auto');

                }).attr('src', object.data('image'));
            }
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var clientsCarousel = {};
    edgt.modules.clientsCarousel = clientsCarousel;

    clientsCarousel.edgtInitClientsCarousel = edgtInitClientsCarousel;

    clientsCarousel.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtInitClientsCarousel();
        edgtInitClientsCarouselCloned();
    }

    function edgtInitClientsCarousel() {
        var edgtClientsCarousel = $('.edgt-clients-carousel-holder.edgt-cc-hover-pulse-image');

        if(edgtClientsCarousel.length){
            edgtClientsCarousel.each(function(){
                var thisClientsCarousel = $(this).find('.edgt-cc-item');

                thisClientsCarousel.each(function(l) {
                    var thisImage = $(this);

                    thisImage.mouseenter(function(){
                        thisImage.addClass('edgt-cc-hover');

                        thisImage.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
                            thisImage.removeClass('edgt-cc-hover');
                        });
                    });

                });
            });
        }
    }

    function edgtInitClientsCarouselCloned(){
        var slider = $('.edgt-owl-slider');

        slider.on('translate.owl.carousel', function(){
            edgtInitClientsCarousel();
        })
    }

})(jQuery);
(function($) {
    'use strict';

    var comparison = {};
    edgt.modules.comparison = comparison;

    comparison.edgtComparisonPricingTables = edgtComparisonPricingTables;


    comparison.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtComparisonPricingTables().init() ;
    }

    function edgtComparisonPricingTables() {
        var pricingTablesHolder = $('.edgt-comparision-pricing-tables-holder');

        var alterPricingTableColumn = function(holder) {
            var featuresHolder = holder.find('.edgt-cpt-features-item');
            var pricingTables = holder.find('.edgt-comparision-table-holder');

            if(pricingTables.length) {
                pricingTables.each(function() {
                    var currentPricingTable = $(this);
                    var pricingItems = currentPricingTable.find('.edgt-cpt-table-content li');

                    if(pricingItems.length) {
                        pricingItems.each(function(i) {
                            var pricingItemFeature = featuresHolder[i];
                            var pricingItem = this;
                            var pricingItemContent = pricingItem.innerHTML;

                            if(typeof pricingItemFeature !== 'undefined') {
                                pricingItem.innerHTML = '<span class="edgt-cpt-table-item-feature">'+ $(pricingItemFeature).text() +': </span>' + pricingItemContent;
                            }
                        });
                    }
                });
            }
        };

        return {
            init: function() {
                if(pricingTablesHolder.length) {
                    pricingTablesHolder.each(function() {
                        alterPricingTableColumn($(this));
                    });
                }
            }
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	edgt.modules.countdown = countdown;
	
	countdown.edgtInitCountdown = edgtInitCountdown;
	
	
	countdown.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function edgtInitCountdown() {
		var countdowns = $('.edgt-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth != month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'yodHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	edgt.modules.counter = counter;
	
	counter.edgtInitCounter = edgtInitCounter;
	
	
	counter.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function edgtInitCounter() {
		var counterHolder = $('.edgt-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edgt-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edgt-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var customFont = {};
	edgt.modules.customFont = customFont;
	
	customFont.edgtCustomFontResize = edgtCustomFontResize;
	
	
	customFont.edgtOnDocumentReady = edgtOnDocumentReady;
	customFont.edgtOnWindowResize = edgtOnWindowResize;
	
	$(document).ready(edgtOnDocumentReady);
	$(window).resize(edgtOnWindowResize);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtCustomFontResize();
	}
	
	/* 
	 All functions to be called on $(window).resize() should be in this function
	 */
	function edgtOnWindowResize() {
		edgtCustomFontResize();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function edgtCustomFontResize(){
		var holder = $('.edgt-custom-font-holder');
		
		if(holder.length){
			holder.each(function() {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
					
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1280') !== 'undefined' && thisItem.data('font-size-1280') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1280') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1280') !== 'undefined' && thisItem.data('line-height-1280') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1280') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if(smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if(smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1280px) {.edgt-custom-font-holder."+itemClass+" { " + smallLaptopStyle + " } }";
					}
					if(ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.edgt-custom-font-holder."+itemClass+" { " + ipadLandscapeStyle + " } }";
					}
					if(ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.edgt-custom-font-holder."+itemClass+" { " + ipadPortraitStyle + " } }";
					}
					if(mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.edgt-custom-font-holder."+itemClass+" { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var timeline = {};
	edgt.modules.timeline = timeline;

	timeline.edgtTimeline = edgtTimeline;


	timeline.edgtOnDocumentReady = edgtOnDocumentReady;

	$(document).ready(edgtOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtTimeline();
	}

	/**
	 * Timeline animation
	 * @type {Function}
	 */
	function edgtTimeline(){

		var itemTimeline = $('.edgt-tml-item-holder');
		if(itemTimeline.length){


			itemTimeline.each(function(){

				var thisTimeline = $(this);


				setTimeout(function(){

					thisTimeline.appear(function(){
						thisTimeline.addClass('edgt-appeared');
					},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
				},500*thisTimeline.index());

			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	edgt.modules.elementsHolder = elementsHolder;
	
	elementsHolder.edgtInitElementsHolderResponsiveStyle = edgtInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function edgtInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.edgt-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.edgt-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('680-768') !== 'undefined' && thisItem.data('680-768') !== false) {
						ipadPortrait = thisItem.data('680-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1281px) and (max-width: 1600px) {.edgt-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1280px) {.edgt-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.edgt-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.edgt-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.edgt-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
				if (typeof edgt.modules.common.edgtOwlSlider === "function") {
					edgt.modules.common.edgtOwlSlider();
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var fullScreenSections = {};
	edgt.modules.fullScreenSections = fullScreenSections;
	
	fullScreenSections.edgtInitFullScreenSections = edgtInitFullScreenSections;
	
	
	fullScreenSections.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitFullScreenSections();
	}
	
	/*
	 **	Init full screen sections shortcode
	 */
	function edgtInitFullScreenSections(){
		var fullScreenSections = $('.edgt-full-screen-sections');
		
		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.edgt-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.edgt-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('edgt-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';
				
				var defaultHeaderStyle = '';
				if (edgt.body.hasClass('edgt-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (edgt.body.hasClass('edgt-dark-header')) {
					defaultHeaderStyle = 'dark';
				}
				
				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}
				
				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';
				
				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.edgt-fss-item',
					scrollingSpeed: 1000,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
					    console.log(direction);
					    var timeout = direction == 'down' ? 900 : 0;
						if(fullScreenSectionsItemsHasHeaderStyle) {
						    setTimeout(function() {
                                checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
                            }, timeout);
						}
						
						if(enableNavigation) {
                            setTimeout(function() {
                                checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
                            }, timeout);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}
						
						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.edgt-fss-nav-holder').css('visibility','visible');
						}
						
						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});
				
				setResposniveData(thisFullScreenSections);
				
				if(enableNavigation) {
					thisFullScreenSections.find('#edgt-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});
					
					thisFullScreenSections.find('#edgt-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}
	
	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			edgt.body.removeClass('edgt-light-header edgt-dark-header').addClass('edgt-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			edgt.body.removeClass('edgt-light-header edgt-dark-header').addClass('edgt-' + default_header_style + '-header');
		} else {
			edgt.body.removeClass('edgt-light-header edgt-dark-header');
		}
	}
	
	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#edgt-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#edgt-fss-nav-down'),
			enableContinuousVertical = false;
		
		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}
		
		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			
			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}
	
	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.edgt-fss-item'),
			responsiveStyle = '',
			style = '';
		
		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';
			
			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}
			
			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {
				
				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1280px) {.edgt-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.edgt-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.edgt-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.edgt-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});
		
		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}
		
		if (style.length) {
			$('head').append(style);
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var googleMap = {};
	edgt.modules.googleMap = googleMap;

	googleMap.edgtShowGoogleMap = edgtShowGoogleMap;


	googleMap.edgtOnDocumentReady = edgtOnDocumentReady;

	$(document).ready(edgtOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtShowGoogleMap();
	}

	/*
	 **	Show Google Map
	 */
	function edgtShowGoogleMap(){
		var googleMap = $('.edgt-google-map');

		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);

				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}

				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}

				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}

				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}

				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}

				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}

				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}

				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}

				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}

				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "edgt-map-"+ uniqueId;

				edgtInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}

	/*
	 **	Init Google Map
	 */
	function edgtInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

		if(typeof google !== 'object') {
			return;
		}

		var mapStyles = [
			{
				stylers: [
					{hue: color },
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];

		var googleMapStyleId;

		if(customMapStyle === 'yes'){
			googleMapStyleId = 'edgt-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}

		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}

		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Edge Google Map"});

		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);

		if (!isNaN(height)){
			height = height + 'px';
		}

		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgt-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};

		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('edgt-style', qoogleMapType);

		var index;

		for (index = 0; index < data.length; ++index) {
			edgtInitializeGoogleAddress(data[index], pin, map, geocoder);
		}

		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}


	/*
	 **	Init Google Map Addresses
	 */
	function edgtInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}

		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});

				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}

})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	edgt.modules.icon = icon;
	
	icon.edgtIcon = edgtIcon;
	
	
	icon.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgtIcon = function() {
		var icons = $('.edgt-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('edgt-icon-animation')) {
				icon.appear(function() {
					icon.parent('.edgt-icon-animation-holder').addClass('edgt-icon-animation-show');
				}, {accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.edgt-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	edgt.modules.iconListItem = iconListItem;
	
	iconListItem.edgtInitIconList = edgtInitIconList;
	
	
	iconListItem.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var edgtInitIconList = function() {
		var iconList = $('.edgt-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('edgt-appeared');
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';

    var iconShowcase = {};
    edgt.modules.iconShowcase = iconShowcase;

    iconShowcase.edgtInitInteractiveIconShowcase = edgtInitInteractiveIconShowcase;


    iconShowcase.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtInitInteractiveIconShowcase();
    }

    function edgtInitInteractiveIconShowcase () {

        var interactiveShowcase = $('.edgt-int-icon-showcase'),
            noAnimationOnTouch = $('.edgt-no-animations-on-touch');

        if (interactiveShowcase.length){
            interactiveShowcase.each(function () {
                var thisShowcase = $(this),
                    iconHolders = thisShowcase.find('.edgt-showcase-item-holder'),
                    thisIcons = thisShowcase.find('.edgt-showcase-icon'),
                    thisContent = thisShowcase.find('.edgt-showcase-content'),
                    thisFirstItem = thisShowcase.find('.edgt-showcase-item-holder:first-child'),
                    thisActiveItem = thisShowcase.find('.edgt-showcase-item-holder.edgt-showcase-active'),
                    isInitialized = false,
                    isPaused = false,
                    currentItem,
                    itemInterval = 3000,
                    numberOfItems = iconHolders.length;

                if(typeof thisShowcase.data('interval') !== 'undefined' && thisShowcase.data('interval') !== false) {
                    itemInterval = thisShowcase.data('interval');
                }

                if (!noAnimationOnTouch.length) {
                    //appear
                    thisShowcase.appear(function(){
                        setTimeout(function(){
                            thisShowcase.addClass('edgt-appeared');
                            if (!thisActiveItem.length) {
                                setTimeout(function(){
                                    isInitialized = true;
                                    thisFirstItem.addClass('edgt-showcase-active');
                                    if (thisShowcase.hasClass('edgt-autoplay')) {
                                        showcaseLoop();
                                        thisShowcase.hover(function (e) {
                                            isPaused = true;
                                        },function (e) {
                                            isPaused = false;
                                        });
                                    }
                                },2500);
                            }
                        },30);
                    },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
                } else {
                    thisFirstItem.addClass('edgt-showcase-active');
                    isInitialized = true;
                }

                //hover actions
                thisIcons.each(function(){
                    var thisIcon = $(this),
                        thisHolder = thisIcon.parent();

                    thisIcon.mouseenter(function(){
                        if (isInitialized == true) {
                            thisHolder.siblings().removeClass('edgt-showcase-active edgt-current');
                            thisHolder.addClass('edgt-showcase-active edgt-current');
                            currentItem = thisShowcase.find('.edgt-current').index(); //reset current loop item to latest hovered item
                        }
                    });
                });

                //loop through the items
                function showcaseLoop()  {
                    currentItem = 0; //start from the first item, index = 0

                    var loop = setInterval(function(){
                        if (!isPaused) {
                            iconHolders.removeClass('edgt-showcase-active edgt-current');
                            if(currentItem == numberOfItems -1){
                                currentItem = 0;
                            }else{
                                currentItem++;
                            }
                            iconHolders.eq(currentItem).addClass('edgt-showcase-active');
                        }
                    }, itemInterval);
                }
            });
        }
    }

})(jQuery);

(function($) {
	'use strict';
	
	var tabs = {};
	edgt.modules.tabs = tabs;
	
	tabs.edgtInitTabs = edgtInitTabs;
	tabs.edgtInitTabIcons =edgtInitTabIcons;
	
	tabs.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitTabs();
		edgtInitTabIcons();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgtInitTabs(){
		var tabs = $('.edgt-icon-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edgt-icon-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edgt-icon-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

				//animate tab content
				var tabContent = thisTabs.find('.edgt-icon-tab-container');

				thisTabs.appear(function(){
					showTabContent(tabContent);
				});

				thisTabs.find('li').each(function(){
					var singleTab = $(this);
					singleTab.click(function(){
						setTimeout(function(){
							showTabContent(tabContent);
						},50);
					});
				});

				function showTabContent(tabContent) {
					tabContent.each(function(){
						var thisTabContent = $(this);
						if(thisTabContent.is(':visible')) {
							thisTabContent.addClass('edgt-visible');
						} else {
							thisTabContent.removeClass('edgt-visible');
						}
					});
				}
			});
		}
	}

	/*
	 **	Generate icons in tabs navigation
	 */
	function edgtInitTabIcons(){

		var tabContent = $('.edgt-icon-tab-container');
		if(tabContent.length){

			tabContent.each(function(){
				var thisTabContent = $(this);

				var id = thisTabContent.attr('id');
				var icon = '';
				if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
					icon = thisTabContent.data('icon-html');
				}

				var tabNav = thisTabContent.parents('.edgt-icon-tabs').find('.edgt-icon-tabs-nav > li > a[href="#'+id+'"]');

				if(typeof(tabNav) !== 'undefined') {
					tabNav.prepend(icon);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var iconWithText = {};
    edgt.modules.iconWithText = iconWithText;

    iconWithText.edgtInitIconWithText = edgtInitIconWithText;

    iconWithText.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtInitIconWithText();
    }

    function edgtInitIconWithText() {
        var edgtIwt = $('.edgt-iwt');

        edgtIwt.mouseenter(function(){
            var thisIwt = $(this);
            thisIwt.addClass("edgt-iwt-hover");

            thisIwt.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
                thisIwt.removeClass("edgt-iwt-hover");
            });
        });
    }

})(jQuery);

(function($) {
    'use strict';
	
	var imageGallery = {};
	edgt.modules.imageGallery = imageGallery;
	
	imageGallery.edgtInitImageGalleryMasonry = edgtInitImageGalleryMasonry;
	
	
	imageGallery.edgtOnWindowLoad = edgtOnWindowLoad;
	
	$(window).load(edgtOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function edgtOnWindowLoad() {
		edgtInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function edgtInitImageGalleryMasonry(){
		var holder = $('.edgt-image-gallery.edgt-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edgt-ig-masonry');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgt-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.edgt-ig-grid-gutter',
							columnWidth: '.edgt-ig-grid-sizer'
						}
					});
					
					setTimeout(function() {
						masonry.isotope('layout');
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	edgt.modules.pieChart = pieChart;
	
	pieChart.edgtInitPieChart = edgtInitPieChart;
	
	
	pieChart.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function edgtInitPieChart() {
		var pieChartHolder = $('.edgt-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.edgt-pc-percentage'),
					barColor = '#2D76B2',
					trackColor = '#f7f7f7',
					lineWidth = 6,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.edgt-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
    'use strict';

    var process = {};
    edgt.modules.process = process;

    process.edgtProcess = edgtProcess;


    process.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtProcess().init() ;
    }

    function edgtProcess() {
        var processes = $('.edgt-process-holder');

        var setProcessItemsPosition = function(process) {
            var items = process.find('.edgt-process-item-holder');
            var highlighted = items.filter('.edgt-pi-highlighted');
    
            if(highlighted.length) {
                if(highlighted.length === 1) {
                    var afterHighlighed = highlighted.nextAll();
    
                    if(afterHighlighed.length) {
                        afterHighlighed.addClass('edgt-pi-push-right');
                    }
                } else {
                    process.addClass('edgt-process-multiple-highlights');
                }
            }
        };
    
        var processAnimation = function(process) {

            if(!edgt.body.hasClass('edgt-no-animations-on-touch')) {
                var items = process.find('.edgt-process-item-holder');
                var background = process.find('.edgt-process-bg-holder');
                process.appear(function() {
                    var tl = new TimelineLite();
                    tl.fromTo(background, 0.3, {y: 50, opacity: 0, delay: 0.1}, {opacity: 1, y: 0, delay: 0.1});
                    tl.staggerFromTo(items, 0.8, {opacity: 0, y: 30, ease: Back.easeOut.config(2)}, {opacity: 1, y: 0, ease: Back.easeOut.config(2)}, 0.2);
                }, {accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
            }
        };
    
        return {
            init: function() {
                if(processes.length) {
                    processes.each(function() {
                        setProcessItemsPosition($(this));
                        processAnimation($(this));
                    });
                }
            }
        }
    };

})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	edgt.modules.progressBar = progressBar;
	
	progressBar.edgtInitProgressBars = edgtInitProgressBars;
	
	
	progressBar.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function edgtInitProgressBars(){
		var progressBar = $('.edgt-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.edgt-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					edgtInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function edgtInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.edgt-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	edgt.modules.tabs = tabs;
	
	tabs.edgtInitTabs = edgtInitTabs;
	
	
	tabs.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgtInitTabs(){
		var tabs = $('.edgt-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edgt-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edgt-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

				$('.edgt-tabs a.edgt-external-link').unbind('click');

				//animate tab content
				var tabContent = thisTabs.find('.edgt-tab-container');

				thisTabs.appear(function(){
					showTabContent(tabContent);
				});

				thisTabs.find('li').each(function(){
					var singleTab = $(this);
					singleTab.click(function(){
						setTimeout(function(){
							showTabContent(tabContent);
						},50);
					});
				});

				function showTabContent(tabContent) {
					tabContent.each(function(){
						var thisTabContent = $(this);
						if(thisTabContent.is(':visible')) {
							thisTabContent.addClass('edgt-visible');
						} else {
							thisTabContent.removeClass('edgt-visible');
						}
					});
				}
			});
		}
	}

})(jQuery);