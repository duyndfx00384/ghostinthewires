(function($) {
    'use strict';

    var portfolio = {};
    edgt.modules.portfolio = portfolio;

    portfolio.edgtOnDocumentReady = edgtOnDocumentReady;
    portfolio.edgtOnWindowLoad = edgtOnWindowLoad;
    portfolio.edgtOnWindowResize = edgtOnWindowResize;
    portfolio.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
    }


    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitPortfolioMasonry();
        edgtInitPortfolioFilter();
        initPortfolioSingleMasonry();
        edgtInitPortfolioListAnimation();
	    edgtInitPortfolioPagination().init();
        edgtPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {
        edgtInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
	    edgtInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgtInitPortfolioListAnimation(){
        var portList = $('.edgt-portfolio-list-holder.edgt-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.edgt-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('edgt-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('edgt-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function edgtInitPortfolioMasonry(){
        var portList = $('.edgt-portfolio-list-holder.edgt-pl-masonry');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this),
                    masonry = thisPortList.children('.edgt-pl-inner'),
                    size = thisPortList.find('.edgt-pl-grid-sizer').width();
                
                edgtResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.edgt-pl-grid-gutter',
                        columnWidth: '.edgt-pl-grid-sizer'
                    }
                });
                
                setTimeout(function () {
	                edgt.modules.common.edgtInitParallax();
                }, 600);

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Portfolio Items
     */
    function edgtResizePortfolioItems(size,container){
        if(container.hasClass('edgt-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edgt-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.edgt-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.edgt-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.edgt-pl-masonry-large-width-height');

            if (edgt.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function edgtInitPortfolioFilter(){
        var filterHolder = $('.edgt-portfolio-list-holder .edgt-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.edgt-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.edgt-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('edgt-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.edgt-pl-filter:first').addClass('edgt-pl-current');
	            
	            if(thisPortListHolder.hasClass('edgt-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.edgt-pl-filter').click(function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.edgt-pl-filter').removeClass('edgt-pl-current');
                    thisFilter.addClass('edgt-pl-current');

                    if(portListHasLoadMore && !portListHasArtciles) {
                        edgtInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.edgt-pl-inner').isotope({ filter: filterValue });
	                    edgt.modules.common.edgtInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function edgtInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.edgt-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = edgt.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edgt_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.edgt-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('edgt-showing edgt-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                edgtResizePortfolioItems(thisPortListInner.find('.edgt-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('edgt-showing edgt-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    edgtInitPortfolioListAnimation();
	                                edgt.modules.common.edgtInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('edgt-showing edgt-filter-trigger');
                            edgtInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function edgtInitPortfolioPagination(){
		var portList = $('.edgt-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.edgt-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.edgt-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;
			
			if(!thisPortList.hasClass('edgt-pl-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.edgt-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('edgt-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('edgt-pl-pag-infinite-scroll')) {
				thisPortList.addClass('edgt-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgt.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.edgt-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('edgt-pl-pag-standard')) {
					loadingItem.addClass('edgt-showing edgt-standard-pag-trigger');
					thisPortList.addClass('edgt-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('edgt-showing');
				}
				
				var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'edgt_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtGlobalVars.vars.edgtAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('edgt-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('edgt-pl-pag-standard')) {
							edgtInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edgt-pl-masonry')){
									edgtInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edgt-pl-gallery') && thisPortList.hasClass('edgt-pl-has-filter')) {
									edgtInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgtInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('edgt-pl-masonry')){
									edgtInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('edgt-pl-gallery') && thisPortList.hasClass('edgt-pl-has-filter')) {
									edgtInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									edgtInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('edgt-pl-infinite-scroll-started')) {
							thisPortList.removeClass('edgt-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.edgt-pl-load-more-holder').hide();
			}
		};
		
		var edgtInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.edgt-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edgt-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edgt-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edgt-pl-pag-next a');
			
			standardPagNumericItem.removeClass('edgt-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edgt-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var edgtInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
            edgtResizePortfolioItems(thisPortListInner.find('.edgt-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisPortList.removeClass('edgt-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgtInitPortfolioListAnimation();
				edgt.modules.common.edgtInitParallax();
			}, 600);
		};
		
		var edgtInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisPortList.removeClass('edgt-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			edgtInitPortfolioListAnimation();
			edgt.modules.common.edgtInitParallax();
		};
		
		var edgtInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
            edgtResizePortfolioItems(thisPortListInner.find('.edgt-pl-grid-sizer').width(), thisPortList);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				edgtInitPortfolioListAnimation();
				edgt.modules.common.edgtInitParallax();
			}, 600);
		};
		
		var edgtInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing');
			thisPortListInner.append(responseHtml);
			edgtInitPortfolioListAnimation();
			edgt.modules.common.edgtInitParallax();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edgt-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edgt-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('edgt-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('edgt-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}
	
	var edgtPortfolioSingleFollow = function() {
		var info = $('.edgt-follow-portfolio-info .edgt-portfolio-single-holder .edgt-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.edgt-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .edgt-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0;
		}
		
		var infoHolderPosition = function() {
			if(info.length) {
				if (mediaHolderHeight > infoHolderHeight) {
					if(edgt.scroll > infoHolderOffset) {
						var marginTop = edgt.scroll - infoHolderOffset + edgtGlobalVars.vars.edgtAddForAdminBar + headerHeight;
						// if scroll is initially positioned below mediaHolderHeight
						if(marginTop + infoHolderHeight > mediaHolderHeight){
							marginTop = mediaHolderHeight - infoHolderHeight;
						}
						info.stop().animate({
							marginTop: marginTop
						});
					}
				}
			}
		};
		
		var recalculateInfoHolderPosition = function() {
			if (info.length) {
				if(mediaHolderHeight > infoHolderHeight) {
					if(edgt.scroll > infoHolderOffset) {
						
						if(edgt.scroll + headerHeight + edgtGlobalVars.vars.edgtAddForAdminBar + infoHolderHeight + 50 < infoHolderOffset + mediaHolderHeight) { //50 to prevent mispositioning
							
							//Calculate header height if header appears
							if ($('.header-appear, .edgt-fixed-wrapper').length) {
								headerHeight = $('.header-appear, .edgt-fixed-wrapper').height();
							}
							info.stop().animate({
								marginTop: (edgt.scroll - infoHolderOffset + edgtGlobalVars.vars.edgtAddForAdminBar + headerHeight)
							});
							//Reset header height
							headerHeight = 0;
						}
						else{
							info.stop().animate({
								marginTop: mediaHolderHeight - infoHolderHeight
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			}
		};
		
		return {
			init : function() {
				infoHolderPosition();
				$(window).scroll(function(){
					recalculateInfoHolderPosition();
				});
			}
		};
	};
	
	function initPortfolioSingleMasonry(){
		var masonryHolder = $('.edgt-portfolio-single-holder .edgt-ps-masonry-images'),
			masonry = masonryHolder.children();
		
		if(masonry.length){
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.edgt-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.edgt-ps-grid-gutter',
                    columnWidth: '.edgt-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
		}
	}

})(jQuery);