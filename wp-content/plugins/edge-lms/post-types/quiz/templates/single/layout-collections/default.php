<div class="edgt-quiz-single-wrapper">
    <div class="edgt-quiz-title-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/title', 'quiz'); ?>
    </div>
    <div class="edgt-quiz-info-top-wrapper">
        <?php edgt_lms_template_quiz_info_top($params); ?>
        <?php edgt_lms_template_start_quiz_button($params); ?>
    </div>
    <div class="edgt-quiz-result-wrapper">
        <?php edgt_lms_template_quiz_status($params); ?>
    </div>
    <div class="edgt-quiz-old-results-wrapper">
        <?php edgt_lms_template_quiz_results($params); ?>
    </div>
</div>