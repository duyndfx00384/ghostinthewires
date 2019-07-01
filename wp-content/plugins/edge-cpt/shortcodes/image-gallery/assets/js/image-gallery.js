(function($) {
    'use strict';
	
	var imageGallery = {};
	edgt.modules.imageGallery = imageGallery;
	
	imageGallery.edgtInitImageGalleryMasonry = edgtInitImageGalleryMasonry;
	
	
	imageGallery.edgtOnWindowLoad = edgtOnWindowLoad;
	
	$(window).load(edgtOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function edgtOnWindowLoad() {
		edgtInitImageGalleryMasonry();
	}
	
	/*
	 ** Init Image Gallery shortcode - Masonry layout
	 */
	function edgtInitImageGalleryMasonry(){
		var holder = $('.edgt-image-gallery.edgt-ig-masonry-type');
		
		if(holder.length){
			holder.each(function(){
				var thisHolder = $(this),
					masonry = thisHolder.find('.edgt-ig-masonry');
				
				masonry.waitForImages(function() {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.edgt-ig-image',
						percentPosition: true,
						packery: {
							gutter: '.edgt-ig-grid-gutter',
							columnWidth: '.edgt-ig-grid-sizer'
						}
					});
					
					setTimeout(function() {
						masonry.isotope('layout');
					}, 800);
					
					masonry.css('opacity', '1');
				});
			});
		}
	}

})(jQuery);