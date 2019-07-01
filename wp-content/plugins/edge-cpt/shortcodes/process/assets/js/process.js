(function($) {
    'use strict';

    var process = {};
    edgt.modules.process = process;

    process.edgtProcess = edgtProcess;


    process.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtProcess().init() ;
    }

    function edgtProcess() {
        var processes = $('.edgt-process-holder');

        var setProcessItemsPosition = function(process) {
            var items = process.find('.edgt-process-item-holder');
            var highlighted = items.filter('.edgt-pi-highlighted');
    
            if(highlighted.length) {
                if(highlighted.length === 1) {
                    var afterHighlighed = highlighted.nextAll();
    
                    if(afterHighlighed.length) {
                        afterHighlighed.addClass('edgt-pi-push-right');
                    }
                } else {
                    process.addClass('edgt-process-multiple-highlights');
                }
            }
        };
    
        var processAnimation = function(process) {

            if(!edgt.body.hasClass('edgt-no-animations-on-touch')) {
                var items = process.find('.edgt-process-item-holder');
                var background = process.find('.edgt-process-bg-holder');
                process.appear(function() {
                    var tl = new TimelineLite();
                    tl.fromTo(background, 0.3, {y: 50, opacity: 0, delay: 0.1}, {opacity: 1, y: 0, delay: 0.1});
                    tl.staggerFromTo(items, 0.8, {opacity: 0, y: 30, ease: Back.easeOut.config(2)}, {opacity: 1, y: 0, ease: Back.easeOut.config(2)}, 0.2);
                }, {accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
            }
        };
    
        return {
            init: function() {
                if(processes.length) {
                    processes.each(function() {
                        setProcessItemsPosition($(this));
                        processAnimation($(this));
                    });
                }
            }
        }
    };

})(jQuery);