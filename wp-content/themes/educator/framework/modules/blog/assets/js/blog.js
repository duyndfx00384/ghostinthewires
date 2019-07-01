(function($) {
	"use strict";

    var blog = {};
    edgt.modules.blog = blog;

    blog.edgtOnDocumentReady = edgtOnDocumentReady;
    blog.edgtOnWindowLoad = edgtOnWindowLoad;
    blog.edgtOnWindowResize = edgtOnWindowResize;
    blog.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function edgtOnDocumentReady() {
        edgtInitAudioPlayer();
        edgtInitBlogMasonry();
        edgtInitBlogListMasonry();
	    edgtInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function edgtOnWindowLoad() {
	    edgtInitBlogPagination().init();
	    edgtInitBlogListShortcodePagination().init();
        edgtInitBlogChequered();
        edgtInitBlogMasonryGalleryAppear();
        edgtInitBlogNarrowAppear();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function edgtOnWindowResize() {
        edgtInitBlogMasonry();
	    edgtInitBlogMasonryGallery();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function edgtOnWindowScroll() {
	    edgtInitBlogPagination().scroll();
	    edgtInitBlogListShortcodePagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function edgtInitAudioPlayer() {
        var players = $('audio.edgt-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function edgtResizeBlogItems(size,container){

        if(container.hasClass('edgt-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.edgt-post-size-default'),
                largeWidthMasonryItem = container.find('.edgt-post-size-large-width'),
                largeHeightMasonryItem = container.find('.edgt-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.edgt-post-size-large-width-height');

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
    * Init Blog Masonry Layout
    */
    function edgtInitBlogMasonry() {
	    var holder = $('.edgt-blog-holder.edgt-blog-type-masonry');
	
	    if(holder.length){
		    holder.each(function(){
			    var thisHolder = $(this),
				    masonry = thisHolder.children('.edgt-blog-holder-inner'),
                    size = thisHolder.find('.edgt-blog-masonry-grid-sizer').width();
			    
                edgtResizeBlogItems(size, thisHolder);
                
			    masonry.waitForImages(function() {
				    masonry.isotope({
					    layoutMode: 'packery',
					    itemSelector: 'article',
					    percentPosition: true,
					    packery: {
						    gutter: '.edgt-blog-masonry-grid-gutter',
						    columnWidth: '.edgt-blog-masonry-grid-sizer'
					    }
				    });
                    masonry.css('opacity', '1');
				
				    setTimeout(function() {
					    masonry.isotope('layout');
				    }, 800);
                });
		    });
	    }
    }

    /**
     *  Init Blog Chequered
     */
    function edgtInitBlogChequered(){
        var container = $('.edgt-blog-holder.edgt-blog-chequered');
        var masonry = container.children('.edgt-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.edgt-blog-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });
        }
    }
	
    /**
     *  Init Blog Masonry Gallery
     *
     *  Function that sets equal height of articles on blog masonry gallery list
     */
    function edgtInitBlogMasonryGallery() {
        var blogList = $('.edgt-blog-holder.edgt-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){

                var container = $(this),
                    masonry = container.children('.edgt-blog-holder-inner'),
                    article = masonry.find('article'),
                    size = masonry.find('.edgt-blog-masonry-grid-sizer').width() * 1.25;

                article.css({'height': (size) + 'px'});

                masonry.isotope( 'layout', function(){});
                edgtInitBlogMasonryGalleryAppear();
            });
        }
    }

    /**
     *  Animate blog masonry gallery type
     */
    function edgtInitBlogMasonryGalleryAppear() {
        var blogList = $('.edgt-blog-holder.edgt-blog-masonry-gallery');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgt-blog-pagination-holder'),
                    animateCycle = 7, // rewind delay
                    animateCycleCounter = 0;

                article.each(function(){
                    var thisArticle = $(this);
                    setTimeout(function(){
                        thisArticle.appear(function(){
                            animateCycleCounter ++;
                            if(animateCycleCounter == animateCycle) {
                                animateCycleCounter = 0;
                            }
                            setTimeout(function(){
                                thisArticle.addClass('edgt-appeared');
                            },animateCycleCounter * 200);
                        },{accX: 0, accY: 0});
                    },150);
                });

                pagination.appear(function(){
                    pagination.addClass('edgt-appeared');
                },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});

            });
        }
    }

    /**
     *  Animate blog narrow articles on appear
     */
    function edgtInitBlogNarrowAppear() {
        var blogList = $('.edgt-blog-holder.edgt-blog-narrow');
        if(blogList.length){
            blogList.each(function(){
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.edgt-blog-pagination-holder');

                article.each(function(){
                    var thisArticle = $(this);
                    thisArticle.appear(function(){
                        thisArticle.addClass('edgt-appeared');
                    },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
                });

                pagination.appear(function(){
                    pagination.addClass('edgt-appeared');
                },{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});

            });
        }
    }

	
	/**
	 * Initializes blog pagination functions
	 */
	function edgtInitBlogPagination(){
		var holder = $('.edgt-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edgt-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;
			
			if(!thisHolder.hasClass('edgt-blog-pagination-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.edgt-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('edgt-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgt.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edgt-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('edgt-showing');
				
				var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'educator_edge_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtGlobalVars.vars.edgtAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('edgt-blog-type-masonry')){
								edgtInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                edgtResizeBlogItems(thisHolderInner.find('.edgt-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								edgtInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								edgtInitAudioPlayer();
								edgt.modules.common.edgtOwlSlider();
								edgt.modules.common.edgtFluidVideo();
                                edgt.modules.common.edgtInitSelfHostedVideoPlayer();
                                edgt.modules.common.edgtSelfHostedVideoSize();
                                edgtInitBlogNarrowAppear();
                                edgtInitBlogMasonryGalleryAppear();
                                edgtInitBlogChequered();
							}, 400);
						});
						
						if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('edgt-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edgt-blog-pag-load-more').hide();
			}
		};
		
		var edgtInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}
	
	/**
	 * Init blog list shortcode masonry layout
	 */
	function edgtInitBlogListMasonry() {
		var holder = $('.edgt-blog-list-holder.edgt-bl-masonry');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edgt-blog-list');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgt-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.edgt-bl-grid-gutter',
							columnWidth: '.edgt-bl-grid-sizer'
						}
					});
					
					masonry.css('opacity', '1');
				});
			});
		}
	}
	
	/**
	 * Init blog list shortcode pagination functions
	 */
	function edgtInitBlogListShortcodePagination(){
		var holder = $('.edgt-blog-list-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.edgt-bl-standard-pagination li');
			
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
						
						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.edgt-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;
			
			if(!thisHolder.hasClass('edgt-bl-pag-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.edgt-blog-list'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}
			
			if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll')) {
				thisHolder.addClass('edgt-bl-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = edgt.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.edgt-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
					loadingItem.addClass('edgt-showing edgt-standard-pag-trigger');
					thisHolder.addClass('edgt-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('edgt-showing');
				}
				
				var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'educator_edge_blog_shortcode_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: edgtGlobalVars.vars.edgtAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
							nextPage++;
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
							edgtInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);
							
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edgt-bl-masonry')){
									edgtInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									edgtInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function(){
								if(thisHolder.hasClass('edgt-bl-masonry')){
									edgtInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									edgtInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('edgt-bl-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.edgt-blog-pag-load-more').hide();
			}
		};
		
		var edgtInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.edgt-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.edgt-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.edgt-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.edgt-bl-pag-next a');
			
			standardPagNumericItem.removeClass('edgt-bl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('edgt-bl-pag-active');
			
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
		
		var edgtInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisHolder.removeClass('edgt-bl-pag-standard-blog-list-animate');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
			thisHolder.removeClass('edgt-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};
		
		var edgtInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('edgt-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var edgtInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('edgt-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgt-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('edgt-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);