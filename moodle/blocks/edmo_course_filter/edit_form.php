<?php

class block_edmo_course_filter_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $style = 1;
        if(isset($this->block->config->style)){
            $style = $this->block->config->style;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2', 3 => 'Style 3', 4 => 'Style 4', 5 => 'Style 5', 6 => 'Style 6', 7 => 'Style 7')); 
        $mform->setDefault('config_style', 1);
        
        // Top Title
        $mform->addElement('text', 'config_top_title', 'Top Title');
        $mform->setDefault('config_top_title', 'LEARN AT YOUR OWN PACE');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Edmo Popular Courses');
        $mform->setType('config_title', PARAM_RAW);

        // Subtitle
        $mform->addElement('text', 'config_subtitle', get_string('config_subtitle', 'theme_edmo'));
        $mform->setDefault('config_subtitle', 'Explore all of our courses and pick your suitable ones to enroll and start learning with us! We ensure that you will never regret it!');
        $mform->setType('config_subtitle', PARAM_RAW);

        // Bottom Content
        $mform->addElement('textarea', 'config_bottom_body', get_string('config_bottom_body', 'theme_edmo'));
        $mform->setDefault('config_bottom_body', 'Enjoy the top notch learning methods and achieve next level skills! You are the creator of your own career & we will guide you through that.');
        $mform->setType('config_bottom_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_button_text', get_string('config_button_text', 'theme_edmo'));
        $mform->setDefault('config_button_text', 'View All Courses');
        $mform->setType('config_button_text', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_button_link', get_string('config_button_link', 'theme_edmo'));
        $mform->setDefault('config_button_link', $CFG->wwwroot . '/course');
        $mform->setType('config_button_link', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', 'Main Button Text(for style 2 & 4)');
        $mform->setDefault('config_btn', 'View All Courses');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_btn_link', 'Main Button Link(for style 2 & 4)');
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/login/index.php');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Button Icon
        $select = $mform->addElement('select', 'config_icon', 'Main Button Icon(for style 2 & 4)', $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_icon', 'flaticon-user');

        $options = array(
            'multiple' => true,
            'noselectionstring' => get_string('select_from_dropdown_multiple', 'theme_edmo'),
        );
        $mform->addElement('course', 'config_courses', get_string('courses'), $options);

         // Courses
         $mform->addElement('text', 'config_student_title', get_string('config_student_title', 'theme_edmo'));
         $mform->setDefault('config_student_title', 'Students');
         $mform->setType('config_student_title', PARAM_RAW);

         // Shape Image URL
        $mform->addElement('text', 'config_shape_img', 'Shape Image(for style 3, 4 & 5)');
        $mform->setType('config_shape_img', PARAM_RAW);
    }
}
