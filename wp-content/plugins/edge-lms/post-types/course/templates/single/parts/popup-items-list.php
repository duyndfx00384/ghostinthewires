<?php
$course_sections = get_post_meta(get_the_ID(), 'edgt_course_curriculum', true);
if(!empty($course_sections)) { ?>
    <div class="edgt-course-popup-items">
        <div class="edgt-course-popup-items-list">
            <?php foreach($course_sections as $course_section) { ?>
                <div class="edgt-popup-items-section">
                    <h5 class="edgt-section-name">
                        <?php echo esc_html($course_section['section_name']) ?>
                    </h5>
                    <h5 class="edgt-section-title">
                        <?php echo esc_html($course_section['section_title']) ?>
                    </h5>
                    <div class="edgt-section-content">
                         <?php
                         if (isset($course_section['section_elements']) && $course_section['section_elements'] !== ''){
                            $section_elements = $course_section['section_elements'];
                            if(!empty($section_elements)) {
                                $list = edgt_lms_get_course_curriculum_list($section_elements);
                                $elements = $list['elements'];
                                $lessons_summary = $list['lessons_summary'];
                                ?>
                                <div class="edgt-section-elements">
                                    <?php if(!empty($lessons_summary)) {
                                        $lesson_info = implode(', ', $lessons_summary);
                                    ?>
                                        <div class="edgt-section-elements-summary">
                                            <i class="lnr lnr-book" aria-hidden="true"></i> <span class="edgt-summary-value"><?php echo esc_html($lesson_info); ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php foreach ($elements as $key => $element) { ?>
                                        <div class="edgt-section-element <?php echo esc_attr($element['class']); ?> clearfix <?php echo edgt_lms_get_course_item_completed_class($element['id']); ?>" data-section-element-id="<?php echo esc_attr($element['id']); ?>">
                                            <div class="edgt-element-title">
                                                <span class="edgt-element-icon">
                                                    <?php print $element['icon']; ?>
                                                </span>
                                                <span class="edgt-element-label">
                                                    <?php echo esc_attr($element['label']); ?>
                                                </span>
                                                <?php if(edgt_lms_course_is_preview_available($element['id'])) { ?>
                                                    <a class="edgt-element-name edgt-element-link-open" itemprop="url" href="<?php echo esc_attr($element['url']); ?>" title="<?php echo esc_attr($element['title']); ?>" data-item-id="<?php echo esc_attr($element['id']); ?>" data-course-id="<?php echo get_the_ID(); ?>" >
                                                        <?php echo esc_html($element['title']); ?><?php if(!edgt_lms_user_has_course() || !edgt_lms_user_completed_prerequired_course()) { ?> <span class="edgt-element-preview-holder"><?php esc_html_e('preview', 'edge-lms'); ?></span> <?php } ?>
                                                    </a>
                                                <?php } else { ?>
                                                    <?php echo esc_html($element['title']); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="edgt-element-info">
                                                <?php if($element['class'] !== 'edgt-section-quiz') {?>
                                                    <span class="edgt-element-clock-icon lnr lnr-clock"></span>
                                                <?php } ?>
                                                <span class="edgt-element-extra-info-value">
                                                    <?php echo esc_html($element['extra_info_value']); ?>
                                                </span>
                                                <span class="edgt-element-extra-info-unit">
                                                    <?php echo esc_html($element['extra_info_unit']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
