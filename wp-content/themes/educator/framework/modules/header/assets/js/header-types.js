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