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
	    edgtInitCoursePopup();
	    edgtInitCoursePopupClose();
	    edgtCompleteItem();
	    edgtCourseAddToWishlist();
	    edgtRetakeCourse();
	    edgtSearchCourses();
	    edgtInitCourseList();
	    edgtInitAdvancedCourseSearch();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitCourseListAnimation();
        edgtInitCoursePagination().init();
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
        edgtInitCoursePagination().scroll();
    }


    function edgtInitCoursePopup(){
	    var elements = $('.edgt-element-link-open');
	    var popup = $('.edgt-course-popup');
	    var popupContent = $('.edgt-popup-content');

        if(elements.length){
	        elements.each(function(){
				var element = $(this);
		        element.on('click', function(e){
			        e.preventDefault();
			        if(!popup.hasClass('edgt-course-popup-opened')){
				        popup.addClass('edgt-course-popup-opened');
				        edgt.modules.common.edgtDisableScroll();
			        }
			        var courseId = 0;
			        if(typeof element.data('course-id') !== 'undefined' && element.data('course-id') !== false) {
				        courseId = element.data('course-id');
			        }
                    edgtPopupScroll();
			        edgtLoadElementItem(element.data('item-id'),courseId, popupContent);
		        });
	        });
        }
    }
	function edgtInitCourseItemsNavigation(){
		var elements = $('.edgt-course-popup-navigation .edgt-element-link-open');
		var popupContent = $('.edgt-popup-content');

		if(elements.length){
			elements.each(function(){
				var element = $(this);
				element.on('click', function(e){
					e.preventDefault();
					var courseId = 0;
					if(typeof element.data('course-id') !== 'undefined' && element.data('course-id') !== false) {
						courseId = element.data('course-id');
					}
					edgtLoadElementItem(element.data('item-id'),courseId, popupContent);
				});
			});
		}
	}

	function edgtInitCoursePopupClose(){
		var closeButton = $('.edgt-course-popup-close');
		var popup = $('.edgt-course-popup');
		if(closeButton.length){
			closeButton.on('click', function(e){
				e.preventDefault();
				popup.removeClass('edgt-course-popup-opened');
				location.reload();
			});
		}
	}

	function edgtLoadElementItem(id ,courseId, container){
        var preloader = container.prevAll('.edgt-course-item-preloader');
        preloader.removeClass('edgt-hide');
		var ajaxData = {
			action: 'edgt_lms_load_element_item',
			item_id : id,
			course_id : courseId
		};
		$.ajax({
			type: 'POST',
			data: ajaxData,
			url: edgtGlobalVars.vars.edgtAjaxUrl,
			success: function (data) {
				var response = JSON.parse(data);
				if(response.status == 'success'){
					container.html(response.data.html);
					edgtInitCourseItemsNavigation();
					edgtCompleteItem();
					edgtSearchCourses();
                    edgt.modules.quiz.edgtStartQuiz();
                    edgt.modules.common.edgtFluidVideo();
                    preloader.addClass('edgt-hide');
				} else {
				    alert("An error occurred");
                    preloader.addClass('edgt-hide');
                }

			}
		});

	}

	function edgtCompleteItem(){

		$('.edgt-lms-complete-item-form').on('submit',function(e) {

			e.preventDefault();
			var form = $(this);
			var itemID = $(this).find( "input[name$='edgt_lms_item_id']").val();
			var formData = form.serialize();
			var ajaxData = {
				action: 'edgt_lms_complete_item',
				post: formData
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: edgtGlobalVars.vars.edgtAjaxUrl,
				success: function (data) {
					var response = JSON.parse(data);
					if(response.status == 'success'){

						form.replaceWith(response.data['content_message']);
						var elements =  $('.edgt-section-element.edgt-section-lesson');
						elements.each(function () {
							if($(this).data('section-element-id') == itemID){
								$(this).addClass('edgt-item-completed')
							}
						})
					}
				}
			});
		});

	}

	function edgtRetakeCourse(){

		$('.edgt-lms-retake-course-form').on('submit',function(e) {

			e.preventDefault();
			var form = $(this);
			var formData = form.serialize();
			var ajaxData = {
				action: 'edgt_lms_retake_course',
				post: formData
			};

			$.ajax({
				type: 'POST',
				data: ajaxData,
				url: edgtGlobalVars.vars.edgtAjaxUrl,
				success: function (data) {
					var response = JSON.parse(data);
					if(response.status == 'success'){
						alert(response.message);
                        location.reload();
					}
				}
			});
		});

	}

	function edgtPopupScroll(){


        var mainHolder = $('.edgt-course-popup');

        /* Content items */
		var content = $('.edgt-popup-content');
		var contentHolder = $('.edgt-course-popup-inner');
		var contentHeading = $('.edgt-popup-heading');

		/* Navigation items */
        var navigationHolder = $('.edgt-course-popup-items');
        var navigationWrapper = $('.edgt-popup-info-wrapper');
        var searchHolder = $('.edgt-lms-search-holder');

        if(edgt.windowWidth > 1024) {
            if (content.length) {
                content.height(mainHolder.height() - contentHeading.outerHeight());
                content.perfectScrollbar({
                    wheelSpeed: 0.6,
                    suppressScrollX: true
                });
            }

            if (navigationHolder.length) {
                navigationHolder.height(mainHolder.height() - parseInt(navigationWrapper.css('padding-top')) - parseInt(navigationWrapper.css('padding-bottom')) - searchHolder.outerHeight(true));
                navigationHolder.perfectScrollbar({
                    wheelSpeed: 0.6,
                    suppressScrollX: true
                });
            }
        } else {
            contentHolder.find('.edgt-grid-row').height(mainHolder.height());
            contentHolder.find('.edgt-grid-row').perfectScrollbar({
                wheelSpeed: 0.6,
                suppressScrollX: true
            });
        }

		return true

	}

	function edgtCourseAddToWishlist(){

		$('.edgt-course-wishlist').on('click',function(e) {
			e.preventDefault();
			var course = $(this),
				courseId;

			if(typeof course.data('course-id') !== 'undefined') {
				courseId = course.data('course-id');
			}

            edgtCoursewishlistAdding(course, courseId);

		});

	}

	function edgtCoursewishlistAdding(course, courseId){

		var ajaxData = {
			action: 'edgt_lms_add_course_to_wishlist',
			course_id : courseId
		};

		$.ajax({
			type: 'POST',
			data: ajaxData,
			url: edgtGlobalVars.vars.edgtAjaxUrl,
			success: function (data) {
				var response = JSON.parse(data);
				if(response.status == 'success'){
                    if(!course.hasClass('edgt-icon-only')) {
                        course.find('span').text(response.data.message);
                    }
                    course.find('i').removeClass('fa fa-heart-o fa-heart').addClass(response.data.icon);
				}
			}
		});

		return false;

	}

	function edgtSearchCourses(){

        var courseSearchHolder = $('.edgt-lms-search-holder');

        if (courseSearchHolder.length) {
            courseSearchHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.edgt-lms-search-field'),
                    resultsHolder = thisSearch.find('.edgt-lms-search-results'),
                    searchLoading = thisSearch.find('.edgt-search-loading'),
                    searchIcon = thisSearch.find('.edgt-search-icon');

                searchLoading.addClass('edgt-hidden');

                var keyPressTimeout;

                searchField.on('keyup paste', function(e) {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('edgt-hidden');
                    searchIcon.addClass('edgt-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('edgt-hidden');
                            searchIcon.removeClass('edgt-hidden');
                        } else {
                            var ajaxData = {
                                action: 'edgt_lms_search_courses',
                                term: searchTerm
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: edgtGlobalVars.vars.edgtAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status == 'success') {
                                        searchLoading.addClass('edgt-hidden');
                                        searchIcon.removeClass('edgt-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('edgt-hidden');
                                    searchIcon.removeClass('edgt-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('edgt-hidden');
                    searchIcon.removeClass('edgt-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }

	}

    /**
     * Initializes course pagination functions
     */
    function edgtInitCoursePagination(){
        var courseList = $('.edgt-course-list-holder');

        var initStandardPagination = function(thisCourseList) {
            var standardLink = thisCourseList.find('.edgt-cl-standard-pagination li');

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

                        initMainPagFunctionality(thisCourseList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisCourseList) {
            var loadMoreButton = thisCourseList.find('.edgt-cl-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisCourseList);
            });
        };

        var initInifiteScrollPagination = function(thisCourseList) {
            var courseListHeight = thisCourseList.outerHeight(),
                courseListTopOffest = thisCourseList.offset().top,
                courseListPosition = courseListHeight + courseListTopOffest - edgtGlobalVars.vars.edgtAddForAdminBar;

            if(!thisCourseList.hasClass('edgt-cl-infinite-scroll-started') && edgt.scroll + edgt.windowHeight > courseListPosition) {
                initMainPagFunctionality(thisCourseList);
            }
        };

        var initMainPagFunctionality = function(thisCourseList, pagedLink) {
            var thisCourseListInner = thisCourseList.find('.edgt-cl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisCourseList.data('max-num-pages') !== 'undefined' && thisCourseList.data('max-num-pages') !== false) {
                maxNumPages = thisCourseList.data('max-num-pages');
            }

            if(thisCourseList.hasClass('edgt-cl-pag-standard')) {
                thisCourseList.data('next-page', pagedLink);
            }

            if(thisCourseList.hasClass('edgt-cl-pag-infinite-scroll')) {
                thisCourseList.addClass('edgt-cl-infinite-scroll-started');
            }

            var loadMoreData = edgt.modules.common.getLoadMoreData(thisCourseList),
                loadingItem = thisCourseList.find('.edgt-cl-loading');

            nextPage = loadMoreData.nextPage;

            if(nextPage <= maxNumPages || maxNumPages == 0){
                if(thisCourseList.hasClass('edgt-cl-pag-standard')) {
                    loadingItem.addClass('edgt-showing edgt-standard-pag-trigger');
                    thisCourseList.addClass('edgt-cl-pag-standard-animate');
                } else {
                    loadingItem.addClass('edgt-showing');
                }

                var ajaxData = edgt.modules.common.setLoadMoreAjaxData(loadMoreData, 'edgt_lms_course_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: edgtGlobalVars.vars.edgtAjaxUrl,
                    success: function (data) {
                        if(!thisCourseList.hasClass('edgt-cl-pag-standard')) {
                            nextPage++;
                        }

                        thisCourseList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html,
                            minValue = response.minValue,
                            maxValue = response.maxValue;

                        if(thisCourseList.hasClass('edgt-cl-pag-standard') || pagedLink == 1) {
                            edgtInitStandardPaginationLinkChanges(thisCourseList, maxNumPages, nextPage);
                            edgtInitHtmlGalleryNewContent(thisCourseList, thisCourseListInner, loadingItem, responseHtml);
                            edgtInitPostsCounterChanges(thisCourseList, minValue, maxValue);
                        } else {
                            edgtInitAppendGalleryNewContent(thisCourseListInner, loadingItem, responseHtml);
                            edgtInitPostsCounterChanges(thisCourseList, 1, maxValue);
                        }

                        if(thisCourseList.hasClass('edgt-cl-infinite-scroll-started')) {
                            thisCourseList.removeClass('edgt-cl-infinite-scroll-started');
                        }
                    }
                });
            }

            if(pagedLink == 1) {
                thisCourseList.find('.edgt-cl-load-more-holder').show();
            }

            if(nextPage === maxNumPages){
                thisCourseList.find('.edgt-cl-load-more-holder').hide();
            }
        };

        var edgtInitStandardPaginationLinkChanges = function(thisCourseList, maxNumPages, nextPage) {
            var standardPagHolder = thisCourseList.find('.edgt-cl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.edgt-cl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.edgt-cl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.edgt-cl-pag-next a');

            standardPagNumericItem.removeClass('edgt-cl-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('edgt-cl-pag-active');

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

        var edgtInitPostsCounterChanges = function(thisCourseList, minValue, maxValue) {
            var postsCounterHolder = thisCourseList.find('.edgt-course-items-counter');
            var minValueHolder = postsCounterHolder.find('.counter-min-value');
            var maxValueHolder = postsCounterHolder.find('.counter-max-value');
            minValueHolder.text(minValue);
            maxValueHolder.text(maxValue);
        };

        var edgtInitHtmlGalleryNewContent = function(thisCourseList, thisCourseListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgt-showing edgt-standard-pag-trigger');
            thisCourseListInner.waitForImages(function() {
                thisCourseList.removeClass('edgt-cl-pag-standard-animate');
                thisCourseListInner.html(responseHtml);
                edgtInitCourseListAnimation();
                edgt.modules.common.edgtInitParallax();
            });
        };

        var edgtInitAppendGalleryNewContent = function(thisCourseListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('edgt-showing');
            thisCourseListInner.waitForImages(function() {
                thisCourseListInner.append(responseHtml);
                edgtInitCourseListAnimation();
                edgt.modules.common.edgtInitParallax();
            });
        };

        return {
            init: function() {
                if(courseList.length) {
                    courseList.each(function() {
                        var thisCourseList = $(this);

                        if(thisCourseList.hasClass('edgt-cl-pag-standard')) {
                            initStandardPagination(thisCourseList);
                        }

                        if(thisCourseList.hasClass('edgt-cl-pag-load-more')) {
                            initLoadMorePagination(thisCourseList);
                        }

                        if(thisCourseList.hasClass('edgt-cl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisCourseList);
                        }
                    });
                }
            },
            scroll: function() {
                if(courseList.length) {
                    courseList.each(function() {
                        var thisCourseList = $(this);

                        if(thisCourseList.hasClass('edgt-cl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisCourseList);
                        }
                    });
                }
            },
            getMainPagFunction: function(thisCourseList, paged) {
                initMainPagFunctionality(thisCourseList, paged);
            }
        };
    }

    /**
     * Initializes portfolio list article animation
     */
    function edgtInitCourseListAnimation(){
        var courseList = $('.edgt-course-list-holder.edgt-cl-has-animation');

        if(courseList.length){
            courseList.each(function(){
                var thisCourseList = $(this).children('.edgt-cl-inner');

                thisCourseList.children('article').each(function(l) {
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

    function edgtInitCourseList() {
        var courseLists = $('.edgt-course-list-holder');
        if (courseLists.length) {
            courseLists.each(function () {
                var thisList = $(this);
                if (thisList.hasClass('edgt-cl-has-filter')) {
                    edgtInitCourseLayoutChange(thisList);
                    edgtInitCourseLayoutOrdering(thisList);
                }
            })
        }
    }

    function edgtInitCourseLayoutOrdering(thisList) {
        var filter = thisList.find('.edgt-cl-filter-holder .edgt-course-order-filter');
        filter.select2({
            minimumResultsForSearch: -1
        }).on('select2:select', function (evt) {
            var dataAtts = evt.params.data.element.dataset;
            var type = dataAtts.type;
            var order = dataAtts.order;
            thisList.data('order-by', type);
            thisList.data('order', order);
            thisList.data('next-page', 1);
            edgtInitCoursePagination().getMainPagFunction(thisList, 1);
        });
    }

    function edgtInitCourseLayoutChange(thisList) {
        var filter = thisList.find('.edgt-cl-filter-holder .edgt-course-layout-filter');
        var filterElements = filter.find('span');
        if (filter.length > 0) {
            filterElements.click(function() {
                filterElements.removeClass('edgt-active');
                var thisFilter = $(this);
                thisFilter.addClass('edgt-active');
                var type = thisFilter.data('type');
                thisList.removeClass('edgt-cl-gallery edgt-cl-simple');
                thisList.addClass('edgt-cl-' + type);
            });
        }
    }

    function edgtInitAdvancedCourseSearch() {
        var advancedCoursSearches = $('.edgt-advanced-course-search');
        if (advancedCoursSearches.length) {
            advancedCoursSearches.each(function () {
                var thisSearch = $(this);
                var select = thisSearch.find('select');
                if(select.length) {
                    select.each(function() {
                        var thisSelect = $(this);
                        thisSelect.select2({
                            minimumResultsForSearch: -1
                        });
                        thisSelect.next().addClass(thisSelect.attr('name'));
                    });
                }
            })
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var question = {};
    edgt.modules.question = question;

    question.edgtQuestionHint = edgtQuestionHint;
    question.edgtQuestionCheck = edgtQuestionCheck;
    question.edgtQuestionChange = edgtQuestionChange;
    question.edgtQuestionAnswerChange = edgtQuestionAnswerChange;
    question.edgtValidateAnswer = edgtValidateAnswer;
    question.edgtQuestionSave = edgtQuestionSave;

    question.edgtOnDocumentReady = edgtOnDocumentReady;
    question.edgtOnWindowLoad = edgtOnWindowLoad;
    question.edgtOnWindowResize = edgtOnWindowResize;
    question.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtQuestionHint();
        edgtQuestionCheck();
        edgtQuestionChange();
        edgtQuestionAnswerChange();
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

    function edgtQuestionAnswerChange() {
        var answersHolder = $('.edgt-question-answers');
        var radios = answersHolder.find('input[type=radio]');
        var checkboxes = answersHolder.find('input[type=checkbox]');
        var textbox = answersHolder.find('input[type=text]');
        var checkForm = $('.edgt-lms-question-actions-check-form');
        var nextForm = $('.edgt-lms-question-next-form');
        var prevForm = $('.edgt-lms-question-prev-form');
        var finishForm = $('.edgt-lms-finish-quiz-form');

        radios.change(function() {
            checkForm.find('input[name=edgt_lms_question_answer]').val(this.value);
            nextForm.find('input[name=edgt_lms_question_answer]').val(this.value);
            prevForm.find('input[name=edgt_lms_question_answer]').val(this.value);
            finishForm.find('input[name=edgt_lms_question_answer]').val(this.value);
        });

        checkboxes.on('change', function() {
            var values = $('input[type=checkbox]:checked').map(function() {
                return this.value;
            }).get().join(',');
            checkForm.find('input[name=edgt_lms_question_answer]').val(values);
            nextForm.find('input[name=edgt_lms_question_answer]').val(values);
            prevForm.find('input[name=edgt_lms_question_answer]').val(values);
            finishForm.find('input[name=edgt_lms_question_answer]').val(values);
        }).change();

        textbox.on("change paste keyup", function() {
            checkForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
            nextForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
            prevForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
            finishForm.find('input[name=edgt_lms_question_answer]').val($(this).val());
        });
    }

    function edgtUpdateQuestionPosition(questionPosition) {
        var positionHolder = $('.edgt-question-number-completed');
        positionHolder.text(questionPosition);
    }

    function edgtUpdateQuestionId(questionId) {
        var finishForm = $('.edgt-lms-finish-quiz-form');
        finishForm.find('input[name=edgt_lms_question_id]').val(questionId);
    }

    function edgtValidateAnswer(answersHolder, result, originalResult, answerChecked) {
        var radios = answersHolder.find('input[type=radio]');
        var checkboxes = answersHolder.find('input[type=checkbox]');
        var textbox = answersHolder.find('input[type=text]');

        if(answerChecked == 'yes') {
            answersHolder.find('input').prop("disabled", true);
            if (radios.length) {
                $.each(result, function (key, val) {
                    var input = answersHolder.find('input[type=radio][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-true');
                    } else {
                        input.parent().addClass('edgt-false');
                    }
                });
                $.each(originalResult, function (key, val) {
                    var input = answersHolder.find('input[type=radio][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-base-true');
                    }
                });
            }

            if (checkboxes.length) {
                $.each(result, function (key, val) {
                    var input = answersHolder.find('input[type=checkbox][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-true');
                    } else {
                        input.parent().addClass('edgt-false');
                    }
                });
                $.each(originalResult, function (key, val) {
                    var input = answersHolder.find('input[type=checkbox][value=' + key + ']');
                    if (val == true) {
                        input.parent().addClass('edgt-base-true');
                    }
                });
            }

            if (textbox.length) {
                if (result) {
                    textbox.parent().addClass('edgt-true');
                } else {
                    textbox.parent().addClass('edgt-false');
                    textbox.parent().append('<p class="edgt-base-answer">' + originalResult + '</p>');
                }
            }
        }
    }

    function edgtQuestionHint() {
        var answersHolder = $('.edgt-question-answer-wrapper');
        $('.edgt-lms-question-actions-hint-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'edgt_lms_check_question_hint',
                post: formData
            };
            form.find('input').prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        answersHolder.append(response.data.html);
                    }
                }
            });
        });
    }

    function edgtQuestionCheck() {
        var answersHolder = $('.edgt-question-answer-wrapper');
        $('.edgt-lms-question-actions-check-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'edgt_lms_check_question_answer',
                post: formData
            };
            form.find('input').prop("disabled", true);
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        var result = response.data.result;
                        var originalResult = response.data.original_result;
                        var answerChecked = response.data.answer_checked;
                        edgtValidateAnswer(answersHolder, result, originalResult, answerChecked);
                    }
                }
            });
        });
    }

    function edgtQuestionChange() {
        var questionHolder = $('.edgt-quiz-question-wrapper');
        $('.edgt-lms-question-prev-form, .edgt-lms-question-next-form').on('submit',function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            var retakeId = $('input[name=edgt_lms_retake_id]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            formData += '&edgt_lms_retake_id=' + retakeId.val();
            var ajaxData = {
                action: 'edgt_lms_change_question',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        questionHolder.html(response.data.html);
                        var answersHolder = $('.edgt-question-answer-wrapper');
                        var result = response.data.result;
                        var originalResult = response.data.original_result;
                        var answerChecked = response.data.answer_checked;
                        edgtQuestionHint();
                        edgtQuestionCheck();
                        edgtQuestionChange();
                        edgtQuestionAnswerChange();
                        edgtUpdateQuestionPosition(response.data.question_position);
                        edgtUpdateQuestionId(response.data.question_id);
                        edgtValidateAnswer(answersHolder, result, originalResult, answerChecked);
                        edgt.modules.quiz.edgtFinishQuiz();
                    }
                }
            });
        });
    }

    function edgtQuestionSave() {
        $(window).unload(function() {
            var form = $('.edgt-lms-question-next-form');
            if(!form.length) {
                form = $('edgt-lms-question-prev-form');
            }
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            var retakeId = $('input[name=edgt_lms_retake_id]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            formData += '&edgt_lms_retake_id=' + retakeId.val();
            console.log(formData);
            var ajaxData = {
                action: 'edgt_lms_save_question',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                async: false,
                url: edgtGlobalVars.vars.edgtAjaxUrl
            });
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var quiz = {};
    edgt.modules.quiz = quiz;

    quiz.edgtStartQuiz = edgtStartQuiz;
    quiz.edgtFinishQuiz = edgtFinishQuiz;

    quiz.edgtOnDocumentReady = edgtOnDocumentReady;
    quiz.edgtOnWindowLoad = edgtOnWindowLoad;
    quiz.edgtOnWindowResize = edgtOnWindowResize;
    quiz.edgtOnWindowScroll = edgtOnWindowScroll;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtStartQuiz();
        edgtFinishQuiz();
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

    function edgtStartQuiz(){
        var popupContent = $('.edgt-quiz-single-holder');
        var preloader = $('.edgt-course-item-preloader');
        $('.edgt-lms-start-quiz-form').on('submit',function(e) {
            e.preventDefault();
            preloader.removeClass('edgt-hide');
            var form = $(this);
            var formData = form.serialize();
            var ajaxData = {
                action: 'edgt_lms_start_quiz',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        var questionId = response.data.question_id;
                        var quizId = response.data.quiz_id;
                        var courseId = response.data.course_id;
                        var retake = response.data.retake;
                        edgtLoadQuizQuestion(questionId, quizId, courseId, retake, popupContent);
                        edgt.modules.question.edgtQuestionSave();
                    } else {
                        alert("An error occurred");
                        preloader.addClass('edgt-hide');
                    }
                }
            });
        });
    }

    function edgtLoadQuizQuestion(questionId ,quizId, courseId, retake, container){
        var preloader = $('.edgt-course-item-preloader');
        var ajaxData = {
            action: 'edgt_lms_load_first_question',
            question_id : questionId,
            quiz_id : quizId,
            course_id : courseId,
            retake : retake
        };
        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: edgtGlobalVars.vars.edgtAjaxUrl,
            success: function (data) {
                var response = JSON.parse(data);
                if(response.status == 'success'){
                    container.html(response.data.html);
                    edgt.modules.question.edgtQuestionHint();
                    edgt.modules.question.edgtQuestionCheck();
                    edgt.modules.question.edgtQuestionChange();
                    edgt.modules.question.edgtQuestionAnswerChange();
                    edgtFinishQuiz();

                    var answersHolder = $('.edgt-question-answer-wrapper');
                    var result = response.data.result;
                    var originalResult = response.data.original_result;
                    var answerChecked = response.data.answer_checked;
                    edgt.modules.question.edgtValidateAnswer(answersHolder, result, originalResult, answerChecked);

                    var timerHolder = $('#edgt-quiz-timer');
                    var duration = timerHolder.data('duration');
                    var timeRemaining = $('input[name=edgt_lms_time_remaining]');
                    timerHolder.vTimer('start', {duration: duration})
                        .on('update', function (e, remaining) {
                            // total seconds
                            var seconds = remaining;
                            // calculate seconds
                            var s = seconds % 60;
                            // add leading zero to seconds if needed
                            s = s < 10 ? "0" + s : s;
                            // calculate minutes
                            var m = Math.floor(seconds / 60) % 60;
                            // add leading zero to minutes if needed
                            m = m < 10 ? "0" + m : m;
                            // calculate hours
                            var h = Math.floor(seconds / 60 / 60);
                            h = h < 10 ? "0" + h : h;
                            var time = h + ":" + m + ":" + s;
                            timerHolder.text(time);
                            timeRemaining.val(remaining);
                        })
                        .on('complete', function () {
                            $('.edgt-lms-finish-quiz-form').submit();
                        });
                    preloader.addClass('edgt-hide');
                } else {
                    alert("An error occurred");
                    preloader.addClass('edgt-hide');
                }
            }
        });

    }

    function edgtFinishQuiz(){
        var popupContent = $('.edgt-quiz-single-holder');
        var preloader = $('.edgt-course-item-preloader');
        $('.edgt-lms-finish-quiz-form').on('submit',function(e) {
            e.preventDefault();
            preloader.removeClass('edgt-hide');
            var form = $(this);
            var formData = form.serialize();
            var timeRemaining = $('input[name=edgt_lms_time_remaining]');
            formData += '&edgt_lms_time_remaining=' + timeRemaining.val();
            var ajaxData = {
                action: 'edgt_lms_finish_quiz',
                post: formData
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        popupContent.replaceWith(response.data.html);
                        edgtStartQuiz();
                        preloader.addClass('edgt-hide');
                    } else {
                        alert("An error occurred");
                        preloader.addClass('edgt-hide');
                    }
                }
            });
        });
    }

})(jQuery);
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