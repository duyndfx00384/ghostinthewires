<?php

/*
   Class: EducatorEdgeMultipleImages
   A class that initializes Edge LMS Course Sections
*/
class EdgefLMSCourseSectionsMetaBox implements iEducatorEdgeRender {
    private $name;
    private $label;
    private $description;

    function __construct($name, $label="", $description="") {
        global $educator_edge_Framework;
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $educator_edge_Framework->edgtMetaBoxes->addOption($this->name,"");
    }

    public function render($factory) {

        global $post;
        $rows = empty($post->ID) ? array() : get_post_meta($post->ID, 'edgt_course_curriculum', true);

        //Get list of lessons;
        $edgt_lessons = array();
        $lessons = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'lesson',
                'post_status' => 'publish',
            )
        );
        foreach ($lessons as $lesson) {
            $edgt_lessons[$lesson->ID] = $lesson->post_title;
        }

        //Get list of quizzes;
        $edgt_quizzes = array();
        $quizzes = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'quiz',
                'post_status' => 'publish'
            )
        );
        foreach ($quizzes as $quiz) {
            $edgt_quizzes[$quiz->ID] = $quiz->post_title;
        }

        ?>
        <input type="hidden" id="course_id" name="course_id" value="<?php echo esc_attr($post->ID); ?>">
        <div id="edgt-course-section-content" class="edgt-repeater-fields-holder edgt-enable-pc edgt-sortable-holder clearfix">
            <?php if(is_array($rows) && count($rows)) :
            $i = 0;
            ?>
            <?php foreach($rows as $key=>$value) : ?>
            <div class="edgt-course-section edgt-repeater-fields-row edgt-sort-parent first-level" data-index="<?php echo esc_attr($i); ?>">
                <div class="edgt-repeater-fields-row-inner">
                    <div class="edgt-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="edgt-repeater-field-item">
                        <div class="edgt-page-form-section edgt-repeater-field edgt-no-description">
                            <div class="edgt-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Name', 'edge-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control edgt-input edgt-form-element" placeholder="" value="<?php echo esc_attr($value['section_name']); ?>" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_name]">
                                            </div>
                                            <h4><?php esc_html_e('Section Title', 'edge-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control edgt-input edgt-form-element" placeholder="" value="<?php echo esc_attr($value['section_title']); ?>" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_title]">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Description', 'edge-lms'); ?></h4>
                                            <div class="form-group">
                                                <textarea type="text" rows="6" class="form-control edgt-input edgt-form-element" placeholder="" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_description]"><?php echo esc_attr($value['section_description']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edgt-sortable-holder" id="edgt-course-section-elements-<?php echo esc_attr($i); ?>">
                            <?php if(!empty($value['section_elements']) && is_array($value['section_elements']) && count($value['section_elements'])) : ?>
                                <?php $j = 0; ?>
                                <?php foreach($value['section_elements'] as $element) : ?>
                                    <?php if($element['type'] == 'lesson'): ?>
                                    <div class="edgt-course-element edgt-repeater-fields-row edgt-sort-child second-level" data-index="<?php echo esc_attr($j); ?>">
                                        <div class="edgt-repeater-fields-row-inner">
                                            <div class="edgt-repeater-sort">
                                                <i class="fa fa-sort"></i>
                                            </div>
                                            <div class="edgt-repeater-field-item">
                                                <div class="edgt-page-form-section edgt-repeater-field edgt-no-description">
                                                    <div class="edgt-section-content">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="edgt-inner-field-holder">
                                                                        <input type="hidden" value="lesson" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][type]">
                                                                        <select class="edgt-select2 form-control edgt-form-element" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][value]">
                                                                            <?php foreach($edgt_lessons as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                                                <option <?php if ($element['value'] == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="edgt-repeater-remove">
                                                <a href="#" class="edgt-course-lesson-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Section', 'edge-lms'); ?>"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php elseif($element['type'] == 'quiz'): ?>
                                    <div class="edgt-course-element edgt-repeater-fields-row edgt-sort-child second-level" data-index="<?php echo esc_attr($j); ?>">
                                        <div class="edgt-repeater-fields-row-inner">
                                            <div class="edgt-repeater-sort">
                                                <i class="fa fa-sort"></i>
                                            </div>
                                            <div class="edgt-repeater-field-item">
                                                <div class="edgt-page-form-section edgt-repeater-field edgt-no-description">
                                                    <div class="edgt-section-content">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="edgt-inner-field-holder">
                                                                        <input type="hidden" value="quiz" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][type]">
                                                                        <select class="edgt-select2 form-control edgt-form-element" name="edgt_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][value]">
                                                                            <?php foreach($edgt_quizzes as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                                                <option <?php if ($element['value'] == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="edgt-repeater-remove">
                                                <a href="#" class="edgt-course-quiz-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Section', 'edge-lms'); ?>"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php $j++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="edgt-course-section-controls">
                            <div class="edgt-repeater-add">
                                <a id="edgt-course-lesson-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Lesson', 'edge-lms'); ?></a>
                                <a id="edgt-course-quiz-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Quiz', 'edge-lms'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="edgt-repeater-remove">
                        <a href="#" class="edgt-course-section-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Section', 'edge-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <?php
            $i++;
            endforeach;
                ?>
            <?php endif; ?>
        </div>

        <div class="edgt-course-section-controls">
            <div class="edgt-repeater-add">
                <a id="edgt-course-section-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Section', 'edge-lms'); ?></a>
            </div>
        </div>

        <script type="text/html" id="tmpl-edgt-course-section-template">
            <div class="edgt-course-section edgt-repeater-fields-row edgt-sort-parent first-level" data-index="{{{ data.rowIndex }}}">
                <div class="edgt-repeater-fields-row-inner">
                    <div class="edgt-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="edgt-repeater-field-item">
                        <div class="edgt-page-form-section edgt-repeater-field edgt-no-description">
                            <div class="edgt-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Name', 'edge-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control edgt-input edgt-form-element" placeholder="" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_name]">
                                            </div>
                                            <h4><?php esc_html_e('Section Title', 'edge-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control edgt-input edgt-form-element" placeholder="" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_title]">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Description', 'edge-lms'); ?></h4>
                                            <div class="form-group">
                                                <textarea type="text" rows="6" class="form-control edgt-input edgt-form-element" placeholder="" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_description]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edgt-sortable-holder" id="edgt-course-section-elements-{{{ data.rowIndex }}}">

                        </div>
                        <div class="edgt-course-section-controls">
                            <div class="edgt-repeater-add">
                                <a id="edgt-course-lesson-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Lesson', 'edge-lms'); ?></a>
                                <a id="edgt-course-quiz-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Quiz', 'edge-lms'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="edgt-repeater-remove">
                        <a href="#" class="edgt-course-section-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Section', 'edge-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </script>

        <script type="text/html" id="tmpl-edgt-section-lesson-template">
            <div class="edgt-course-element edgt-repeater-fields-row edgt-sort-child second-level" data-index="{{{ data.lessonIndex }}}">
                <div class="edgt-repeater-fields-row-inner">
                    <div class="edgt-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="edgt-repeater-field-item">
                        <div class="edgt-page-form-section edgt-repeater-field edgt-no-description">
                            <div class="edgt-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="edgt-inner-field-holder">
                                                <input type="hidden" value="lesson" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.lessonIndex }}}][type]">
                                                <select class="edgt-select2 form-control edgt-form-element" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.lessonIndex }}}][value]">
                                                    <?php foreach($edgt_lessons as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                        <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edgt-repeater-remove">
                        <a href="#" class="edgt-course-lesson-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Lesson', 'edge-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </script>

        <script type="text/html" id="tmpl-edgt-section-quiz-template">
            <div class="edgt-course-element edgt-repeater-fields-row edgt-sort-child second-level" data-index="{{{ data.quizIndex }}}">
                <div class="edgt-repeater-fields-row-inner">
                    <div class="edgt-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="edgt-repeater-field-item">
                        <div class="edgt-page-form-section edgt-repeater-field edgt-no-description">
                            <div class="edgt-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="edgt-inner-field-holder">
                                                <input type="hidden" value="quiz" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.quizIndex }}}][type]">
                                                <select class="edgt-select2 form-control edgt-form-element" name="edgt_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.quizIndex }}}][value]">
                                                    <?php foreach($edgt_quizzes as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                        <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edgt-repeater-remove">
                        <a href="#" class="edgt-course-lesson-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_html_e('Remove Quiz', 'edge-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </script>

        <?php
    }
}