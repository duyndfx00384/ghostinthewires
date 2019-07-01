(function($) {
    'use strict';

    var iconShowcase = {};
    edgt.modules.iconShowcase = iconShowcase;

    iconShowcase.edgtInitInteractiveIconShowcase = edgtInitInteractiveIconShowcase;


    iconShowcase.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtInitInteractiveIconShowcase();
    }

    function edgtInitInteractiveIconShowcase () {

        var interactiveShowcase = $('.edgt-int-icon-showcase'),
            noAnimationOnTouch = $('.edgt-no-animations-on-touch');

        if (interactiveShowcase.length){
            interactiveShowcase.each(function () {
                var thisShowcase = $(this),
                    iconHolders = thisShowcase.find('.edgt-showcase-item-holder'),
                    thisIcons = thisShowcase.find('.edgt-showcase-icon'),
                    thisContent = thisShowcase.find('.edgt-showcase-content'),
                    thisFirstItem = thisShowcase.find('.edgt-showcase-item-holder:first-child'),
                    thisActiveItem = thisShowcase.find('.edgt-showcase-item-holder.edgt-showcase-active'),
                    isInitialized = false,
                    isPaused = false,
                    currentItem,
                    itemInterval = 3000,
                    numberOfItems = iconHolders.length;

                if(typeof thisShowcase.data('interval') !== 'undefined' && thisShowcase.data('interval') !== false) {
                    itemInterval = thisShowcase.data('interval');
                }

                if (!noAnimationOnTouch.length) {
                    //appear
                    thisShowcase.appear(function(){
                        setTimeout(function(){
                            thisShowcase.addClass('edgt-appeared');
                            if (!thisActiveItem.length) {
                                setTimeout(function(){
                                    isInitialized = true;
                                    thisFirstItem.addClass('edgt-showcase-active');
                                    if (thisShowcase.hasClass('edgt-autoplay')) {
                                        showcaseLoop();
                                        thisShowcase.hover(function (e) {
                                            isPaused = true;
                                        },function (e) {
                                            isPaused = false;
                                        });
                                    }
                                },2500);
                            }
                        },30);
                    },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
                } else {
                    thisFirstItem.addClass('edgt-showcase-active');
                    isInitialized = true;
                }

                //hover actions
                thisIcons.each(function(){
                    var thisIcon = $(this),
                        thisHolder = thisIcon.parent();

                    thisIcon.mouseenter(function(){
                        if (isInitialized == true) {
                            thisHolder.siblings().removeClass('edgt-showcase-active edgt-current');
                            thisHolder.addClass('edgt-showcase-active edgt-current');
                            currentItem = thisShowcase.find('.edgt-current').index(); //reset current loop item to latest hovered item
                        }
                    });
                });

                //loop through the items
                function showcaseLoop()  {
                    currentItem = 0; //start from the first item, index = 0

                    var loop = setInterval(function(){
                        if (!isPaused) {
                            iconHolders.removeClass('edgt-showcase-active edgt-current');
                            if(currentItem == numberOfItems -1){
                                currentItem = 0;
                            }else{
                                currentItem++;
                            }
                            iconHolders.eq(currentItem).addClass('edgt-showcase-active');
                        }
                    }, itemInterval);
                }
            });
        }
    }

})(jQuery);
