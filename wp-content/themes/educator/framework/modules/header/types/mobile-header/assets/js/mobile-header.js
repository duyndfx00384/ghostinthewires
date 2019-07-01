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