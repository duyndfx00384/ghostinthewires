(function($) {
    "use strict";

    window.edgt = {};
    edgt.modules = {};

    edgt.scroll = 0;
    edgt.window = $(window);
    edgt.document = $(document);
    edgt.windowWidth = $(window).width();
    edgt.windowHeight = $(window).height();
    edgt.body = $('body');
    edgt.html = $('html, body');
    edgt.htmlEl = $('html');
    edgt.menuDropdownHeightSet = false;
    edgt.defaultHeaderStyle = '';
    edgt.minVideoWidth = 1500;
    edgt.videoWidthOriginal = 1280;
    edgt.videoHeightOriginal = 720;
    edgt.videoRatio = 1.61;

    edgt.edgtOnDocumentReady = edgtOnDocumentReady;
    edgt.edgtOnWindowLoad = edgtOnWindowLoad;
    edgt.edgtOnWindowResize = edgtOnWindowResize;
    edgt.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgt.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(edgt.body.hasClass('edgt-dark-header')){ edgt.defaultHeaderStyle = 'edgt-dark-header';}
        if(edgt.body.hasClass('edgt-light-header')){ edgt.defaultHeaderStyle = 'edgt-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtOnWindowResize() {
        edgt.windowWidth = $(window).width();
        edgt.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtOnWindowScroll() {
        edgt.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case edgt.body.hasClass('edgt-grid-1300'):
            edgt.boxedLayoutWidth = 1350;
            break;
        case edgt.body.hasClass('edgt-grid-1200'):
            edgt.boxedLayoutWidth = 1250;
            break;
        case edgt.body.hasClass('edgt-grid-1000'):
            edgt.boxedLayoutWidth = 1050;
            break;
        case edgt.body.hasClass('edgt-grid-800'):
            edgt.boxedLayoutWidth = 850;
            break;
        default :
            edgt.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    edgt.modules.common = common;

    common.edgtFluidVideo = edgtFluidVideo;
    common.edgtEnableScroll = edgtEnableScroll;
    common.edgtDisableScroll = edgtDisableScroll;
    common.edgtOwlSlider = edgtOwlSlider;
    common.edgtInitParallax = edgtInitParallax;
    common.edgtInitSelfHostedVideoPlayer = edgtInitSelfHostedVideoPlayer;
    common.edgtSelfHostedVideoSize = edgtSelfHostedVideoSize;
    common.edgtPrettyPhoto = edgtPrettyPhoto;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;

    common.edgtOnDocumentReady = edgtOnDocumentReady;
    common.edgtOnWindowLoad = edgtOnWindowLoad;
    common.edgtOnWindowResize = edgtOnWindowResize;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
	    edgtIconWithHover().init();
	    edgtIEversion();
	    edgtDisableSmoothScrollForMac();
	    edgtInitAnchor().init();
	    edgtInitBackToTop();
	    edgtBackButtonShowHide();
	    edgtInitSelfHostedVideoPlayer();
	    edgtSelfHostedVideoSize();
	    edgtFluidVideo();
	    edgtOwlSlider();
	    edgtPreloadBackgrounds();
	    edgtPrettyPhoto();
	    edgtSearchPostTypeWidget();
		edgtInitCustomMenuDropdown();
        edgtTwitterResize();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtOnWindowLoad() {
	    edgtInitParallax();
        edgtSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtOnWindowResize() {
        edgtSelfHostedVideoSize();
    }
	
	/*
	 * IE version
	 */
	function edgtIEversion() {
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");
		
		if (msie > 0) {
			var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
			edgt.body.addClass('edgt-ms-ie'+version);
		}
		return false;
	}
	
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function edgtDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && edgt.body.hasClass('edgt-smooth-scroll')) {
			edgt.body.removeClass('edgt-smooth-scroll');
		}
	}
	
	function edgtDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', edgtWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = edgtWheel;
		document.onkeydown = edgtKeydown;
	}
	
	function edgtEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', edgtWheel, false);
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function edgtWheel(e) {
		edgtPreventDefaultValue(e);
	}
	
	function edgtKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				edgtPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function edgtPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var edgtInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			
			$('.edgt-main-menu .edgt-active-item, .edgt-mobile-nav .edgt-active-item, .edgt-fullscreen-menu .edgt-active-item').removeClass('edgt-active-item');
			anchor.parent().addClass('edgt-active-item');
			
			$('.edgt-main-menu a, .edgt-mobile-nav a, .edgt-fullscreen-menu a').removeClass('current');
			anchor.addClass('current');
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			
			$('[data-edgt-anchor]').waypoint( function(direction) {
				if(direction === 'down') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edgt-anchor")+"']"));
				}
			}, { offset: '50%' });
			
			$('[data-edgt-anchor]').waypoint( function(direction) {
				if(direction === 'up') {
					setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("edgt-anchor")+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
			
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-edgt-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function($this) {
			var scrollAmount;
			var anchor = $('a');
			var hash = $this;
			if(hash !== "" && $('[data-edgt-anchor="' + hash + '"]').length > 0 ) {
				var anchoredElementOffset = $('[data-edgt-anchor="' + hash + '"]').offset().top;
				scrollAmount = $('[data-edgt-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - edgtGlobalVars.vars.edgtAddForAdminBar;
				
				setActiveState(anchor);
				
				edgt.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function() {
					//change hash tag in url
					if(history.pushState) { history.pushState(null, null, '#'+hash); }
				});
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offest
		 */
		var headerHeihtToSubtract = function(anchoredElementOffset){
			
			if(edgt.modules.stickyHeader.behaviour === 'edgt-sticky-header-on-scroll-down-up') {
				edgt.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > edgt.modules.header.stickyAppearAmount);
			}
			
			if(edgt.modules.stickyHeader.behaviour === 'edgt-sticky-header-on-scroll-up') {
				if((anchoredElementOffset > edgt.scroll)){
					edgt.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = edgt.modules.stickyHeader.isStickyVisible ? edgtGlobalVars.vars.edgtStickyHeaderTransparencyHeight : edgtPerPageVars.vars.edgtHeaderTransparencyHeight;
			
			if(edgt.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function() {
			edgt.document.on("click", ".edgt-main-menu a, .edgt-fullscreen-menu a, .edgt-btn, .edgt-anchor, .edgt-mobile-nav a", function() {
				var scrollAmount;
				var anchor = $(this);
				var hash = anchor.prop("hash").split('#')[1];
				
				if(hash !== "" && $('[data-edgt-anchor="' + hash + '"]').length > 0 ) {
					
					var anchoredElementOffset = $('[data-edgt-anchor="' + hash + '"]').offset().top;
					scrollAmount = $('[data-edgt-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - edgtGlobalVars.vars.edgtAddForAdminBar;
					
					setActiveState(anchor);
					
					edgt.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function() {
						//change hash tag in url
						if(history.pushState) { history.pushState(null, null, '#'+hash); }
					});
					return false;
				}
			});
		};
		
		return {
			init: function() {
				if($('[data-edgt-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).load(function() { checkActiveStateOnLoad(); });
				}
			}
		};
	};
	
	function edgtInitBackToTop(){
		var backToTopButton = $('#edgt-back-to-top');
		backToTopButton.on('click',function(e){
			e.preventDefault();
			edgt.html.animate({scrollTop: 0}, edgt.window.scrollTop()/3, 'linear');
		});
	}
	
	function edgtBackButtonShowHide(){
		edgt.window.scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { edgtToTopButton('off'); } else { edgtToTopButton('on'); }
		});
	}
	
	function edgtToTopButton(a) {
		var b = $("#edgt-back-to-top");
		b.removeClass('off on');
		if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
	}
	
	function edgtInitSelfHostedVideoPlayer() {
		var players = $('.edgt-self-hosted-video');
		
		if(players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function edgtSelfHostedVideoSize(){
		var selfVideoHolder = $('.edgt-self-hosted-video-holder .edgt-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.edgt-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / edgt.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function edgtFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function edgtSmoothTransition() {

		if (edgt.body.hasClass('edgt-smooth-page-transitions')) {

			//check for preload animation
			if (edgt.body.hasClass('edgt-smooth-page-transitions-preloader')) {
				var loader = $('body > .edgt-smooth-transition-loader.edgt-mimic-ajax');
				loader.fadeOut(500);

				$(window).bind('pageshow', function (event) {
					if (event.originalEvent.persisted) {
						loader.fadeOut(500);
					}
				});
			}

			//check for fade out animation
			if (edgt.body.hasClass('edgt-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.click(function (e) {
					var a = $(this);

					if ((a.parents('.edgt-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}

					if (
						e.which == 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
                        (!a.hasClass('edgt-element-link-open')) && //Not popup opener on single course
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.edgt-wrapper-inner').fadeOut(1000, function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'edgt-preload-background' class
	 */
	function edgtPreloadBackgrounds(){
		var preloadBackHolder = $('.edgt-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('edgt-preload-background');
						});
					}
				} else {
					$(window).load(function(){ preloadBackground.removeClass('edgt-preload-background'); }); //make sure that edgt-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function edgtPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

    function edgtSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.edgt-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.edgt-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.edgt-post-type-search-results'),
                    searchLoading = thisSearch.find('.edgt-search-loading'),
                    searchIcon = thisSearch.find('.edgt-search-icon');

                searchLoading.addClass('edgt-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function(e) {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('edgt-hidden');
                    searchIcon.addClass('edgt-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('edgt-hidden');
                            searchIcon.removeClass('edgt-hidden');
                        } else {
                            var ajaxData = {
                                action: 'educator_edge_search_post_types',
                                term: searchTerm,
                                postType: postType
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: edgtGlobalVars.vars.edgtAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status == 'success') {
                                        searchLoading.addClass('edgt-hidden');
                                        searchIcon.removeClass('edgt-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('edgt-hidden');
                                    searchIcon.removeClass('edgt-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('edgt-hidden');
                    searchIcon.removeClass('edgt-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }

	function edgtInitCustomMenuDropdown() {
		var menus = $('.edgt-sidebar .widget_nav_menu .menu');

		var dropdownOpeners,
			currentMenu;


		if(menus.length) {
			menus.each(function() {
				currentMenu = $(this);

				dropdownOpeners = currentMenu.find('li.menu-item-has-children > a');

				if(dropdownOpeners.length) {
					dropdownOpeners.each(function() {
						var currentDropdownOpener = $(this);

						currentDropdownOpener.on('click', function(e) {
							e.preventDefault();

							var dropdownToOpen = currentDropdownOpener.parent().children('.sub-menu');

							if(dropdownToOpen.is(':visible')) {
								dropdownToOpen.slideUp();
								currentDropdownOpener.removeClass('edgt-custom-menu-active');
							} else {
								dropdownToOpen.slideDown();
								currentDropdownOpener.addClass('edgt-custom-menu-active');
							}
						});
					});
				}
			});
		}
	}
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * return array
	 */
	function setLoadMoreAjaxData(container, action){
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var edgtIconWithHover = function() {
		//get all icons on page
		var icons = $('.edgt-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function edgtInitParallax(){
		var parallaxHolder = $('.edgt-parallax-row-holder');
		
		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					image = parallaxElement.data('parallax-bg-image'),
					speed = parallaxElement.data('parallax-bg-speed') * 0.4,
					height = 0;
				
				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}
				
				parallaxElement.css({'background-image': 'url('+image+')'});
				
				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}

    /**
     * Init Owl Carousel
     */
    function edgtOwlSlider() {
        var sliders = $('.edgt-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    element,
	                slideItemsNumber = slider.children().length,
	                numberOfItems = 1,
	                loop = true,
	                autoplay = true,
	                autoplayHoverPause = true,
	                sliderSpeed = 5000,
	                sliderSpeedAnimation = 600,
	                margin = 0,
					dragEndSpeed = 500,
	                responsiveMargin = 0,
	                stagePadding = 0,
	                stagePaddingEnabled = false,
	                center = false,
	                autoWidth = false,
	                animateInClass = false, // keyframe css animation
	                animateOut = false, // keyframe css animation
	                navigation = true,
	                pagination = false,
	                sliderIsPortfolio = !!slider.hasClass('edgt-pl-is-slider'),
	                sliderDataHolder = sliderIsPortfolio ? slider.parent() : slider;  // this is condition for portfolio slider

                slider.on('initialized.owl.carousel', function(event){
                    element = slider.find('.owl-item');

                    element.each(function(){
                        var thisElement = $(this),
                            flag = 0;

                        thisElement.on("mousedown", function(){
                            flag = 0;
                        });

                        thisElement.on("mousemove", function(){
                            flag = 1;
                        });

                        thisElement.on("mouseup", function(e){
                            if(flag === 0){
                                edgt.modules.common.edgtPrettyPhoto();
                            }
                            else if(flag === 1){
                                thisElement.find('a').unbind('click');
                            }
                        });

                        if(sliderIsPortfolio){
                            thisElement.data('');
                        }

                    });

                });
	
	            if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsPortfolio) {
		            numberOfItems = slider.data('number-of-items');
	            }
	            if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsPortfolio) {
		            numberOfItems = sliderDataHolder.data('number-of-columns');
	            }
	            if (sliderDataHolder.data('enable-loop') === 'no') {
		            loop = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay') === 'no') {
		            autoplay = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
		            autoplayHoverPause = false;
	            }
	            if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
		            sliderSpeed = sliderDataHolder.data('slider-speed');
	            }
	            if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
		            sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
	            }
	            if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
		            margin = sliderDataHolder.data('slider-margin');
	            }

	            if(slider.parent().hasClass('edgt-ig-normal-space') || slider.parent().hasClass('edgt-normal-space')) {
		            margin = 30;
	            } else if (slider.parent().hasClass('edgt-ig-small-space') || slider.parent().hasClass('edgt-small-space')) {
		            margin = 15;
	            } else if (slider.parent().hasClass('edgt-ig-tiny-space') || slider.parent().hasClass('edgt-tiny-space')) {
		            margin = 5;
	            }
                else if (slider.parent().hasClass('edgt-ig-no-space') || slider.parent().hasClass('edgt-no-space')) {
                    margin = 0;
                }
                else {
                    margin = 50;
                }
	            if (sliderDataHolder.data('slider-padding') === 'yes') {
		            stagePaddingEnabled = true;
		            stagePadding = parseInt(slider.outerWidth() * 0.3);
		            margin = 50;
	            }
	            if (sliderDataHolder.data('enable-center') === 'yes') {
		            center = true;
	            }
	            if (sliderDataHolder.data('enable-auto-width') === 'yes') {
		            autoWidth = true;
	            }
	            if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
		            animateInClass = sliderDataHolder.data('slider-animate-in');
	            }
	            if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
		            animateOut = sliderDataHolder.data('slider-animate-out');
	            }
	            if (sliderDataHolder.data('enable-navigation') === 'no') {
		            navigation = false;
	            }
	            if (sliderDataHolder.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }
	            
	            if(navigation && pagination) {
		            slider.addClass('edgt-slider-has-both-nav');
	            }
	
	            if (slideItemsNumber <= 1) {
		            loop       = false;
		            autoplay   = false;
		            navigation = false;
		            pagination = false;
	            }
	
	            var responsiveNumberOfItems1 = 1,
		            responsiveNumberOfItems2 = 2,
		            responsiveNumberOfItems3 = 3,
		            responsiveNumberOfItems4 = numberOfItems;
	
	            if (numberOfItems < 3) {
		            responsiveNumberOfItems2 = numberOfItems;
		            responsiveNumberOfItems3 = numberOfItems;
	            }
	
	            if (numberOfItems > 4) {
		            responsiveNumberOfItems4 = 4;
	            }
	            
	            if (stagePaddingEnabled || margin > 0) {
	            	responsiveMargin = 20;
	            }

				slider.waitForImages(function() {
					slider.owlCarousel({
						items: numberOfItems,
						loop: loop,
						autoplay: autoplay,
						autoplayHoverPause: autoplayHoverPause,
						autoplayTimeout: sliderSpeed,
						smartSpeed: sliderSpeedAnimation,
						margin: margin,
						stagePadding: stagePadding,
						center: center,
						autoWidth: autoWidth,
						dragEndSpeed: dragEndSpeed,
						animateInClass: animateInClass,
						animateOut: animateOut,
						dots: pagination,
						nav: navigation,
						navText: [
							'<span class="edgt-prev-icon"><span class="edgt-icon-arrow fa fa-angle-left"></span></span>',
							'<span class="edgt-next-icon"><span class="edgt-icon-arrow fa fa-angle-right"></span></span>'
						],
						responsive: {
							0: {
								items: responsiveNumberOfItems1,
								margin: responsiveMargin,
								stagePadding: 0,
								center: false,
								autoWidth: false
							},
							681: {
								items: responsiveNumberOfItems1,
								autoWidth: false
							},
							769: {
								items: responsiveNumberOfItems3
							},
							1025: {
								items: responsiveNumberOfItems4
							},
							1281: {
								items: numberOfItems
							}
						},
						onInitialize: function () {
							slider.css('visibility', 'visible');
							edgtInitParallax();
						}
					});
				});
			});
        }
    }

    function edgtTwitterResize(){

        var container = $('.edgt-twitter-list-holder');
        var listItem = container.find('.edgt-tl-item');
        var maxHeight = 0;

        listItem.each(function () {
            var height = $(this).find('.edgt-twitter-content-bottom').height();
            maxHeight = height > maxHeight ? height : maxHeight;
        });

        listItem.each(function () {
            $(this).find('.edgt-twitter-content-bottom').height(maxHeight);
        });

    }

})(jQuery);
(function($) {
    'use strict';

    var like = {};
    
    like.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function edgtOnDocumentReady() {
        edgtLikes();
    }

    function edgtLikes() {
        $(document).on('click','.edgt-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'educator_edge_like',
                likes_id: id,
                type: type
            };

            var like = $.post(edgtGlobalVars.vars.edgtAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    edgt.modules.blog = blog;

    blog.edgtOnDocumentReady = edgtOnDocumentReady;
    blog.edgtOnWindowLoad = edgtOnWindowLoad;
    blog.edgtOnWindowResize = edgtOnWindowResize;
    blog.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgtInitAudioPlayer();
        edgtInitBlogMasonry();
        edgtInitBlogListMasonry();
	    edgtInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtOnWindowLoad() {
	    edgtInitBlogPagination().init();
	    edgtInitBlogListShortcodePagination().init();
        edgtInitBlogChequered();
        edgtInitBlogMasonryGalleryAppear();
        edgtInitBlogNarrowAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtOnWindowResize() {
        edgtInitBlogMasonry();
	    edgtInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtOnWindowScroll() {
	    edgtInitBlogPagination().scroll();
	    edgtInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function edgtInitAudioPlayer() {
        var players = $('audio.edgt-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function edgtResizeBlogItems(size,container){

        if(container.hasClass('edgt-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edgt-post-size-default'),
                largeWidthMasonryItem = container.find('.edgt-post-size-large-width'),
                largeHeightMasonryItem = container.find('.edgt-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.edgt-post-size-large-width-height');

			if (edgt.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
        }
    }

    /**
    * Init Blog Masonry Layout
    */
    function edgtInitBlogMasonry() {
	    var holder = $('.edgt-blog-holder.edgt-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.edgt-blog-holder-inner'),
                    size = thisHolder.find('.edgt-blog-masonry-grid-sizer').width();
			    
                edgtResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.edgt-blog-masonry-grid-gutter',
						    columnWidth: '.edgt-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
				
				    setTimeout(function() {
					    masonry.isotope('layout');
				    }, 800);
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function edgtInitBlogChequered(){
        var container = $('.edgt-blog-holder.edgt-blog-chequered');
        var masonry = container.children('.edgt-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.edgt-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }
	
    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function edgtInitBlogMasonryGallery() {
        var blogList = $('.edgt-blog-holder.edgt-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.edgt-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.edgt-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                edgtInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function edgtInitBlogMasonryGalleryAppear() {
        var blogList = $('.edgt-blog-holder.edgt-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgt-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('edgt-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edgt-appeared');
                },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function edgtInitBlogNarrowAppear() {
        var blogList = $('.edgt-blog-holder.edgt-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgt-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('edgt-appeared');
                    },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('edgt-appeared');
                },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function edgtInitBlogPagination(){
		var holder = $('.edgt-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edgt-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;
			
			if(!thisHolder.hasClass('edgt-blog-pagination-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.edgt-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('edgt-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgt.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edgt-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('edgt-showing');
				
				var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'educator_edge_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtGlobalVars.vars.edgtAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('edgt-blog-type-masonry')){
								edgtInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                edgtResizeBlogItems(thisHolderInner.find('.edgt-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								edgtInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								edgtInitAudioPlayer();
								edgt.modules.common.edgtOwlSlider();
								edgt.modules.common.edgtFluidVideo();
                                edgt.modules.common.edgtInitSelfHostedVideoPlayer();
                                edgt.modules.common.edgtSelfHostedVideoSize();
                                edgtInitBlogNarrowAppear();
                                edgtInitBlogMasonryGalleryAppear();
                                edgtInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('edgt-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edgt-blog-pag-load-more').hide();
			}
		};
		
		var edgtInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function edgtInitBlogListMasonry() {
		var holder = $('.edgt-blog-list-holder.edgt-bl-masonry');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edgt-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgt-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.edgt-bl-grid-gutter',
							columnWidth: '.edgt-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function edgtInitBlogListShortcodePagination(){
		var holder = $('.edgt-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.edgt-bl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edgt-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;
			
			if(!thisHolder.hasClass('edgt-bl-pag-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.edgt-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll')) {
				thisHolder.addClass('edgt-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgt.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edgt-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
					loadingItem.addClass('edgt-showing edgt-standard-pag-trigger');
					thisHolder.addClass('edgt-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('edgt-showing');
				}
				
				var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'educator_edge_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtGlobalVars.vars.edgtAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
							edgtInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edgt-bl-masonry')){
									edgtInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									edgtInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edgt-bl-masonry')){
									edgtInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									edgtInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('edgt-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edgt-blog-pag-load-more').hide();
			}
		};
		
		var edgtInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.edgt-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edgt-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edgt-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edgt-bl-pag-next a');
			
			standardPagNumericItem.removeClass('edgt-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edgt-bl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgtInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisHolder.removeClass('edgt-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisHolder.removeClass('edgt-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var edgtInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgt-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    edgt.modules.headerMinimal = headerMinimal;
	
	headerMinimal.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgtFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function edgtFullscreenMenu() {
	    var popupMenuOpener = $( 'a.edgt-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".edgt-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.edgt-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.edgt-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.edgt-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.edgt-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.edgt-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            popupMenuHolderOuter.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(edgt.windowHeight);
            });

            if (edgt.body.hasClass('edgt-fade-push-text-right')) {
                cssClass = 'edgt-push-nav-right';
                fadeRight = true;
            } else if (edgt.body.hasClass('edgt-fade-push-text-top')) {
                cssClass = 'edgt-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('edgt-fm-opened')) {
                    popupMenuOpener.addClass('edgt-fm-opened');
                    edgt.body.removeClass('edgt-fullscreen-fade-out').addClass('edgt-fullscreen-menu-opened edgt-fullscreen-fade-in');
                    edgt.body.removeClass(cssClass);
                    edgt.modules.common.edgtDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode == 27 ) {
                            popupMenuOpener.removeClass('edgt-fm-opened');
                            edgt.body.removeClass('edgt-fullscreen-menu-opened edgt-fullscreen-fade-in').addClass('edgt-fullscreen-fade-out');
                            edgt.body.addClass(cssClass);
                            edgt.modules.common.edgtEnableScroll();
                            
                            $("nav.edgt-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('edgt-fm-opened');
                    edgt.body.removeClass('edgt-fullscreen-menu-opened edgt-fullscreen-fade-in').addClass('edgt-fullscreen-fade-out');
                    edgt.body.addClass(cssClass);
                    edgt.modules.common.edgtEnableScroll();
                    
                    $("nav.edgt-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent();

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint');
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(menuItemWithChild.length === 1) {
			                thisItemParent.removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint');
		                } else {
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                submenu.slideDown(400, 'easeInOutQuint');
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.click(function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which == 1) {
                        popupMenuOpener.removeClass('edgt-fm-opened');
                        edgt.body.removeClass('edgt-fullscreen-menu-opened');
                        edgt.body.removeClass('edgt-fullscreen-fade-in').addClass('edgt-fullscreen-fade-out');
                        edgt.body.addClass(cssClass);
                        $("nav.edgt-fullscreen-menu ul.sub_menu").slideUp(200);
                        edgt.modules.common.edgtEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var mobileHeader = {};
    edgt.modules.mobileHeader = mobileHeader;
	
	mobileHeader.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgtInitMobileNavigation();
        edgtMobileHeaderBehavior();
    }

    function edgtInitMobileNavigation() {
        var mobileHeader = $('.edgt-mobile-header');
        var navigationOpener = $('.edgt-mobile-header .edgt-mobile-menu-opener, .edgt-close-mobile-side-area-holder');
        var navigationHolder = $('.edgt-mobile-header .edgt-mobile-side-area');
        var navigationMenuHolder = $('.edgt-mobile-header .edgt-mobile-nav');
        var dropdownOpener = $('.edgt-mobile-nav .mobile_arrow, .edgt-mobile-nav h6, .edgt-mobile-nav a.edgt-mobile-no-link');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.hasClass('opened')) {
                    navigationHolder.removeClass('opened');
                } else {
                    navigationHolder.addClass('opened');
                }
            });
        }

        //init scrollable menu
        var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
        var scrollHeight = navigationHolder.outerHeight() - mobileHeaderHeight > edgt.windowHeight ?  edgt.windowHeight - mobileHeaderHeight - 100 : navigationHolder.height();
        navigationMenuHolder.height(scrollHeight);
        navigationMenuHolder.perfectScrollbar({
            wheelSpeed: 0.6,
            suppressScrollX: true
        });

        $(window).resize(function() {
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var scrollHeight = navigationHolder.outerHeight() - mobileHeaderHeight > edgt.windowHeight ?  edgt.windowHeight - mobileHeaderHeight - 100 : navigationHolder.height();
            navigationMenuHolder.height(scrollHeight);
            navigationMenuHolder.perfectScrollbar('update');
        });

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('edgt-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('edgt-opened');
                            openerParent.siblings().removeClass('edgt-opened');
                            openerParent.siblings().children('ul').slideUp(animationSpeed);
                        }
                    }

                });
            });
        }

        $('.edgt-mobile-nav a, .edgt-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function edgtMobileHeaderBehavior() {
	    var mobileHeader = $('.edgt-mobile-header'),
		    mobileMenuOpener = mobileHeader.find('.edgt-mobile-menu-opener'),
		    mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
	    
	    if(edgt.body.hasClass('edgt-content-is-behind-header') && mobileHeaderHeight > 0 && edgt.windowWidth <= 1024) {
		    $('.edgt-content').css('marginTop', -mobileHeaderHeight);
	    }
	    
        if(edgt.body.hasClass('edgt-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                adminBar     = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + edgtGlobalVars.vars.edgtAddForAdminBar;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('edgt-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('edgt-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('edgt-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.edgt-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    edgt.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
	    if(edgt.windowWidth > 1024) {
		    edgtHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function edgtHeaderBehaviour() {
        var header = $('.edgt-page-header'),
	        stickyHeader = $('.edgt-sticky-header'),
            fixedHeaderWrapper = $('.edgt-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.edgt-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.edgt-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;

        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - edgtGlobalVars.vars.edgtAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case edgt.body.hasClass('edgt-sticky-header-on-scroll-up'):
                edgt.modules.stickyHeader.behaviour = 'edgt-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(edgtGlobalVars.vars.edgtTopBarHeight) + parseInt(edgtGlobalVars.vars.edgtLogoAreaHeight) + parseInt(edgtGlobalVars.vars.edgtMenuAreaHeight) + parseInt(edgtGlobalVars.vars.edgtStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        edgt.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgt-main-menu .second').removeClass('edgt-drop-down-start');
                        edgt.body.removeClass('edgt-sticky-header-appear');
                    } else {
                        edgt.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    edgt.body.addClass('edgt-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case edgt.body.hasClass('edgt-sticky-header-on-scroll-down-up'):
                edgt.modules.stickyHeader.behaviour = 'edgt-sticky-header-on-scroll-down-up';

                if(edgtPerPageVars.vars.edgtStickyScrollAmount !== 0){
                    edgt.modules.stickyHeader.stickyAppearAmount = parseInt(edgtPerPageVars.vars.edgtStickyScrollAmount);
                } else {
                    edgt.modules.stickyHeader.stickyAppearAmount = parseInt(edgtGlobalVars.vars.edgtTopBarHeight) + parseInt(edgtGlobalVars.vars.edgtLogoAreaHeight) + parseInt(edgtGlobalVars.vars.edgtMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(edgt.scroll < edgt.modules.stickyHeader.stickyAppearAmount) {
                        edgt.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.edgt-main-menu .second').removeClass('edgt-drop-down-start');
	                    edgt.body.removeClass('edgt-sticky-header-appear');
                    }else{
                        edgt.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    edgt.body.addClass('edgt-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case edgt.body.hasClass('edgt-fixed-on-scroll'):
                edgt.modules.stickyHeader.behaviour = 'edgt-fixed-on-scroll';
                var headerFixed = function(){
	                if(edgt.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                edgt.body.removeClass('edgt-fixed-header-appear');
		                fixedMenuArea.css({'height': fixedMenuAreaHeight + 'px'});
		                header.css('margin-bottom', '0');
                        var z = $('.edgt-fixed-wrapper:not(.fixed)').find('.edgt-logo-wrapper a');
                        z.css('max-height', fixedMenuAreaHeight + 'px');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                edgt.body.addClass('edgt-fixed-header-appear');
		                fixedMenuArea.css({'height': (fixedMenuAreaHeight - 10) + 'px'});
		                header.css('margin-bottom', (fixedMenuAreaHeight - 10) + 'px');
                        var z = $('.edgt-fixed-wrapper.fixed').find('.edgt-logo-wrapper a');
                        z.css('max-height', (fixedMenuAreaHeight - 10) + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	edgt.modules.header = header;
	
	header.edgtSetDropDownMenuPosition     = edgtSetDropDownMenuPosition;
	header.edgtSetDropDownWideMenuPosition = edgtSetDropDownWideMenuPosition;
	
	header.edgtOnDocumentReady = edgtOnDocumentReady;
	header.edgtOnWindowLoad = edgtOnWindowLoad;
	
	$(document).ready(edgtOnDocumentReady);
	$(window).load(edgtOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtSetDropDownMenuPosition();
		edgtDropDownMenu();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function edgtOnWindowLoad() {
		edgtSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function edgtSetDropDownMenuPosition() {
		var menuItems = $('.edgt-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = edgt.windowWidth - menuItemPosition;
				
				if (edgt.body.hasClass('edgt-boxed')) {
					menuItemFromLeft = edgt.boxedLayoutWidth - (menuItemPosition - (edgt.windowWidth - edgt.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function edgtSetDropDownWideMenuPosition(){
		var menuItems = $(".edgt-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
				var menuItemSubMenu = $(menuItems[i]).find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(edgt.body.hasClass('edgt-boxed')) {
						var boxedWidth = $('.edgt-boxed .edgt-wrapper .edgt-wrapper-inner').outerWidth();
						left_position = left_position - (edgt.windowWidth - boxedWidth) / 2;
						
						menuItemSubMenu.css('left', -left_position);
						menuItemSubMenu.css('width', boxedWidth);
					} else {
						menuItemSubMenu.css('left', -left_position);
						menuItemSubMenu.css('width', edgt.windowWidth);
					}
				}
			});
		}
	}
	
	function edgtDropDownMenu() {
		var menu_items = $('.edgt-drop-down > ul > li');
		
		menu_items.each(function(i) {
			if($(menu_items[i]).find('.second').length > 0) {
				var thisItem = $(menu_items[i]),
					dropDownSecondDiv = thisItem.find('.second');
				
				if(thisItem.hasClass('wide')) {
					//set columns to be same height - start
					var tallest = 0,
						dropDownSecondItem = $(this).find('.second > .inner > ul > li');
                    dropDownSecondItem.waitForImages(function() {
                        dropDownSecondItem.each(function () {
                            var thisHeight = $(this).height();
                            if (thisHeight > tallest) {
                                tallest = thisHeight;
                            }
                        });
                    });
					
					dropDownSecondItem.css('height', ''); // delete old inline css - via resize
					dropDownSecondItem.height(tallest);
					//set columns to be same height - end
				}
				
				if(!edgt.menuDropdownHeightSet) {
					thisItem.data('original_height', dropDownSecondDiv.height() + 'px');
					dropDownSecondDiv.height(0);
				}
				
				if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					thisItem.on("touchstart mouseenter", function() {
						dropDownSecondDiv.css({
							'height': thisItem.data('original_height'),
							'overflow': 'visible',
							'visibility': 'visible',
							'opacity': '1'
						});
					}).on("mouseleave", function() {
						dropDownSecondDiv.css({
							'height': '0px',
							'overflow': 'hidden',
							'visibility': 'hidden',
							'opacity': '0'
						});
					});
				} else {
					if(edgt.body.hasClass('edgt-dropdown-animate-height')) {
						thisItem.mouseenter(function() {
							dropDownSecondDiv.css({
								'visibility': 'visible',
								'height': '0px',
								'opacity': '0'
							});
							dropDownSecondDiv.stop().animate({
								'height': thisItem.data('original_height'),
								opacity: 1
							}, 300, function() {
								dropDownSecondDiv.css('overflow', 'visible');
							});
						}).mouseleave(function() {
							dropDownSecondDiv.stop().animate({
								'height': '0px'
							}, 150, function() {
								dropDownSecondDiv.css({
									'overflow': 'hidden',
									'visibility': 'hidden'
								});
							});
						});
					} else {
						var config = {
							interval: 0,
							over: function() {
								setTimeout(function() {
									dropDownSecondDiv.addClass('edgt-drop-down-start');
                                    dropDownSecondDiv.waitForImages(function() {
                                        dropDownSecondDiv.stop().css({'height': thisItem.data('original_height')});
                                    });
								}, 150);
							},
							timeout: 150,
							out: function() {
								dropDownSecondDiv.stop().css({'height': '0px'});
								dropDownSecondDiv.removeClass('edgt-drop-down-start');
							}
						};
						thisItem.hoverIntent(config);
					}
				}
			}
		});
		
		$('.edgt-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which == 1){
				var $this = $(this);
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		edgt.menuDropdownHeightSet = true;
	}
	
})(jQuery);
(function($) {
    "use strict";

    var search = {};
    edgt.modules.search = search;

    search.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtSearch();
    }

    /**
     * Init Search Types
     */
    function edgtSearch() {
        var searchOpener = $('a.edgt-search-opener'),
            searchForm,
            searchClose;

        if ( searchOpener.length > 0 ) {
            //Check for type of search
           if ( edgt.body.hasClass( 'edgt-search-covers-header' ) ) {
               edgtSearchCoversHeader();
           }
        }

        /**
         * Search covers header type of search
         */
        function edgtSearchCoversHeader() {
            searchOpener.click(function (e) {
                e.preventDefault();

                var thisSearchOpener = $(this),
                    searchFormHeight,
                    searchFormHeaderHolder = $('.edgt-page-header'),
                    searchFormTopHeaderHolder = $('.edgt-top-bar'),
                    searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.edgt-fixed-wrapper.fixed'),
                    searchFormMobileHeaderHolder = $('.edgt-mobile-header'),
                    searchForm = $('.edgt-search-cover'),
                    searchFormIsInTopHeader = !!thisSearchOpener.parents('.edgt-top-bar').length,
                    searchFormIsInFixedHeader = !!thisSearchOpener.parents('.edgt-fixed-wrapper.fixed').length,
                    searchFormIsInStickyHeader = !!thisSearchOpener.parents('.edgt-sticky-header').length,
                    searchFormIsInMobileHeader = !!thisSearchOpener.parents('.edgt-mobile-header').length;

                searchForm.removeClass('edgt-is-active');

                //Find search form position in header and height
                if (searchFormIsInTopHeader) {
                    searchFormHeight = edgtGlobalVars.vars.edgtTopBarHeight;
                    searchFormTopHeaderHolder.find('.edgt-search-cover').addClass('edgt-is-active');

                } else if (searchFormIsInFixedHeader) {
                    searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                    searchFormHeaderHolder.children('.edgt-search-cover').addClass('edgt-is-active');

                } else if (searchFormIsInStickyHeader) {
                    searchFormHeight = $('.edgt-sticky-header.header-appear').height();
                    searchFormHeaderHolder.children('.edgt-search-cover').addClass('edgt-is-active');

                } else if (searchFormIsInMobileHeader) {
                    if(searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                        searchFormHeight = searchFormMobileHeaderHolder.children('.edgt-mobile-header-inner').outerHeight();
                    } else {
                        searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                    }

                    searchFormMobileHeaderHolder.find('.edgt-search-cover').addClass('edgt-is-active');

                } else {
                    searchFormHeight = searchFormHeaderHolder.outerHeight();
                    searchFormHeaderHolder.children('.edgt-search-cover').addClass('edgt-is-active');
                }

                if(searchForm.hasClass('edgt-is-active')) {
                    searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                }

                searchForm.find('.edgt-search-close').click(function (e) {
                    e.preventDefault();
                    searchForm.stop(true).fadeOut(450);
                });

                searchForm.blur(function () {
                    searchForm.stop(true).fadeOut(450);
                });

                $(window).scroll(function(){
                    searchForm.stop(true).fadeOut(450);
                });
            });
        }


    }

})(jQuery);

(function($) {
    "use strict";

    var sidearea = {};
    edgt.modules.sidearea = sidearea;

    sidearea.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
	    edgtSideArea();
	    edgtSideAreaScroll();
    }
	
	/**
	 * Show/hide side area
	 */
	function edgtSideArea() {
		var wrapper = $('.edgt-wrapper'),
			sideMenuButtonOpen = $('a.edgt-side-menu-button-opener'),
            sideMenuCloser = $('.edgt-close-side-menu-holder'),
            headerTop = $('.edgt-top-bar'),
			cssClass = 'edgt-right-side-menu-opened';
		
		wrapper.prepend('<div class="edgt-cover"/>');
		
		$('a.edgt-side-menu-button-opener, a.edgt-close-side-menu').click( function(e) {
			e.preventDefault();
			
			if(!sideMenuButtonOpen.hasClass('opened')) {
				sideMenuButtonOpen.addClass('opened');
				edgt.body.addClass(cssClass);
				
				$('.edgt-wrapper .edgt-cover').click(function() {
					edgt.body.removeClass('edgt-right-side-menu-opened');
					sideMenuButtonOpen.removeClass('opened');
				});
				
				var currentScroll = $(window).scrollTop();
				$(window).scroll(function() {
					if(Math.abs(edgt.scroll - currentScroll) > 400){
						edgt.body.removeClass(cssClass);
						sideMenuButtonOpen.removeClass('opened');
					}
				});
			} else {
				sideMenuButtonOpen.removeClass('opened');
				edgt.body.removeClass(cssClass);
			}
		});

        if(headerTop.length && edgt.body.hasClass('edgt-side-menu-slide-from-right')){
            var headerTopHeight = headerTop.height();
            var closingIconPosition = sideMenuCloser.css('top');
            var temp = sideMenuCloser.css('top').indexOf('px');
            closingIconPosition = Number(closingIconPosition.substring(0, temp)) + headerTopHeight;
            sideMenuCloser.css('top', closingIconPosition);
            console.log(closingIconPosition);
        }

	}
	
	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function edgtSideAreaScroll(){
		var sideMenu = $('.edgt-side-menu');
		
		if(sideMenu.length){
			sideMenu.perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
		}
	}

})(jQuery);

(function($) {
    "use strict";

    var title = {};
    edgt.modules.title = title;

    title.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgtParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
    function edgtParallaxTitle() {
        var parallaxBackground = $('.edgt-title-holder.edgt-bg-parallax');

        if (parallaxBackground.length > 0 && edgt.windowWidth > 1024) {
            var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('edgt-bg-parallax-zoom-out'),
                titleHeight = parseInt(parallaxBackground.data('height')),
                imageWidth = parseInt(parallaxBackground.data('background-width')),
                parallaxRate = titleHeight / 10000 * 7,
                parallaxYPos = -(edgt.scroll * parallaxRate),
                adminBarHeight = edgtGlobalVars.vars.edgtAddForAdminBar;

            parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});

            if (parallaxBackgroundWithZoomOut) {
                parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - edgt.scroll + 'px auto'});
            }

            //set position of background on window scroll
            $(window).scroll(function () {
                parallaxYPos = -(edgt.scroll * parallaxRate);
                parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});

                if (parallaxBackgroundWithZoomOut) {
                    parallaxBackgroundWithZoomOut.css({'background-size': imageWidth - edgt.scroll + 'px auto'});
                }
            });
        }
    }

})(jQuery);

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
(function($) {
    'use strict';
	
	var masonryGallery = {};
	edgt.modules.masonryGallery = masonryGallery;
	
	masonryGallery.edgtInitMasonryGallery = edgtInitMasonryGallery;
	
	
	masonryGallery.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitMasonryGallery();
		edgtInitMasonryGalleryIcon();
	}
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function edgtInitMasonryGallery(){
		var galleryHolder = $('.edgt-masonry-gallery-holder'),
			gallery = galleryHolder.children('.edgt-mg-inner'),
			gallerySizer = gallery.children('.edgt-mg-grid-sizer');
		
		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
		
		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.edgt-mg-inner');
				
				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});
					
					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgt-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.edgt-mg-grid-gutter',
							columnWidth: '.edgt-mg-grid-sizer'
						}
					});
				});
			});
			
			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
				
				gallery.isotope('reloadItems');
			});
		}
	}
	
	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.edgt-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.edgt-mg-rectangle-landscape'),
			square_big = holder.find('.edgt-mg-square-big'),
			square_small = holder.find('.edgt-mg-square-small');
		
		rectangle_portrait.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}
		
		square_big.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}
		
		square_small.css('height', size);
	}

	/**
	 * Masonry gallery standardt type icon hover init
	 */

	function edgtInitMasonryGalleryIcon() {
		var edgtMasonryGallery = $('.edgt-masonry-gallery-holder');

		if(edgtMasonryGallery.length){
			edgtMasonryGallery.each(function(){
				var thisPortList = $(this).children('.edgt-mg-inner');

				thisPortList.children('article.edgt-mg-simple').each(function(l) {
					var thisArticle = $(this);

					thisArticle.mouseenter(function(){
						thisArticle.addClass('edgt-mg-hover');

						thisArticle.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
							thisArticle.removeClass('edgt-mg-hover');
						});
					});

				});
			});
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    edgt.modules.portfolio = portfolio;

    portfolio.edgtOnDocumentReady = edgtOnDocumentReady;
    portfolio.edgtOnWindowLoad = edgtOnWindowLoad;
    portfolio.edgtOnWindowResize = edgtOnWindowResize;
    portfolio.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
    }


    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitPortfolioMasonry();
        edgtInitPortfolioFilter();
        initPortfolioSingleMasonry();
        edgtInitPortfolioListAnimation();
	    edgtInitPortfolioPagination().init();
        edgtPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {
        edgtInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
	    edgtInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgtInitPortfolioListAnimation(){
        var portList = $('.edgt-portfolio-list-holder.edgt-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.edgt-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('edgt-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('edgt-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function edgtInitPortfolioMasonry(){
        var portList = $('.edgt-portfolio-list-holder.edgt-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.edgt-pl-inner'),
                    size = thisPortList.find('.edgt-pl-grid-sizer').width();
                
                edgtResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.edgt-pl-grid-gutter',
                        columnWidth: '.edgt-pl-grid-sizer'
                    }
                });
                
                setTimeout(function () {
	                edgt.modules.common.edgtInitParallax();
                }, 600);

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Portfolio Items
     */
    function edgtResizePortfolioItems(size,container){
        if(container.hasClass('edgt-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edgt-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.edgt-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.edgt-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.edgt-pl-masonry-large-width-height');

            if (edgt.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function edgtInitPortfolioFilter(){
        var filterHolder = $('.edgt-portfolio-list-holder .edgt-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.edgt-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.edgt-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('edgt-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.edgt-pl-filter:first').addClass('edgt-pl-current');
	            
	            if(thisPortListHolder.hasClass('edgt-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.edgt-pl-filter').click(function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.edgt-pl-filter').removeClass('edgt-pl-current');
                    thisFilter.addClass('edgt-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        edgtInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.edgt-pl-inner').isotope({ filter: filterValue });
	                    edgt.modules.common.edgtInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function edgtInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.edgt-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = edgt.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edgt_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.edgt-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('edgt-showing edgt-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                edgtResizePortfolioItems(thisPortListInner.find('.edgt-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('edgt-showing edgt-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    edgtInitPortfolioListAnimation();
	                                edgt.modules.common.edgtInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('edgt-showing edgt-filter-trigger');
                            edgtInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function edgtInitPortfolioPagination(){
		var portList = $('.edgt-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.edgt-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.edgt-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;
			
			if(!thisPortList.hasClass('edgt-pl-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.edgt-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('edgt-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('edgt-pl-pag-infinite-scroll')) {
				thisPortList.addClass('edgt-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgt.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.edgt-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('edgt-pl-pag-standard')) {
					loadingItem.addClass('edgt-showing edgt-standard-pag-trigger');
					thisPortList.addClass('edgt-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('edgt-showing');
				}
				
				var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edgt_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtGlobalVars.vars.edgtAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('edgt-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('edgt-pl-pag-standard')) {
							edgtInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edgt-pl-masonry')){
									edgtInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edgt-pl-gallery') && thisPortList.hasClass('edgt-pl-has-filter')) {
									edgtInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgtInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edgt-pl-masonry')){
									edgtInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edgt-pl-gallery') && thisPortList.hasClass('edgt-pl-has-filter')) {
									edgtInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgtInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('edgt-pl-infinite-scroll-started')) {
							thisPortList.removeClass('edgt-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.edgt-pl-load-more-holder').hide();
			}
		};
		
		var edgtInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.edgt-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edgt-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edgt-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edgt-pl-pag-next a');
			
			standardPagNumericItem.removeClass('edgt-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edgt-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgtInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            edgtResizePortfolioItems(thisPortListInner.find('.edgt-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisPortList.removeClass('edgt-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgtInitPortfolioListAnimation();
				edgt.modules.common.edgtInitParallax();
			}, 600);
		};
		
		var edgtInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisPortList.removeClass('edgt-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			edgtInitPortfolioListAnimation();
			edgt.modules.common.edgtInitParallax();
		};
		
		var edgtInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
            edgtResizePortfolioItems(thisPortListInner.find('.edgt-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgtInitPortfolioListAnimation();
				edgt.modules.common.edgtInitParallax();
			}, 600);
		};
		
		var edgtInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing');
			thisPortListInner.append(responseHtml);
			edgtInitPortfolioListAnimation();
			edgt.modules.common.edgtInitParallax();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edgt-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edgt-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edgt-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edgt-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}
	
	var edgtPortfolioSingleFollow = function() {
		var info = $('.edgt-follow-portfolio-info .edgt-portfolio-single-holder .edgt-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.edgt-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .edgt-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0;
		}
		
		var infoHolderPosition = function() {
			if(info.length) {
				if (mediaHolderHeight > infoHolderHeight) {
					if(edgt.scroll > infoHolderOffset) {
						var marginTop = edgt.scroll - infoHolderOffset + edgtGlobalVars.vars.edgtAddForAdminBar + headerHeight;
						// if scroll is initially positioned below mediaHolderHeight
						if(marginTop + infoHolderHeight > mediaHolderHeight){
							marginTop = mediaHolderHeight - infoHolderHeight;
						}
						info.stop().animate({
							marginTop: marginTop
						});
					}
				}
			}
		};
		
		var recalculateInfoHolderPosition = function() {
			if (info.length) {
				if(mediaHolderHeight > infoHolderHeight) {
					if(edgt.scroll > infoHolderOffset) {
						
						if(edgt.scroll + headerHeight + edgtGlobalVars.vars.edgtAddForAdminBar + infoHolderHeight + 50 < infoHolderOffset + mediaHolderHeight) { //50 to prevent mispositioning
							
							//Calculate header height if header appears
							if ($('.header-appear, .edgt-fixed-wrapper').length) {
								headerHeight = $('.header-appear, .edgt-fixed-wrapper').height();
							}
							info.stop().animate({
								marginTop: (edgt.scroll - infoHolderOffset + edgtGlobalVars.vars.edgtAddForAdminBar + headerHeight)
							});
							//Reset header height
							headerHeight = 0;
						}
						else{
							info.stop().animate({
								marginTop: mediaHolderHeight - infoHolderHeight
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			}
		};
		
		return {
			init : function() {
				infoHolderPosition();
				$(window).scroll(function(){
					recalculateInfoHolderPosition();
				});
			}
		};
	};
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.edgt-portfolio-single-holder .edgt-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.edgt-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.edgt-ps-grid-gutter',
                    columnWidth: '.edgt-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);
(function($) {
    'use strict';

    var course = {};
    edgt.modules.course = course;

	course.edgtOnDocumentReady = edgtOnDocumentReady;
	course.edgtOnWindowLoad = edgtOnWindowLoad;
	course.edgtOnWindowResize = edgtOnWindowResize;
	course.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
	    edgtInitCoursePopup();
	    edgtInitCoursePopupClose();
	    edgtCompleteItem();
	    edgtCourseAddToWishlist();
	    edgtRetakeCourse();
	    edgtSearchCourses();
	    edgtInitCourseList();
	    edgtInitAdvancedCourseSearch();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitCourseListAnimation();
        edgtInitCoursePagination().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
        edgtInitCoursePagination().scroll();
    }


    function edgtInitCoursePopup(){
	    var elements = $('.edgt-element-link-open');
	    var popup = $('.edgt-course-popup');
	    var popupContent = $('.edgt-popup-content');

        if(elements.length){
	        elements.each(function(){
				var element = $(this);
		        element.on('click', function(e){
			        e.preventDefault();
			        if(!popup.hasClass('edgt-course-popup-opened')){
				        popup.addClass('edgt-course-popup-opened');
				        edgt.modules.common.edgtDisableScroll();
			        }
			        var courseId = 0;
			        if(typeof element.data('course-id') !== 'undefined' && element.data('course-id') !== false) {
				        courseId = element.data('course-id');
			        }
                    edgtPopupScroll();
			        edgtLoadElementItem(element.data('item-id'),courseId, popupContent);
		        });
	        });
        }
    }
	function edgtInitCourseItemsNavigation(){
		var elements = $('.edgt-course-popup-navigation .edgt-element-link-open');
		var popupContent = $('.edgt-popup-content');

		if(elements.length){
			elements.each(function(){
				var element = $(this);
				element.on('click', function(e){
					e.preventDefault();
					var courseId = 0;
					if(typeof element.data('course-id') !== 'undefined' && element.data('course-id') !== false) {
						courseId = element.data('course-id');
					}
					edgtLoadElementItem(element.data('item-id'),courseId, popupContent);
				});
			});
		}
	}

	function edgtInitCoursePopupClose(){
		var closeButton = $('.edgt-course-popup-close');
		var popup = $('.edgt-course-popup');
		if(closeButton.length){
			closeButton.on('click', function(e){
				e.preventDefault();
				popup.removeClass('edgt-course-popup-opened');
				location.reload();
			});
		}
	}

	function edgtLoadElementItem(id ,courseId, container){
        var preloader = container.prevAll('.edgt-course-item-preloader');
        preloader.removeClass('edgt-hide');
		var ajaxData = {
			action: 'edgt_lms_load_element_item',
			item_id : id,
			course_id : courseId
		};
		$.ajax({
			type: 'POST',
			data: ajaxData,
			url: edgtGlobalVars.vars.edgtAjaxUrl,
			success: function (data) {
				var response = JSON.parse(data);
				if(response.status == 'success'){
					container.html(response.data.html);
					edgtInitCourseItemsNavigation();
					edgtCompleteItem();
					edgtSearchCourses();
                    edgt.modules.quiz.edgtStartQuiz();
                    edgt.modules.common.edgtFluidVideo();
                    preloader.addClass('edgt-hide');
				} else {
				    alert("An error occurred");
                    preloader.addClass('edgt-hide');
                }

			}
		});

	}

	function edgtCompleteItem(){

		$('.edgt-lms-complete-item-form').on('submit',function(e) {

			e.preventDefault();
			var form = $(this);
			var itemID = $(this).find( "input[name$='edgt_lms_item_id']").val();
			var formData = form.serialize();
			var ajaxData = {
				action: 'edgt_lms_complete_item',
				post: formData
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: edgtGlobalVars.vars.edgtAjaxUrl,
				success: function (data) {
					var response = JSON.parse(data);
					if(response.status == 'success'){

						form.replaceWith(response.data['content_message']);
						var elements =  $('.edgt-section-element.edgt-section-lesson');
						elements.each(function () {
							if($(this).data('section-element-id') == itemID){
								$(this).addClass('edgt-item-completed')
							}
						})
					}
				}
			});
		});

	}

	function edgtRetakeCourse(){

		$('.edgt-lms-retake-course-form').on('submit',function(e) {

			e.preventDefault();
			var form = $(this);
			var formData = form.serialize();
			var ajaxData = {
				action: 'edgt_lms_retake_course',
				post: formData
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: edgtGlobalVars.vars.edgtAjaxUrl,
				success: function (data) {
					var response = JSON.parse(data);
					if(response.status == 'success'){
						alert(response.message);
                        location.reload();
					}
				}
			});
		});

	}

	function edgtPopupScroll(){


        var mainHolder = $('.edgt-course-popup');

        /* Content items */
		var content = $('.edgt-popup-content');
		var contentHolder = $('.edgt-course-popup-inner');
		var contentHeading = $('.edgt-popup-heading');

		/* Navigation items */
        var navigationHolder = $('.edgt-course-popup-items');
        var navigationWrapper = $('.edgt-popup-info-wrapper');
        var searchHolder = $('.edgt-lms-search-holder');

        if(edgt.windowWidth > 1024) {
            if (content.length) {
                content.height(mainHolder.height() - contentHeading.outerHeight());
                content.perfectScrollbar({
                    wheelSpeed: 0.6,
                    suppressScrollX: true
                });
            }

            if (navigationHolder.length) {
                navigationHolder.height(mainHolder.height() - parseInt(navigationWrapper.css('padding-top')) - parseInt(navigationWrapper.css('padding-bottom')) - searchHolder.outerHeight(true));
                navigationHolder.perfectScrollbar({
                    wheelSpeed: 0.6,
                    suppressScrollX: true
                });
            }
        } else {
            contentHolder.find('.edgt-grid-row').height(mainHolder.height());
            contentHolder.find('.edgt-grid-row').perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
        }

		return true

	}

	function edgtCourseAddToWishlist(){

		$('.edgt-course-wishlist').on('click',function(e) {
			e.preventDefault();
			var course = $(this),
				courseId;

			if(typeof course.data('course-id') !== 'undefined') {
				courseId = course.data('course-id');
			}

            edgtCoursewishlistAdding(course, courseId);

		});

	}

	function edgtCoursewishlistAdding(course, courseId){

		var ajaxData = {
			action: 'edgt_lms_add_course_to_wishlist',
			course_id : courseId
		};

		$.ajax({
			type: 'POST',
			data: ajaxData,
			url: edgtGlobalVars.vars.edgtAjaxUrl,
			success: function (data) {
				var response = JSON.parse(data);
				if(response.status == 'success'){
                    if(!course.hasClass('edgt-icon-only')) {
                        course.find('span').text(response.data.message);
                    }
                    course.find('i').removeClass('fa fa-heart-o fa-heart').addClass(response.data.icon);
				}
			}
		});

		return false;

	}

	function edgtSearchCourses(){

        var courseSearchHolder = $('.edgt-lms-search-holder');

        if (courseSearchHolder.length) {
            courseSearchHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.edgt-lms-search-field'),
                    resultsHolder = thisSearch.find('.edgt-lms-search-results'),
                    searchLoading = thisSearch.find('.edgt-search-loading'),
                    searchIcon = thisSearch.find('.edgt-search-icon');

                searchLoading.addClass('edgt-hidden');

                var keyPressTimeout;

                searchField.on('keyup paste', function(e) {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('edgt-hidden');
                    searchIcon.addClass('edgt-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('edgt-hidden');
                            searchIcon.removeClass('edgt-hidden');
                        } else {
                            var ajaxData = {
                                action: 'edgt_lms_search_courses',
                                term: searchTerm
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: edgtGlobalVars.vars.edgtAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status == 'success') {
                                        searchLoading.addClass('edgt-hidden');
                                        searchIcon.removeClass('edgt-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('edgt-hidden');
                                    searchIcon.removeClass('edgt-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('edgt-hidden');
                    searchIcon.removeClass('edgt-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }

	}

    /**
     * Initializes course pagination functions
     */
    function edgtInitCoursePagination(){
        var courseList = $('.edgt-course-list-holder');

        var initStandardPagination = function(thisCourseList) {
            var standardLink = thisCourseList.find('.edgt-cl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisCourseList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisCourseList) {
            var loadMoreButton = thisCourseList.find('.edgt-cl-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisCourseList);
            });
        };

        var initInifiteScrollPagination = function(thisCourseList) {
            var courseListHeight = thisCourseList.outerHeight(),
                courseListTopOffest = thisCourseList.offset().top,
                courseListPosition = courseListHeight + courseListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;

            if(!thisCourseList.hasClass('edgt-cl-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > courseListPosition) {
                initMainPagFunctionality(thisCourseList);
            }
        };

        var initMainPagFunctionality = function(thisCourseList, pagedLink) {
            var thisCourseListInner = thisCourseList.find('.edgt-cl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisCourseList.data('max-num-pages') !== 'undefined' && thisCourseList.data('max-num-pages') !== false) {
                maxNumPages = thisCourseList.data('max-num-pages');
            }

            if(thisCourseList.hasClass('edgt-cl-pag-standard')) {
                thisCourseList.data('next-page', pagedLink);
            }

            if(thisCourseList.hasClass('edgt-cl-pag-infinite-scroll')) {
                thisCourseList.addClass('edgt-cl-infinite-scroll-started');
            }

            var loadMoreData = edgt.modules.common.getLoadMoreData(thisCourseList),
                loadingItem = thisCourseList.find('.edgt-cl-loading');

            nextPage = loadMoreData.nextPage;

            if(nextPage <= maxNumPages || maxNumPages == 0){
                if(thisCourseList.hasClass('edgt-cl-pag-standard')) {
                    loadingItem.addClass('edgt-showing edgt-standard-pag-trigger');
                    thisCourseList.addClass('edgt-cl-pag-standard-animate');
                } else {
                    loadingItem.addClass('edgt-showing');
                }

                var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreData, 'edgt_lms_course_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: edgtGlobalVars.vars.edgtAjaxUrl,
                    success: function (data) {
                        if(!thisCourseList.hasClass('edgt-cl-pag-standard')) {
                            nextPage++;
                        }

                        thisCourseList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html,
                            minValue = response.minValue,
                            maxValue = response.maxValue;

                        if(thisCourseList.hasClass('edgt-cl-pag-standard') || pagedLink == 1) {
                            edgtInitStandardPaginationLinkChanges(thisCourseList, maxNumPages, nextPage);
                            edgtInitHtmlGalleryNewContent(thisCourseList, thisCourseListInner, loadingItem, responseHtml);
                            edgtInitPostsCounterChanges(thisCourseList, minValue, maxValue);
                        } else {
                            edgtInitAppendGalleryNewContent(thisCourseListInner, loadingItem, responseHtml);
                            edgtInitPostsCounterChanges(thisCourseList, 1, maxValue);
                        }

                        if(thisCourseList.hasClass('edgt-cl-infinite-scroll-started')) {
                            thisCourseList.removeClass('edgt-cl-infinite-scroll-started');
                        }
                    }
                });
            }

            if(pagedLink == 1) {
                thisCourseList.find('.edgt-cl-load-more-holder').show();
            }

            if(nextPage === maxNumPages){
                thisCourseList.find('.edgt-cl-load-more-holder').hide();
            }
        };

        var edgtInitStandardPaginationLinkChanges = function(thisCourseList, maxNumPages, nextPage) {
            var standardPagHolder = thisCourseList.find('.edgt-cl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.edgt-cl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.edgt-cl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.edgt-cl-pag-next a');

            standardPagNumericItem.removeClass('edgt-cl-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('edgt-cl-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var edgtInitPostsCounterChanges = function(thisCourseList, minValue, maxValue) {
            var postsCounterHolder = thisCourseList.find('.edgt-course-items-counter');
            var minValueHolder = postsCounterHolder.find('.counter-min-value');
            var maxValueHolder = postsCounterHolder.find('.counter-max-value');
            minValueHolder.text(minValue);
            maxValueHolder.text(maxValue);
        };

        var edgtInitHtmlGalleryNewContent = function(thisCourseList, thisCourseListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
            thisCourseListInner.waitForImages(function() {
                thisCourseList.removeClass('edgt-cl-pag-standard-animate');
                thisCourseListInner.html(responseHtml);
                edgtInitCourseListAnimation();
                edgt.modules.common.edgtInitParallax();
            });
        };

        var edgtInitAppendGalleryNewContent = function(thisCourseListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgt-showing');
            thisCourseListInner.waitForImages(function() {
                thisCourseListInner.append(responseHtml);
                edgtInitCourseListAnimation();
                edgt.modules.common.edgtInitParallax();
            });
        };

        return {
            init: function() {
                if(courseList.length) {
                    courseList.each(function() {
                        var thisCourseList = $(this);

                        if(thisCourseList.hasClass('edgt-cl-pag-standard')) {
                            initStandardPagination(thisCourseList);
                        }

                        if(thisCourseList.hasClass('edgt-cl-pag-load-more')) {
                            initLoadMorePagination(thisCourseList);
                        }

                        if(thisCourseList.hasClass('edgt-cl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisCourseList);
                        }
                    });
                }
            },
            scroll: function() {
                if(courseList.length) {
                    courseList.each(function() {
                        var thisCourseList = $(this);

                        if(thisCourseList.hasClass('edgt-cl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisCourseList);
                        }
                    });
                }
            },
            getMainPagFunction: function(thisCourseList, paged) {
                initMainPagFunctionality(thisCourseList, paged);
            }
        };
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgtInitCourseListAnimation(){
        var courseList = $('.edgt-course-list-holder.edgt-cl-has-animation');

        if(courseList.length){
            courseList.each(function(){
                var thisCourseList = $(this).children('.edgt-cl-inner');

                thisCourseList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('edgt-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('edgt-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    function edgtInitCourseList() {
        var courseLists = $('.edgt-course-list-holder');
        if (courseLists.length) {
            courseLists.each(function () {
                var thisList = $(this);
                if (thisList.hasClass('edgt-cl-has-filter')) {
                    edgtInitCourseLayoutChange(thisList);
                    edgtInitCourseLayoutOrdering(thisList);
                }
            })
        }
    }

    function edgtInitCourseLayoutOrdering(thisList) {
        var filter = thisList.find('.edgt-cl-filter-holder .edgt-course-order-filter');
        filter.select2({
            minimumResultsForSearch: -1
        }).on('select2:select', function (evt) {
            var dataAtts = evt.params.data.element.dataset;
            var type = dataAtts.type;
            var order = dataAtts.order;
            thisList.data('order-by', type);
            thisList.data('order', order);
            thisList.data('next-page', 1);
            edgtInitCoursePagination().getMainPagFunction(thisList, 1);
        });
    }

    function edgtInitCourseLayoutChange(thisList) {
        var filter = thisList.find('.edgt-cl-filter-holder .edgt-course-layout-filter');
        var filterElements = filter.find('span');
        if (filter.length > 0) {
            filterElements.click(function() {
                filterElements.removeClass('edgt-active');
                var thisFilter = $(this);
                thisFilter.addClass('edgt-active');
                var type = thisFilter.data('type');
                thisList.removeClass('edgt-cl-gallery edgt-cl-simple');
                thisList.addClass('edgt-cl-' + type);
            });
        }
    }

    function edgtInitAdvancedCourseSearch() {
        var advancedCoursSearches = $('.edgt-advanced-course-search');
        if (advancedCoursSearches.length) {
            advancedCoursSearches.each(function () {
                var thisSearch = $(this);
                var select = thisSearch.find('select');
                if(select.length) {
                    select.each(function() {
                        var thisSelect = $(this);
                        thisSelect.select2({
                            minimumResultsForSearch: -1
                        });
                        thisSelect.next().addClass(thisSelect.attr('name'));
                    });
                }
            })
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var question = {};
    edgt.modules.question = question;

    question.edgtQuestionHint = edgtQuestionHint;
    question.edgtQuestionCheck = edgtQuestionCheck;
    question.edgtQuestionChange = edgtQuestionChange;
    question.edgtQuestionAnswerChange = edgtQuestionAnswerChange;
    question.edgtValidateAnswer = edgtValidateAnswer;
    question.edgtQuestionSave = edgtQuestionSave;

    question.edgtOnDocumentReady = edgtOnDocumentReady;
    question.edgtOnWindowLoad = edgtOnWindowLoad;
    question.edgtOnWindowResize = edgtOnWindowResize;
    question.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtQuestionHint();
        edgtQuestionCheck();
        edgtQuestionChange();
        edgtQuestionAnswerChange();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {

    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {

    }

    function edgtQuestionAnswerChange() {
        var answersHolder = $('.edgt-question-answers');
        var radios = answersHolder.find('input[type=radio]');
        var checkboxes = answersHolder.find('input[type=checkbox]');
        var textbox = answersHolder.find('input[type=text]');
        var checkForm = $('.edgt-lms-question-actions-check-form');
        var nextForm = $('.edgt-lms-question-next-form');
        var prevForm = $('.edgt-lms-question-prev-form');
        var finishForm = $('.edgt-lms-finish-quiz-form');

        radios.change(function() {
            checkForm.find('input[name=edgt_lms_question_answer]').val(this.value);
            nextForm.find('input[name=edgt_lms_question_answer]').val(this.value);
            prevForm.find('input[name=edgt_lms_question_answer]').val(this.value);
            finishForm.find('input[name=edgt_lms_question_answer]').val(this.value);
        });

        checkboxes.on('change', function() {
            var values = $('input[type=checkbox]:checked').map(function() {
                return this.value;
            }).get().join(',');
            checkForm.find('input[name=edgt_lms_question_answer]').val(values);
            nextForm.find('input[name=edgt_lms_question_answer]').val(values);
            prevForm.find('input[name=edgt_lms_question_answer]').val(values);
            finishForm.find('input[name=edgt_lms_question_answer]').val(values);
        }).change();

        textbox.on("change paste keyup", function() {
            checkForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
            nextForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
            prevForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
            finishForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
        });
    }

    function edgtUpdateQuestionPosition(questionPosition) {
        var positionHolder = $('.edgt-question-number-completed');
        positionHolder.text(questionPosition);
    }

    function edgtUpdateQuestionId(questionId) {
        var finishForm = $('.edgt-lms-finish-quiz-form');
        finishForm.find('input[name=edgt_lms_question_id]').val(questionId);
    }

    function edgtValidateAnswer(answersHolder, result, originalResult, answerChecked) {
        var radios = answersHolder.find('input[type=radio]');
        var checkboxes = answersHolder.find('input[type=checkbox]');
        var textbox = answersHolder.find('input[type=text]');

        if(answerChecked == 'yes') {
            answersHolder.find('input').prop("disabled", true);
            if (radios.length) {
                $.each(result, function (key, val) {
                    var input = answersHolder.find('input[type=radio][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-true');
                    } else {
                        input.parent().addClass('edgt-false');
                    }
                });
                $.each(originalResult, function (key, val) {
                    var input = answersHolder.find('input[type=radio][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-base-true');
                    }
                });
            }

            if (checkboxes.length) {
                $.each(result, function (key, val) {
                    var input = answersHolder.find('input[type=checkbox][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-true');
                    } else {
                        input.parent().addClass('edgt-false');
                    }
                });
                $.each(originalResult, function (key, val) {
                    var input = answersHolder.find('input[type=checkbox][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-base-true');
                    }
                });
            }

            if (textbox.length) {
                if (result) {
                    textbox.parent().addClass('edgt-true');
                } else {
                    textbox.parent().addClass('edgt-false');
                    textbox.parent().append('<p class="edgt-base-answer">' + originalResult + '</p>');
                }
            }
        }
    }

    function edgtQuestionHint() {
        var answersHolder = $('.edgt-question-answer-wrapper');
        $('.edgt-lms-question-actions-hint-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'edgt_lms_check_question_hint',
                post: formData
            };
            form.find('input').prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        answersHolder.append(response.data.html);
                    }
                }
            });
        });
    }

    function edgtQuestionCheck() {
        var answersHolder = $('.edgt-question-answer-wrapper');
        $('.edgt-lms-question-actions-check-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'edgt_lms_check_question_answer',
                post: formData
            };
            form.find('input').prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        var result = response.data.result;
                        var originalResult = response.data.original_result;
                        var answerChecked = response.data.answer_checked;
                        edgtValidateAnswer(answersHolder, result, originalResult, answerChecked);
                    }
                }
            });
        });
    }

    function edgtQuestionChange() {
        var questionHolder = $('.edgt-quiz-question-wrapper');
        $('.edgt-lms-question-prev-form, .edgt-lms-question-next-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            var retakeId = $('input[name=edgt_lms_retake_id]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            formData += '&edgt_lms_retake_id=' + retakeId.val();
            var ajaxData = {
                action: 'edgt_lms_change_question',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        questionHolder.html(response.data.html);
                        var answersHolder = $('.edgt-question-answer-wrapper');
                        var result = response.data.result;
                        var originalResult = response.data.original_result;
                        var answerChecked = response.data.answer_checked;
                        edgtQuestionHint();
                        edgtQuestionCheck();
                        edgtQuestionChange();
                        edgtQuestionAnswerChange();
                        edgtUpdateQuestionPosition(response.data.question_position);
                        edgtUpdateQuestionId(response.data.question_id);
                        edgtValidateAnswer(answersHolder, result, originalResult, answerChecked);
                        edgt.modules.quiz.edgtFinishQuiz();
                    }
                }
            });
        });
    }

    function edgtQuestionSave() {
        $(window).unload(function() {
            var form = $('.edgt-lms-question-next-form');
            if(!form.length) {
                form = $('edgt-lms-question-prev-form');
            }
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            var retakeId = $('input[name=edgt_lms_retake_id]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            formData += '&edgt_lms_retake_id=' + retakeId.val();
            console.log(formData);
            var ajaxData = {
                action: 'edgt_lms_save_question',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                async: false,
                url: edgtGlobalVars.vars.edgtAjaxUrl
            });
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var quiz = {};
    edgt.modules.quiz = quiz;

    quiz.edgtStartQuiz = edgtStartQuiz;
    quiz.edgtFinishQuiz = edgtFinishQuiz;

    quiz.edgtOnDocumentReady = edgtOnDocumentReady;
    quiz.edgtOnWindowLoad = edgtOnWindowLoad;
    quiz.edgtOnWindowResize = edgtOnWindowResize;
    quiz.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtStartQuiz();
        edgtFinishQuiz();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {
        
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {

    }

    function edgtStartQuiz(){
        var popupContent = $('.edgt-quiz-single-holder');
        var preloader = $('.edgt-course-item-preloader');
        $('.edgt-lms-start-quiz-form').on('submit',function(e) {
            e.preventDefault();
            preloader.removeClass('edgt-hide');
            var form = $(this);
            var formData = form.serialize();
            var ajaxData = {
                action: 'edgt_lms_start_quiz',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        var questionId = response.data.question_id;
                        var quizId = response.data.quiz_id;
                        var courseId = response.data.course_id;
                        var retake = response.data.retake;
                        edgtLoadQuizQuestion(questionId, quizId, courseId, retake, popupContent);
                        edgt.modules.question.edgtQuestionSave();
                    } else {
                        alert("An error occurred");
                        preloader.addClass('edgt-hide');
                    }
                }
            });
        });
    }

    function edgtLoadQuizQuestion(questionId ,quizId, courseId, retake, container){
        var preloader = $('.edgt-course-item-preloader');
        var ajaxData = {
            action: 'edgt_lms_load_first_question',
            question_id : questionId,
            quiz_id : quizId,
            course_id : courseId,
            retake : retake
        };
        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: edgtGlobalVars.vars.edgtAjaxUrl,
            success: function (data) {
                var response = JSON.parse(data);
                if(response.status == 'success'){
                    container.html(response.data.html);
                    edgt.modules.question.edgtQuestionHint();
                    edgt.modules.question.edgtQuestionCheck();
                    edgt.modules.question.edgtQuestionChange();
                    edgt.modules.question.edgtQuestionAnswerChange();
                    edgtFinishQuiz();

                    var answersHolder = $('.edgt-question-answer-wrapper');
                    var result = response.data.result;
                    var originalResult = response.data.original_result;
                    var answerChecked = response.data.answer_checked;
                    edgt.modules.question.edgtValidateAnswer(answersHolder, result, originalResult, answerChecked);

                    var timerHolder = $('#edgt-quiz-timer');
                    var duration = timerHolder.data('duration');
                    var timeRemaining = $('input[name=edgt_lms_time_remaining]');
                    timerHolder.vTimer('start', {duration: duration})
                        .on('update', function (e, remaining) {
                            // total seconds
                            var seconds = remaining;
                            // calculate seconds
                            var s = seconds % 60;
                            // add leading zero to seconds if needed
                            s = s < 10 ? "0" + s : s;
                            // calculate minutes
                            var m = Math.floor(seconds / 60) % 60;
                            // add leading zero to minutes if needed
                            m = m < 10 ? "0" + m : m;
                            // calculate hours
                            var h = Math.floor(seconds / 60 / 60);
                            h = h < 10 ? "0" + h : h;
                            var time = h + ":" + m + ":" + s;
                            timerHolder.text(time);
                            timeRemaining.val(remaining);
                        })
                        .on('complete', function () {
                            $('.edgt-lms-finish-quiz-form').submit();
                        });
                    preloader.addClass('edgt-hide');
                } else {
                    alert("An error occurred");
                    preloader.addClass('edgt-hide');
                }
            }
        });

    }

    function edgtFinishQuiz(){
        var popupContent = $('.edgt-quiz-single-holder');
        var preloader = $('.edgt-course-item-preloader');
        $('.edgt-lms-finish-quiz-form').on('submit',function(e) {
            e.preventDefault();
            preloader.removeClass('edgt-hide');
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'edgt_lms_finish_quiz',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        popupContent.replaceWith(response.data.html);
                        edgtStartQuiz();
                        preloader.addClass('edgt-hide');
                    } else {
                        alert("An error occurred");
                        preloader.addClass('edgt-hide');
                    }
                }
            });
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var course = {};
    edgt.modules.course = course;

	course.edgtOnDocumentReady = edgtOnDocumentReady;
	course.edgtOnWindowLoad = edgtOnWindowLoad;
	course.edgtOnWindowResize = edgtOnWindowResize;
	course.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {

	    edgtInitCommentRating();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {

    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
    }

	function edgtInitCommentRating() {
		var ratingInput = $('#edgt-rating'),
			ratingValue = ratingInput.val(),
			stars = $('.edgt-star-rating');

		var addActive = function() {
			for ( var i = 0; i < stars.length; i++ ) {
				var star = stars[i];
				if ( i < ratingValue ) {
					$(star).addClass('active');
				} else {
					$(star).removeClass('active');
				}
			}
		};

		addActive();

		stars.click(function(){
			ratingInput.val( $(this).data('value')).trigger('change');
		});

		ratingInput.change(function(){
			ratingValue = ratingInput.val();
			addActive();
		});

	}


})(jQuery);