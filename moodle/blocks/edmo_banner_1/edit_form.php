<?php

class block_edmo_banner_1_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        if(isset($this->block->config->funfactsnumber)){
            $funfactsnumber = $this->block->config->funfactsnumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'The World’s Leading Distance Learning Provider');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Flexible easy to access learning opportunities can bring a significant change in how individuals prefer to learn! The Edmo can offer you to enjoy the beauty of eLearning!');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', get_string('config_btn', 'block_edmo_banner_1'));
        $mform->setDefault('config_btn', 'Join For Free');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_btn_link', get_string('config_btn_link', 'block_edmo_banner_1'));
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/course');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Button Icon
        $select = $mform->addElement('select', 'config_btn_icon', get_string('config_btn_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_btn_icon', 'flaticon-user');

        // * Courses
        $mform->addElement('text', 'config_student_title', get_string('config_student_title', 'theme_edmo'));
        $mform->setDefault('config_student_title', 'Students');
        $mform->setType('config_student_title', PARAM_RAW);

        $options = array(
            'multiple' => true,
            'noselectionstring' => get_string('select_from_dropdown_multiple', 'theme_edmo'),
        );
        $mform->addElement('course', 'config_courses', get_string('courses'), $options);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>');
            
        $mform->addElement('text', 'config_bg_img', get_string('config_bg_img', 'theme_edmo'));
        $mform->setType('config_bg_img', PARAM_TEXT);

        // Shape Images
        $shape_image_count = 3;
        for($i = 1; $i <= $shape_image_count; $i++) {
            $mform->addElement('text', 'config_shape_img' . $i, 'Banner Shape Image ' . $i);
            $mform->setType('config_shape_img' . $i, PARAM_TEXT);
        }     
    }
}
