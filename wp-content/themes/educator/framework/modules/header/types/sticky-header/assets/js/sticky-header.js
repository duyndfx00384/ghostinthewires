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