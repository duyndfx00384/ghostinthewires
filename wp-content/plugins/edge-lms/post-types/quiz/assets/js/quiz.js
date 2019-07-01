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