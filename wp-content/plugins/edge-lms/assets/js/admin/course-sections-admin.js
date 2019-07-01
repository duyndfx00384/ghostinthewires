(function($) {
    'use strict';

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        courseSection.rowRepeater.init();
        courseSection.lessonRepeater.init();
        courseSection.quizRepeater.init();
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


    var courseSection = function() {
        var $courseSections = $('#edgt-course-section-content'),
            numberOfRows = $courseSections.find('.edgt-course-section').length;

        var rowRepeater = function() {
            var sectionTemplate = wp.template('edgt-course-section-template');
            var $addButton = $('#edgt-course-section-add');

            var addNewPeriod = function() {
                $addButton.on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    $(document).trigger('edgt_course_section/before_add_section');

                    var $row = $(sectionTemplate({
                        rowIndex: getLastRowIndex() + 1 || 0
                    }));

                    $courseSections.append($row);
                    numberOfRows += 1;

                    fieldsHelper.sortableHelper.initSortableField($row);

                    $(document).trigger('edgt_course_section/after_add_section');
                });
            };

            var removePeriod = function() {
                $courseSections.on('click', '.edgt-course-section-remove-item', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if(!window.confirm('Are you sure you want to remove this section?')) {
                        return;
                    }

                    var $rowParent = $(this).parents('.edgt-course-section');
                    $rowParent.remove();

                    decrementNumberOfRows();

                    $(document).trigger('edgt_course_section/after_delete_section');
                });
            };

            var getLastRowIndex = function() {
                var $lastRow = $courseSections.find('.edgt-course-section').last();

                if(typeof $lastRow === 'undefined') {
                    return false;
                }

                return $lastRow.data('index');
            };

            var decrementNumberOfRows = function() {
                if(numberOfRows <= 0) {
                    return;
                }

                numberOfRows -= 1;
            };

            var getNumberOfRows = function() {
                return numberOfRows;
            };

            return {
                init: function() {
                    addNewPeriod();
                    removePeriod();
                },
                numberOfRows: getNumberOfRows,
                getLastRowIndex: getLastRowIndex
            }
        }();

        var lessonRepeater = function() {
            var lessonTemplate = wp.template('edgt-section-lesson-template');

            var addNewLesson = function() {
                $courseSections.on('click', '#edgt-course-lesson-add', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $clickedButton = $(this);
                    var $parentRow = $clickedButton.parents('.edgt-course-section').first();
                    var parentIndex = $parentRow.data('index');

                    var $lessonContent = $clickedButton.parents('.edgt-course-section-controls').prev();

                    var lastLessonIndex = $parentRow.find('.edgt-course-element').last().data('index');
                    lastLessonIndex = typeof lastLessonIndex !== 'undefined' ? lastLessonIndex : -1;

                    var $lessonRow = $(lessonTemplate({
                        rowIndex: parentIndex,
                        lessonIndex: lastLessonIndex + 1
                    }));

                    $lessonContent.append($lessonRow);
                    fieldsHelper.select2Helper.initSelect2Field($lessonRow);
                });
            };

            var removeLesson = function() {
                $courseSections.on('click', '.edgt-course-lesson-remove-item', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if(!confirm('Are you sure you want to remove this lesson?')) {
                        return;
                    }

                    var $removeButton = $(this);
                    var $parent = $removeButton.parents('.edgt-course-element');

                    $parent.remove();
                });
            };

            return {
                init: function() {
                    addNewLesson();
                    removeLesson();
                }
            }
        }();

        var quizRepeater = function() {
            var quizTemplate = wp.template('edgt-section-quiz-template');

            var addNewQuiz = function() {
                $courseSections.on('click', '#edgt-course-quiz-add', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var $clickedButton = $(this);
                    var $parentRow = $clickedButton.parents('.edgt-course-section').first();
                    var parentIndex = $parentRow.data('index');

                    var $quizContent = $clickedButton.parents('.edgt-course-section-controls').prev();

                    var lastQuizIndex = $parentRow.find('.edgt-course-element').last().data('index');
                    lastQuizIndex = typeof lastQuizIndex !== 'undefined' ? lastQuizIndex : -1;

                    var $quizRow = $(quizTemplate({
                        rowIndex: parentIndex,
                        quizIndex: lastQuizIndex + 1
                    }));

                    $quizContent.append($quizRow);
                    fieldsHelper.select2Helper.initSelect2Field($quizRow);
                });
            };

            var removeQuiz = function() {
                $courseSections.on('click', '.edgt-course-quiz-remove-item', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if(!confirm('Are you sure you want to remove this quiz?')) {
                        return;
                    }

                    var $removeButton = $(this);
                    var $parent = $removeButton.parents('.edgt-course-element');

                    $parent.remove();
                });
            };

            return {
                init: function() {
                    addNewQuiz();
                    removeQuiz();
                }
            }
        }();

        return {
            rowRepeater: rowRepeater,
            lessonRepeater: lessonRepeater,
            quizRepeater: quizRepeater,
            $courseSections: $courseSections
        }
    }();

    var fieldsHelper = function() {
        var select2Helper = function() {
            return {
                initSelect2Field: function($content) {
                    var $selectFields = $content.find('.edgt-select2');

                    if($selectFields.length) {
                        $selectFields.each(function() {
                            $(this).select2({
                                allowClear: true
                            });
                        });
                    }
                }
            };
        }();

        var sortableHelper = function() {
            return {
                initSortableField: function($content) {
                    var $sortableFields = $content.find('.edgt-sortable-holder');

                    if($sortableFields.length) {
                        $sortableFields.each(function () {
                            var sortingHolder = $(this);
                            var enableParentChild = sortingHolder.hasClass('edgt-enable-pc');
                            sortingHolder.sortable({
                                handle: '.edgt-repeater-sort',
                                cursor: 'move',
                                placeholder: "placeholder",
                                start: function(event, ui) {
                                    ui.placeholder.height(ui.item.height());
                                    if(enableParentChild) {
                                        if (ui.helper.hasClass('second-level')) {
                                            ui.placeholder.removeClass('placeholder');
                                            ui.placeholder.addClass('placeholder-sub');
                                        }
                                        else {
                                            ui.placeholder.removeClass('placeholder-sub');
                                            ui.placeholder.addClass('placeholder');
                                        }
                                    }
                                },
                                sort: function(event, ui) {
                                    if(enableParentChild) {
                                        var pos;
                                        if (ui.helper.hasClass('second-level')) {
                                            pos = ui.position.left + 50;
                                        }
                                        else {
                                            pos = ui.position.left;
                                        }
                                        if (pos >= 75 && !ui.helper.hasClass('second-level') && !ui.helper.hasClass('edgt-sort-parent')) {
                                            ui.placeholder.removeClass('placeholder');
                                            ui.placeholder.addClass('placeholder-sub');
                                            ui.helper.addClass('second-level');
                                        }
                                        else if (pos < 30 && ui.helper.hasClass('second-level') && !ui.helper.hasClass('edgt-sort-child')) {
                                            ui.placeholder.removeClass('placeholder-sub');
                                            ui.placeholder.addClass('placeholder');
                                            ui.helper.removeClass('second-level');
                                        }
                                    }
                                }
                            });
                        });
                    }
                }
            };
        }();

        return {
            select2Helper: select2Helper,
            sortableHelper: sortableHelper
        }
    }();


})(jQuery);