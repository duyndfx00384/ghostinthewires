(function($) {
    'use strict';

    var comparison = {};
    edgt.modules.comparison = comparison;

    comparison.edgtComparisonPricingTables = edgtComparisonPricingTables;


    comparison.edgtOnDocumentReady = edgtOnDocumentReady;

    $(document).ready(edgtOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtComparisonPricingTables().init() ;
    }

    function edgtComparisonPricingTables() {
        var pricingTablesHolder = $('.edgt-comparision-pricing-tables-holder');

        var alterPricingTableColumn = function(holder) {
            var featuresHolder = holder.find('.edgt-cpt-features-item');
            var pricingTables = holder.find('.edgt-comparision-table-holder');

            if(pricingTables.length) {
                pricingTables.each(function() {
                    var currentPricingTable = $(this);
                    var pricingItems = currentPricingTable.find('.edgt-cpt-table-content li');

                    if(pricingItems.length) {
                        pricingItems.each(function(i) {
                            var pricingItemFeature = featuresHolder[i];
                            var pricingItem = this;
                            var pricingItemContent = pricingItem.innerHTML;

                            if(typeof pricingItemFeature !== 'undefined') {
                                pricingItem.innerHTML = '<span class="edgt-cpt-table-item-feature">'+ $(pricingItemFeature).text() +': </span>' + pricingItemContent;
                            }
                        });
                    }
                });
            }
        };

        return {
            init: function() {
                if(pricingTablesHolder.length) {
                    pricingTablesHolder.each(function() {
                        alterPricingTableColumn($(this));
                    });
                }
            }
        }
    }

})(jQuery);