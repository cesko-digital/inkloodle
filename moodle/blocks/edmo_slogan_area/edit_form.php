<?php

class block_edmo_slogan_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');
        
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Section Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setType('config_class', PARAM_RAW);
        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Our project management training equips learners with the knowledge and discipline required to effectively plan, manage, execute, and control projects regardless of industry. You"ll learn all about the most popular project management methodologies that help organizations deliver successful projects.');
        $mform->setType('config_body', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'William James');
        $mform->setType('config_title', PARAM_RAW);

        // Sub Title
        $mform->addElement('text', 'config_sub_title', 'Sub Title');
        $mform->setDefault('config_sub_title', 'CEO at Edmo');
        $mform->setType('config_sub_title', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        // Images
        $mform->addElement('filemanager', 'config_image', 'Section Image', null,  array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => 1, 'accepted_types' => array('.png', '.jpg', '.gif') ));

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
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_slogan_area', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_slogan_area', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
