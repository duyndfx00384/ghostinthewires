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