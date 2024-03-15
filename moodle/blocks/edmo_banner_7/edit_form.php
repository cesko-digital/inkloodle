<?php

class block_edmo_banner_7_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');
        
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Accredited Online Yoga Teacher Training
        ');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', get_string('config_btn', 'theme_edmo'));
        $mform->setDefault('config_btn', 'Join For Free');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Icon
        $select = $mform->addElement('select', 'config_icon', 'Button Icon', $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_icon', 'flaticon-user');

        // Button Link
        $mform->addElement('text', 'config_btn_link', 'Button Link');
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/course');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>');

        $mform->addElement('text', 'config_bg', 'Section Background Image URL');
        $mform->setDefault('config_bg', $CFG->wwwroot . '/theme/edmo/pix/main-banner3.jpg');
        $mform->setType('config_bg', PARAM_TEXT);

        // Shape Images
        $mform->addElement('text', 'config_bg_shape', 'Content Background Image URL');
        $mform->setDefault('config_bg_shape', $CFG->wwwroot . '/theme/edmo/pix/yoga-banner.png');
        $mform->setType('config_bg_shape', PARAM_TEXT);
        
        $mform->addElement('text', 'config_shape_img1', 'Shape Image 1 URL');
        $mform->setDefault('config_shape_img1', $CFG->wwwroot . '/theme/edmo/pix/top-img.png');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Shape Image 2 URL');
        $mform->setDefault('config_shape_img2', $CFG->wwwroot . '/theme/edmo/pix/banner-shape2.png');
        $mform->setType('config_shape_img2', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img3', 'Shape Image 3 URL');
        $mform->setDefault('config_shape_img3', $CFG->wwwroot . '/theme/edmo/pix/banner-shape3.png');
        $mform->setType('config_shape_img3', PARAM_TEXT);
    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_banner_7', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_banner_7', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
