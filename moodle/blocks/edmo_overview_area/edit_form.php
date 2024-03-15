<?php

class block_edmo_overview_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Section Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setType('config_class', PARAM_RAW);

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'Overview Area');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Feel Like You Are Attending Your Classes Physically!');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Edmo training programs can bring you a super exciting experience of learning through online! You never face any negative experience while enjoying your classes virtually by sitting in your comfort zone. Our flexible learning initiatives will help you to learn better and quicker than the traditional ways of learning skills.');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', get_string('config_btn', 'block_edmo_overview_area'));
        $mform->setDefault('config_btn', 'Get Started Now');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_btn_link', get_string('config_btn_link', 'block_edmo_overview_area'));
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/course');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Button Icon
        $select = $mform->addElement('select', 'config_icon', get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_icon', 'flaticon-user');

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        // Images
        $mform->addElement('filemanager', 'config_image', 'Section Image', null,  array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => 1, 'accepted_types' => array('.png', '.jpg', '.gif') ));

        // Bottom Section
        $mform->addElement('header', 'config_bottom_section', 'Bottom Section');

        // Bottom Top Title
        $mform->addElement('text', 'config_bottom_top_title', 'Bottom Top Title');
        $mform->setDefault('config_bottom_top_title', 'EDMO MOBILE APP');
        $mform->setType('config_bottom_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_bottom_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_bottom_title', 'Access From Your Mobile, Learn Any Time Any Where');
        $mform->setType('config_bottom_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_bottom_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_bottom_body', 'Edmo training programs can bring you a super exciting experience of learning through online! You never face any negative experience while enjoying your classes virtually by sitting in your comfort zone. Our flexible learning initiatives will help you to learn better and quicker than the traditional ways of learning skills.');
        $mform->setType('config_bottom_body', PARAM_RAW);

        // Bottom Section Image URL
        $mform->addElement('text', 'config_bottom_section_img_link', 'Bottom Section Image URL');
        $mform->setType('config_bottom_section_img_link', PARAM_TEXT);

        // Button Top Text
        $mform->addElement('text', 'config_bottom_top_btn', 'Left Button Top Title');
        $mform->setDefault('config_bottom_top_btn', 'GET IT ON');
        $mform->setType('config_bottom_top_btn', PARAM_RAW);

        // Button Icon Image URL
        $mform->addElement('text', 'config_bottom_img_link', 'Left Button Icon');
        $mform->setType('config_bottom_img_link', PARAM_TEXT);

        // Button Text
        $mform->addElement('text', 'config_bottom_btn', 'Left Button Text');
        $mform->setDefault('config_bottom_btn', 'Google Play');
        $mform->setType('config_bottom_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_bottom_btn_link', get_string('config_btn_link', 'block_edmo_overview_area'));
        $mform->setDefault('config_bottom_btn_link', '#');
        $mform->setType('config_bottom_btn_link', PARAM_RAW);

        // Right Button Top Text
        $mform->addElement('text', 'config_right_bottom_top_btn', 'Right Button Top Title');
        $mform->setDefault('config_right_bottom_top_btn', 'GET IT ON');
        $mform->setType('config_right_bottom_top_btn', PARAM_RAW);

        // Right Button Icon Image URL
        $mform->addElement('text', 'config_right_bottom_img_link', 'Right Button Icon');
        $mform->setType('config_right_bottom_img_link', PARAM_TEXT);

        // Right Button Text
        $mform->addElement('text', 'config_right_bottom_btn', 'Right Button Text');
        $mform->setDefault('config_right_bottom_btn', 'Apple Store');
        $mform->setType('config_right_bottom_btn', PARAM_RAW);

        // Right Button Link
        $mform->addElement('text', 'config_right_bottom_btn_link', get_string('config_btn_link', 'block_edmo_overview_area'));
        $mform->setDefault('config_right_bottom_btn_link', $CFG->wwwroot . '/course');
        $mform->setType('config_right_bottom_btn_link', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 
            
        // Shape Images
        $mform->addElement('text', 'config_shape_img1', 'Shape Image 1 URL');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Shape Image 2 URL');
        $mform->setType('config_shape_img2', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img3', 'Shape Image 3 URL');
        $mform->setType('config_shape_img3', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img4', 'Shape Image 4 URL');
        $mform->setType('config_shape_img4', PARAM_TEXT);
    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_overview_area', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_overview_area', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
