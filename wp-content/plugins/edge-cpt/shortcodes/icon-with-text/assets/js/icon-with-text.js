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
