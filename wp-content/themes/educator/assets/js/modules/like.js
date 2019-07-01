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