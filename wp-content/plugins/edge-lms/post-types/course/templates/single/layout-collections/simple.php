<div class="edgt-course-single-wrapper edgt-simple-course">
    <div class="edgt-course-title-wrapper">
        <div class="edgt-course-left-section">
            <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/title', 'course', '', $params); ?>
        </div>
        <div class="edgt-course-right-section">
            <?php edgt_lms_get_wishlist_button(); ?>
        </div>
    </div>
    <div class="edgt-course-basic-info-wrapper">
        <div class="edgt-grid-row">
            <div class="edgt-grid-col-6">
                <div class="edgt-grid-row">
                    <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/instructor', 'course', '', $params); ?>
                    <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/categories', 'course', '', $params); ?>
                </div>
            </div>
            <div class="edgt-grid-col-6">
                <div class="edgt-course-price-detail">
                    <?php
                    if(!edgt_lms_user_has_course()) { ?>
                        <div class="edgt-user-price-wrapper">
                            <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/course-type', 'course', '', $params); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="edgt-course-image-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/image', 'course', '', $params); ?>
    </div>
    <div class="edgt-course-tabs-wrapper">
        <?php edgt_lms_get_cpt_single_module_template_part('templates/single/parts/content', 'course', '', $params); ?>
    </div>
</div>