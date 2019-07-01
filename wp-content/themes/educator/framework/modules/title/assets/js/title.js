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
