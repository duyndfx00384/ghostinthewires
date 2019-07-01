<?php

if (!function_exists('edgt_lms_map_course_meta')) {
    function edgt_lms_map_course_meta() {

        //Get list of courses;
        $edgt_courses = array();
        $courses = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'course',
                'post_status'    => 'publish'
            )
        );
        foreach ($courses as $course) {
            $edgt_courses[$course->ID] = $course->post_title;
        }

        //Get list of instructors;
        $edgt_instructors = array();
        $instructors = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'instructor',
                'post_status'    => 'publish'
            )
        );
        foreach ($instructors as $instructor) {
            $edgt_instructors[$instructor->ID] = $instructor->post_title;
        }

        if(edgt_lms_bbpress_plugin_installed()) {
            //Get list of forums;
            $edgt_forums = array();
            $forums = get_posts(
                array(
                    'numberposts' => -1,
                    'post_type' => 'forum',
                    'post_status' => 'publish',
                    'posts_per_page' => get_option('_bbp_forums_per_page', 50),
                    'ignore_sticky_posts' => true,
                    'orderby' => 'menu_order title',
                    'order' => 'ASC'
                )
            );
            foreach ($forums as $forum) {
                $edgt_forums[$forum->ID] = $forum->post_title;
            }
        }

        $meta_box = educator_edge_add_meta_box(array(
            'scope' => 'course',
            'title' => esc_html__('Course Settings', 'edge-lms'),
            'name'  => 'course_settings_meta_box'
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_show_title_area_course_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'edge-lms'),
                'description' => esc_html__('Enabling this option will show title area on your single course page', 'edge-lms'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'edge-lms'),
                    'yes' => esc_html__('Yes', 'edge-lms'),
                    'no' => esc_html__('No', 'edge-lms')
                )
            )
        );

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_instructor_meta',
            'type'        => 'selectblank',
            'label'       => esc_html__('Course Instructor', 'edge-lms'),
            'description' => esc_html__('Select instructor for this course', 'edge-lms'),
            'parent'      => $meta_box,
            'options'     => $edgt_instructors,
            'args'        => array(
                'select2' => true
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Course Type', 'edge-lms'),
            'description' => esc_html__('Set the type for this course', 'edge-lms'),
            'options'     => array(
                'default'        => esc_html__('Default', 'edge-lms'),
                'simple'  => esc_html__('Simple', 'edge-lms')
            ),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3,
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_age_restriction_meta',
            'type'        => 'text',
            'label'       => esc_html__('Course Age Restriction', 'edge-lms'),
            'description' => esc_html__('Set the age restriction for this course (it will apply only for simple course type)', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3,
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_duration_meta',
            'type'        => 'text',
            'label'       => esc_html__('Course Duration', 'edge-lms'),
            'description' => esc_html__('Set duration for course', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_curriculum_desc_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('General Curriculum Description', 'edge-lms'),
            'description' => esc_html__('Set general description of course curriculum', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name' => 'edgt_course_duration_parameter_meta',
            'type' => 'select',
            'label' => esc_html__('Course Duration Parameter', 'edge-lms'),
            'description' => esc_html__('Choose parameter for course duration', 'edge-lms'),
            'default_value' => 'minutes',
            'parent' => $meta_box,
            'options' => array(
                '' => esc_html__('Default', 'edge-lms'),
                'minutes' => esc_html__('Minutes', 'edge-lms'),
                'hours' => esc_html__('Hours', 'edge-lms'),
                'days' => esc_html__('Days', 'edge-lms'),
                'weeks' => esc_html__('Weeks', 'edge-lms'),
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_maximum_students_meta',
            'type'        => 'text',
            'label'       => esc_html__('Maximum Students', 'edge-lms'),
            'description' => esc_html__('Set maximal number of students', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_retake_number_meta',
            'type'        => 'text',
            'label'       => esc_html__('Number of Re-Takes', 'edge-lms'),
            'description' => esc_html__('Set maximal number of retakes', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(
            array(
                'name'          => 'edgt_course_featured_meta',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__( 'Featured Course', 'edge-lms' ),
                'description'   => esc_html__( 'Enable this option to set course featured', 'edge-lms' ),
                'parent'        => $meta_box
            )
        );

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_prerequired_meta',
            'type'        => 'selectblank',
            'label'       => esc_html__('Pre-Required Course', 'edge-lms'),
            'description' => esc_html__('Select course that needs to be completed before attending', 'edge-lms'),
            'parent'      => $meta_box,
            'options'     => $edgt_courses,
            'args'        => array(
                'select2' => true
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_passing_percentage_meta',
            'type'        => 'text',
            'label'       => esc_html__('Passing Percentage', 'edge-lms'),
            'description' => esc_html__('Set value required to pass the course', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_course_free_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Free Course', 'edge-lms'),
                'description' => esc_html__('Enabling this option will set course to be free', 'edge-lms'),
                'parent'      => $meta_box,
                'options' => array(
                    'no' => esc_html__('No', 'edge-lms'),
                    'yes' => esc_html__('Yes', 'edge-lms')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'no'  => '',
                        'yes' => '#edgt_course_price_container'
                    ),
                    'show' => array(
                        'no'  => '#edgt_course_price_container',
                        'yes' => ''
                    )
                )
            )
        );

        $course_price_container = educator_edge_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'course_price_container',
            'parent'          => $meta_box,
            'hidden_property' => 'edgt_course_free_meta',
            'hidden_values'   => array('yes')
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_price_meta',
            'type'        => 'text',
            'label'       => esc_html__('Price', 'edge-lms'),
            'description' => esc_html__('Set price for course', 'edge-lms'),
            'parent'      => $course_price_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_course_price_discount_meta',
            'type'        => 'text',
            'label'       => esc_html__('Discount', 'edge-lms'),
            'description' => esc_html__('Enter discount value for course', 'edge-lms'),
            'parent'      => $course_price_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        if(edgt_lms_bbpress_plugin_installed()) {
            educator_edge_add_meta_box_field(array(
                'name'        => 'edgt_course_forum_meta',
                'type'        => 'selectblank',
                'label'       => esc_html__('Course Forum', 'edge-lms'),
                'description' => esc_html__('Select forum for this course', 'edge-lms'),
                'parent'      => $meta_box,
                'options'     => $edgt_forums,
                'args'        => array(
                    'select2' => true
                )
            ));
        }

        $meta_box_curriculum = educator_edge_add_meta_box(array(
            'scope' => 'course',
            'title' => esc_html__('Course Curriculum', 'edge-lms'),
            'name'  => 'course_curriculum_meta_box'
        ));

        edgt_lms_add_meta_box_course_items_field(array(
            'name'        => 'edgt_course_curriculum',
            'label'       => esc_html__('Curriculum', 'edge-lms'),
            'description' => esc_html__('Organize lessons and quizzes into sections.', 'edge-lms'),
            'parent'      => $meta_box_curriculum
        ));

    }

    add_action('educator_edge_meta_boxes_map', 'edgt_lms_map_course_meta', 5);
}