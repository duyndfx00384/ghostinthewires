<div class="edgt-lms-lesson-media">
    <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/audio', 'lesson', '', $params); ?>
</div>
<div class="edgt-lms-lesson-content-wrapper">
    <div class="edgt-lms-lesson-title">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/title', 'lesson', '', $params); ?>
    </div>
    <div class="edgt-lms-lesson-content">
        <?php the_content(); ?>
    </div>
    <div class="edgt-lms-lesson-complete">
        <?php echo edgt_lms_complete_button($params); ?>
    </div>
</div>