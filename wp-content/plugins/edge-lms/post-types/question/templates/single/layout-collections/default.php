<?php
$question_slug = str_replace('_', '-', $question_type);
?>
<div class="edgt-question-single-wrapper">
    <div class="edgt-question-title-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/title', 'question', '', $params); ?>
    </div>
    <div class="edgt-question-text-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/text', 'question', '', $params); ?>
    </div>
    <div class="edgt-question-answer-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/answers', 'question', $question_slug, $params); ?>
        <?php if($question_params['show_hint'] == 'yes') { ?>
            <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/hint', 'question', '', $params); ?>
        <?php } ?>
    </div>
    <div class="edgt-question-actions-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/actions-prev-form', 'question', '', $params); ?>
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/actions-hint-form', 'question', '', $params); ?>
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/actions-check-form', 'question', '', $params); ?>
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/actions-next-form', 'question', '', $params); ?>
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/actions-finish', 'quiz', '', $params); ?>
    </div>
</div>