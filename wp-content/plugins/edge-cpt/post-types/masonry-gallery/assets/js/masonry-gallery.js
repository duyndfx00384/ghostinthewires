(function($) {
    'use strict';
	
	var masonryGallery = {};
	edgt.modules.masonryGallery = masonryGallery;
	
	masonryGallery.edgtInitMasonryGallery = edgtInitMasonryGallery;
	
	
	masonryGallery.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitMasonryGallery();
		edgtInitMasonryGalleryIcon();
	}
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function edgtInitMasonryGallery(){
		var galleryHolder = $('.edgt-masonry-gallery-holder'),
			gallery = galleryHolder.children('.edgt-mg-inner'),
			gallerySizer = gallery.children('.edgt-mg-grid-sizer');
		
		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
		
		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.edgt-mg-inner');
				
				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});
					
					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgt-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.edgt-mg-grid-gutter',
							columnWidth: '.edgt-mg-grid-sizer'
						}
					});
				});
			});
			
			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
				
				gallery.isotope('reloadItems');
			});
		}
	}
	
	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.edgt-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.edgt-mg-rectangle-landscape'),
			square_big = holder.find('.edgt-mg-square-big'),
			square_small = holder.find('.edgt-mg-square-small');
		
		rectangle_portrait.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}
		
		square_big.css('height', 2*size);
		
		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}
		
		square_small.css('height', size);
	}

	/**
	 * Masonry gallery standardt type icon hover init
	 */

	function edgtInitMasonryGalleryIcon() {
		var edgtMasonryGallery = $('.edgt-masonry-gallery-holder');

		if(edgtMasonryGallery.length){
			edgtMasonryGallery.each(function(){
				var thisPortList = $(this).children('.edgt-mg-inner');

				thisPortList.children('article.edgt-mg-simple').each(function(l) {
					var thisArticle = $(this);

					thisArticle.mouseenter(function(){
						thisArticle.addClass('edgt-mg-hover');

						thisArticle.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
							thisArticle.removeClass('edgt-mg-hover');
						});
					});

				});
			});
		}
	}

})(jQuery);