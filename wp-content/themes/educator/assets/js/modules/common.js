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