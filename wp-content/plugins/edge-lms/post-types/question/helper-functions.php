<?php
//Register meta boxes
if(!function_exists('edgt_lms_question_meta_box_functions')) {
	function edgt_lms_question_meta_box_functions($post_types) {
		$post_types[] = 'question';
		
		return $post_types;
	}
	
	add_filter('educator_edge_meta_box_post_types_save', 'edgt_lms_question_meta_box_functions');
	add_filter('educator_edge_meta_box_post_types_remove', 'edgt_lms_question_meta_box_functions');
}

//Register question post type
if(!function_exists('edgt_lms_register_question_cpt')) {
	function edgt_lms_register_question_cpt($cpt_class_name) {
		$cpt_class = array(
			'EdgefLMS\CPT\Question\QuestionRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('edgt_lms_filter_register_custom_post_types', 'edgt_lms_register_question_cpt');
}

//Question single functions
if(!function_exists('edgt_lms_get_single_question')) {
    function edgt_lms_get_single_question() {
        edgt_lms_get_cpt_single_module_template_part('templates/single/holder', 'question', '', array());
    }
}

//Function for returning question hint
if(!function_exists('edgt_lms_check_question_hint')) {
    function edgt_lms_check_question_hint() {

        if(empty($_POST) || !isset($_POST)) {
            edgt_lms_ajax_status('error', esc_html__('All fields are empty', 'edge-lms'));
        } else {
            $data = $_POST;
            $data_string = $data['post'];
            parse_str($data_string, $data_array);
            $question_id = $data_array['edgt_lms_question_id'];
            $quiz_id = $data_array['edgt_lms_quiz_id'];
            $course_id = $data_array['edgt_lms_course_id'];
            $time_remaining = $data_array['edgt_lms_time_remaining'];
            $hint_value = get_post_meta($question_id, 'edgt_question_hint_meta', true);
            $params = array(
                'question_id' => $question_id,
                'hint_value' => $hint_value
            );

            $quiz_temp = edgt_lms_get_user_quiz_values($course_id, $quiz_id, 'edgt_user_quiz_temp');
            if($quiz_temp != '' && !empty($quiz_temp)) {
                $questions = $quiz_temp['questions'];
                $question = $questions[$question_id];
                $question['show_hint'] = 'yes';

                $questions[$question_id] = $question;
                $quiz_temp['questions'] = $questions;
                $quiz_temp['time_remaining'] = $time_remaining;
            }

            edgt_lms_set_user_quiz_values($course_id, $quiz_id, $quiz_temp, 'edgt_user_quiz_temp');

            $html = edgt_lms_cpt_single_module_template_part('templates/single/parts/hint', 'question', '', $params);
            $json_data['html'] = $html;

            edgt_lms_ajax_status('success', '', $json_data);
        }
        wp_die();
    }

    add_action('wp_ajax_edgt_lms_check_question_hint', 'edgt_lms_check_question_hint');
}

//Function for returning previous question
if(!function_exists('edgt_lms_change_question')) {
    function edgt_lms_change_question()
    {
        if(empty($_POST) || !isset($_POST)) {
            edgt_lms_ajax_status('error', esc_html__('All fields are empty', 'edge-lms'));
        } else {
            $question_params = array();
            $data = $_POST;
            $data_string = $data['post'];
            parse_str($data_string, $data_array);
            $current_question_id = $data_array['edgt_lms_question_id'];
            $question_id = $data_array['edgt_lms_change_question'];
            $quiz_id = $data_array['edgt_lms_quiz_id'];
            $course_id = $data_array['edgt_lms_course_id'];
            $time_remaining = $data_array['edgt_lms_time_remaining'];
            $retake = $data_array['edgt_lms_retake_id'];
            $answer = $data_array['edgt_lms_question_answer'];

            $quiz_temp = edgt_lms_get_user_quiz_values($course_id, $quiz_id, 'edgt_user_quiz_temp');
            if($quiz_temp != '' && !empty($quiz_temp)) {

                $quiz_temp['time_remaining'] = $time_remaining;

                $questions = $quiz_temp['questions'];

                //Update answer values of question we are navigating from
                $question = $questions[$current_question_id];
                $question['answers'] = $answer;
                $questions[$current_question_id] = $question;
                $quiz_temp['questions'] = $questions;

                //Update last question value to new question that is being loaded
                $quiz_temp['last_question'] = $question_id;

                //Load answers of question that is being loaded
                if(array_key_exists($question_id, $questions)) {
                    $question_params = $questions[$question_id];

                } else {
                    $question_params = array();
                    $question_params['show_hint'] = 'no';
                    $question_params['answer_checked'] = 'no';
                    $question_params['answers'] = '';
                    $questions[$question_id] = $question_params;
                    $quiz_temp['questions'] = $questions;
                }
            }

            edgt_lms_set_user_quiz_values($course_id, $quiz_id, $quiz_temp, 'edgt_user_quiz_temp');

            $questions = get_post_meta($quiz_id, 'edgt_quiz_question_meta', true);
            $answers = get_post_meta($question_id, 'edgt_question_answer_title_meta', true);
            $question_type = get_post_meta($question_id, 'edgt_question_type_meta', true);
            $hint_value = get_post_meta($question_id, 'edgt_question_hint_meta', true);

            $index = array_search($question_id, $questions);
            if($index !== FALSE) {
                $next_question = $index != sizeof($questions) - 1 ? $questions[$index + 1] : -1;
                $prev_question = $index != 0 ? $questions[$index - 1] : -1;
            } else {
                $next_question = -1;
                $prev_question = -1;
            }

            $previous_answers = $question_params['answers'];
            $past_answer_params = edgt_lms_validate_question($question_id, $previous_answers);

            $params = array(
                'question_id' => $question_id,
                'quiz_id' => $quiz_id,
                'course_id' => $course_id,
                'questions' => implode(',', $questions),
                'question_position' => $index + 1,
                'next_question' => $next_question,
                'prev_question' => $prev_question,
                'question_params' => $question_params,
                'answers' => $answers,
                'retake' => $retake,
                'question_type' => $question_type,
                'hint_value' => $hint_value
            );

            $html = edgt_lms_cpt_single_module_template_part('templates/single/holder', 'question', '', $params);
            $json_data['html'] = $html;
            $json_data['question_position'] = $index + 1;
            $json_data['question_id'] = $question_id;
            $json_data['answer_checked'] = $question_params['answer_checked'];
            $json_data = array_merge($json_data, $past_answer_params);

            edgt_lms_ajax_status('success', '', $json_data);
        }

        wp_die();
    }

    add_action('wp_ajax_edgt_lms_change_question', 'edgt_lms_change_question');
}

//Function for saving current question
if(!function_exists('edgt_lms_save_question')) {
    function edgt_lms_save_question() {
        if(empty($_POST) || !isset($_POST)) {
            edgt_lms_ajax_status('error', esc_html__('All fields are empty', 'edge-lms'));
        } else {
            $question_params = array();
            $data = $_POST;
            $data_string = $data['post'];
            parse_str($data_string, $data_array);
            $current_question_id = $data_array['edgt_lms_question_id'];
            $question_id = $data_array['edgt_lms_change_question'];
            $quiz_id = $data_array['edgt_lms_quiz_id'];
            $course_id = $data_array['edgt_lms_course_id'];
            $time_remaining = $data_array['edgt_lms_time_remaining'];
            $retake = $data_array['edgt_lms_retake_id'];
            $answer = $data_array['edgt_lms_question_answer'];

            $quiz_temp = edgt_lms_get_user_quiz_values($course_id, $quiz_id, 'edgt_user_quiz_temp');
            if($quiz_temp != '' && !empty($quiz_temp)) {

                $quiz_temp['time_remaining'] = $time_remaining;

                $questions = $quiz_temp['questions'];

                //Update answer values of question we are navigating from
                $question = $questions[$current_question_id];
                $question['answers'] = $answer;
                $questions[$current_question_id] = $question;
                $quiz_temp['questions'] = $questions;

                //Update last question value to save current question
                $quiz_temp['last_question'] = $current_question_id;

                //Load answers of question that is being loaded
                if(array_key_exists($question_id, $questions)) {
                    $question_params = $questions[$question_id];

                } else {
                    $question_params = array();
                    $question_params['show_hint'] = 'no';
                    $question_params['answer_checked'] = 'no';
                    $question_params['answers'] = '';
                    $questions[$question_id] = $question_params;
                    $quiz_temp['questions'] = $questions;
                }
            }

            edgt_lms_set_user_quiz_values($course_id, $quiz_id, $quiz_temp, 'edgt_user_quiz_temp');
        }

        wp_die();
    }

    add_action('wp_ajax_edgt_lms_save_question', 'edgt_lms_save_question');
}

//Function for checking if submitted answer is correct
if(!function_exists('edgt_lms_check_question_answer')) {
    function edgt_lms_check_question_answer() {

        if(empty($_POST) || !isset($_POST)) {
            edgt_lms_ajax_status('error', esc_html__('All fields are empty', 'edge-lms'));
        } else {
            $data = $_POST;
            $data_string = $data['post'];
            parse_str($data_string, $data_array);
            $question_id = $data_array['edgt_lms_question_id'];
            $course_id = $data_array['edgt_lms_course_id'];
            $quiz_id = $data_array['edgt_lms_quiz_id'];
            $time_remaining = $data_array['edgt_lms_time_remaining'];
            $answer = $data_array['edgt_lms_question_answer'];

            $quiz_temp = edgt_lms_get_user_quiz_values($course_id, $quiz_id, 'edgt_user_quiz_temp');
            if($quiz_temp != '' && !empty($quiz_temp)) {
                $questions = $quiz_temp['questions'];
                $question = $questions[$question_id];
                $question['answers'] = $answer;
                $question['answer_checked'] = 'yes';

                $questions[$question_id] = $question;
                $quiz_temp['questions'] = $questions;
                $quiz_temp['time_remaining'] = $time_remaining;
            }

            edgt_lms_set_user_quiz_values($course_id, $quiz_id, $quiz_temp, 'edgt_user_quiz_temp');

            $json_data = edgt_lms_validate_question($question_id, $answer);
            $json_data['answer_checked'] =  'yes';

            edgt_lms_ajax_status('success', '', $json_data);
        }
        wp_die();
    }

    add_action('wp_ajax_edgt_lms_check_question_answer', 'edgt_lms_check_question_answer');
}

if(!function_exists('edgt_lms_validate_question')) {
    function edgt_lms_validate_question($question_id = '', $answer = '', $calculate = false) {


        $question_type = get_post_meta($question_id, 'edgt_question_type_meta', true);
        if($question_type !== 'text') {
            $answer_titles = get_post_meta($question_id, 'edgt_question_answer_title_meta', true);
            foreach ($answer_titles as $key => $value){
                $value = preg_replace("#[[:punct:]]#", "", $value);
                $answer_titles[$key]  = str_replace(' ', '_', strtolower($value));
            }
            $answer_values = get_post_meta($question_id, 'edgt_question_answer_true_meta', true);
            $result = array();
            $original_result = array();
            $submitted_answer = explode(',', $answer);
            foreach($submitted_answer as $answer) {
                $key = array_search($answer, $answer_titles);
                if ($answer_values[$key] == 'yes') {
                    $result[$answer] = true;
                    unset($answer_titles[$key]);
                    unset($answer_values[$key]);
                } else {
                    $result[$answer] = false;
                }
            }
            foreach ($answer_titles as $key => $value) {
                if($answer_values[$key] == 'yes') {
                    $original_result[$value] = true;
                }
            }
        } else {
            $answer_text = get_post_meta($question_id, 'edgt_answers_text_meta', true);
            $formated_submitted_answer = preg_replace('/[^a-z]/', "", strtolower($answer));
            $formated_answer_text = preg_replace('/[^a-z]/', "", strtolower($answer_text));
            if($formated_answer_text === $formated_submitted_answer) {
                $result = true;
            } else {
                $result = false;
            }
            $original_result = $answer_text;
        }

        if($calculate) {
            $response = get_post_meta($question_id, 'edgt_question_mark_meta', true);
            if($question_type !== 'text') {
                foreach($result as $r) {
                    if(!$r) {
                        $response = 0;
                        break;
                    }
                }
            } else {
                if(!$result) {
                    $response = 0;
                }
            }
        } else {
            $response = array(
                'result' => $result,
                'original_result' => $original_result
            );
        }

        return $response;
    }
}