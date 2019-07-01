(function($) {
    'use strict';

    var clientsCarousel = {};
    edgt.modules.clientsCarousel = clientsCarousel;

    clientsCarousel.edgtInitClientsCarousel = edgtInitClientsCarousel;

    clientsCarousel.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtInitClientsCarousel();
        edgtInitClientsCarouselCloned();
    }

    function edgtInitClientsCarousel() {
        var edgtClientsCarousel = $('.edgt-clients-carousel-holder.edgt-cc-hover-pulse-image');

        if(edgtClientsCarousel.length){
            edgtClientsCarousel.each(function(){
                var thisClientsCarousel = $(this).find('.edgt-cc-item');

                thisClientsCarousel.each(function(l) {
                    var thisImage = $(this);

                    thisImage.mouseenter(function(){
                        thisImage.addClass('edgt-cc-hover');

                        thisImage.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
                            thisImage.removeClass('edgt-cc-hover');
                        });
                    });

                });
            });
        }
    }

    function edgtInitClientsCarouselCloned(){
        var slider = $('.edgt-owl-slider');

        slider.on('translate.owl.carousel', function(){
            edgtInitClientsCarousel();
        })
    }

})(jQuery);