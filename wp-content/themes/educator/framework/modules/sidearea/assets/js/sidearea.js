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
