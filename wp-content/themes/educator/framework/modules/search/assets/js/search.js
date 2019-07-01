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
