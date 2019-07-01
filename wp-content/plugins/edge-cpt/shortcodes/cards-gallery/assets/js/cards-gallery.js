(function($) {
    'use strict';

    var cardsGallery = {};
    edgt.modules.cardsGallery = cardsGallery;

    cardsGallery.edgtInitCardsGallery = edgtInitCardsGallery;

    cardsGallery.edgtOnDocumentReady = edgtOnDocumentReady;
    cardsGallery.edgtOnWindowLoad = edgtOnWindowLoad;
    cardsGallery.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).scroll(edgtOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtLazyImages();
    }

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitCardsGallery();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
        edgtLazyImages();
    }

    /**
     * Cards Gallery shortcode
     */
    function edgtInitCardsGallery() {
        if ($('.edgt-cards-gallery-holder').length) {
            $('.edgt-cards-gallery-holder').each(function () {
                var gallery = $(this);
                var cards = gallery.find('.card');
                cards.each(function () {
                    var card = $(this);
                    card.click(function () {
                        if (!cards.last().is(card)) {
                            card.addClass('out animating').siblings().addClass('animating-siblings');
                            card.detach();
                            card.insertAfter(cards.last());
                            setTimeout(function () {
                                card.removeClass('out');
                            }, 200);
                            setTimeout(function () {
                                card.removeClass('animating').siblings().removeClass('animating-siblings');
                            }, 1200);
                            cards = gallery.find('.card');
                            return false;
                        }
                    });
                });

                if (gallery.hasClass('edgt-appear-effect-yes') && !edgt.htmlEl.hasClass('touch')) {
                    gallery.appear(function () {
                        gallery.addClass('edgt-appeared');
                        gallery.find('img').one('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function () {
                            $(this).addClass('edgt-animation-done');
                        });
                    }, {accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
                }
            });
        }
    }

    /**
     * Loads images that are set to be 'lazy'
     */
    function edgtLazyImages() {
        $.fn.preloader = function (action, callback) {
            if (!!action && action == 'destroy') {
                this.find('.edgt-preloader').remove();
            } else {
                var block = $('<div class="edgt-preloader"></div>');
                block.appendTo(this);
                if (typeof callback == 'function')
                    callback();
            }
            return this;
        };

        $('img[data-image][data-lazy="true"]:not(.lazyLoading)').each(function (i, object) {
            object = $(object);

            if (object.attr('data-ratio')) {
                object.height(object.width() * object.data('ratio'));

            }

            var rect = object[0].getBoundingClientRect(),
                vh = (edgt.windowHeight || document.documentElement.clientHeight),
                vw = (edgt.windowWidth || document.documentElement.clientWidth),
                oh = object.outerHeight(),
                ow = object.outerWidth();


            if (
                ( rect.top != 0 || rect.right != 0 || rect.bottom != 0 || rect.left != 0 ) &&
                ( rect.top >= 0 || rect.top + oh >= 0 ) &&
                ( rect.bottom >= 0 && rect.bottom - oh - vh <= 0 ) &&
                ( rect.left >= 0 || rect.left + ow >= 0 ) &&
                ( rect.right >= 0 && rect.right - ow - vw <= 0 )
            ) {

                var p = object.parent();
                if (!!p) {
                    p.preloader('init');
                }
                object.addClass('lazyLoading');

                var imageObj = new Image();

                $(imageObj).on('load', function () {

                    p.preloader('destroy');
                    object
                        .removeAttr('data-image')
                        .removeData('image')
                        .removeAttr('data-lazy')
                        .removeData('lazy')
                        .removeClass('lazyLoading');

                    object.attr('src', $(this).attr('src'));
                    object.height('auto');

                }).attr('src', object.data('image'));
            }
        });
    }

})(jQuery);