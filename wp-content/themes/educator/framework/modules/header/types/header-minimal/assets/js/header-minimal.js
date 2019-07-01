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