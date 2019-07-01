(function($) {
    'use strict';

    var course = {};
    edgt.modules.course = course;

	course.edgtOnDocumentReady = edgtOnDocumentReady;
	course.edgtOnWindowLoad = edgtOnWindowLoad;
	course.edgtOnWindowResize = edgtOnWindowResize;
	course.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {

	    edgtInitCommentRating();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {

    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
    }

	function edgtInitCommentRating() {
		var ratingInput = $('#edgt-rating'),
			ratingValue = ratingInput.val(),
			stars = $('.edgt-star-rating');

		var addActive = function() {
			for ( var i = 0; i < stars.length; i++ ) {
				var star = stars[i];
				if ( i < ratingValue ) {
					$(star).addClass('active');
				} else {
					$(star).removeClass('active');
				}
			}
		};

		addActive();

		stars.click(function(){
			ratingInput.val( $(this).data('value')).trigger('change');
		});

		ratingInput.change(function(){
			ratingValue = ratingInput.val();
			addActive();
		});

	}


})(jQuery);